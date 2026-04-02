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
    wp_enqueue_style('avis-style', $uri . '/assets/css/avis.css', array(), null);
    wp_enqueue_style('faq-style', $uri . '/assets/css/faq.css', array(), null);

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
    wp_enqueue_script('burger-js', $uri . '/assets/js/burger.js', array(), null, true);

    if (is_page_template('page-blog.php') || is_single()) {
        wp_enqueue_style('blog-style', $uri . '/assets/css/blog.css');
    }

    if (is_front_page()) {
        wp_enqueue_script('hero-effects', $uri . '/assets/js/hero-effects.js', array(), null, true);
        wp_enqueue_script('hero-slider-js', $uri . '/assets/js/slider.js', array(), null, true);
    }

    // --- LEAFLET & MAP ---
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
    wp_enqueue_script('map-init', $uri . '/assets/js/map-init.js', array('leaflet-js'), '1.0', true);

    // Récupération des données ACF pour la carte (sur le CPT landing-page)
    $adresse  = '47 Bd de Pesaro, 92000 Nanterre'; // Adresse par défaut si vide
    $rue      = '47 Bd de Pesaro';
    $cp_ville = '92000 Nanterre';
    $gare     = 'RER A - Nanterre Ville (5 min)';
    $parking  = 'Gratuit dans la rue';
    $email    = 'contact@culturemouvement.fr';
    $telephone = '01 47 21 00 00';

    $localisation_query = new WP_Query(array(
        'post_type' => 'landing-page',
        'posts_per_page' => 1,
        'name' => 'map-localisation',
        'post_status' => 'publish',
    ));

    if ($localisation_query->have_posts()) {
        while ($localisation_query->have_posts()) {
            $localisation_query->the_post();

            if (function_exists('get_field')) {
                $adresse   = get_field('adresse')  ?: $adresse;
                $rue       = get_field('rue')      ?: $rue;
                $cp_ville  = get_field('cp_ville') ?: $cp_ville;
                $gare      = get_field('gare')     ?: $gare;
                $parking   = get_field('parking')  ?: $parking;
                $email     = get_field('email')    ?: $email;
                $telephone = get_field('telephone') ?: $telephone;
            }
        }
        wp_reset_postdata();
    }

    wp_localize_script('map-init', 'mapConfig', array(
        'nom'       => 'Culture Mouvement',
        'adresse'   => $adresse,
        'rue'       => $rue,
        'cp_ville'  => $cp_ville,
        'gare'      => $gare,
        'parking'   => $parking,
        'email'     => $email,
        'telephone' => $telephone,
    ));

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
