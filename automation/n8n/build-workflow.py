#!/usr/bin/env python3
"""Genere automation/n8n/workflow.json (workflow n8n de reponse aux devis).

Ce script est la source de verite : editer ce fichier puis relancer
`python automation/n8n/build-workflow.py` plutot que d'editer workflow.json
a la main. Il valide aussi le resultat (JSON, connexions, references).
"""
import json
import os
import re

MODELES = [
    ("lift-x-43",  "LIFTX 4'3\""),
    ("lift-x-48",  "LIFTX 4'8\""),
    ("lift-x-52",  "LIFTX 5'2\""),
    ("lift-5-44",  "LIFT5 4'4\" PRO"),
    ("lift-5-49",  "LIFT5 4'9\" SPORT"),
    ("lift-5-54",  "LIFT5 5'4\" CRUISER"),
    ("lift-5f-49", "LIFT5 F 4'9\" SPORT"),
    ("lift-5f-54", "LIFT5 F 5'4\" CRUISER"),
]

PREP = "Preparer la reponse"
WAIT = "Attendre la validation"

templates_js = ",\n".join(
    "  '%s': `[A REMPLIR - texte %s : voir email-templates.md]`" % (mid, label)
    for mid, label in MODELES
)

CODE_JS = """// Lit la notification du configurateur, choisit le texte du modele et
// construit le lien vers la page d'edition.
//
// On relit le mail d'origine via $('Gmail Trigger') car le node
// "Marquer comme lu" a remplace $json par sa propre sortie.
// normalize('NFC') : sans ca, un corps aux accents decomposes fait echouer
// l'extraction de "Modele".
const body = ($('Gmail Trigger').item.json.text || '').normalize('NFC');

// Les regex sont ANCREES en debut de ligne (^ + flag m). Sans l'ancrage, un
// client dont le nom contient "Email : pirate@exemple.com" ferait partir la
// reponse chez le pirate au lieu du vrai client (teste, la faille est reelle).
const grab = (re) => (body.match(re)?.[1] || '').trim();

const clientEmail = grab(/^Email\\s*:\\s*(\\S+@\\S+)\\s*$/m);
const clientNom   = grab(/^Nom\\s*:\\s*(.+)$/m);
const modeleId    = grab(/^ModeleID\\s*:\\s*(\\S+)$/m);
const modele      = grab(/^Mod\\u00e8le\\s*:\\s*(.+)$/m);

// ---------------------------------------------------------------------------
// Un texte par modele. Remplacer chaque placeholder par le vrai texte.
// Variables disponibles dans le texte : {{nom}} et {{modele}}
// ---------------------------------------------------------------------------
const TEMPLATES = {
%s
};

const FALLBACK = `[A REMPLIR - texte de secours si le modele n'est pas reconnu]`;

const aTemplate = Object.prototype.hasOwnProperty.call(TEMPLATES, modeleId);
const emailBody = (aTemplate ? TEMPLATES[modeleId] : FALLBACK)
  .split('{{nom}}').join(clientNom)
  .split('{{modele}}').join(modele);

if (!clientEmail) {
  throw new Error('Aucune adresse client trouvee dans la notification : ' + body.slice(0, 200));
}

// Lien vers la page d'edition servie par le node "Attendre la validation".
// $execution.resumeFormUrl est calcule ICI (node Code) : c'est l'endroit ou
// n8n le documente comme disponible, alors que sa disponibilite dans une
// expression de node classique est ambigue selon les sources.
const lienEdition = $execution.resumeFormUrl;

return {
  json: {
    clientEmail,
    clientNom,
    modeleId,
    modele,
    aTemplate,
    emailBody,
    emailSubject: 'Votre configuration ' + (modele || 'Lift') + ' - notre proposition',
    lienEdition,
    recapDemande: $('Gmail Trigger').item.json.text || '',
  },
};
""" % templates_js

