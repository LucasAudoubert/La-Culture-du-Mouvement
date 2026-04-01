<?php

/**
 * culture_mouvement functions and definitions
 */

if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/ajax-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/contact-form.php';

require get_template_directory() . '/inc/rename-field.php';
