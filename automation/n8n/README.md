# Réponse automatique aux demandes de devis (n8n)

Objectif : quand un client envoie une demande via le configurateur eFoil, une
réponse **personnalisée selon le modèle exact choisi** (8 variantes, voir
`email-templates.md`) est préparée automatiquement, validée par un humain par
email, puis envoyée au client. Si le client répond ensuite, le message est
transféré à la boîte contact (`contact@efoilcotedazur.com`).

## Comment ça se branche sur le code existant

`wp-content/themes/atelier-child/configurator/ajax-handler.php` envoie déjà,
à chaque soumission du configurateur, une notification à 4 adresses dont
`devis-lift@gmail.com` (placeholder — **à remplacer par la vraie boîte Gmail
dédiée une fois créée**, ici et dans les credentials n8n).

Cette notification contient déjà tout ce qu'il faut :
- Sujet toujours préfixé par `📧 Nouvelle demande de devis Lift -`
- `Reply-To` n'est PAS celui du client sur cette notification (elle part avec
  les en-têtes du site), mais le corps du mail contient une ligne
  `Email : {email du client}` — c'est cette ligne que le workflow parse pour
  savoir à qui envoyer la réponse.
- Le corps contient aussi une ligne `ModeleID : {slug}` (ex. `lift-5-44`) —
  c'est cet identifiant stable, pas le libellé affiché `Modèle : LIFT5 4'4"
  PRO`, qui sert à choisir le bon texte : le libellé contient des apostrophes
  et guillemets qui compliquent inutilement le parsing/matching.

Donc dans la boîte dédiée, deux types de mails arrivent :
1. Les notifications de nouvelle demande (sujet reconnaissable) → à traiter.
2. Les réponses des clients à l'email générique qu'on leur aura envoyé
   (puisque cet email générique part *depuis* la boîte dédiée) → à transférer
   vers `contact@efoilcotedazur.com`.

## 1. Déployer n8n sur Coolify

1. Coolify → **New Resource → Services → n8n** (template officiel, pas besoin
   d'écrire de docker-compose).
2. Attacher un sous-domaine, ex. `n8n.efoilcotedazur.com` — Coolify gère le
   certificat SSL automatiquement.
3. Vérifier les variables d'environnement du service :
   - `N8N_ENCRYPTION_KEY` : générée automatiquement par Coolify, ne pas
     changer une fois définie (sinon les credentials existants deviennent
     illisibles).
   - `WEBHOOK_URL` : doit être l'URL publique du sous-domaine (indispensable
     pour que le bouton "Approuver" dans l'email de validation fonctionne).
4. Démarrer le service, ouvrir l'URL, créer le compte admin n8n.

## 2. Créer la boîte Gmail dédiée

1. Créer le compte Gmail (ex. `devis-lift@gmail.com`), activer la 2FA.
2. Dans n8n : **Credentials → New → Gmail OAuth2 API**. Suivre le flow OAuth
   (nécessite un projet Google Cloud avec l'API Gmail activée — le formulaire
   de credential n8n donne le lien direct et les redirect URLs à coller dans
   Google Cloud Console).
3. Remplacer `devis-lift@gmail.com` par la vraie adresse dans
   `ajax-handler.php` (recherche `boîte dédiée surveillée par le workflow`).

## 3. Construire le workflow

### Node 1 — Gmail Trigger
- Poll every 1 minute.
- Simple: **off** (pour récupérer le corps complet du mail).

### Node 2 — IF (nouvelle demande vs réponse client)
- Condition : `{{$json.subject}}` **contains**
  `📧 Nouvelle demande de devis Lift`

**Branche FAUX (réponse client) :**

### Node 3 — Gmail: Send Message (forward)
- To: `contact@efoilcotedazur.com`
- Subject: `Fwd: {{$json.subject}}`
- Message: `{{$json.text}}` (+ mentionner l'expéditeur d'origine
  `{{$json.from.value[0].address}}`)

**Branche VRAI (nouvelle demande) :**

### Node 4 — Set (extraire les infos)
- `clientEmail` = `{{$json.text.match(/Email\s*:\s*(\S+@\S+)/)?.[1]}}`
- `clientNom` = `{{$json.text.match(/Nom\s*:\s*(.+)/)?.[1]}}`
- `modeleId` = `{{$json.text.match(/ModeleID\s*:\s*(\S+)/)?.[1]}}`
- `modele` = `{{$json.text.match(/Modèle\s*:\s*(.+)/)?.[1]}}`

### Node 5 — Switch (texte selon `modeleId`)
- Mode: **Rules**, une sortie par valeur de `modeleId` : `lift-x-43`,
  `lift-x-48`, `lift-x-52`, `lift-5-44`, `lift-5-49`, `lift-5-54`,
  `lift-5f-49`, `lift-5f-54`.
- Chaque sortie va vers un node **Set** qui pose `emailBody` avec le texte
  correspondant depuis `email-templates.md` (variables `{{clientNom}}` /
  `{{modele}}` remplacées par une expression n8n).
- Fallback (aucune règle matchée, ex. nouveau modèle ajouté au configurateur
  sans template) : `emailBody` = texte générique de secours, à rédiger toi
  aussi — le workflow ne doit jamais planter faute de template.
- Tous les Set convergent ensuite vers le même node 6 (merge implicite : ils
  pointent vers le même node suivant).

### Node 6 — Gmail: Send and Wait for Approval
- To: ton adresse de validation (email choisi précédemment).
- Subject: `Valider la réponse à {{$json.clientNom}} ({{$json.modele}})`
- Message: `{{$json.emailBody}}` (déjà personnalisé par le Switch).
- Approval options : **Approve and Disapprove**.

> ⚠️ Il existe des bugs communautaires connus où ce node reste bloqué en
> "Waiting" (voir forum n8n). Si ça arrive régulièrement, remplacer ce node
> par : Gmail (Send Message, envoie le brouillon) + **Wait node** + un
> **Form Trigger** séparé exposant un bouton Approuver/Modifier — plus
> verbeux à configurer mais plus fiable.

### Node 7 — IF (approuvé ?)
- Condition sur la sortie du node 6 (`{{$json.data.approved}}`).

**Branche VRAI :**

### Node 8 — Gmail: Send Message
- To: `{{$('Set').item.json.clientEmail}}`
- Subject: `Votre demande de devis {{$('Set').item.json.modele}}`
- Message: `{{$('Set').item.json.emailBody}}` (le texte personnalisé validé).

**Branche FAUX :** rien (ou notifier que ce n'est pas parti).

## 4. Marquer comme lu

Ajouter un node **Gmail: Mark as Read** à la fin de chaque branche pour ne
pas retraiter le même mail au prochain polling.

## Pourquoi cette architecture

- **Boîte dédiée** plutôt que boîte perso : le bot n'a accès qu'à cette
  boîte, l'audit est propre, et "tout ce qui n'est pas une notif = une
  réponse client" devient une règle triviale.
- **Validation humaine par email** : pas d'outil supplémentaire à installer,
  cohérent avec le choix fait pour ce projet.
- **Parsing du corps plutôt que des headers** : le format du corps est
  entièrement défini par `ajax-handler.php`, donc stable et sous contrôle —
  contrairement aux headers Gmail qui peuvent varier.
