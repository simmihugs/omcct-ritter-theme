<?php
function omcct_setup() {
    // Titel-Unterstützung
    add_theme_support('title-tag');

    // Menü-System freischalten
    register_nav_menus(array(
        'main-menu' => 'Hauptmenü Oben',
    ));
}
add_action('after_setup_theme', 'omcct_setup');

function omcct_scripts() {
    // Haupt-Stylesheet laden
    wp_enqueue_style('omcct-main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'omcct_scripts');
