<?php
function omcct_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'omcct_setup');

function omcct_scripts() {
    wp_enqueue_style('omcct-main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'omcct_scripts');
