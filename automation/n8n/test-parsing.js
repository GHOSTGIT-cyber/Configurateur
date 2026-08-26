#!/usr/bin/env node
/**
 * Test de régression du parsing utilisé par le node Code du workflow n8n.
 *
 * Lance-le (`node automation/n8n/test-parsing.js`) après toute modification
 * du corps de l'email dans ajax-handler.php ou des regex du node Code : il
 * vérifie que l'extraction reste correcte, y compris face aux tentatives
 * d'injection via les champs libres du formulaire.
 */

// --- Copie des regex du node "Préparer la réponse" (workflow.json) ---------
function parse(bodyRaw) {
  const body = (bodyRaw || '').normalize('NFC');
  const grab = (re) => (body.match(re)?.[1] || '').trim();
  return {
    clientEmail: grab(/^Email\s*:\s*(\S+@\S+)\s*$/m),
    clientNom: grab(/^Nom\s*:\s*(.+)$/m),
    modeleId: grab(/^ModeleID\s*:\s*(\S+)\s*$/m),
    modele: grab(/^Modèle\s*:\s*(.+)$/m),
  };
}

// --- Reproduit le corps généré par ajax-handler.php -----------------------
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
    attendu: { clientEmail: 'jean@example.com', clientNom: 'Jean Dupont', modeleId: 'lift-5-44', modele: 'LIFT5 4\'4" PRO' },
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
    titre: 'Accents décomposés (NFD)',
    input: { nom: 'Zoe', email: 'zoe@client.com', modele: 'LIFT5 F 4\'9" SPORT', modeleId: 'lift-5f-49' },
    transforme: (b) => b.normalize('NFD'),
    attendu: { modele: 'LIFT5 F 4\'9" SPORT' },
  },
  {
    titre: 'Fins de ligne CRLF',
    input: { nom: 'Marc', email: 'marc@client.com', modele: 'LIFTX 4\'8"', modeleId: 'lift-x-48' },
    transforme: (b) => b.replace(/\n/g, '\r\n'),
    attendu: { clientNom: 'Marc', modeleId: 'lift-x-48', modele: 'LIFTX 4\'8"' },
  },
  {
    titre: 'ModeleID absent (page en cache postant l\'ancien formulaire)',
    input: { nom: 'Luc', email: 'luc@client.com', modele: 'LIFT5 5\'4" CRUISER', modeleId: '' },
    attendu: { clientEmail: 'luc@client.com', modeleId: '' },
  },
];

let echecs = 0;
for (const c of cas) {
  let body = corpsNotification(c.input);
  if (c.transforme) body = c.transforme(body);
  const obtenu = parse(body);

  for (const [champ, attendu] of Object.entries(c.attendu)) {
    const ok = obtenu[champ] === attendu;
    if (!ok) echecs++;
    console.log(`${ok ? '  ok  ' : 'ECHEC '} ${c.titre} → ${champ} = "${obtenu[champ]}"${ok ? '' : ` (attendu "${attendu}")`}`);
  }
}

console.log(echecs === 0 ? '\nTous les tests passent.' : `\n${echecs} échec(s).`);
process.exit(echecs === 0 ? 0 : 1);
