# Réponse aux demandes de devis avec page de validation (n8n)

Le workflow prêt à importer est **`workflow.json`**.

## Le parcours

1. **Le client remplit le configurateur.** Il reçoit immédiatement l'accusé
   de réception envoyé par WordPress (`ajax-handler.php`) : *« Votre demande
   de devis Lift a bien été reçue… Nous vous recontacterons sous 24h »*.
   Rien à valider, ça part tout de suite.
2. **Nico reçoit un email** dans la boîte de son choix, contenant :
   le récap complet de la demande, le texte exact qui sera envoyé au client
   (choisi selon le modèle configuré), et **un lien vers une page
   d'édition**. Rien n'est encore parti chez le client.
3. **Nico ouvre la page.** Le sujet et le texte y sont déjà pré-remplis et
   modifiables. Il corrige si besoin, puis choisit **Envoyer le mail** ou
   **Annuler**.
4. **Le client reçoit le texte validé** — celui que Nico a effectivement
   laissé dans la page, modifications comprises.

Si le client répond ensuite, son message arrive dans la boîte dédiée et est
transféré automatiquement à `contact@efoilcotedazur.com`.

Le client reçoit donc deux emails, avec des sujets volontairement différents
pour qu'il ne les prenne pas pour un doublon : l'accusé de réception
immédiat, puis *« Votre configuration {modèle} — notre proposition »*.

## Comment ça se branche sur le code existant

`wp-content/themes/atelier-child/configurator/ajax-handler.php` envoie, à
chaque soumission, une notification à 4 adresses dont `devis-lift@gmail.com`
(placeholder — **à remplacer par la vraie boîte Gmail dédiée**, ici et dans
les credentials n8n).

Le workflow lit cette notification et en extrait :
- Sujet préfixé par `📧 Nouvelle demande de devis Lift -` → distingue une
  nouvelle demande d'une réponse client.
- Ligne `Email : {email du client}` → destinataire de la réponse.
- Ligne `ModeleID : {slug}` (ex. `lift-5-44`) → sélectionne le texte. On
  utilise cet identifiant stable plutôt que le libellé affiché
  (`Modèle : LIFT5 4'4" PRO`), dont les apostrophes et guillemets
  compliqueraient le matching.

> La notification porte aussi un `Reply-To` égal à l'adresse du client. On ne
> s'en sert pas : le parsing du corps donne en plus le nom et le modèle. Mais
> si tu débugges, `$json.replyTo` contient bien l'adresse du client.

Dans la boîte dédiée, deux types de mails arrivent :
1. Les notifications de nouvelle demande → workflow de validation.
2. Tout le reste, essentiellement les réponses des clients → transféré à
   `contact@efoilcotedazur.com`.

### Sécurité du parsing

Les regex du node Code sont **ancrées en début de ligne** (`^…$` avec le flag
`m`). Ce n'est pas cosmétique : sans l'ancrage, un client qui saisit
`Bob Email : pirate@exemple.com` comme **nom** ferait partir la réponse chez
le pirate, la première occurrence de `Email :` dans le corps étant celle-là.
Aucun retour à la ligne n'est nécessaire, donc `sanitize_text_field` côté PHP
ne suffit pas — c'est l'ancrage qui protège. Ne retire pas les `^` / `$` /
`/m`. `test-parsing.js` couvre ce cas.

En complément, `ajax-handler.php` sanitize aussi les valeurs de `$config`,
qui arrivaient brutes de `$_POST`.

## 0. Prise en main n8n (si tu ne connais pas l'interface)

n8n est un éditeur visuel : un workflow = une suite de **nodes** reliés par
des flèches, chaque node faisant une action.

- **Importer** : menu `…` en haut à droite → **Import from File…** →
  `workflow.json`. C'est la façon de démarrer, plutôt que de reconstruire les
  nodes à la main.
- **Configurer un node** : double-clic → panneau à droite.
- **Expressions** : un champ commençant par `=` est une expression.
  `{{$json.xxx}}` lit la donnée reçue par ce node ;
  `{{$('Nom du node').item.json.xxx}}` va chercher une valeur produite plus
  tôt par un node précis.
