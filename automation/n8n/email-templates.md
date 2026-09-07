# Textes des réponses personnalisées par modèle

Un texte par modèle exact (8 au total), plus un texte de secours. Le workflow
choisit le texte dans le node **Préparer la réponse** de `workflow.json`, via
l'objet `TEMPLATES` indexé par `ModeleID` (valeur envoyée par le
configurateur, ex. `lift-5-44` — voir `ajax-handler.php`).

Variables disponibles dans le texte (remplacées avant envoi) :
`{{nom}}` (nom du client), `{{modele}}` (libellé complet du modèle).

Ce fichier est la source de référence : une fois les textes rédigés ici,
reporte-les dans l'objet `TEMPLATES` de `build-workflow.py`, puis relance
`python automation/n8n/build-workflow.py` pour régénérer `workflow.json`.

Ces textes sont des **points de départ**, pas des envois figés : Nico les
voit pré-remplis sur la page de validation et peut les modifier au cas par
cas avant l'envoi. Vise donc le texte juste dans 90 % des cas plutôt que le
texte parfait pour toutes les situations.

**Rappel de contexte** : le client a déjà reçu l'accusé de réception
WordPress (« votre demande a bien été reçue, réponse sous 24h »). Ce texte-ci
est la réponse détaillée qui suit — pas la peine de répéter l'accusé de
réception.

---

## Texte de secours

Utilisé si `ModeleID` est absent ou inconnu (nouveau modèle ajouté au
configurateur sans texte associé). Doit rester valable pour n'importe quel
modèle.

```
TODO
```

---

## LIFTX

### lift-x-43 — LIFTX 4'3" (12 000 €)
```
TODO
```

### lift-x-48 — LIFTX 4'8" (12 200 €)
```
TODO
```

### lift-x-52 — LIFTX 5'2" (12 400 €)
```
TODO
```

## LIFT5

### lift-5-44 — LIFT5 4'4" PRO (13 300 €)
```
TODO
```

### lift-5-49 — LIFT5 4'9" SPORT (13 500 €)
```
TODO
```

### lift-5-54 — LIFT5 5'4" CRUISER (13 700 €)
```
TODO
```

## LIFT5 F

### lift-5f-49 — LIFT5 F 4'9" SPORT (9 166 €)
```
TODO
```

### lift-5f-54 — LIFT5 F 5'4" CRUISER (9 366 €)
```
TODO
```
