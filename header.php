<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="red-stripe">
        <div class="header-container">
            <div class="branding">
                <span class="title">OMCCT</span>
                <span class="tagline">Ordo Militiae Christi Chordi ad</span>
            </div>
            <div class="logo-area">
                <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Wappen">
            </div>
        </div>
    </div>
</header>

<div class="fixed-sidebar-decoration"></div>

<div class="main-container content-wrapper">
    <main class="site-content">
