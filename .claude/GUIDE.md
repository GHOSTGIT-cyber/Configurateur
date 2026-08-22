# Configurateur Lift eFoil - Guide Complet

## Shortcodes WordPress

| Shortcode | Page | Contenu |
|-----------|------|---------|
| `[lift_configurator]` | Page LIFT5 | Configurateur LIFT5 uniquement |
| `[liftx_configurateur]` | Page LIFTX | Configurateur LIFTX uniquement |
| `[lift5f_configurateur]` | Page LIFT5 F | Configurateur LIFT5 F uniquement |

---

## Fichiers Principaux

| Fichier | Rôle |
|---------|------|
| `configurator/config.js` | Données centralisées (prix, labels, chemins images) |
| `configurator/template.php` | Template HTML LIFT5 |
| `configurator/template-liftx.php` | Template HTML LIFTX |
| `configurator/configurator.js` | Logique JS (scroll, slider, prix, modal) |
| `configurator/configurator.css` | Styles |
| `configurator/ajax-handler.php` | Envoi des emails de devis |
| `configurator/template-lift5f.php` | Template HTML LIFT5 F |
| `functions.php` | Enregistrement des shortcodes |

---

## Modifier les Prix

Dans `config.js`, section `prices` :

```javascript
prices: {
    modele: {
        'lift-x-43': 0,     // Prix de base LIFTX
        'lift-x-48': 200,
        'lift-x-52': 400,
        'lift-5-44': 0,     // Prix de base LIFT5
        'lift-5-49': 200,
        'lift-5-54': 400,
    },
    batterie: {
        'sport': 0,
        'explore': 800,
        'ultra': 1500,
        'full-range': 0,    // Gen5 LIFT5
    },
    foil: {
        '148-havoc': 0,
        '210-camber': 0,
        '270-camber': 50,
    },
    propulsion: {
        '24-carbon': 0,
        '28-alu': 0,
        '28-carbon': 1530,
        '32-carbon': 1590,
    }
}
```

**Prix de base** (prix affiché quand tout est à zéro) : modifier `basePrice` dans `config.js`.

---

## Afficher/Masquer les Prix

Dans `config.js`, ligne `showPrices` :
```javascript
showPrices: false,  // true = afficher, false = masquer
```

---

## Structure des Images

```
configurator/images/
├── modele/                          ← Images par taille de board
│   ├── 2025_LIFTX_43.png
│   ├── 2025_LIFTX_48.png
│   ├── 2025_LIFTX_52.png
│   ├── 2025_LIFT5_44.png
│   ├── 2025_LIFT5_49.png
│   └── 2025_LIFT5_54.png
│
├── hull/                            ← Images couleurs avec 4 vues
│   ├── lift-x/
│   │   ├── LIFTX 4'3/
│   │   │   ├── Off-White/           ← 4 images par couleur
│   │   │   │   ├── ..._Ortho_2000x2000.png
│   │   │   │   ├── ..._Package_Iso_Shadow_2000x2000.png
│   │   │   │   ├── ..._Package_TiltBack_Shadow_2000x2000.png
│   │   │   │   └── ..._Package_TiltFront_Shadow_2000x2000.png
│   │   │   ├── Spark Blue/
│   │   │   └── Dawn Patrol/
│   │   ├── LIFTX 4'8/
│   │   └── LIFTX 5'2/
│   └── lift-5/
│       ├── LIFT5 4'4 Pro/
│       │   └── Core Colorways/
│       │       ├── Steel Blue/
│       │       ├── Off-White/
│       │       ├── Sun Kissed/
│       │       └── Carbon Black/
│       ├── LIFT5 4'9 Sport/
│       └── LIFT5 5'4 Cruiser/
│
├── batterie/
├── foil/
├── controller/
├── propulsion/
└── accessoires/
```

---

## Couleurs par Modèle

**LIFTX** (3 couleurs) : `off-white`, `spark-blue`, `dawn-patrol`

**LIFT5** (4 couleurs) : `steel-blue`, `off-white`, `sunkissed`, `carbon-black`

**LIFT5 F** (2 couleurs) : `tide-pool-blue`, `matcha-green`

