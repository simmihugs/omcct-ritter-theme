<?php
/* Template Name: Galerie Übersicht */
get_header(); ?>

<div class="galerie-wrapper">
    <div class="galerie-grid">
        <?php
        $args = array(
            'category_name' => 'galerie',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $galerie_query = new WP_Query($args);

        if ($galerie_query->have_posts()) :
            while ($galerie_query->have_posts()) : $galerie_query->the_post(); ?>
                
                <a href="<?php the_permalink(); ?>" class="galerie-card">
                    <div class="galerie-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium_large'); ?>
                        <?php else: ?>
                            <img src="pfad/zu/deinem/ersatzbild.jpg" alt="Ritterwappen">
                        <?php endif; ?>
                    </div>
                    <div class="galerie-info">
                        <h3><?php the_title(); ?></h3>
                        <span class="galerie-date"><?php echo get_the_date('Y'); ?></span>
                    </div>
                </a>

            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</div>

<?php get_footer(); ?>