- **Tester un node isolément** : bouton ▶ sur le node.
- **Tester tout le workflow** : "Execute Workflow" en haut.
- **Activer** : bascule "Active" en haut à droite. Désactivé, le Trigger ne
  se déclenche jamais seul.

## 1. Déployer n8n sur Coolify

Coolify → **New Resource → Services → n8n**, attacher un sous-domaine (SSL
auto via Let's Encrypt), puis vérifier deux variables d'environnement :

- **`WEBHOOK_URL` doit valoir l'URL publique du sous-domaine.** C'est la plus
  importante ici : c'est elle qui construit le lien de la page d'édition
  envoyé à Nico. Mal réglée, le lien pointe dans le vide.
- `N8N_ENCRYPTION_KEY` : générée au premier démarrage, ne plus jamais la
  changer (sinon les credentials enregistrés deviennent illisibles).

## 2. Créer la boîte Gmail dédiée et son credential OAuth2

1. Créer le compte Gmail (ex. `devis-lift@gmail.com`), activer la 2FA
   (obligatoire pour la suite).
2. **Projet Google Cloud** : https://console.cloud.google.com/ → sélecteur de
   projet → **New Project** → nommer (ex. "efoil-n8n").
3. **Activer l'API Gmail** : ☰ → **APIs & Services → Library** → "Gmail API"
   → **Enable**.
4. **Écran de consentement OAuth** : **APIs & Services → OAuth consent
   screen** → User Type **External** → nom de l'app, email de support et de
   contact. Sur l'écran **Test users**, ajouter l'adresse Gmail dédiée
   elle-même — sinon elle ne pourra pas s'authentifier.
5. **Identifiants OAuth2** : **Credentials → Create Credentials → OAuth
   client ID** → type **Web application**. Pour **Authorized redirect
   URIs** : ouvrir d'abord dans n8n **Credentials → New → Gmail OAuth2 API**,
   n8n y affiche l'URL exacte à copier (de la forme
   `https://n8n.tondomaine.com/rest/oauth2-credential/callback`). Coller dans
   Google Cloud → **Create** → récupérer **Client ID** et **Client Secret** →
   les coller dans n8n → **Connect my account**.

> Tant que l'app Google reste en mode "Testing", le token OAuth expire au
> bout de 7 jours et il faut se reconnecter dans n8n. Le scope Gmail utilisé
> ici étant sensible, publier l'app déclenche une vérification Google. En
> attendant, la reconnexion manuelle est le fallback.

## 3. Importer et compléter le workflow

| Où | Quoi |
|---|---|
| Les 4 nodes Gmail | Sélectionner le credential Gmail créé à l'étape 2 |
| Node **Preparer la reponse** | Remplacer les 8 `[A REMPLIR - …]` + le texte de secours par les vrais textes (voir `email-templates.md`) |
| Node **Prevenir Nico** | Remplacer `NICO@a-remplir.com` par son adresse |
| `ajax-handler.php` | Remplacer `devis-lift@gmail.com` par la vraie adresse |

### Ce que fait le workflow

```
Gmail Trigger (is:unread)
  └─ Marquer comme lu
      └─ Nouvelle demande ?
          ├─ oui → Preparer la reponse   (Code : parsing, choix du texte, lien)
          │         └─ Prevenir Nico     (email : récap + texte + lien)
          │             └─ Attendre la validation   (page d'édition)
          │                 └─ Envoyer ?
          │                     ├─ "Envoyer le mail" → Envoyer au client
          │                     └─ "Annuler" → stop
          └─ non → Transferer au contact
```

### Modifier le workflow

`workflow.json` est **généré** par `build-workflow.py`. Pour changer quelque
chose durablement, édite le script Python puis relance :

```
python automation/n8n/build-workflow.py
node automation/n8n/test-parsing.js
```

Le test extrait le code du node depuis `workflow.json` et l'exécute avec les
variables n8n simulées — il ne peut donc pas diverger du workflow réel.

Éditer directement dans l'interface n8n reste évidemment possible pour
ajuster à chaud, mais pense à reporter le changement dans le script, sinon la
prochaine génération l'écrasera.

## 4. Points de conception à ne pas défaire