MAIL_NICO = """Nouvelle demande de devis a valider.

Client : {{ $json.clientNom }} <{{ $json.clientEmail }}>
Modele : {{ $json.modele }} ({{ $json.modeleId }}){{ $json.aTemplate ? '' : '   /!\\\\ aucun texte specifique pour ce modele, texte de secours utilise' }}

================== RECAP DE LA DEMANDE ==================

{{ $json.recapDemande }}

============ TEXTE QUI SERA ENVOYE AU CLIENT ============

Sujet : {{ $json.emailSubject }}

{{ $json.emailBody }}

=========================================================

Rien n'est parti pour l'instant. Pour modifier le texte puis envoyer
(ou annuler), ouvre cette page :

{{ $json.lienEdition }}
"""

FORM_DESCRIPTION = (
    "Demande de {{ $('" + PREP + "').item.json.clientNom }} "
    "({{ $('" + PREP + "').item.json.clientEmail }}) - "
    "{{ $('" + PREP + "').item.json.modele }}. "
    "Modifie le texte si besoin, puis choisis Envoyer ou Annuler."
)

TRANSFERT = (
    "=Message recu sur la boite devis, transfere automatiquement.\n"
    "Expediteur d'origine : {{ $('Gmail Trigger').item.json.from.value[0].address }}\n"
    "\n---\n\n"
    "{{ $('Gmail Trigger').item.json.text }}"
)

IF_OPTIONS = {
    "options": {"caseSensitive": True, "leftValue": "", "typeValidation": "loose", "version": 2},
    "combinator": "and",
}


def node(name, ntype, type_version, position, parameters):
    return {
        "parameters": parameters,
        "name": name,
        "type": ntype,
        "typeVersion": type_version,
        "position": position,
    }


def condition(left, right, op_type, operation):
    return {
        "id": "cond-" + operation,
        "leftValue": left,
        "rightValue": right,
        "operator": {"type": op_type, "operation": operation},
    }


nodes = [
    node("Gmail Trigger", "n8n-nodes-base.gmailTrigger", 1.2, [-200, 300], {
        # is:unread + "Marquer comme lu" en tete = garde-fou anti-doublon reel
        # (le Gmail Trigger a des bugs de doublons documentes, issue #10470).
        "pollTimes": {"item": [{"mode": "everyMinute"}]},
        "simple": False,
        "filters": {"q": "is:unread"},
        "options": {},
    }),
    node("Marquer comme lu", "n8n-nodes-base.gmail", 2.1, [20, 300], {
        "resource": "message",
        "operation": "markAsRead",
        "messageId": "={{ $json.id }}",
    }),
    node("Nouvelle demande ?", "n8n-nodes-base.if", 2.2, [240, 300], {
        "conditions": dict(IF_OPTIONS, conditions=[
            condition("={{ $('Gmail Trigger').item.json.subject }}",
                      "Nouvelle demande de devis Lift", "string", "contains")
        ]),
        "options": {},
    }),
    node(PREP, "n8n-nodes-base.code", 2, [480, 180], {
        "mode": "runOnceForEachItem",
        "jsCode": CODE_JS,
    }),
    node("Prevenir Nico", "n8n-nodes-base.gmail", 2.1, [700, 180], {
        "resource": "message",
        "operation": "send",
        "sendTo": "NICO@a-remplir.com",
        "subject": "=[A valider] Devis {{ $json.modele }} - {{ $json.clientNom }}",
        "emailType": "text",
        "message": "=" + MAIL_NICO,
        "options": {"appendAttribution": False},
    }),
    node(WAIT, "n8n-nodes-base.wait", 1.1, [920, 180], {
        "resume": "form",
        "formTitle": "Valider la reponse au client",
        "formDescription": "=" + FORM_DESCRIPTION,
        "formFields": {"values": [
            {
                "fieldLabel": "Sujet du mail",
                "fieldType": "text",
                "requiredField": True,
                "defaultValue": "={{ $('" + PREP + "').item.json.emailSubject }}",
            },
            {
                "fieldLabel": "Texte du mail",
                "fieldType": "textarea",
                "requiredField": True,
                "defaultValue": "={{ $('" + PREP + "').item.json.emailBody }}",
            },
            {
                "fieldLabel": "Action",
                "fieldType": "dropdown",
                "requiredField": True,
                "fieldOptions": {"values": [
                    {"option": "Envoyer le mail"},
                    {"option": "Annuler"},
                ]},
            },
        ]},
        "options": {},
    }),
    node("Envoyer ?", "n8n-nodes-base.if", 2.2, [1140, 180], {
        "conditions": dict(IF_OPTIONS, conditions=[
            condition("={{ $json['Action'] }}", "Envoyer le mail", "string", "equals")
        ]),
        "options": {},
    }),
    node("Envoyer au client", "n8n-nodes-base.gmail", 2.1, [1380, 100], {
        "resource": "message",
        "operation": "send",
        # On envoie le texte SORTI DU FORMULAIRE (donc eventuellement modifie
        # par Nico), pas le brouillon d'origine.
        "sendTo": "={{ $('" + PREP + "').item.json.clientEmail }}",
        "subject": "={{ $('" + WAIT + "').item.json['Sujet du mail'] }}",
        "emailType": "text",
        "message": "={{ $('" + WAIT + "').item.json['Texte du mail'] }}",
        # appendAttribution=false : sinon n8n signe "sent automatically with n8n".
        "options": {"appendAttribution": False},
    }),
    node("Transferer au contact", "n8n-nodes-base.gmail", 2.1, [480, 440], {
        "resource": "message",
        "operation": "send",
        "sendTo": "contact@efoilcotedazur.com",
        "subject": "=Fwd: {{ $('Gmail Trigger').item.json.subject }}",
        "emailType": "text",
        "message": TRANSFERT,
        # replyTo = expediteur d'origine, sinon repondre depuis contact@
        # renvoie vers la boite devis au lieu du client.
        "options": {
            "appendAttribution": False,
            "replyTo": "={{ $('Gmail Trigger').item.json.from.value[0].address }}",
        },
    }),
]

