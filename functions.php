<?php

/**
 * culture_mouvement functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package culture_mouvement
 */

if (! defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

function culture_mouvement_setup()
{
	load_theme_textdomain('culture_mouvement', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	register_nav_menus(array('menu-1' => esc_html__('Primary', 'culture_mouvement')));
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
	add_theme_support('custom-background', apply_filters('culture_mouvement_custom_background_args', array('default-color' => 'ffffff', 'default-image' => '')));
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support('custom-logo', array('height' => 250, 'width' => 250, 'flex-width' => true, 'flex-height' => true));
}
add_action('after_setup_theme', 'culture_mouvement_setup');

function culture_mouvement_content_width()
{
	$GLOBALS['content_width'] = apply_filters('culture_mouvement_content_width', 640);
}
add_action('after_setup_theme', 'culture_mouvement_content_width', 0);

function culture_mouvement_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'culture_mouvement'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'culture_mouvement'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'culture_mouvement_widgets_init');

function culture_mouvement_scripts()
{
	wp_enqueue_style('culture_mouvement-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('culture_mouvement-style', 'rtl', 'replace');
	wp_enqueue_script('culture_mouvement-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'culture_mouvement_scripts');

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

function bouton_reservation_hexfit()
{
	$lien_reservation = 'https://app.myhexfit.com/#/public-appointment?secret=816d7206-3d79-4f5a-a655-57caebaf8354';
	return '<div style="text-align:center; margin: 30px 0;"><a href="' . $lien_reservation . '" target="_blank" style="background-color:#000; color:white; padding:15px 30px; text-decoration:none; border-radius:8px; font-weight:bold; font-family:sans-serif; display:inline-block;">RÉSERVER UNE SÉANCE</a></div>';
}
add_shortcode('bouton_hexfit', 'bouton_reservation_hexfit');

add_action('wp_ajax_get_hexfit_ics', 'proxy_google_calendar_ics');
add_action('wp_ajax_nopriv_get_hexfit_ics', 'proxy_google_calendar_ics');
function proxy_google_calendar_ics()
{
	$ics_url = 'https://calendar.google.com/calendar/ical/anisse.elbezazi%40gmail.com/public/basic.ics';
	$response = wp_remote_get($ics_url, array('sslverify' => false, 'timeout' => 15));
	if (ob_get_length()) {
		ob_clean();
	}
	if (is_wp_error($response)) {
		header('Content-Type: text/plain; charset=utf-8');
		echo "Erreur WordPress : " . $response->get_error_message();
	} else {
		header('Content-Type: text/calendar; charset=utf-8');
		echo wp_remote_retrieve_body($response);
	}
	wp_die();
}

// --- 3. CHARGEMENT ASSETS SÉPARÉS (CSS / JS) ---
function charger_assets_calendrier()
{
	// Force le chargement sans condition pour éviter le bug d'affichage
	wp_enqueue_script('ical-js', 'https://cdn.jsdelivr.net/npm/ical.js@1.5.0/build/ical.min.js', array(), null, true);
	wp_enqueue_script('fullcalendar-core', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js', array(), null, true);
	wp_enqueue_script('fullcalendar-ical', 'https://cdn.jsdelivr.net/npm/@fullcalendar/icalendar@6.1.10/index.global.min.js', array('fullcalendar-core', 'ical-js'), null, true);

	// time() empêche le cache local de bloquer ton CSS pendant que tu travailles dessus
	wp_enqueue_style('calendrier-style', get_stylesheet_directory_uri() . '/css/calendrier-style.css', array(), time());
	wp_enqueue_script('calendrier-script', get_stylesheet_directory_uri() . '/js/calendrier-script.js', array('fullcalendar-ical'), time(), true);

	// Injection de l'URL pour le fichier JS
	wp_localize_script('calendrier-script', 'hexfitData', array(
		'ajaxUrl' => admin_url('admin-ajax.php?action=get_hexfit_ics')
	));
}
add_action('wp_enqueue_scripts', 'charger_assets_calendrier');

// --- 4. SHORTCODE HTML ---
function afficher_dashboard_calendrier_hexfit()
{
	ob_start(); ?>
	<div class="planning-wrapper">
		<div class="planning-header">
			<h1>Planning Global</h1>
		</div>
		<div class="main-content">
			<div id="calendar-design"></div>
		</div>
	</div>
<?php return ob_get_clean();
}
add_shortcode('calendrier_dashboard', 'afficher_dashboard_calendrier_hexfit');
