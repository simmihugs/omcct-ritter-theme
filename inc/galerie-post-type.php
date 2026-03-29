<?php


function register_galerie_post_type() {
    $labels = array(
        'name'                  => 'Galerien',
        'singular_name'         => 'Galerie',
        'menu_name'             => 'Galerien',
        'add_new'               => 'Neue Galerie',
        'add_new_item'          => 'Neue Bildergalerie hinzufügen',
        'edit_item'             => 'Galerie bearbeiten',
        'new_item'              => 'Neue Galerie',
        'view_item'             => 'Galerie ansehen',
        'all_items'             => 'Alle Galerien',
        'search_items'          => 'Galerien suchen',
        'not_found'             => 'Keine Galerien gefunden.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-format-gallery',
        'menu_position'      => 7,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
		'rewrite'            => array('slug' => 'galerie-beitrag', 'with_front' => false),
    );

    register_post_type('galerie', $args);
}


function register_galerie_meta_boxes() {
    add_meta_box(
        'galerie_details',
        'Galerie Informationen',
        'display_galerie_meta_box',
        'galerie',
        'normal',
        'high'
    );
}


function display_galerie_meta_box($post) {
    $location = get_post_meta($post->ID, 'galerie_location', true);
    wp_nonce_field('galerie_meta_save', 'galerie_meta_nonce');
    ?>
    <div style="padding: 10px 0;">
        <p>
            <label for="galerie_location"><strong>Ort der Aufnahmen:</strong></label><br>
            <input type="text" name="galerie_location" id="galerie_location" value="<?php echo esc_attr($location); ?>" style="width:100%;" placeholder="z.B. Burg Randeck, Rittersaal">
        </p>
        <p class="description">Hinweis: Nutze den Standard-Editor oben ("Galerie hinzufügen"), um die Bilder in den Beitrag einzufügen.</p>
    </div>
    <?php
}


function save_galerie_meta($post_id) {
    if (!isset($_POST['galerie_meta_nonce']) || !wp_verify_nonce($_POST['galerie_meta_nonce'], 'galerie_meta_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['galerie_location'])) {
        update_post_meta($post_id, 'galerie_location', sanitize_text_field($_POST['galerie_location']));
    }
}

add_action('init', 'register_galerie_post_type');
add_action('add_meta_boxes', 'register_galerie_meta_boxes');
add_action('save_post_galerie', 'save_galerie_meta');

