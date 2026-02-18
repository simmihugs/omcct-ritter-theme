<?php /* footer.php */ ?>
    </div> </div> <footer class="site-footer">
    <div class="footer-content-box">
        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> OMCCT - Ordo Militiae Christi Chordi ad
        </div>
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
