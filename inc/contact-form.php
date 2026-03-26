<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_ajax_send_contact',        'handle_contact_form' );
add_action( 'wp_ajax_nopriv_send_contact', 'handle_contact_form' );

function handle_contact_form() {

    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'contact_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Requête invalide.' ] );
        wp_die();
    }

    $name     = sanitize_text_field(     $_POST['name']     ?? '' );
    $email    = sanitize_email(          $_POST['email']    ?? '' );
    $message  = sanitize_textarea_field( $_POST['message']  ?? '' );
    $datetime = sanitize_text_field(     $_POST['datetime'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( [ 'message' => 'Veuillez remplir tous les champs obligatoires.' ] );
        wp_die();
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Adresse email invalide.' ] );
        wp_die();
    }

    $to           = 'retaliator215@gmail.com';
    $mail_subject = $name . ' - Nouvelle demande de créneau';

    $html_body = "
        <div style='font-family:sans-serif;max-width:600px;margin:auto;'>
            <h2 style='color:#1a1a1a;'>Nouvelle demande de créneau</h2>
            <table style='width:100%;border-collapse:collapse;'>
                <tr>
                    <td style='padding:8px;font-weight:bold;width:120px;'>Nom</td>
                    <td style='padding:8px;'>" . esc_html( $name ) . "</td>
                </tr>
                <tr style='background:#f9f9f9;'>
                    <td style='padding:8px;font-weight:bold;'>Email</td>
                    <td style='padding:8px;'>
                        <a href='mailto:" . esc_attr( $email ) . "'>" . esc_html( $email ) . "</a>
                    </td>
                </tr>
                <tr>
                    <td style='padding:8px;font-weight:bold;'>Date souhaitée</td>
                    <td style='padding:8px;'>" . esc_html( $datetime ) . "</td>
                </tr>
            </table>
            <div style='margin-top:20px;padding:16px;background:#f4f4f4;border-radius:6px;'>
                <p style='margin:0;white-space:pre-wrap;'>" . esc_html( $message ) . "</p>
            </div>
            <p style='color:#999;font-size:12px;margin-top:24px;'>
                Envoyé depuis le formulaire de contact du site.
            </p>
        </div>
    ";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    $sent = wp_mail( $to, $mail_subject, $html_body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => 'Votre message a bien été envoyé. Merci !' ] );
    } else {
        wp_send_json_error( [ 'message' => "Erreur lors de l'envoi. Veuillez réessayer." ] );
    }

    wp_die();
}