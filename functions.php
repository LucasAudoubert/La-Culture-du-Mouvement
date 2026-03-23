<?php
/**
 * culture_mouvement functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package culture_mouvement
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function culture_mouvement_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on culture_mouvement, use a find and replace
		* to change 'culture_mouvement' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'culture_mouvement', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'culture_mouvement' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'culture_mouvement_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'culture_mouvement_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function culture_mouvement_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'culture_mouvement_content_width', 640 );
}
add_action( 'after_setup_theme', 'culture_mouvement_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function culture_mouvement_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'culture_mouvement' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'culture_mouvement' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'culture_mouvement_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function culture_mouvement_scripts() {
	wp_enqueue_style( 'culture_mouvement-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'culture_mouvement-style', 'rtl', 'replace' );

	// Enqueue header styles
	wp_enqueue_style( 'culture_mouvement-header', get_template_directory_uri() . '/style/header.css', array(), _S_VERSION );
	
	// Enqueue footer styles

	wp_enqueue_script( 'culture_mouvement-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'culture_mouvement_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Enqueue Leaflet.js uniquement sur la page d'accueil
 */
function culture_mouvement_enqueue_leaflet() {
    if ( is_front_page() ) {

        // Leaflet CSS
        wp_enqueue_style(
            'leaflet-css',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
            [],
            '1.9.4'
        );

        // ── Ton CSS custom pour la map ──
        wp_enqueue_style(
            'map-css',
            get_template_directory_uri() . '/styles/map.css',
            [ 'leaflet-css' ], // ← chargé après Leaflet
            filemtime( get_template_directory() . '/styles/map.css' )
        );

        // Leaflet JS
        wp_enqueue_script(
            'leaflet-js',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
            [],
            '1.9.4',
            true // ← dans le footer
        );

        // Ton script custom
        wp_enqueue_script(
            'map-init',
            get_template_directory_uri() . '/js/map-init.js',
            [ 'leaflet-js' ],
            filemtime( get_template_directory() . '/js/map-init.js' ),
            true
        );


        // Passer les coordonnées PHP → JS
        wp_localize_script( 'map-init', 'mapConfig', [
            'lat'  => '48.8566',
            'lng'  => '2.3522',
            'nom'  => 'Culture Mouvement',
        ]);

		wp_localize_script( 'map-init', 'mapConfig', [
			'adresse'   => '21 avenue du muguet, 95230 Soisy-sous-Montmorency, France',
			'cp_ville'  => '95230 Soisy-sous-Montmorency',
			'rue'       => '21 avenue du muguet',
			'gare'      => 'Gare la plus proche du local',
			'parking'   => 'Nom du parking',
			'email'     => 'coach.laculturemouvement@gmail.com',
			'telephone' => '+33 6 00 00 00 00',
			'nom'       => 'Culture Mouvement',
		]);
    }
}
add_action( 'wp_enqueue_scripts', 'culture_mouvement_enqueue_leaflet' );

