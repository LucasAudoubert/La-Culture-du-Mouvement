<?php
if (! defined('ABSPATH')) exit;

add_action('wp_ajax_send_contact',        'handle_contact_form');
add_action('wp_ajax_nopriv_send_contact', 'handle_contact_form');

function handle_contact_form()
{

    if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'contact_nonce')) {
        wp_send_json_error(['message' => 'Requête invalide.']);
        wp_die();
    }

    $name     = sanitize_text_field($_POST['name']     ?? '');
    $email    = sanitize_email($_POST['email']    ?? '');
    $message  = sanitize_textarea_field($_POST['message']  ?? '');
    $datetime = sanitize_text_field($_POST['datetime'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'Veuillez remplir tous les champs obligatoires.']);
        wp_die();
    }

    if (! is_email($email)) {
        wp_send_json_error(['message' => 'Adresse email invalide.']);
        wp_die();
    }

    // ── Génère le lien Google Calendar ──────────────────────
    $date_souhaitee = ! empty($datetime) ? strtotime($datetime) : strtotime('+3 days 10:00:00');
    $date_debut     = date('Ymd\THis\Z', $date_souhaitee);
    $date_fin       = date('Ymd\THis\Z', $date_souhaitee + 3600); // +1h

    $gcal_url = 'https://calendar.google.com/calendar/render?' . http_build_query([
        'action'   => 'TEMPLATE',
        'text'     => 'RDV Culture Mouvement - ' . $name,
        'dates'    => $date_debut . '/' . $date_fin,
        'details'  => "Demande de : $name\nEmail : $email\n\nMessage :\n$message",
        'location' => '15 Rue de l\'Industrie, 92000 Nanterre',
    ]);

    // ── Email HTML ───────────────────────────────────────────
    $to           = 'anisse.elbezazi@gmail.com';
    $mail_subject = $name . ' - Nouvelle demande de créneau';
    $reply_url    = 'mailto:' . esc_attr($email) . '?subject=' . rawurlencode('Re: ' . $mail_subject);

    $html_body = "
<html>
<head>
    <style>
        .container {
            font-family: sans-serif;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #1a1a1a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .td-label {
            padding: 8px;
            font-weight: bold;
            width: 120px;
        }
        .td-value {
            padding: 8px;
        }
        .tr-alt {
            background: #f9f9f9;
        }
        .message-box {
            margin-top: 20px;
            padding: 16px;
            background: #f4f4f4;
            border-radius: 6px;
        }
        .message-box p {
            margin: 0;
            white-space: pre-wrap;
        }
        .btn-wrapper {
            margin-top: 24px;
            text-align: center;
            display: flex;
            justify-content: space-around;
        }
        .btn-gcal {
            display: inline-block;
            padding: 12px 24px;
            background: #BDD68F;
            color: #000 !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .btn-gcal:hover {
            background: #000 !important;
            color: #fff !important;
        }
        .btn-reply {
            display: inline-block;
            padding: 12px 24px;
            background: #1a1a1a;
            color: #fff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn-reply:hover {
            background: #BDD68F !important;
            color: #000 !important;
        }
        .footer {
            color: #999;
            font-size: 12px;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Nouvelle demande de créneau</h2>
        <table>
            <tr>
                <td class='td-label'>Nom</td>
                <td class='td-value'>" . esc_html($name) . "</td>
            </tr>
            <tr class='tr-alt'>
                <td class='td-label'>Email</td>
                <td class='td-value'>
                    <a href='mailto:" . esc_attr($email) . "'>" . esc_html($email) . "</a>
                </td>
            </tr>
            <tr>
                <td class='td-label'>Date souhaitée</td>
                <td class='td-value'>" . esc_html($datetime) . "</td>
            </tr>
        </table>
        <div class='message-box'>
            <p>" . esc_html($message) . "</p>
        </div>
            <table class='btn-wrapper'>
                <tr>
                    <td>
                        <a href='" . esc_url($gcal_url) . "' class='btn-gcal'>
                            Accepter → Google Calendar
                        </a>
                    </td>
                    <td>
                        <a href='" . $reply_url . "' class='btn-reply'>
                            Répondre à " . esc_html($name) . "
                        </a>
                    </td>
                </tr>
            </table>
        <p class='footer'>
            Envoyé depuis le formulaire de contact du site.
        </p>
    </div>
</body>
</html>
";
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    $sent = wp_mail($to, $mail_subject, $html_body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Votre message a bien été envoyé. Merci !']);
    } else {
        wp_send_json_error(['message' => "Erreur lors de l'envoi. Veuillez réessayer."]);
    }

    wp_die();
}
