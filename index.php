<?php get_header(); ?>

<main class="site-content">
  <h1>Willkommen auf der Homepage unseres Ritterordens!</h1>
  <?php 
    if (have_posts()) : 
      while (have_posts()) : the_post(); 
        the_content(); 
      endwhile; 
    endif; 
  ?>
</main>

<?php get_footer(); ?>
