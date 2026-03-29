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

				<div class="logo-area">
					<img src="<?php echo get_template_directory_uri(); ?>/img/wappen.png" alt="Wappen">
				</div>

				<div class="branding">
					<span class="title">OMCCT</span>
					<span class="tagline hide-mobile">Ordo Militiae Christi Chordi ad Tirolias</span>
				</div>

				<nav class="main-navigation hide-mobile">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => false,
						'menu_class' => 'nav-list',
					));
					?>
				</nav>

				<div class="header-actions hide-mobile">
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

				<button class="mobile-menu-toggle" aria-label="Menü öffnen">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>

			</div>
		</div>
	</header>

	<div id="mobile-menu-overlay" class="mobile-menu-overlay">
		<div class="mobile-menu-content">
			<ul class="mobile-nav-list">
				<li class="menu-item login-item">
					<?php if (is_user_logged_in()) : ?>
						<a href="<?php echo wp_logout_url(home_url()); ?>">
							<span class="dashicons dashicons-exit"></span> Abmelden
						</a>
					<?php else : ?>
						<a href="<?php echo wp_login_url(); ?>">
							<span class="dashicons dashicons-admin-users"></span> Recken-Login
						</a>
					<?php endif; ?>
				</li>

				<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'container'      => false,
					'items_wrap'     => '%3$s',
				));
				?>
			</ul>
		</div>
	</div>

	<div id="mobile-menu-overlay" class="mobile-menu-overlay">
		<div class="mobile-menu-content">
			<div class="mobile-login-row">
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo wp_logout_url(home_url()); ?>">Abmelden <span class="dashicons dashicons-exit"></span></a>
				<?php else : ?>
					<a href="<?php echo wp_login_url(); ?>">Recken-Login <span class="dashicons dashicons-admin-users"></span></a>
				<?php endif; ?>
			</div>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'container' => false,
				'menu_class' => 'mobile-nav-list',
			));
			?>
		</div>
	</div>
	<div class="fixed-sidebar-decoration"></div>

	<div class="main-container content-wrapper">
		<main class="site-content">
