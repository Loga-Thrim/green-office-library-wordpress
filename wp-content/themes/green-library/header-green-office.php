<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class('green-office-body'); ?>>
<?php wp_body_open(); ?>

<header class="site-header green-office-header">
    <nav class="green-office-navigation">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="green-office-logo-link">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/green-office-logo.png" alt="Green Office Logo" class="green-office-logo-img" onerror="this.style.display='none'">
        </a>
        
        <button class="mobile-menu-toggle green-office-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <?php
        wp_nav_menu( array(
            'theme_location' => 'green-office',
            'menu_class'     => 'green-office-menu',
            'container'      => false,
            'fallback_cb'    => 'green_library_green_office_menu',
        ) );
        ?>
    </nav>
</header>
