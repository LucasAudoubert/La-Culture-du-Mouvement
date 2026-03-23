<?php
function theme_scripts()
{
    $uri = get_template_directory_uri();

    wp_enqueue_style('global-css', $uri . '/assets/css/global.css');
    wp_enqueue_style('header-css', $uri . '/assets/css/header.css');
    wp_enqueue_style('footer-css', $uri . '/assets/css/footer.css');
    wp_enqueue_style('hero-css', $uri . '/assets/css/hero.css');
    wp_enqueue_style('approche-css', get_template_directory_uri() . '/assets/css/approche.css');
    wp_enqueue_style('pour-qui-css', get_template_directory_uri() . '/assets/css/pour-qui.css');
    wp_enqueue_script('main-js', $uri . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');
