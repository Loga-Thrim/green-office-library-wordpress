<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="site-header-container">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main-logo.png" alt="<?php bloginfo( 'name' ); ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/images/logo.png'">
                <?php endif; ?>
            </a>
        </div>
        
        <button class="mobile-menu-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main',
                'menu_class'     => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => 'green_library_default_menu',
            ) );
            ?>
        </nav>
    </div>
</header>

<?php if ( is_front_page() ) : ?>
<section class="hero-section hero-carousel">
    <div class="carousel-container">
        <div class="carousel-slides">
            <?php
            // Get number of slides from Customizer (default 3)
            $slide_count = get_theme_mod( 'hero_slide_count', 3 );
            
            for ( $slide_num = 1; $slide_num <= $slide_count; $slide_num++ ) :
                $slide_active = ( $slide_num === 1 ) ? ' active' : '';
                
                // Get slide image from Customizer
                $slide_image = get_theme_mod( "hero_slide_{$slide_num}_image", '' );
                $slide_alt = get_theme_mod( "hero_slide_{$slide_num}_alt", '' );
                $slide_link = get_theme_mod( "hero_slide_{$slide_num}_link", '' );
                
                // Skip slide if no image
                if ( empty( $slide_image ) ) {
                    continue;
                }
            ?>
            
            <div class="carousel-slide<?php echo $slide_active; ?>" data-slide="<?php echo $slide_num; ?>">
                <?php if ( ! empty( $slide_link ) ) : ?>
                    <a href="<?php echo esc_url( $slide_link ); ?>" class="carousel-slide-link">
                        <img src="<?php echo esc_url( $slide_image ); ?>" 
                             alt="<?php echo esc_attr( $slide_alt ? $slide_alt : 'Slide ' . $slide_num ); ?>" 
                             class="carousel-slide-image">
                    </a>
                <?php else : ?>
                    <img src="<?php echo esc_url( $slide_image ); ?>" 
                         alt="<?php echo esc_attr( $slide_alt ? $slide_alt : 'Slide ' . $slide_num ); ?>" 
                         class="carousel-slide-image">
                <?php endif; ?>
            </div>
            
            <?php endfor; ?>
        </div>
        
        <!-- Carousel Controls -->
        <button class="carousel-control prev" aria-label="Previous Slide">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <button class="carousel-control next" aria-label="Next Slide">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
        
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <?php for ( $i = 1; $i <= $slide_count; $i++ ) : ?>
                <button 
                    class="carousel-indicator<?php echo ( $i === 1 ) ? ' active' : ''; ?>" 
                    data-slide-to="<?php echo $i; ?>"
                    aria-label="Slide <?php echo $i; ?>"
                ></button>
            <?php endfor; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<main class="site-content">