---

## Ajouter une Couleur

### 1. Ajouter les images (4 vues dans le bon dossier)

### 2. `config.js` → `hullImages` : ajouter les 4 chemins

```javascript
hullImages: {
    'lift-x-43': {
        'nouvelle-couleur': {
            ortho:     "hull/lift-x/LIFTX 4'3/Nouvelle Couleur/..._Ortho_2000x2000.png",
            iso:       "hull/lift-x/LIFTX 4'3/Nouvelle Couleur/..._Package_Iso_Shadow_2000x2000.png",
            tiltback:  "hull/lift-x/LIFTX 4'3/Nouvelle Couleur/..._Package_TiltBack_Shadow_2000x2000.png",
            tiltfront: "hull/lift-x/LIFTX 4'3/Nouvelle Couleur/..._Package_TiltFront_Shadow_2000x2000.png"
        }
    }
}
```

### 3. `config.js` → `modelColors` : ajouter la couleur

```javascript
modelColors: {
    'lift-x': ['off-white', 'spark-blue', 'dawn-patrol', 'nouvelle-couleur'],
}
```

### 4. `config.js` → `labels.hull` : ajouter le label

```javascript
labels: { hull: { 'nouvelle-couleur': 'Nouvelle Couleur' } }
```

### 5. `template.php` ou `template-liftx.php` : ajouter le `<li>`

```html
<li class="VerticalList__Item" data-option-category="hull" data-model="lift-x">
    <input type="radio" id="hull-nouvelle-couleur" name="hull" value="nouvelle-couleur" data-price="0">
    <label for="hull-nouvelle-couleur">
        <div class="option-content">
            <div class="color-preview" style="background: #HEXCODE;"></div>
            <h5>Nouvelle Couleur</h5>
        </div>
        <span class="price-diff">Même prix</span>
    </label>
</li>
```

---

## Ajouter un Modèle

1. **Images** : `modele/2025_LIFTX_XX.png` + dossier hull avec toutes couleurs (4 vues chacune)
2. **`config.js`** → `modeleImages`, `hullImages`, `prices.modele`, `labels.modele`, `modelDescriptions`
3. **Template** : ajouter le `<li>` dans la section modèle

---

## LIFT5 F — Spécificités

### Shortcode
```
[lift5f_configurateur]
```

### Structure (7 étapes)
1. Modèle (4'9 Sport / 5'4 Cruiser)
2. Couleur (Tide Pool Blue / Matcha Green)
3. Batterie (Gen5 Full Range — inclus, radio disabled)
4. Front Wing & Stab (200 Surf V2 + 38/48 Surf — inclus, radio disabled)
5. Controller (Lift Hand Controller — inclus, radio disabled)
6. Mât & Propulsion (28" LCS Aluminum 68 + Lift Jet — inclus, radio disabled)
7. Accessoires (optionnels)

### Prix
`showPrices: false` — prix masqués pour le LIFT5 F.

### Images à déposer
```
configurator/images/
├── modele/
│   ├── 2025_LIFT5F_49.png
│   └── 2025_LIFT5F_54.png
└── hull/lift-5-f/
    ├── LIFT5F 4'9 Sport/
    │   ├── Tide Pool Blue/   ← 4 vues (Ortho, Iso, TiltBack, TiltFront)
    │   └── Matcha Green/     ← 4 vues
    └── LIFT5F 5'4 Cruiser/
        ├── Tide Pool Blue/   ← 4 vues
        └── Matcha Green/     ← 4 vues
```

---

## Emails de Devis

Dans `ajax-handler.php`, ligne `$to` :
```php
$to = array(
    'n.pernodet12@gmail.com',
    'bakari06@live.fr'
);
```

---

## Fonctions Utilitaires (`config.js`)

| Fonction | Description |
|----------|-------------|
| `getModeleImagePath(modele)` | Chemin image de sélection du modèle |
| `getHullImages(modele, color)` | Objet `{ortho, iso, tiltback, tiltfront}` |
| `getBoardImagePath(modele, color)` | Alias → retourne `ortho` |
| `getAccessoryImagePath(section, option)` | Chemin image d'un accessoire |
