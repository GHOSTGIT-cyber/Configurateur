# Réponse automatique aux demandes de devis (n8n)

Quand un client envoie une demande via le configurateur eFoil, une réponse
**personnalisée selon le modèle exact choisi** (8 variantes, voir
`email-templates.md`) est préparée automatiquement, validée par un humain par
email, puis envoyée au client. Si le client répond ensuite, le message est
transféré à la boîte contact (`contact@efoilcotedazur.com`).

Le workflow prêt à importer est dans **`workflow.json`**.

## Les deux emails que reçoit le client

C'est voulu, et l'ordre compte :

1. **Immédiat** — l'accusé de réception envoyé par WordPress
   (`ajax-handler.php`) : *« Votre demande de devis Lift a bien été reçue…
   Nous vous recontacterons sous 24h »*. Il part tout de suite, sans
   validation.
2. **Après ta validation** — la réponse détaillée envoyée par n8n :
   *« Votre configuration {modèle} — notre proposition »*. C'est celle dont
   le contenu dépend du modèle choisi.

Les sujets sont volontairement différents pour que le client ne les prenne
pas pour un doublon.

## Comment ça se branche sur le code existant

`wp-content/themes/atelier-child/configurator/ajax-handler.php` envoie, à
chaque soumission, une notification à 4 adresses dont `devis-lift@gmail.com`
(placeholder — **à remplacer par la vraie boîte Gmail dédiée**, ici et dans
les credentials n8n).

Le workflow lit cette notification et en extrait ce dont il a besoin :
- Sujet toujours préfixé par `📧 Nouvelle demande de devis Lift -` → c'est ce
  qui distingue une nouvelle demande d'une réponse client.
- Ligne `Email : {email du client}` → destinataire de la réponse.
- Ligne `ModeleID : {slug}` (ex. `lift-5-44`) → sélectionne le texte. On
  utilise cet identifiant stable plutôt que le libellé affiché
  (`Modèle : LIFT5 4'4" PRO`), dont les apostrophes et guillemets
  compliqueraient le matching.

> La notification porte aussi un `Reply-To` égal à l'adresse du client
> (`ajax-handler.php`, en-têtes de `wp_mail`). On ne s'en sert pas : le
> parsing du corps donne en plus le nom et le modèle, donc autant tout lire
> au même endroit. Mais si tu débugges, sache que `$json.replyTo` contient
> bien l'adresse du client.

Donc dans la boîte dédiée, deux types de mails arrivent :
1. Les notifications de nouvelle demande (sujet reconnaissable) → à traiter.
2. Tout le reste, essentiellement les réponses des clients à l'email envoyé
   par n8n (qui part *depuis* la boîte dédiée) → transféré à
   `contact@efoilcotedazur.com`.

### Sécurité du parsing

Les regex du node Code sont **ancrées en début de ligne** (`^…$` avec le
flag `m`). Ce n'est pas cosmétique : sans l'ancrage, un client qui saisit
`Bob Email : pirate@exemple.com` comme **nom** ferait partir la réponse chez
le pirate, parce que la première occurrence de `Email :` trouvée dans le
corps serait celle-là. Aucun retour à la ligne n'est nécessaire, donc
`sanitize_text_field` côté PHP ne suffit pas à s'en protéger — c'est
l'ancrage qui protège. Ne retire pas les `^` / `$` / `/m`.

En complément, `ajax-handler.php` sanitize désormais aussi les valeurs de
`$config` (elles arrivaient brutes de `$_POST`).

## 0. Prise en main n8n (si tu ne connais pas l'interface)

n8n est un éditeur visuel : un workflow = une suite de **nodes** (rectangles)
reliés par des flèches, chaque node fait une action (déclencher, filtrer,
transformer, envoyer un email...).

- **Importer un workflow** : menu `…` en haut à droite → **Import from
  File…** → choisir `workflow.json`. C'est la façon de démarrer ici, plutôt
  que de reconstruire les nodes à la main.
- **Configurer un node** : double-clic dessus, ça ouvre un panneau à droite
  avec les champs. Chaque champ peut être une valeur fixe ou une
  **expression**.
- **Expressions** : un champ qui commence par `=` est une expression.
  `{{$json.xxx}}` lit le champ `xxx` de la donnée reçue par ce node.
  `{{$('Nom du node').item.json.xxx}}` va chercher une valeur produite plus
  tôt par un node précis.
- **Tester un node isolément** : bouton ▶ sur le node. Le résultat s'affiche
  en bas — indispensable pour vérifier que le node Code extrait bien le bon
  email avant de brancher la suite.
- **Tester tout le workflow** : bouton "Execute Workflow" en haut. Le Gmail
  Trigger ira chercher un vrai email non lu — envoie-toi donc une vraie
  demande de test depuis le configurateur.
- **Activer** : bascule "Active" en haut à droite. Tant qu'elle est
  désactivée, le Trigger ne se déclenche jamais tout seul.

## 1. Déployer n8n sur Coolify

