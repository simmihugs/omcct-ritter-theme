<?php


function register_partner_post_type() {
    $labels = array(
        'name'                  => 'Partner',
        'singular_name'         => 'Partner',
        'menu_name'             => 'Partner / Bünde',
        'add_new'               => 'Neuen hinzufügen',
        'add_new_item'          => 'Neuen Partner hinzufügen',
        'edit_item'             => 'Partner bearbeiten',
        'new_item'              => 'Neuer Partner',
        'view_item'             => 'Partner ansehen',
        'all_items'             => 'Alle Partner',
        'search_items'          => 'Partner suchen',
        'not_found'             => 'Keine Partner gefunden.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-groups',
        'menu_position'      => 6,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
        'rewrite'            => array('slug' => 'partner'),
    );

    register_post_type('partner', $args);
}

function register_partner_meta_boxes() {
    add_meta_box(
        'partner_details', 
        'Partner Kontakt-Details', 
        'display_partner_meta_box', 
        'partner', 
        'normal', 
        'high'
    );
}



function display_partner_meta_box($post) {
    $website = get_post_meta($post->ID, 'website_url', true);
    $email = get_post_meta($post->ID, 'kontakt_email', true);
    
    wp_nonce_field('partner_meta_save', 'partner_meta_nonce');
    ?>
    <div style="padding: 10px 0;">
        <p>
            <label for="website_url"><strong>Website URL:</strong></label><br>
            <input type="url" name="website_url" id="website_url" value="<?php echo esc_attr($website); ?>" style="width:100%;" placeholder="https://...">
        </p>
        <p>
            <label for="kontakt_email"><strong>Kontakt E-Mail:</strong></label><br>
            <input type="email" name="kontakt_email" id="kontakt_email" value="<?php echo esc_attr($email); ?>" style="width:100%;" placeholder="ritter@orden.at">
        </p>
    </div>
    <?php
}


function save_partner_meta($post_id) {
    if (!isset($_POST['partner_meta_nonce']) || !wp_verify_nonce($_POST['partner_meta_nonce'], 'partner_meta_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['website_url'])) {
        update_post_meta($post_id, 'website_url', esc_url_raw($_POST['website_url']));
    }
    if (isset($_POST['kontakt_email'])) {
        update_post_meta($post_id, 'kontakt_email', sanitize_email($_POST['kontakt_email']));
    }
}


add_action('init', 'register_partner_post_type');
add_action('add_meta_boxes', 'register_partner_meta_boxes');
add_action('save_post_partner', 'save_partner_meta');
