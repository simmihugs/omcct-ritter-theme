<?php
/** Template Name: Kalendarium **/
get_header(); ?>

<main class="archiv-container"> <div class="archiv-sticky-header">
        <h1 class="archiv-title">Ordens-Kalendarium</h1>
        <p style="margin: 0; color: #666; font-size: 0.9rem;">
            Abonniere den Kalender für dein Smartphone über die Buttons unten im Kalender.
        </p>
    </div>

    <div class="archiv-content-scroll" style="margin-top: 100px;">
        <div class="ritter-kalender-wrapper">
            <?php 
            // Dieser Shortcode rendert den kompletten Kalender
            echo do_shortcode('[tribe_events]'); 
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
