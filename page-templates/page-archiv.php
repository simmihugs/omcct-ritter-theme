<?php

/** Template Name: Archiv Seite **/
get_header(); ?>


<main class="archiv-container">
    <div class="archiv-sticky-header">
        <h1>Ordens-Archiv</h1>
        <nav class="archiv-nav">
            <?php 
            $cats = get_terms('archiv_kategorie');
            foreach($cats as $cat): ?>
                <a href="#cat-<?php echo $cat->slug; ?>">
                    <span class="dashicons dashicons-category"></span> 
                    <?php echo $cat->name; ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
	<?php foreach ($cats as $cat): ?>
		<section id="cat-<?php echo $cat->slug; ?>" class="archiv-section">
			<h2><?php echo $cat->name; ?></h2>
			<div class="doc-list">
				<?php
				$docs = new WP_Query(array(
					'post_type' => 'archiv_doc',
					'tax_query' => array(array('taxonomy' => 'archiv_kategorie', 'field' => 'slug', 'terms' => $cat->slug)),
					'posts_per_page' => -1
				));

				if ($docs->have_posts()):
					while ($docs->have_posts()): $docs->the_post(); ?>
						<article class="archiv-article-entry">
							<h3><?php the_title(); ?></h3>
							<div class="article-body">
								<?php the_content();
								?>
							</div>
							<hr class="separator">
						</article>
					<?php endwhile;
					wp_reset_postdata();
				else: ?>
					<p>Noch keine Dokumente in dieser Kategorie vorhanden.</p>
				<?php endif; ?>
			</div>
		</section>
	<?php endforeach; ?>
</main>

					
<?php get_footer(); ?>
