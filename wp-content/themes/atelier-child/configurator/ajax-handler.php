<?php
/**
 * CONFIGURATEUR LIFT - Handler AJAX pour envoi emails
 */

// Handler pour utilisateurs connectés
add_action('wp_ajax_send_lift_quote', 'send_lift_quote_email');

// Handler pour utilisateurs non connectés
add_action('wp_ajax_nopriv_send_lift_quote', 'send_lift_quote_email');

function send_lift_quote_email() {
    // Vérification nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'lift_quote_nonce')) {
        wp_send_json_error(array('message' => 'Erreur de sécurité'));
        return;
    }

    // Récupérer les données
    $config = isset($_POST['config']) ? $_POST['config'] : array();
    $client = array(
        'nom' => sanitize_text_field($_POST['nom'] ?? ''),
        'email' => sanitize_email($_POST['email'] ?? ''),
        'tel' => sanitize_text_field($_POST['tel'] ?? ''),
        'message' => sanitize_textarea_field($_POST['message'] ?? '')
    );

    // Validation
    if (empty($client['nom']) || empty($client['email']) || empty($client['tel'])) {
        wp_send_json_error(array('message' => 'Veuillez remplir tous les champs obligatoires'));
        return;
    }

    if (!is_email($client['email'])) {
        wp_send_json_error(array('message' => 'Email invalide'));
        return;
    }

    // Construire l'email
    $to = array(
        'n.pernodet12@gmail.com',
        'bakari06@live.fr',
        'contact@efoilcotedazur.com'
    );
    $subject = '📧 Nouvelle demande de devis Lift - ' . ($config['modele'] ?? 'Lift X');

    $message = "
━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📧 NOUVELLE DEMANDE DE DEVIS LIFT
━━━━━━━━━━━━━━━━━━━━━━━━━━━━

CLIENT
───────────────
Nom : {$client['nom']}
Email : {$client['email']}
Téléphone : {$client['tel']}

CONFIGURATION
───────────────
Modèle : {$config['modele']}
Couleur : {$config['hull']}
Batterie : {$config['batterie']}
Aile avant : {$config['foil']}
Aile arrière : {$config['stab']}
Télécommande : {$config['controller']}
Propulsion : {$config['propulsion']}

";

    if (!empty($config['accessoires'])) {
        $message .= "Accessoires:\n";
        foreach ($config['accessoires'] as $acc) {
            $message .= "  - {$acc}\n";
        }
        $message .= "\n";
    }

    if (!empty($client['message'])) {
        $message .= "MESSAGE CLIENT\n───────────────\n{$client['message']}\n\n";
    }

    $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $message .= "Envoyé depuis le configurateur Lift\n";
    $message .= "Date: " . current_time('d/m/Y à H:i') . "\n";

    // Headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Configurateur Lift <noreply@' . parse_url(home_url(), PHP_URL_HOST) . '>',
        'Reply-To: ' . $client['email']
    );

    // Envoyer l'email
    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        // Email de confirmation au client
        $client_subject = 'Votre demande de devis Lift a bien été reçue';
        $client_message = "
Bonjour {$client['nom']},

Nous avons bien reçu votre demande de devis pour :

{$config['modele']} - {$config['hull']}

Nous vous recontacterons sous 24h pour finaliser votre devis personnalisé.

Cordialement,
L'équipe Lift
";

        wp_mail($client['email'], $client_subject, $client_message);

        wp_send_json_success(array('message' => 'Demande envoyée avec succès'));
    } else {
        wp_send_json_error(array('message' => 'Erreur lors de l\'envoi. Veuillez réessayer.'));
    }
}
