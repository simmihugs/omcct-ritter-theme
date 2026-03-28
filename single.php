<?php get_header(); ?>

<div class="container">
    <main id="primary" class="site-main">

        <?php while (have_posts()) : the_post(); ?>

            <?php 
            if (get_post_type() === 'galerie') : 
            ?>
                <div class="back-to-gallery-nav" style="margin: 20px 0;">
                    <a href="<?php echo home_url('/galerie/'); ?>" class="btn-ritter-back">
                        <span>&#10229;</span>
                    </a>
                </div>
            <?php endif; ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    
                    <?php if (get_post_type() === 'galerie') : ?>
                        <div class="galerie-meta" style="margin-bottom: 20px; font-style: italic; color: #555;">
                            <?php 
                            $location = get_post_meta(get_the_ID(), 'galerie_location', true);
                            if ($location) {
                                echo 'Ort: ' . esc_html($location) . ' | ';
                            }
                            echo 'Jahr: ' . get_the_date('Y');
                            ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php 
                    the_content(); 
                    ?>
                </div>
            </article>

        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>