**Le filtre `is:unread` + « Marquer comme lu » placé tout en haut** est le
garde-fou anti-doublon. Le Gmail Trigger a des bugs de doublons documentés
(n8n issue #10470) et il ne déduplique **pas** par statut lu/non-lu — il suit
les IDs de messages. Le couple filtre + marquage précoce, lui, déduplique
vraiment.

Le marquage doit rester **avant** l'attente de validation. Sinon, pendant que
la page attend Nico (potentiellement des jours), le mail reste non lu et
chaque poll d'une minute relance un cycle → une avalanche d'emails de
validation. Contrepartie assumée : si le workflow plante en cours de route,
le mail est déjà marqué lu et ne sera pas rejoué — mais la notification est
aussi partie vers les 3 autres adresses, donc rien n'est perdu.

**Le lien d'édition est calculé dans le node Code**, pas directement dans le
node Gmail. `$execution.resumeFormUrl` est documenté comme disponible dans le
node Code ; sa disponibilité dans une expression de node classique est
ambiguë selon les sources. Le calculer dans le Code node fonctionne dans les
deux cas.

**La page est pré-remplie via le paramètre `defaultValue` des champs**, pas
via des query parameters d'URL. C'est délibéré : le pré-remplissage par query
parameters ne fonctionne qu'en mode production dans n8n, jamais en mode test
— on ne pourrait donc pas tester la page avant activation.

**Le node « Envoyer au client » lit le texte du formulaire**
(`$('Attendre la validation')`), pas le brouillon d'origine. C'est ce qui
fait que les modifications de Nico sont réellement prises en compte ; le
script de génération vérifie ce point automatiquement.

**Le `Reply-To` du node « Transferer au contact »** vaut l'expéditeur
d'origine. Sans lui, répondre au transfert depuis `contact@` renverrait vers
la boîte devis au lieu du client.

`appendAttribution: false` est positionné sur tous les envois, sinon n8n
ajoute « sent automatically with n8n » en bas des emails clients.

## 5. Tester avant d'activer

1. Workflow **désactivé**, remplir une vraie demande sur le configurateur
   avec ta propre adresse comme email client.
2. **Execute Workflow** dans n8n → le Trigger récupère la notification.
3. Ouvrir le node **Preparer la reponse** et vérifier sa sortie :
   `clientEmail` = ton adresse, `modeleId` = le bon slug, `aTemplate` =
   `true` (si `false`, le modèle n'a pas de texte et le secours est utilisé),
   et `lienEdition` doit être une vraie URL sur ton domaine n8n — pas
   `undefined`, ce qui signalerait un `WEBHOOK_URL` mal réglé.
4. Vérifier que l'email arrive chez Nico, cliquer le lien, vérifier que le
   sujet et le texte sont bien pré-remplis et modifiables.
5. Modifier volontairement le texte, choisir **Envoyer le mail**, et vérifier
   que le client reçoit bien la version modifiée.
6. Refaire un tour en choisissant **Annuler** : rien ne doit partir.
7. Répondre à l'email client et relancer → il doit partir vers `contact@`
   avec le bon `Reply-To`.
8. Seulement ensuite : basculer **Active**.

> Tant que Nico n'a pas répondu, l'exécution reste en statut « Waiting » dans
> n8n — c'est normal. Si tu veux qu'elle expire au bout d'un délai plutôt que
> d'attendre indéfiniment, active **Limit Wait Time** dans les options du
> node « Attendre la validation » ; un dépassement n'enverra rien au client,
> puisque le test « Envoyer ? » ne laisse passer que la valeur exacte
> `Envoyer le mail`.

## Statut de vérification

`workflow.json` est validé automatiquement à la génération (JSON bien formé,
noms de nodes uniques, connexions cohérentes, toute référence `$('Node')`
pointant vers un node existant, envoi client branché sur le formulaire), et
`test-parsing.js` exécute le vrai code du node contre le corps réellement
produit par `ajax-handler.php`.

En revanche il **n'a pas été importé dans une instance n8n réelle**. Les
formes de paramètres viennent de la documentation et du code source n8n ;
selon ta version, un `typeVersion` de node peut demander un ajustement à
l'import — n8n le signale alors clairement.
