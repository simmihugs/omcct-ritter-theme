<?php
function omcct_setup() {
    // Aktiviert den Titel im Browser-Tab
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'omcct_setup');

function omcct_scripts() {
    // Lädt deine style.css Datei
    wp_enqueue_style('omcct-main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'omcct_scripts');