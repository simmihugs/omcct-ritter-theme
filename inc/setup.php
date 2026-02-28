<?php

function omcct_setup() {
    add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'main-menu' => 'Hauptmenü Oben',
    ));
}

function omcct_scripts() {
    wp_enqueue_style('omcct-main-style', get_stylesheet_uri());
}

function omcct_enqueue_dashicons() {
    wp_enqueue_style( 'dashicons' );
}


register_nav_menus(array(
    'main-menu'   => 'Hauptmenü Oben',
    'footer-menu' => 'Footer Menü Unten',
));


add_action('after_setup_theme', 'omcct_setup');
add_action('wp_enqueue_scripts', 'omcct_scripts');
add_action( 'wp_enqueue_scripts', 'omcct_enqueue_dashicons' );
