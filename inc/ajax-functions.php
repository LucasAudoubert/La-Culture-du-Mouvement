<?php
add_action('wp_ajax_get_hexfit_ics', 'proxy_google_calendar_ics');
add_action('wp_ajax_nopriv_get_hexfit_ics', 'proxy_google_calendar_ics');

function proxy_google_calendar_ics()
{
    $ics_url = 'https://calendar.google.com/calendar/ical/anisse.elbezazi%40gmail.com/public/basic.ics';

    $query = new WP_Query(array(
        'post_type'      => 'calendrier',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ));

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $acf_url = get_field('lien_calendrier', get_the_ID());
            if ($acf_url) {
                $ics_url = $acf_url;
            }
        }
        wp_reset_postdata();
    }

    $response = wp_remote_get($ics_url, array('sslverify' => false, 'timeout' => 15));

    if (ob_get_length()) ob_clean();

    if (is_wp_error($response)) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "Erreur WordPress : " . $response->get_error_message();
    } else {
        header('Content-Type: text/calendar; charset=utf-8');
        echo wp_remote_retrieve_body($response);
    }
    wp_die();
}
