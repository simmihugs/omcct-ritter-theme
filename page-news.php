<?php
/* Template Name: News Timeline */
get_header(); ?>

<div class="news-container">
    <aside class="year-navigation">
        <ul id="year-list">
            </ul>
    </aside>

    <main class="news-timeline">
        <?php
        $current_year = null;
        $args = array(
            'category_name' => 'news',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $news_query = new WP_Query($args);

        if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post();
                $post_year = get_the_date('Y');

                // Wenn ein neues Jahr beginnt, gib die Jahreszahl als Trenner/Anker aus
                if ($post_year !== $current_year) {
                    $current_year = $post_year;
                    echo '<h2 id="year-' . $current_year . '" class="timeline-year">' . $current_year . '</h2>';
                }
                ?>
                <article class="news-item">
                    <h3><?php the_title(); ?></h3>
                    <div class="news-meta"><?php echo get_the_date(); ?></div>
                    <div class="news-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </main>
</div>

<?php get_footer(); ?>
