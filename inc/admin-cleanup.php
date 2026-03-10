<?php

function cleanup_admin_menu_for_non_admins() {
    if (current_user_can('manage_options')) {
        return;
    }

    remove_menu_page('edit.php');                   
    remove_menu_page('upload.php');                 
    remove_menu_page('edit.php?post_type=page');    
    remove_menu_page('edit-comments.php');          
    remove_menu_page('wpcf7');                      
    remove_menu_page('tools.php');                  

}

add_action('admin_menu', 'cleanup_admin_menu_for_non_admins', 999);
