<?php

function register_partner_meta_boxes() {
    add_meta_box('partner_details', 'Partner Kontakt-Details', 'display_partner_meta_box', 'post', 'normal', 'high');
}


function display_partner_meta_box($post) {
    $website = get_post_meta($post->ID, 'website_url', true);
    $email = get_post_meta($post->ID, 'kontakt_email', true);
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
    if (isset($_POST['website_url'])) {
        update_post_meta($post_id, 'website_url', sanitize_text_field($_POST['website_url']));
    }
    if (isset($_POST['kontakt_email'])) {
        update_post_meta($post_id, 'kontakt_email', sanitize_email($_POST['kontakt_email']));
    }
}

add_action('add_meta_boxes', 'register_partner_meta_boxes');
add_action('save_post', 'save_partner_meta');
