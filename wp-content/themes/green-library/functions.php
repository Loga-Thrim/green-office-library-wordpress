<?php
/**
 * Green Library Theme Functions
 * 
 * @package Green_Library
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme Setup
 */
function green_library_setup() {
    // Register Navigation Menus
    register_nav_menus( array(
        'main'          => __( 'Main Site Menu', 'green-library' ),
        'green-library' => __( 'Green Library Menu', 'green-library' ),
        'green-office'  => __( 'Green Office Menu', 'green-library' ),
    ) );
    
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
    
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );
    
    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    
    // Enable support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    
    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // Add support for editor styles
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for wide alignment
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'green_library_setup' );

/**
 * Enqueue scripts and styles
 */
function green_library_scripts() {
    // Enqueue Thai fonts from Google Fonts
    wp_enqueue_style( 
        'green-library-fonts', 
        'https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&family=Prompt:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Enqueue main stylesheet
    wp_enqueue_style( 
        'green-library-style', 
        get_stylesheet_uri(),
        array( 'green-library-fonts' ),
        wp_get_theme()->get( 'Version' )
    );
    
    // Enqueue navigation script
    wp_enqueue_script(
        'green-library-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
    
    // Green Office page uses the same carousel script as main site
    // No need for separate carousel script
    
    // Enqueue carousel script
    wp_enqueue_script(
        'green-library-carousel',
        get_template_directory_uri() . '/assets/js/carousel.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
    
    // Enqueue Chart.js from CDN
    wp_enqueue_script(
        'chartjs',
        'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
        array(),
        '4.4.0',
        true
    );
    
    // Enqueue charts script
    wp_enqueue_script(
        'green-library-charts',
        get_template_directory_uri() . '/assets/js/charts.js',
        array( 'chartjs' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'green_library_scripts' );

/**
 * Default menu fallback
 */
function green_library_default_menu() {
    echo '<ul class="primary-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">หน้าแรก</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/green-office/' ) ) . '">สำนักงานสีเขียว</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/green-library/' ) ) . '">ห้องสมุดสีเขียว</a></li>';
    echo '<li><a href="#">เกี่ยวกับ</a></li>';
    echo '<li><a href="#">บริการ</a></li>';
    echo '<li><a href="#">ติดต่อ</a></li>';
    echo '</ul>';
}

/**
 * Green Office menu fallback
 */
function green_library_green_office_menu() {
    echo '<ul class="green-office-menu">';
    echo '<li><a href="' . home_url('/green-office/') . '">หน้าแรก</a></li>';
    echo '<li><a href="#">เกี่ยวกับ</a></li>';
    echo '<li><a href="#">กฎหมายที่เกี่ยวข้อง</a></li>';
    echo '<li><a href="#">เอกสารที่เกี่ยวข้อง</a></li>';
    echo '<li><a href="#">สื่อประชาสัมพันธ์</a></li>';
    echo '<li class="menu-item-has-children">';
    echo '<a href="#">ผลการดำเนินงาน</a>';
    echo '<ul class="sub-menu">';
    for ($i = 1; $i <= 7; $i++) {
        echo '<li><a href="' . home_url('/green-office/?year=2568&category=' . $i) . '">หมวดที่ ' . $i . '</a></li>';
    }
    echo '</ul>';
    echo '</li>';
    echo '</ul>';
}

/**
 * Note: Green Office Results pages now use the "Green Office Results (ผลการดำเนินงาน)" template
 * Admin creates pages like "ผลการดำเนินงาน ปี 2568" and assigns the template.
 * The year is automatically extracted from the page title.
 */

/**
 * Green Library menu fallback
 */
function green_library_green_library_menu() {
    echo '<ul class="green-library-sub-menu">';
    echo '<li class="current-menu-item"><a href="' . esc_url( home_url( '/green-library/' ) ) . '">หน้าแรก</a></li>';
    echo '<li><a href="#">เกี่ยวกับห้องสมุดสีเขียว</a></li>';
    echo '<li><a href="#">การดำเนินงาน</a></li>';
    echo '<li><a href="#">แหล่งข้อมูลห้องสมุดสีเขียว</a></li>';
    echo '<li><a href="#">เครือข่ายห้องสมุด</a></li>';
    echo '<li><a href="#">ติดต่อเรา</a></li>';
    echo '</ul>';
}

/**
 * Customizer additions
 */
function green_library_customize_register( $wp_customize ) {
    
    // ==========================================
    // MAIN SITE (/) Settings - Priority 30-39
    // ==========================================
    
    // Hero Carousel Section
    $wp_customize->add_section( 'main_hero_carousel_section', array(
        'title'       => __( '[Main] Carousel หน้าแรก', 'green-library' ),
        'description' => __( 'Upload images for the carousel slider. Each slide can have an optional link.', 'green-library' ),
        'priority'    => 30,
    ) );
    
    // Number of Slides
    $wp_customize->add_setting( 'hero_slide_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'hero_slide_count', array(
        'label'       => __( 'Number of Slides', 'green-library' ),
        'description' => __( 'How many image slides to display (1-10)', 'green-library' ),
        'section'     => 'main_hero_carousel_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 10,
            'step' => 1,
        ),
    ) );
    
    // Create settings for each slide
    $max_slides = 10;
    for ( $slide = 1; $slide <= $max_slides; $slide++ ) {
        
        // Slide Image
        $wp_customize->add_setting( "hero_slide_{$slide}_image", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "hero_slide_{$slide}_image", array(
            'label'       => sprintf( __( 'Slide %d - Image', 'green-library' ), $slide ),
            'description' => sprintf( __( 'Upload image for slide %d (recommended: 1920x600px)', 'green-library' ), $slide ),
            'section'     => 'main_hero_carousel_section',
        ) ) );
        
        // Slide Alt Text
        $wp_customize->add_setting( "hero_slide_{$slide}_alt", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( "hero_slide_{$slide}_alt", array(
            'label'   => sprintf( __( 'Slide %d - Alt Text', 'green-library' ), $slide ),
            'description' => __( 'Alternative text for accessibility', 'green-library' ),
            'section' => 'main_hero_carousel_section',
            'type'    => 'text',
        ) );
        
        // Slide Link (Optional)
        $wp_customize->add_setting( "hero_slide_{$slide}_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( "hero_slide_{$slide}_link", array(
            'label'       => sprintf( __( 'Slide %d - Link URL (Optional)', 'green-library' ), $slide ),
            'description' => __( 'If set, clicking the image will go to this URL', 'green-library' ),
            'section'     => 'main_hero_carousel_section',
            'type'        => 'url',
        ) );
    }
    
    // ==========================================
    // GREEN LIBRARY (/green-library) Settings - Priority 40-49
    // ==========================================
    
    // Green Library Carousel Section
    $wp_customize->add_section( 'green_library_carousel', array(
        'title'    => __( '[Green Library] Carousel', 'green-library' ),
        'priority' => 41,
    ) );
    
    // Green Library Carousel Images (up to 5 slides)
    for ( $i = 1; $i <= 5; $i++ ) {
        // Image setting
        $wp_customize->add_setting( "green_library_carousel_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            "green_library_carousel_{$i}_image",
            array(
                'label'    => sprintf( __( 'Slide %d Image', 'green-library' ), $i ),
                'section'  => 'green_library_carousel',
                'settings' => "green_library_carousel_{$i}_image",
            )
        ) );
        
        // Link setting
        $wp_customize->add_setting( "green_library_carousel_{$i}_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        
        $wp_customize->add_control( "green_library_carousel_{$i}_link", array(
            'label'    => sprintf( __( 'Slide %d Link (Optional)', 'green-library' ), $i ),
            'section'  => 'green_library_carousel',
            'settings' => "green_library_carousel_{$i}_link",
            'type'     => 'url',
        ) );
    }
    
    // Green Library Results - Dynamic Years from Pages
    $gl_results_pages = get_posts( array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-green-library-category.php',
        'post_status'    => 'publish',
    ) );
    
    // Extract years from page titles
    $gl_years = array();
    if ( ! empty( $gl_results_pages ) ) {
        foreach ( $gl_results_pages as $page ) {
            preg_match( '/(\d{4})/', $page->post_title, $matches );
            if ( isset( $matches[1] ) ) {
                $gl_years[] = intval( $matches[1] );
            }
        }
    }
    
    // Sort and remove duplicates
    $gl_years = array_unique( $gl_years );
    sort( $gl_years );
    
    $gl_priority = 42;
    
    foreach ( $gl_years as $gl_year ) {
        // Create section for each year
        $wp_customize->add_section( "green_library_year_{$gl_year}", array(
            'title'       => sprintf( __( '[Green Library] ผลการดำเนินงาน ปี %d', 'green-library' ), $gl_year ),
            'priority'    => $gl_priority,
            'description' => sprintf( __( 'เนื้อหาหมวด 1-9 สำหรับปี %d', 'green-library' ), $gl_year ),
        ) );
        $gl_priority++;
        
        // Create 9 category settings for each year
        for ( $i = 1; $i <= 9; $i++ ) {
            $setting_key = "green_library_year_{$gl_year}_category_{$i}_content";
            
            $wp_customize->add_setting( $setting_key, array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            ) );
            
            $wp_customize->add_control( $setting_key, array(
                'label'       => sprintf( __( 'หมวดที่ %d - HTML Content', 'green-library' ), $i ),
                'description' => __( 'Enter HTML content for this category', 'green-library' ),
                'section'     => "green_library_year_{$gl_year}",
                'type'        => 'textarea',
            ) );
        }
    }
    
    // ==========================================
    // GREEN OFFICE (/green-office) Settings - Priority 50+
    // ==========================================
    
    // Green Office Carousel Section
    $wp_customize->add_section( 'green_office_carousel', array(
        'title'    => __( '[Green Office] Carousel', 'green-library' ),
        'priority' => 51,
    ) );
    
    // Green Office Carousel Images (up to 5 slides)
    for ( $i = 1; $i <= 5; $i++ ) {
        // Image setting
        $wp_customize->add_setting( "green_office_carousel_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            "green_office_carousel_{$i}_image",
            array(
                'label'    => sprintf( __( 'Slide %d Image', 'green-library' ), $i ),
                'section'  => 'green_office_carousel',
                'settings' => "green_office_carousel_{$i}_image",
            )
        ) );
        
        // Link setting
        $wp_customize->add_setting( "green_office_carousel_{$i}_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        
        $wp_customize->add_control( "green_office_carousel_{$i}_link", array(
            'label'    => sprintf( __( 'Slide %d Link (Optional)', 'green-library' ), $i ),
            'section'  => 'green_office_carousel',
            'settings' => "green_office_carousel_{$i}_link",
            'type'     => 'url',
        ) );
    }
    
    // Green Office Results - Dynamic Years from Pages
    // Get all pages using the "Green Office Results" template
    $results_pages = get_posts( array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-green-office-category.php',
        'post_status'    => 'publish',
    ) );
    
    // Extract years from page titles
    $years = array();
    if ( ! empty( $results_pages ) ) {
        foreach ( $results_pages as $page ) {
            preg_match( '/(\d{4})/', $page->post_title, $matches );
            if ( isset( $matches[1] ) ) {
                $years[] = intval( $matches[1] );
            }
        }
    }
    
    // Sort and remove duplicates (NO default years - only show pages that exist)
    $years = array_unique( $years );
    sort( $years );
    
    $priority = 52;
    
    foreach ( $years as $year ) {
        // Create section for each year
        $wp_customize->add_section( "green_office_year_{$year}", array(
            'title'       => sprintf( __( '[Green Office] ผลการดำเนินงาน ปี %d', 'green-library' ), $year ),
            'priority'    => $priority,
            'description' => sprintf( __( 'เนื้อหาหมวด 1-7 สำหรับปี %d', 'green-library' ), $year ),
        ) );
        $priority++;
        
        // Create 7 category settings for each year
        for ( $i = 1; $i <= 7; $i++ ) {
            $setting_key = "green_office_year_{$year}_category_{$i}_content";
            
            $wp_customize->add_setting( $setting_key, array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            ) );
            
            $wp_customize->add_control( $setting_key, array(
                'label'       => sprintf( __( 'หมวดที่ %d - HTML Content', 'green-library' ), $i ),
                'description' => __( 'Enter HTML content for this category', 'green-library' ),
                'section'     => "green_office_year_{$year}",
                'type'        => 'textarea',
            ) );
        }
    }
    
}
add_action( 'customize_register', 'green_library_customize_register' );

