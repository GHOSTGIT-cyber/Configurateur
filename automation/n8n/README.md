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

## 0. Prise en main n8n (si tu ne connais pas l'interface)

n8n est un éditeur visuel : un workflow = une suite de **nodes** (rectangles)
reliés par des flèches, chaque node fait une action (déclencher, filtrer,
transformer, envoyer un email...).

- **Ajouter un node** : clic sur le `+` (soit flottant sur le canvas, soit à
  la sortie d'un node existant en survolant le petit `+` sur la flèche) →
  taper le nom du node dans la barre de recherche (ex. "Gmail", "IF",
  "Switch") → cliquer dessus. Il apparaît sur le canvas.
- **Connecter deux nodes** : cliquer-glisser depuis le petit rond à droite
  d'un node vers le rond à gauche d'un autre. Une flèche indique le sens du
  flux de données.
- **Configurer un node** : double-clic dessus, ça ouvre un panneau à droite
  avec les champs (Resource, Operation, To, Subject, Message...). Chaque
  champ peut être une valeur fixe ou une **expression**.
- **Expressions** : cliquer sur la petite icône `fx` (ou taper directement)
  à côté d'un champ, entourer le code de `{{ }}`. `{{$json.xxx}}` lit le
  champ `xxx` de la donnée reçue par ce node. `{{$('NomDuNode').item.json.xxx}}`
  va chercher une valeur produite plus tôt dans le workflow par un node
  précis (utile après un Switch/IF qui a plusieurs branches).
- **Tester un node isolément** : bouton "Execute step" / l'icône ▶ sur le
  node lui-même (pas besoin de lancer tout le workflow). Le résultat
  s'affiche dans un panneau en bas — utile pour vérifier qu'une expression
  regex extrait bien ce qu'on veut avant de brancher la suite.
- **Tester tout le workflow** : bouton "Execute Workflow" en haut. Pour un
  Trigger comme Gmail, ça va chercher les derniers emails réels reçus — donc
  teste avec un vrai email de test envoyé à la boîte dédiée plutôt que
  d'inventer des données.
- **Activer le workflow** : bascule "Active" en haut à droite. Tant qu'elle
  est désactivée, le Trigger ne se déclenche jamais tout seul, seulement
  via "Execute Workflow" manuel.

## 1. Déployer n8n sur Coolify

Cette étape est faite directement via l'API Coolify (token fourni), pas
besoin de suivre un tuto manuel — voir le résultat du déploiement dans la
suite de la conversation. Pour référence si tu dois refaire ça un jour sans
moi : Coolify → **New Resource → Services → n8n**, attacher un sous-domaine
(SSL auto via Let's Encrypt), vérifier que `WEBHOOK_URL` correspond bien à
l'URL publique du sous-domaine (sinon le bouton "Approuver" de l'email de
validation ne fonctionnera pas), démarrer le service.

## 2. Créer la boîte Gmail dédiée et son credential OAuth2

1. Créer le compte Gmail (ex. `devis-lift@gmail.com`), activer la 2FA
   (obligatoire pour la suite).
2. **Créer un projet Google Cloud** :
   - Aller sur https://console.cloud.google.com/ (connecté avec le compte
     Gmail dédié).
   - En haut, sélecteur de projet → **New Project** → nommer (ex.
     "efoil-n8n") → **Create**.
3. **Activer l'API Gmail** :
   - Menu ☰ → **APIs & Services → Library**.
   - Chercher "Gmail API" → l'ouvrir → **Enable**.
4. **Configurer l'écran de consentement OAuth** :
   - **APIs & Services → OAuth consent screen**.
   - User Type : **External** (sauf si Google Workspace : **Internal**
     possible).
   - Renseigner nom de l'app (ex. "eFoil Devis Bot"), email de support,
     email de contact développeur → **Save and Continue** sur les écrans
     suivants (scopes et test users peuvent rester par défaut à ce stade).
   - Sur l'écran **Test users**, ajouter l'adresse Gmail dédiée elle-même —
     tant que l'app n'est pas publiée, seuls les comptes listés ici peuvent
     s'authentifier.
5. **Créer les identifiants OAuth2** :
   - **APIs & Services → Credentials → Create Credentials → OAuth client
     ID**.
   - Application type : **Web application**.
   - **Authorized redirect URIs** : dans n8n, ouvrir
     **Credentials → New → Gmail OAuth2 API**, n8n affiche l'URL de
     redirection exacte à copier (ressemble à
     `https://n8n.efoilcotedazur.com/rest/oauth2-credential/callback`) —
     la coller ici dans Google Cloud, puis **Create**.
   - Google donne un **Client ID** et un **Client Secret** : les copier dans
     le formulaire de credential n8n, puis **Connect my account** — ça ouvre
     une fenêtre Google classique de connexion/autorisation.
6. Remplacer `devis-lift@gmail.com` par la vraie adresse dans
   `ajax-handler.php` (recherche `boîte dédiée surveillée par le workflow`).

> Tant que l'app Google Cloud est en mode "Testing" (non publiée), le token
> OAuth expire au bout de 7 jours et il faut se reconnecter dans n8n. Pour
> un usage permanent, publier l'app (**OAuth consent screen → Publish App**)
> — Google peut demander une vérification si les scopes sont sensibles,
> mais le scope Gmail utilisé ici (envoi/lecture) déclenche cette
> vérification ; en attendant la validation, la reconnexion manuelle tous
> les 7 jours reste le fallback.

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