connections = {
    "Gmail Trigger": {"main": [[{"node": "Marquer comme lu", "type": "main", "index": 0}]]},
    "Marquer comme lu": {"main": [[{"node": "Nouvelle demande ?", "type": "main", "index": 0}]]},
    "Nouvelle demande ?": {"main": [
        [{"node": PREP, "type": "main", "index": 0}],
        [{"node": "Transferer au contact", "type": "main", "index": 0}],
    ]},
    PREP: {"main": [[{"node": "Prevenir Nico", "type": "main", "index": 0}]]},
    "Prevenir Nico": {"main": [[{"node": WAIT, "type": "main", "index": 0}]]},
    WAIT: {"main": [[{"node": "Envoyer ?", "type": "main", "index": 0}]]},
    "Envoyer ?": {"main": [[{"node": "Envoyer au client", "type": "main", "index": 0}], []]},
}

workflow = {
    "name": "Devis eFoil - reponse avec page de validation",
    "nodes": nodes,
    "connections": connections,
    "settings": {"executionOrder": "v1"},
    "pinData": {},
}

out = os.path.join(os.path.dirname(os.path.abspath(__file__)), "workflow.json")
with open(out, "w", encoding="utf-8") as f:
    json.dump(workflow, f, ensure_ascii=False, indent=2)
    f.write("\n")

# --- Validation -----------------------------------------------------------
with open(out, encoding="utf-8") as f:
    reloaded = json.load(f)

names = [n["name"] for n in reloaded["nodes"]]
assert len(names) == len(set(names)), "noms de nodes dupliques"

for src, conn in reloaded["connections"].items():
    assert src in names, "connexion depuis un node inconnu: " + src
    for outputs in conn["main"]:
        for c in outputs:
            assert c["node"] in names, "connexion vers un node inconnu: " + c["node"]

blob = json.dumps(reloaded, ensure_ascii=False)
for ref in sorted(set(re.findall(r"\$\('([^']+)'\)", blob))):
    assert ref in names, "reference a un node inexistant: " + ref

# Le node d'envoi au client doit lire le formulaire, pas le brouillon d'origine
envoi = [n for n in reloaded["nodes"] if n["name"] == "Envoyer au client"][0]
assert WAIT in envoi["parameters"]["message"], "l'envoi client n'utilise pas le texte du formulaire"

print("OK - %d nodes, JSON valide, references coherentes" % len(names))
print("Nodes :", ", ".join(names))
print("Ecrit :", out)
