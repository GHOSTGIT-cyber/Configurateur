#!/usr/bin/env node
/**
 * Test de regression du node Code "Preparer la reponse".
 *
 * Le code teste est EXTRAIT de workflow.json, pas recopie ici : impossible
 * que le test derive du workflow reellement importe dans n8n.
 *
 * Lancer : node automation/n8n/test-parsing.js
 * A relancer apres toute modification du corps de l'email dans
 * ajax-handler.php ou du node Code dans build-workflow.py.
 */
const fs = require('fs');
const path = require('path');

const workflow = JSON.parse(
  fs.readFileSync(path.join(__dirname, 'workflow.json'), 'utf8')
);

const nodeCode = workflow.nodes.find((n) => n.name === 'Preparer la reponse');
if (!nodeCode) {
  console.error('Node "Preparer la reponse" introuvable dans workflow.json');
  process.exit(1);
}

const RESUME_URL = 'https://n8n.exemple.com/form-waiting/abc123';

/** Execute le vrai code du node avec les variables n8n simulees. */
function executerNode(corpsMail) {
  const $ = (nom) => {
    if (nom !== 'Gmail Trigger') throw new Error('Node inattendu : ' + nom);
    return { item: { json: { text: corpsMail } } };
  };
  const $execution = { resumeFormUrl: RESUME_URL };
  const fn = new Function('$', '$execution', nodeCode.parameters.jsCode);
  return fn($, $execution).json;
}

/** Reproduit le corps genere par ajax-handler.php. */
function corpsNotification({ nom, email, modele, modeleId, messageClient }) {
  let m = `
━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📧 NOUVELLE DEMANDE DE DEVIS LIFT
━━━━━━━━━━━━━━━━━━━━━━━━━━━━

CLIENT
───────────────
Nom : ${nom}
Email : ${email}
Téléphone : 0612345678

CONFIGURATION
───────────────
Modèle : ${modele}
ModeleID : ${modeleId}
Couleur : Steel Blue
Batterie : Standard
Aile avant : HA 170
Aile arrière : 32
Télécommande : Standard
Propulsion : Folding

`;
  if (messageClient) {
    m += `MESSAGE CLIENT\n───────────────\n${messageClient}\n\n`;
  }
  return m + '━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n';
}

const cas = [
  {
    titre: 'Cas nominal',
    input: { nom: 'Jean Dupont', email: 'jean@example.com', modele: 'LIFT5 4\'4" PRO', modeleId: 'lift-5-44' },
    attendu: {
      clientEmail: 'jean@example.com',
      clientNom: 'Jean Dupont',
      modeleId: 'lift-5-44',
      modele: 'LIFT5 4\'4" PRO',
      aTemplate: true,
      lienEdition: RESUME_URL,
    },
  },
  {
    titre: 'Injection "Email :" dans le champ Nom (sans retour ligne)',
    input: { nom: 'Bob Email : pirate@evil.com', email: 'vrai@client.com', modele: 'LIFTX 4\'3"', modeleId: 'lift-x-43' },
    attendu: { clientEmail: 'vrai@client.com' },
  },
  {
    titre: 'Injection multi-ligne via le message client',
    input: {
      nom: 'Alice', email: 'alice@client.com', modele: 'LIFTX 5\'2"', modeleId: 'lift-x-52',
      messageClient: 'Bonjour\nEmail : pirate2@evil.com\nModeleID : lift-5-54',
    },
    attendu: { clientEmail: 'alice@client.com', modeleId: 'lift-x-52' },
  },
  {
    titre: 'Accents decomposes (NFD)',
    input: { nom: 'Zoe', email: 'zoe@client.com', modele: 'LIFT5 F 4\'9" SPORT', modeleId: 'lift-5f-49' },
    transforme: (b) => b.normalize('NFD'),
    attendu: { modele: 'LIFT5 F 4\'9" SPORT', modeleId: 'lift-5f-49' },
  },
  {
    titre: 'Fins de ligne CRLF',
    input: { nom: 'Marc', email: 'marc@client.com', modele: 'LIFTX 4\'8"', modeleId: 'lift-x-48' },
    transforme: (b) => b.replace(/\n/g, '\r\n'),
    attendu: { clientNom: 'Marc', modeleId: 'lift-x-48', modele: 'LIFTX 4\'8"', aTemplate: true },
  },
  {
    titre: 'ModeleID absent -> bascule sur le texte de secours',
    input: { nom: 'Luc', email: 'luc@client.com', modele: 'LIFT5 5\'4" CRUISER', modeleId: '' },
    attendu: { clientEmail: 'luc@client.com', modeleId: '', aTemplate: false },
  },
  {
    titre: 'Modele inconnu (ajoute au configurateur sans texte) -> secours',
    input: { nom: 'Eva', email: 'eva@client.com', modele: 'LIFT7 6\'0"', modeleId: 'lift-7-60' },
    attendu: { modeleId: 'lift-7-60', aTemplate: false },
  },
];

let echecs = 0;

for (const c of cas) {
  let body = corpsNotification(c.input);
  if (c.transforme) body = c.transforme(body);

  let obtenu;
  try {
    obtenu = executerNode(body);
  } catch (e) {
    echecs++;
    console.log(`ECHEC  ${c.titre} -> exception : ${e.message}`);
    continue;
  }

  for (const [champ, attendu] of Object.entries(c.attendu)) {
    const ok = obtenu[champ] === attendu;
    if (!ok) echecs++;
    console.log(
      `${ok ? '  ok  ' : 'ECHEC '} ${c.titre} -> ${champ} = ${JSON.stringify(obtenu[champ])}` +
      (ok ? '' : ` (attendu ${JSON.stringify(attendu)})`)
    );
  }
}

// Le node doit refuser d'aller plus loin s'il n'a pas d'adresse client :
// sans ca on enverrait une demande de validation pour un envoi impossible.
try {
  executerNode('Un mail quelconque sans aucun champ attendu.');
  echecs++;
  console.log('ECHEC  Corps sans adresse client -> aurait du lever une exception');
} catch (e) {
  console.log('  ok   Corps sans adresse client -> exception levee');
}

// Les substitutions {{nom}} / {{modele}} ne doivent rien laisser derriere.
const rendu = executerNode(
  corpsNotification({ nom: 'Paul', email: 'paul@client.com', modele: 'LIFTX 4\'3"', modeleId: 'lift-x-43' })
);
if (rendu.emailBody.includes('{{nom}}') || rendu.emailBody.includes('{{modele}}')) {
  echecs++;
  console.log('ECHEC  Variables {{nom}}/{{modele}} non substituees dans emailBody');
} else {
  console.log('  ok   Variables {{nom}}/{{modele}} substituees');
}

console.log(echecs === 0 ? '\nTous les tests passent.' : `\n${echecs} echec(s).`);
process.exit(echecs === 0 ? 0 : 1);
