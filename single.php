<?php get_header(); ?>

<div class="container">
	<main id="primary" class="site-main">

		<?php while (have_posts()) : the_post(); ?>

			<?php if (has_category('galerie')) : ?>
				<div class="back-to-gallery-nav" style="margin: 20px 0;">
					<a href="<?php echo get_permalink(get_page_by_path('galerie')); ?>" class="btn-ritter-back">
						<span>&#10229;</span> Zurück zur Galerie-Übersicht
					</a>
				</div>
			<?php endif; ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				</header>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>

		<?php endwhile; ?>

	</main>
</div>

<?php get_footer(); ?>
