<?php
function theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'primary' => 'Menu Principal',
    ]);
}
add_action('after_setup_theme', 'theme_setup');
