<?php
function omcct_setup() {
    add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'main-menu' => 'Hauptmenü Oben',
    ));
}
add_action('after_setup_theme', 'omcct_setup');

function omcct_scripts() {
    wp_enqueue_style('omcct-main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'omcct_scripts');

register_nav_menus(array(
    'main-menu'   => 'Hauptmenü Oben',
    'footer-menu' => 'Footer Menü Unten',
));


// Custom Post Type für die Tafelrunde (Mitglieder)
function register_ritter_post_type() {
    $labels = array(
        'name'               => 'Ritter',
        'singular_name'      => 'Ritter',
        'menu_name'          => 'Tafelrunde (Ritter)',
        'add_new'            => 'Neuen Ritter hinzufügen',
        'add_new_item'       => 'Neuen Ritter anlegen',
        'edit_item'          => 'Ritter bearbeiten',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-shield',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true, 
    );

    register_post_type('ritter', $args);
}
add_action('init', 'register_ritter_post_type');


// Meta Box mit Medien-Upload
function ritter_wappen_meta_box() {
    add_meta_box('ritter_wappen', 'Ritter-Wappen', 'display_ritter_wappen_meta_box', 'ritter', 'side');
}
add_action('add_meta_boxes', 'ritter_wappen_meta_box');

function display_ritter_wappen_meta_box($post) {
    $wappen_url = get_post_meta($post->ID, 'ritter_wappen', true);
    wp_nonce_field('ritter_wappen_save', 'ritter_wappen_nonce');
    ?>
    <div id="ritter-wappen-container">
        <img id="ritter-wappen-preview" src="<?php echo esc_url($wappen_url); ?>" style="max-width:100%; display:<?php echo $wappen_url ? 'block' : 'none'; ?>; margin-bottom:10px;" />
        <input type="hidden" name="ritter_wappen" id="ritter_wappen_input" value="<?php echo esc_attr($wappen_url); ?>" />
        <button type="button" class="button" id="ritter_wappen_upload_btn">Wappen auswählen</button>
        <button type="button" class="button" id="ritter_wappen_remove_btn" style="display:<?php echo $wappen_url ? 'inline-block' : 'none'; ?>;">Entfernen</button>
    </div>
    
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#ritter_wappen_upload_btn').on('click', function(e) {
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({ title: 'Wappen auswählen', button: { text: 'Wappen verwenden' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#ritter_wappen_input').val(attachment.url);
                $('#ritter_wappen_preview').attr('src', attachment.url).show();
                $('#ritter_wappen_remove_btn').show();
            });
            frame.open();
        });
        $('#ritter_wappen_remove_btn').on('click', function() {
            $('#ritter_wappen_input').val('');
            $('#ritter_wappen_preview').hide();
            $(this).hide();
        });
    });
    </script>
    <?php
}

// Skripte für den Medien-Uploader im Backend laden
function load_ritter_admin_scripts($hook) {
    if ('post.php' != $hook && 'post-new.php' != $hook) return;
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_ritter_admin_scripts');

// Speichern bleibt gleich
add_action('save_post', function($post_id) {
    if (!isset($_POST['ritter_wappen_nonce']) || !wp_verify_nonce($_POST['ritter_wappen_nonce'], 'ritter_wappen_save')) return;
    if (isset($_POST['ritter_wappen'])) update_post_meta($post_id, 'ritter_wappen', $_POST['ritter_wappen']);
});