Coolify → **New Resource → Services → n8n**, attacher un sous-domaine (SSL
auto via Let's Encrypt), puis vérifier deux variables d'environnement :

- `WEBHOOK_URL` doit valoir l'URL publique du sous-domaine. **Sans ça, les
  boutons Approuver/Refuser de l'email de validation ne fonctionnent pas** :
  ils pointent vers cette URL.
- `N8N_ENCRYPTION_KEY` : générée au premier démarrage, ne plus jamais la
  changer (sinon les credentials enregistrés deviennent illisibles).

## 2. Créer la boîte Gmail dédiée et son credential OAuth2

1. Créer le compte Gmail (ex. `devis-lift@gmail.com`), activer la 2FA
   (obligatoire pour la suite).
2. **Créer un projet Google Cloud** : https://console.cloud.google.com/ →
   sélecteur de projet → **New Project** → nommer (ex. "efoil-n8n").
3. **Activer l'API Gmail** : ☰ → **APIs & Services → Library** → chercher
   "Gmail API" → **Enable**.
4. **Écran de consentement OAuth** : **APIs & Services → OAuth consent
   screen** → User Type **External** → renseigner nom de l'app, email de
   support et de contact. Sur l'écran **Test users**, ajouter l'adresse Gmail
   dédiée elle-même — sinon elle ne pourra pas s'authentifier.
5. **Identifiants OAuth2** : **Credentials → Create Credentials → OAuth
   client ID** → type **Web application**. Pour le champ **Authorized
   redirect URIs** : ouvrir d'abord dans n8n **Credentials → New → Gmail
   OAuth2 API**, n8n y affiche l'URL exacte à copier (de la forme
   `https://n8n.tondomaine.com/rest/oauth2-credential/callback`). Coller
   dans Google Cloud → **Create** → récupérer **Client ID** et **Client
   Secret** → les coller dans n8n → **Connect my account**.

> Tant que l'app Google reste en mode "Testing", le token OAuth expire au
> bout de 7 jours et il faut se reconnecter dans n8n. Le scope Gmail utilisé
> ici est considéré comme sensible par Google, donc publier l'app déclenche
> une procédure de vérification. En attendant, la reconnexion manuelle est le
> fallback.

## 3. Importer et compléter le workflow

Importer `workflow.json`, puis remplir ce qui est marqué à remplir :

| Où | Quoi |
|---|---|
| Tous les nodes Gmail (4) | Sélectionner le credential Gmail créé à l'étape 2 |
| Node **Préparer la réponse** | Remplacer les 8 `[A REMPLIR - …]` + le texte de secours par les vrais textes (voir `email-templates.md`) |
| Node **Demander validation** | Remplacer `VALIDATEUR@a-remplir.com` par ton adresse de validation |
| `ajax-handler.php` | Remplacer `devis-lift@gmail.com` par la vraie adresse |

### Ce que fait le workflow

```
Gmail Trigger (is:unread)
  └─ Marquer comme lu
      └─ Nouvelle demande ?
          ├─ oui → Préparer la réponse (node Code : parsing + choix du texte)
          │         └─ Demander validation (Send and Wait for Approval)
          │             └─ Approuvé ?
          │                 ├─ oui → Envoyer au client
          │                 └─ non → stop
          └─ non → Transférer au contact
```

### Deux points de conception à ne pas défaire

**Le filtre `is:unread` + « Marquer comme lu » placé tout en haut** est le
garde-fou anti-doublon. Le Gmail Trigger a des bugs de doublons documentés
(n8n issue #10470), et il ne déduplique **pas** par statut lu/non-lu — il
suit les IDs de messages. Le couple filtre + marquage précoce, lui,
déduplique vraiment : un message déjà traité n'est plus `unread`, donc le
poll suivant l'ignore.

Le marquage doit rester **avant** le node de validation, pas après. Sinon,
pendant que l'approbation attend ta réponse (potentiellement des heures), le
mail reste non lu et chaque poll d'une minute relance un nouveau cycle → une
avalanche d'emails de validation. Contrepartie assumée : si le workflow
plante en cours de route, le mail est déjà marqué lu et ne sera pas rejoué —
mais la notification est aussi partie vers les 3 autres adresses, donc rien
n'est réellement perdu.

**Le `Reply-To` du node « Transférer au contact »** vaut l'expéditeur
d'origine. Sans lui, répondre au transfert depuis `contact@` renverrait vers
la boîte devis au lieu du client.

Par ailleurs `appendAttribution: false` est positionné sur tous les envois :
sinon n8n ajoute une mention « sent automatically with n8n » en bas des
emails clients.

## 4. Tester avant d'activer

1. Workflow **désactivé**, remplir une vraie demande sur le configurateur
   avec ta propre adresse comme email client.
2. Cliquer **Execute Workflow** dans n8n → le Trigger doit récupérer la
   notification.
3. Ouvrir le node **Préparer la réponse** et vérifier sa sortie :
   `clientEmail` doit être ton adresse, `modeleId` le bon slug, `aTemplate`
   doit valoir `true` (s'il vaut `false`, le modèle n'a pas de texte et le
   secours est utilisé).
4. Vérifier que l'email de validation arrive, cliquer **Approuver**, vérifier
   que l'email client part avec le bon texte.
5. Répondre à cet email et relancer → il doit partir vers `contact@` avec le
   bon `Reply-To`.
6. Seulement ensuite : basculer **Active**.

> `workflow.json` a été validé (JSON bien formé, connexions cohérentes,
> syntaxe du node Code vérifiée, parsing testé contre le corps réel généré
> par `ajax-handler.php`). En revanche il n'a pas été importé dans une
> instance n8n réelle : selon ta version, un `typeVersion` de node peut
> demander un ajustement à l'import — n8n le signale alors clairement.

## Pourquoi cette architecture

- **Boîte dédiée** plutôt que boîte perso : le bot n'a accès qu'à cette
  boîte, et « tout ce qui n'est pas une notification = une réponse client »
  devient une règle triviale.
- **Un node Code** plutôt que 8 branches Switch + 8 nodes Set : même
  résultat, un seul endroit à éditer pour changer un texte.
- **Parsing du corps** plutôt que des en-têtes : le format du corps est
  entièrement défini par `ajax-handler.php`, donc stable et sous contrôle.