/**
 * Register widget areas
 */
function green_library_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'green-library' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'green-library' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Footer Area', 'green-library' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer.', 'green-library' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'green_library_widgets_init' );

/**
 * Custom template tags
 */
if ( ! function_exists( 'green_library_posted_on' ) ) {
    function green_library_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        
        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );
        
        $posted_on = sprintf(
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );
        
        echo '<span class="posted-on">' . $posted_on . '</span>';
    }
}

if ( ! function_exists( 'green_library_posted_by' ) ) {
    function green_library_posted_by() {
        $byline = sprintf(
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );
        
        echo '<span class="byline"> ' . $byline . '</span>';
    }
}

/**
 * Create default menus on theme activation
 */
function green_library_create_default_menus() {
    // Create Green Office menu if it doesn't exist
    $menu_name = 'green-office';
    $menu_exists = wp_get_nav_menu_object( $menu_name );
    
    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );
        
        // Menu items for Green Office
        $menu_items = array(
            array( 'title' => 'หน้าแรก', 'url' => home_url( '/green-office/' ) ),
            array( 'title' => 'เกี่ยวกับสำนักงานสีเขียว', 'url' => home_url( '/green-office/about/' ) ),
            array( 'title' => 'คณะกรรมการ', 'url' => home_url( '/green-office/committee/' ) ),
            array( 'title' => 'นโยบายและแผน', 'url' => home_url( '/green-office/policy/' ) ),
            array( 'title' => 'มาตรการ', 'url' => home_url( '/green-office/measures/' ) ),
            array( 'title' => 'กฎหมายที่เกี่ยวข้อง', 'url' => home_url( '/green-office/laws/' ) ),
            array( 'title' => 'เอกสารที่เกี่ยวข้อง', 'url' => home_url( '/green-office/documents/' ) ),
            array( 'title' => 'สื่อประชาสัมพันธ์', 'url' => home_url( '/green-office/media/' ) ),
            array( 'title' => 'ผลการดำเนินงาน', 'url' => home_url( '/green-office/results/' ) ),
        );
        
        $menu_order = 1;
        foreach ( $menu_items as $item ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'   => $item['title'],
                'menu-item-url'     => $item['url'],
                'menu-item-status'  => 'publish',
                'menu-item-type'    => 'custom',
                'menu-item-position' => $menu_order,
            ) );
            $menu_order++;
        }
        
        // Assign menu to location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['green-office'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
    
    // Create Main menu if it doesn't exist
    $main_menu_name = 'main';
    $main_menu_exists = wp_get_nav_menu_object( $main_menu_name );
    
    if ( ! $main_menu_exists ) {
        $main_menu_id = wp_create_nav_menu( $main_menu_name );
        
        $main_menu_items = array(
            array( 'title' => 'หน้าแรก', 'url' => home_url( '/' ) ),
            array( 'title' => 'สำนักงานสีเขียว', 'url' => home_url( '/green-office/' ) ),
            array( 'title' => 'ห้องสมุดสีเขียว', 'url' => home_url( '/green-library/' ) ),
        );
        
        $menu_order = 1;
        foreach ( $main_menu_items as $item ) {
            wp_update_nav_menu_item( $main_menu_id, 0, array(
                'menu-item-title'   => $item['title'],
                'menu-item-url'     => $item['url'],
                'menu-item-status'  => 'publish',
                'menu-item-type'    => 'custom',
                'menu-item-position' => $menu_order,
            ) );
            $menu_order++;
        }
        
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['main'] = $main_menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
    
    // Create Green Library menu if it doesn't exist
    $gl_menu_name = 'green-library';
    $gl_menu_exists = wp_get_nav_menu_object( $gl_menu_name );
    
    if ( ! $gl_menu_exists ) {
        $gl_menu_id = wp_create_nav_menu( $gl_menu_name );
        
        $gl_menu_items = array(
            array( 'title' => 'หน้าแรก', 'url' => home_url( '/green-library/' ) ),
            array( 'title' => 'เกี่ยวกับห้องสมุดสีเขียว', 'url' => home_url( '/green-library/about/' ) ),
            array( 'title' => 'การดำเนินงาน', 'url' => home_url( '/green-library/operations/' ) ),
            array( 'title' => 'แหล่งข้อมูลห้องสมุดสีเขียว', 'url' => home_url( '/green-library/resources/' ) ),
            array( 'title' => 'เครือข่ายห้องสมุด', 'url' => home_url( '/green-library/network/' ) ),
            array( 'title' => 'ติดต่อเรา', 'url' => home_url( '/green-library/contact/' ) ),
        );
        
        $menu_order = 1;
        foreach ( $gl_menu_items as $item ) {
            wp_update_nav_menu_item( $gl_menu_id, 0, array(
                'menu-item-title'   => $item['title'],
                'menu-item-url'     => $item['url'],
                'menu-item-status'  => 'publish',
                'menu-item-type'    => 'custom',
                'menu-item-position' => $menu_order,
            ) );
            $menu_order++;
        }
        
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['green-library'] = $gl_menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
}
add_action( 'after_switch_theme', 'green_library_create_default_menus' );

// Also run on init if menus don't exist (for existing installations)
function green_library_maybe_create_menus() {
    if ( ! is_admin() ) {
        return;
    }
    
    $menus_created = get_option( 'green_library_menus_created' );
    if ( ! $menus_created ) {
        green_library_create_default_menus();
        update_option( 'green_library_menus_created', true );
    }
}
add_action( 'admin_init', 'green_library_maybe_create_menus' );
