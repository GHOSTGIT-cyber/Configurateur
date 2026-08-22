# Ce qui n'a PAS marché — Configurateur Lift

## Problème : Cacher les prix dans le modal de devis

### Tentative 1 — CSS display:none sur les éléments de prix
```css
.config-recap .total { display: none !important; }
.config-recap li span { display: none !important; }
```
**Pourquoi ça n'a pas marché :**
Les prix étaient dans des nœuds texte directement dans les `<li>`, pas dans des balises séparées.
Le CSS ne peut pas cibler du texte brut — seulement des éléments HTML.

---

### Tentative 2 — Supprimer l'appel à buildConfigRecap() dans le JS
```js
$('#openQuoteModal').on('click', function() {
    // buildConfigRecap() supprimé
    $('#quoteModal').fadeIn(300);
});
```
**Pourquoi ça n'a pas marché :**
Pas suffisant. Une ancienne version du fichier JS pouvait encore être active,
ou la fonction était appelée depuis un autre endroit.

---

### Tentative 3 — Commenter buildConfigRecap() avec des //
```js
// function buildConfigRecap() {
//     ...
// }
```
**Pourquoi ça n'a pas marché :**
Erreur de syntaxe. Le corps de la fonction contenait des blocs `{}`
qui ne se commentent pas proprement ligne par ligne avec `//`.
Il faut utiliser `/* ... */` pour un bloc entier.

---

### Tentative 4 — Versionner les fichiers avec filemtime() dans functions.php
```php
wp_enqueue_script('lift-configurator-js', ..., filemtime(...), true);
```
**Pourquoi ça n'a pas marché :**
Modification refusée par l'utilisateur. Non souhaité dans functions.php.

---

## Solution finale qui a marché

**Supprimer le `<div id="config-recap">` directement dans les fichiers PHP.**

```php
// AVANT
<div id="config-recap" class="config-recap"></div>
<form id="quoteForm">

// APRÈS
<form id="quoteForm">
```

Fichiers modifiés :
- `configurator/template-liftx.php`
- `configurator/template.php`

**Pourquoi ça marche :**
Sans le div dans le DOM, le JS ne peut rien y injecter — peu importe le cache navigateur ou serveur.
C'est la solution la plus radicale et la plus fiable.
