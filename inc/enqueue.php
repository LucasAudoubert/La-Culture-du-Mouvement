<?php
function culture_mouvement_all_assets()
{
    $uri = get_template_directory_uri();

    // --- CSS GLOBAUX ---
    wp_enqueue_style('main-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('global-css', $uri . '/assets/css/global.css');
    wp_enqueue_style('header-css', $uri . '/assets/css/header.css');
    wp_enqueue_style('footer-css', $uri . '/assets/css/footer.css');

    // --- CSS SECTIONS ---
    wp_enqueue_style('hero-css', $uri . '/assets/css/hero.css');
    wp_enqueue_style('approche-css', $uri . '/assets/css/approche.css');
    wp_enqueue_style('pour-qui-css', $uri . '/assets/css/pour-qui.css');
    wp_enqueue_style('map-style', $uri . '/assets/css/map.css');
    wp_enqueue_style('cta-footer-css', $uri . '/assets/css/cta-footer.css');

    // --- CSS + JS Page Contact ---
    wp_enqueue_style('contact-style', $uri . '/assets/css/contact.css');
    wp_enqueue_style('tabs-css', $uri . '/assets/css/tabs.css');

    wp_enqueue_script('tabs-js', $uri . '/assets/js/tabs.js', array(), _S_VERSION, true);

    wp_enqueue_script('contact-form-js', $uri . '/assets/js/contact-form.js', array(), _S_VERSION, true);

    wp_localize_script('contact-form-js', 'contactConfig', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('contact_nonce'),
        'email'     => 'coach.laculturemouvement@gmail.com',
        'telephone' => '+33 6 00 00 00 00',
        'ville'     => 'Nanterre, 92000',
        'linkedin'  => '',
        'github'    => '',
    ));

    // --- SCRIPTS JS GLOBAUX ---
    // wp_enqueue_script('main-js', $uri . '/assets/js/main.js', array(), _S_VERSION, true);

    // Hero Effects (uniquement Home)
    if (is_front_page()) {
        wp_enqueue_script('hero-effects', $uri . '/assets/js/hero-effects.js', array(), null, true);
    }

    // Leaflet & Map
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
    wp_enqueue_script('map-init', $uri . '/assets/js/map-init.js', array('leaflet-js'), '1.0', true);
    wp_localize_script('map-init', 'mapConfig', array(
        'nom'       => 'Culture Mouvement',
        'adresse'   => '15 Rue de l\'Industrie, 92000 Nanterre',
        'rue'       => '15 Rue de l\'Industrie',
        'cp_ville'  => '92000 Nanterre',
        'gare'      => 'RER A - Nanterre Ville (5 min)',
        'parking'   => 'Gratuit dans la rue',
        'email'     => 'contact@culturemouvement.fr',
        'telephone' => '01 47 21 00 00'
    ));

    // Calendrier Assets
    wp_enqueue_script('ical-js', 'https://cdn.jsdelivr.net/npm/ical.js@1.5.0/build/ical.min.js', array(), null, true);
    wp_enqueue_script('fullcalendar-core', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js', array(), null, true);
    wp_enqueue_script('fullcalendar-ical', 'https://cdn.jsdelivr.net/npm/@fullcalendar/icalendar@6.1.10/index.global.min.js', array('fullcalendar-core', 'ical-js'), null, true);

    wp_enqueue_style('calendrier-style', $uri . '/assets/css/calendrier-style.css', array(), time());
    wp_enqueue_script('calendrier-script', $uri . '/assets/js/calendrier-script.js', array('fullcalendar-ical'), time(), true);

    wp_localize_script('calendrier-script', 'hexfitData', array(
        'ajaxUrl' => admin_url('admin-ajax.php?action=get_hexfit_ics')
    ));
}
add_action('wp_enqueue_scripts', 'culture_mouvement_all_assets');