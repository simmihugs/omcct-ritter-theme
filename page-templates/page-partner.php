<?php
/* Template Name: Partner Übersicht */
get_header(); ?>

<div class="container">
    <h1 class="entry-title">Befreundete Freundesbünde</h1>
    
    <div class="partner-grid">
        <?php
        $partner_query = new WP_Query(array(
            'category_name' => 'partner', 
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ));
        
        if ($partner_query->have_posts()) :
            while ($partner_query->have_posts()) : $partner_query->the_post(); ?>
                
                <div class="partner-card">
                    <div class="partner-wappen">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else: ?>
                            <div class="wappen-placeholder"></div>
                        <?php endif; ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    
                    <div class="partner-actions">
                        <a href="<?php echo get_post_meta(get_the_ID(), 'website_url', true); ?>" class="action-btn" title="Website besuchen" target="_blank">
                            <span>&#127760;</span>
                        </a>
                        <a href="mailto:<?php echo get_post_meta(get_the_ID(), 'kontakt_email', true); ?>" class="action-btn" title="E-Mail schreiben">
                            <span>&#9993;</span>
                        </a>
                    </div>
                </div>

            <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <p>Keine Partner gefunden. Bitte Kategorie prüfen.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
