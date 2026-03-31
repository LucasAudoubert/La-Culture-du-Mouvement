<?php

/**
 * culture_mouvement functions and definitions
 */

if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

// 1. Configuration de base (Supports, Menus, Widgets)
require get_template_directory() . '/inc/setup.php';

// 2. Chargement de tous les CSS et JS
require get_template_directory() . '/inc/enqueue.php';

// 3. Fonctions AJAX (Proxy Calendrier)
require get_template_directory() . '/inc/ajax-functions.php';

// 4. Shortcodes (Boutons et Calendrier)
require get_template_directory() . '/inc/shortcodes.php';

// 5. Autres fichiers générés par WordPress (Optionnel selon tes besoins)
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/contact-form.php';

