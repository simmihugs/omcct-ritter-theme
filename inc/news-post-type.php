<?php

function register_news_post_type() {
    $labels = array(
        'name'                  => 'News',
        'singular_name'         => 'News-Eintrag',
        'menu_name'             => 'News',
        'name_admin_bar'        => 'News',
        'add_new'               => 'Neuen hinzufügen',
        'add_new_item'          => 'Neuen News-Eintrag hinzufügen',
        'new_item'              => 'Neuer Eintrag',
        'edit_item'             => 'Eintrag bearbeiten',
        'view_item'             => 'Eintrag ansehen',
        'all_items'             => 'Alle News',
        'search_items'          => 'News suchen',
        'not_found'             => 'Keine News gefunden.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'news'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5, // Direkt unter "Beiträge"
        'menu_icon'          => 'dashicons-megaphone', // Das Sprachrohr-Icon
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true, // WICHTIG: Aktiviert den modernen Gutenberg-Editor
    );

    register_post_type('news', $args);
}

add_action('init', 'register_news_post_type');
