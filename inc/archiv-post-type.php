<?php

function register_archiv_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'Archiv',
        'menu_icon' => 'dashicons-archive',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );
    register_post_type('archiv_doc', $args);
}

function register_archiv_logic() {
    // 1. Den Post Type registrieren
    $args = array(
        'public' => true,
        'label'  => 'Archiv',
        'menu_icon' => 'dashicons-archive',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'has_archive' => true,
    );
    register_post_type('archiv_doc', $args);

    // 2. Kategorien für das Archiv (Taxonomie)
    register_taxonomy('archiv_kategorie', 'archiv_doc', array(
        'label' => 'Archiv-Kategorien',
        'hierarchical' => true, // Verhält sich wie Kategorien, nicht wie Tags
        'show_in_rest' => true,
    ));
}

function display_archiv_pdf_meta($post) {
    $pdf_url = get_post_meta($post->ID, '_archiv_pdf_url', true);
    ?>
    <input type="text" name="archiv_pdf_url" id="archiv_pdf_url" value="<?php echo esc_url($pdf_url); ?>" style="width:80%;" />
    <button type="button" class="button" id="upload_pdf_btn">Datei wählen</button>
    <p class="description">Lade das PDF in die Mediathek hoch und kopiere die URL hier hinein oder nutze den Button.</p>
    <script>
    jQuery('#upload_pdf_btn').click(function(e) {
        e.preventDefault();
        var frame = wp.media({ title: 'PDF wählen', button: { text: 'Verwenden' }, multiple: false });
        frame.on('select', function() {
            var obj = frame.state().get('selection').first().toJSON();
            jQuery('#archiv_pdf_url').val(obj.url);
        });
        frame.open();
    });
    </script>
    <?php
}

function display_archiv_file_meta($post) {
    $file_url = get_post_meta($post->ID, '_archiv_file_url', true);
    ?>
    <div class="archiv-file-upload-wrapper">
        <input type="text" name="archiv_file_url" id="archiv_file_url" value="<?php echo esc_attr($file_url); ?>" style="width:100%; margin-bottom: 10px;" placeholder="https://..." />
        <button type="button" class="button" id="upload_file_button">Datei wählen</button>
        <p class="description">Wähle ein PDF oder Dokument aus der Mediathek.</p>
    </div>
    <script>
    jQuery(document).ready(function($){
        $('#upload_file_button').click(function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Dokument auswählen',
                button: { text: 'Datei verwenden' },
                multiple: false
            }).on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#archiv_file_url').val(attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}


add_action('add_meta_boxes', function() {
    add_meta_box('archiv_file_download', 'Datei-Download', 'display_archiv_file_meta', 'archiv_doc', 'side');
});


add_action('save_post', function($post_id) {
    if (isset($_POST['archiv_file_url'])) {
        update_post_meta($post_id, '_archiv_file_url', esc_url_raw($_POST['archiv_file_url']));
    }
});

add_action('init', 'register_archiv_post_type');
add_action('init', 'register_archiv_logic');


add_action('add_meta_boxes', function() {
    add_meta_box('archiv_pdf_file', 'PDF Dokument', 'display_archiv_pdf_meta', 'archiv_doc', 'normal', 'high');
});

add_action('save_post', function($post_id) {
    if (isset($_POST['archiv_pdf_url'])) update_post_meta($post_id, '_archiv_pdf_url', esc_url_raw($_POST['archiv_pdf_url']));
});

