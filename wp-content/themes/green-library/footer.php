</main>

<footer class="site-footer">
    <div class="footer-content">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <?php _e( 'All rights reserved.', 'green-library' ); ?></p>
        <?php if ( get_theme_mod( 'footer_text' ) ) : ?>
            <p><?php echo wp_kses_post( get_theme_mod( 'footer_text' ) ); ?></p>
        <?php endif; ?>
        
        <?php
        wp_nav_menu( array(
            'theme_location' => 'footer-menu',
            'menu_class'     => 'footer-menu',
            'container'      => 'nav',
            'container_class'=> 'footer-navigation',
            'fallback_cb'    => false,
        ) );
        ?>
    </div>
</footer>

<script>
function copyToClipboard(url) {
    navigator.clipboard.writeText(url).then(function() {
        var btn = document.querySelector('.share-copy');
        if (btn) {
            btn.classList.add('copied');
            btn.title = 'คัดลอกแล้ว!';
            setTimeout(function() {
                btn.classList.remove('copied');
                btn.title = 'คัดลอกลิงก์';
            }, 2000);
        }
    });
}
</script>
<?php wp_footer(); ?>
</body>
</html>
