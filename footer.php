<?php /* footer.php */ ?>
    </div> </div> <footer class="site-footer">
    <div class="footer-content-box">
        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> OMCCT - Ordo Militiae Christi Chordi ad Tirolias
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const menuOverlay = document.getElementById('mobile-menu-overlay');
    const body = document.body;

    if (menuToggle && menuOverlay) {
        menuToggle.addEventListener('click', function() {
            menuOverlay.classList.toggle('active');
            
            body.classList.toggle('menu-open');
            
            menuToggle.classList.toggle('is-active');
        });

        const navLinks = menuOverlay.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuOverlay.classList.remove('active');
                body.classList.remove('menu-open');
                menuToggle.classList.remove('is-active');
            });
        });
    }
});
</script>

</body>
</html>
