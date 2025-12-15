<?php
/**
 * Template Name: Green Office
 * Template for Green Office (สำนักงานสีเขียว)
 *
 * @package Green_Library
 */

get_header('green-office');
?>

<div class="green-office-page">
    <section class="page-hero">
        <div class="page-hero-content">
            <h1 class="page-title">สำนักงานสีเขียว</h1>
            <p class="page-subtitle">Green Office</p>
        </div>
    </section>

    <!-- Hero Carousel Section -->
    <section class="hero-section green-office-hero-carousel">
        <div class="carousel-container">
            <div class="carousel-slides">
                <?php
                // Check for carousel images - supports both ACF and Customizer
                $has_carousel = false;
                
                // Try ACF first (if plugin is installed)
                if (function_exists('get_field')) {
                    $carousel_images = get_field('green_office_carousel_images');
                    if ($carousel_images && is_array($carousel_images) && !empty($carousel_images)) {
                        $has_carousel = true;
                        $slide_index = 0;
                        foreach ($carousel_images as $image) :
                            $active_class = ($slide_index === 0) ? 'active' : '';
                            $image_url = is_array($image) ? $image['url'] : $image;
                            $image_alt = is_array($image) && isset($image['alt']) ? $image['alt'] : 'Green Office';
                            $image_link = is_array($image) && isset($image['link']) ? $image['link'] : '';
                            ?>
                            <div class="carousel-slide <?php echo $active_class; ?>">
                                <?php if (!empty($image_link)) : ?>
                                    <a href="<?php echo esc_url($image_link); ?>" class="carousel-slide-link">
                                        <img src="<?php echo esc_url($image_url); ?>" 
                                             alt="<?php echo esc_attr($image_alt); ?>" 
                                             class="carousel-slide-image">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($image_url); ?>" 
                                         alt="<?php echo esc_attr($image_alt); ?>" 
                                         class="carousel-slide-image">
                                <?php endif; ?>
                            </div>
                            <?php
                            $slide_index++;
                        endforeach;
                    }
                }
                
                // Try Customizer settings
                if (!$has_carousel) {
                    for ($i = 1; $i <= 5; $i++) {
                        $image_url = get_theme_mod("green_office_carousel_{$i}_image");
                        $image_link = get_theme_mod("green_office_carousel_{$i}_link", '');
                        
                        if ($image_url) {
                            $has_carousel = true;
                            $active_class = ($i === 1) ? 'active' : '';
                            ?>
                            <div class="carousel-slide <?php echo $active_class; ?>">
                                <?php if ($image_link) : ?>
                                    <a href="<?php echo esc_url($image_link); ?>" class="carousel-slide-link">
                                        <img src="<?php echo esc_url($image_url); ?>" 
                                             alt="Green Office Slide <?php echo $i; ?>" 
                                             class="carousel-slide-image">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($image_url); ?>" 
                                         alt="Green Office Slide <?php echo $i; ?>" 
                                         class="carousel-slide-image">
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                    }
                }
                
                // No fallback - carousel will be empty if no images uploaded
                ?>
            </div>
            
            <button class="carousel-control prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="carousel-control next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
            <div class="carousel-indicators">
                <?php
                // Count slides dynamically
                $slide_count = 0;
                if (function_exists('get_field')) {
                    $acf_images = get_field('green_office_carousel_images');
                    if ($acf_images && is_array($acf_images)) {
                        $slide_count = count($acf_images);
                    }
                }
                if ($slide_count === 0) {
                    for ($i = 1; $i <= 5; $i++) {
                        if (get_theme_mod("green_office_carousel_{$i}_image")) {
                            $slide_count++;
                        }
                    }
                }
                // No default slides
                
                for ($i = 0; $i < $slide_count; $i++) :
                    $active_class = ($i === 0) ? 'active' : '';
                    ?>
                    <button class="carousel-indicator <?php echo $active_class; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <section class="green-office-activities">
        <div class="section-container">
            <h2 class="section-title">กิจกรรมล่าสุด</h2>
            <div class="activities-grid">
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/activity-1.jpg" alt="กิจกรรม" onerror="this.src='https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=600&h=400&fit=crop'">
                    </div>
                    <div class="activity-content">
                        <span class="activity-date">15 พ.ย. 2567</span>
                        <h3>รณรงค์ลดใช้พลาสติก</h3>
                        <p>โครงการส่งเสริมการใช้ถุงผ้าและบรรจุภัณฑ์ที่เป็นมิตรกับสิ่งแวดล้อม</p>
                        <a href="#" class="activity-link">อ่านเพิ่มเติม →</a>
                    </div>
                </div>
                
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/activity-2.jpg" alt="กิจกรรม" onerror="this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop'">
                    </div>
                    <div class="activity-content">
                        <span class="activity-date">8 พ.ย. 2567</span>
                        <h3>ปลูกต้นไม้ในสำนักงาน</h3>
                        <p>กิจกรรมเพิ่มพื้นที่สีเขียวและคุณภาพอากาศภายในอาคาร</p>
                        <a href="#" class="activity-link">อ่านเพิ่มเติม →</a>
                    </div>
                </div>
                
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/activity-3.jpg" alt="กิจกรรม" onerror="this.src='https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&h=400&fit=crop'">
                    </div>
                    <div class="activity-content">
                        <span class="activity-date">1 พ.ย. 2567</span>
                        <h3>อบรมการจัดการพลังงาน</h3>
                        <p>สัมมนาเชิงปฏิบัติการเพื่อเพิ่มประสิทธิภาพการใช้พลังงาน</p>
                        <a href="#" class="activity-link">อ่านเพิ่มเติม →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
?>
