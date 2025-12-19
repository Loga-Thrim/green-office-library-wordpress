<?php
/**
 * Template Name: Green Library
 * Template for Green Library (ห้องสมุดสีเขียว)
 *
 * @package Green_Library
 */

get_header('green-library-sub');
?>

<div class="green-library-page">
    <section class="gl-page-hero">
        <div class="gl-hero-particles">
            <div class="gl-particle"></div>
            <div class="gl-particle"></div>
            <div class="gl-particle"></div>
            <div class="gl-particle"></div>
            <div class="gl-particle"></div>
        </div>
        <div class="gl-hero-content">
            <div class="gl-hero-icon-wrap">
                <span class="gl-hero-main-icon">📚</span>
            </div>
            <h1 class="gl-hero-title">ห้องสมุด<span class="gl-highlight">สีเขียว</span></h1>
            <p class="gl-hero-subtitle">GREEN LIBRARY</p>
        </div>
        <div class="gl-hero-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,60 C300,100 600,20 900,60 C1050,80 1150,40 1200,60 L1200,120 L0,120 Z" fill="currentColor"/>
            </svg>
        </div>
    </section>

    <!-- Hero Carousel Section - Thumbnail Gallery Style -->
    <section class="gl-carousel-section">
        <div class="gl-carousel-wrapper">
            <!-- Main Image -->
            <div class="gl-main-slide">
                <?php
                $first_image = get_theme_mod("green_library_carousel_1_image");
                $first_link = get_theme_mod("green_library_carousel_1_link", '');
                if ($first_image) :
                    if ($first_link) : ?>
                        <a href="<?php echo esc_url($first_link); ?>">
                            <img src="<?php echo esc_url($first_image); ?>" alt="Green Library" class="gl-main-image active" data-index="0">
                        </a>
                    <?php else : ?>
                        <img src="<?php echo esc_url($first_image); ?>" alt="Green Library" class="gl-main-image active" data-index="0">
                    <?php endif;
                endif;
                
                // Preload other images (hidden)
                for ($i = 2; $i <= 5; $i++) {
                    $image_url = get_theme_mod("green_library_carousel_{$i}_image");
                    if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="Green Library Slide <?php echo $i; ?>" class="gl-main-image" data-index="<?php echo $i - 1; ?>">
                    <?php endif;
                }
                ?>
            </div>
            
            <!-- Thumbnail Strip -->
            <div class="gl-thumbnail-strip">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    $image_url = get_theme_mod("green_library_carousel_{$i}_image");
                    if ($image_url) :
                        $active_class = ($i === 1) ? 'active' : '';
                        ?>
                        <button class="gl-thumbnail <?php echo $active_class; ?>" data-index="<?php echo $i - 1; ?>">
                            <img src="<?php echo esc_url($image_url); ?>" alt="Thumbnail <?php echo $i; ?>">
                        </button>
                    <?php endif;
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Latest Posts Section - Magazine Layout -->
    <section class="gl-news-section">
        <div class="gl-news-container">
            <div class="gl-news-header">
                <h2 class="gl-news-title">
                    <span class="gl-news-icon">📰</span>
                    ข่าวสารและกิจกรรม
                </h2>
                <div class="gl-news-line"></div>
            </div>
            
            <div class="gl-news-grid">
                <?php
                // Query posts from 'green-library' category
                $gl_posts = new WP_Query( array(
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'category_name'  => 'green-library',
                ) );
                
                if ( $gl_posts->have_posts() ) :
                    $post_index = 0;
                    while ( $gl_posts->have_posts() ) : $gl_posts->the_post();
                        $card_class = ($post_index === 0) ? 'gl-news-card gl-news-featured' : 'gl-news-card';
                ?>
                    <article class="<?php echo $card_class; ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="gl-news-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( ($post_index === 0) ? 'large' : 'medium' ); ?>
                                </a>
                                <span class="gl-news-date-badge"><?php echo get_the_date( 'j M' ); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="gl-news-content">
                            <h3 class="gl-news-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php if ($post_index === 0) : ?>
                                <p class="gl-news-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="gl-news-readmore">อ่านต่อ →</a>
                        </div>
                    </article>
                <?php
                        $post_index++;
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="no-posts-message">
                        <p>ยังไม่มีข่าวสาร</p>
                        <p class="small-text">สร้างโพสต์ใหม่และเพิ่มในหมวดหมู่ "green-library"</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
?>
