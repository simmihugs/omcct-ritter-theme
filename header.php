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

				<nav class="main-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => false,
						'menu_class' => 'nav-list',
					));
					?>
				</nav>

				<div class="header-actions">
					<?php if (is_user_logged_in()) : ?>
						<a href="<?php echo wp_logout_url(home_url()); ?>" class="recken-icon logged-in" title="Abmelden">
							<span class="dashicons dashicons-exit"></span>
						</a>
					<?php else : ?>
						<a href="<?php echo wp_login_url(); ?>" class="recken-icon logged-out" title="Recken-Login">
							<span class="dashicons dashicons-admin-users"></span>
						</a>
					<?php endif; ?>
				</div>

				<div class="logo-area">
					<img src="<?php echo get_template_directory_uri(); ?>/img/screenshot.png" alt="Wappen">
				</div>
			</div>
		</div>
	</header>

	<div class="fixed-sidebar-decoration"></div>

	<div class="main-container content-wrapper">
		<main class="site-content">
