# Plan — Correction batteries, ailes et adaptateur LIFTX

## Contexte
Le client a signalé des incohérences dans les options du configurateur : batteries mal configurées, et une combinaison LIFTX + batterie Explore qui nécessite un adaptateur. Ce plan corrige les 3 modèles pour être conformes à la réalité produit.

---

## Changements à effectuer

### 1. LIFTX — Supprimer la batterie Explore
**Fichier :** `configurator/template-liftx.php`

- Supprimer le `<li>` entier de la batterie Explore (+800€)
- La batterie Sport reste seule, cochée et `disabled` (incluse, pas de choix)
- Mettre `disabled` sur le radio Sport (comme le mât/propulseur du LIFTX)

**Avant :** 2 options (Sport checked + Explore +800€)  
**Après :** 1 option Sport, disabled, "Inclus"

---

### 2. LIFTX — Note adaptateur batterie
Le LIFTX avec la batterie Explore nécessite un adaptateur — mais puisqu'on supprime l'Explore, cette info n'est plus nécessaire. ✅ Résolu par la suppression.

---

## Récapitulatif des fichiers modifiés

| Fichier | Modification |
|---|---|
| `configurator/template-liftx.php` | Supprimer option Explore, rendre Sport disabled |

## Ce qu'on ne change PAS
- LIFT5 : Full Range inclus + Sport même prix → correct
- LIFT5 F : Full Range disabled inclus → correct
- Les ailes (front wing / stab) des 3 modèles → confirmées correctes
- config.js : la clé `explore` peut rester (pas utilisée activement)

## Vérification
Après modification, sur la page LIFTX :
- L'étape batterie affiche une seule option Sport, grisée, marquée "Inclus"
- Le prix total ne change pas lors du choix de batterie
- Le formulaire de devis inclut bien `batterie: sport`
