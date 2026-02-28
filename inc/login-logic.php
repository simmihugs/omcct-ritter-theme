<?php
function omcct_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'administrator', $user->roles ) ) {
            return $redirect_to;
        } else {
            return home_url();
        }
    }
    return $redirect_to;
}

function grossmeister_login_redirect($redirect_to, $request, $user) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('editor', $user->roles)) {
            return admin_url(); // Leitet direkt zum Dashboard (/wp-admin/)
        }
    }
    return $redirect_to;
}

function omcct_login_styling() { ?>
    <style type="text/css">
        body.login { background-color: #f4f4f4; }
        #login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/screenshot.png);
            background-size: contain;
            width: 100%;
            height: 100px;
        }
        .login #loginwp { display: none; }
        .wp-core-ui .button-primary {
            background: #8b0000 !important; /* Dein Rot */
            border-color: #660000 !important;
            text-shadow: none !important;
            box-shadow: none !important;
        }
        .login form {
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
<?php }

add_filter( 'login_redirect', 'omcct_login_redirect', 10, 3 );
add_filter('login_redirect', 'grossmeister_login_redirect', 10, 3);
add_action( 'login_enqueue_scripts', 'omcct_login_styling' );
