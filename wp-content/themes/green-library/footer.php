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

// Green Library Thumbnail Gallery with Auto-Slide
document.addEventListener('DOMContentLoaded', function() {
    var thumbnails = document.querySelectorAll('.gl-thumbnail');
    var mainImages = document.querySelectorAll('.gl-main-image');
    var currentIndex = 0;
    var autoSlideInterval;
    var slideDuration = 4000; // 4 seconds
    
    if (thumbnails.length === 0) return;
    
    function showSlide(index) {
        // Wrap around
        if (index >= thumbnails.length) index = 0;
        if (index < 0) index = thumbnails.length - 1;
        
        currentIndex = index;
        
        // Update thumbnails
        thumbnails.forEach(function(t) { t.classList.remove('active'); });
        thumbnails[index].classList.add('active');
        
        // Update main images
        mainImages.forEach(function(img) { img.classList.remove('active'); });
        var targetImage = document.querySelector('.gl-main-image[data-index="' + index + '"]');
        if (targetImage) {
            targetImage.classList.add('active');
        }
    }
    
    function nextSlide() {
        showSlide(currentIndex + 1);
    }
    
    function startAutoSlide() {
        stopAutoSlide();
        autoSlideInterval = setInterval(nextSlide, slideDuration);
    }
    
    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }
    
    // Click handlers for thumbnails
    thumbnails.forEach(function(thumb, idx) {
        thumb.addEventListener('click', function() {
            stopAutoSlide();
            showSlide(idx);
            startAutoSlide();
        });
    });
    
    // Pause on hover
    var carouselWrapper = document.querySelector('.gl-carousel-wrapper');
    if (carouselWrapper) {
        carouselWrapper.addEventListener('mouseenter', stopAutoSlide);
        carouselWrapper.addEventListener('mouseleave', startAutoSlide);
    }
    
    // Start auto-slide
    startAutoSlide();
});
</script>
<?php wp_footer(); ?>
</body>
</html>
