<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class('green-library-sub-body'); ?>>
<?php wp_body_open(); ?>

<header class="site-header green-library-sub-header">
    <div class="green-library-sub-nav-container">
        <div class="green-library-sub-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/green-library-logo.png" alt="Green Library" onerror="this.style.display='none'">
            </a>
        </div>
        
        <button class="mobile-menu-toggle green-library-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <nav class="green-library-sub-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'green-library',
                'menu_class'     => 'green-library-sub-menu',
                'container'      => false,
                'fallback_cb'    => 'green_library_green_library_menu',
            ) );
            ?>
        </nav>
    </div>
</header>
