<?php
/* Template Name: News Timeline */
get_header(); ?>

<div class="container news-wrapper">
	<?php

	$args = array(
		'post_type'  => 'news',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC'
	);
	$news_query = new WP_Query($args);

	if ($news_query->have_posts()) :
		$years = array();
		while ($news_query->have_posts()) : $news_query->the_post();
			$years[] = get_the_date('Y');
		endwhile;
		$unique_years = array_unique($years);
		$news_query->rewind_posts();
	?>

		<div class="news-nav-sticky">
			<nav class="news-jump-nav">
				<?php foreach ($unique_years as $year) : ?>
					<a href="#year-<?php echo $year; ?>" class="jump-btn">
						<span>&#128193;</span> <?php echo $year; ?>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>

		<main class="news-timeline">
			<?php
			$current_year = null;
			while ($news_query->have_posts()) : $news_query->the_post();
				$post_year = get_the_date('Y');

				if ($post_year !== $current_year) {
					$current_year = $post_year;
					echo '<h2 id="year-' . $current_year . '" class="timeline-year">' . $current_year . '</h2>';
				}
			?>
				<article class="news-item">
					<div class="news-card">
						<h3><?php the_title(); ?></h3>
						<div class="news-meta"><?php echo get_the_date(); ?></div>
						<div class="news-content">
							<?php the_content(); ?>
						</div>
					</div>
				</article>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</main>

	<?php else: ?>
		<p>Keine Neuigkeiten gefunden.</p>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
