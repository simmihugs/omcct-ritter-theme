<?php get_header(); ?>

<main class="single-archiv-container">
    <article>
        <h1><?php the_title(); ?></h1>
        
        <div class="entry-content">
            <?php the_content();
        </div>
        
        <a href="<?php echo get_post_type_archive_link('archiv_doc'); ?>" class="back-link">← Zurück zum Archiv</a>
    </article>
</main>

<?php get_footer(); ?>
