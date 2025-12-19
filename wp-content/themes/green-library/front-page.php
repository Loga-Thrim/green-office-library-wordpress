<?php
/**
 * Front Page Template
 *
 * @package Green_Library
 */

get_header();
?>

<div class="content-area">
    
    <!-- Green Office & Green Library Section -->
    <section class="about-green-section">
        <div class="about-green-container">
            <div class="about-green-image">
                <?php 
                $about_image = get_theme_mod( 'about_green_image' );
                if ( $about_image ) :
                ?>
                    <img src="<?php echo esc_url( $about_image ); ?>" alt="Green Office">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/psru-lib-office.png" alt="PSRU Library Office" onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&h=400&fit=crop'">
                <?php endif; ?>
            </div>
            <div class="about-green-content">
                <div class="about-leaf-icon">🍃</div>
                <h2 class="about-green-title">
                    <?php echo get_theme_mod( 'about_green_title', 'Green Office & Green Library' ); ?>
                </h2>
                <p class="about-green-description">
                    <?php echo get_theme_mod( 'about_green_description', 'แหล่งเรียนรู้สู่ความสดชื่นที่มาพร้อมกับการบริหารจัดการและใช้ให้บริการอย่างแบบเพื่อมิตรต่อสุขภาพดีและเป็นมิตรต่อสิ่งแวดล้อม' ); ?>
                </p>
            </div>
        </div>
    </section>
    
    <!-- Green Office Results Section -->
    <section class="green-results-section">
        <div class="section-header-with-icon">
            <div class="section-icon">🍃</div>
            <h2 class="section-title-blue">ผลการดำเนินงาน Green Office</h2>
        </div>
        
        <div class="results-grid">
            <?php
            // Find the latest year page using the category template
            $year_pages = get_posts( array(
                'post_type'      => 'page',
                'posts_per_page' => 1,
                'meta_key'       => '_wp_page_template',
                'meta_value'     => 'page-green-office-category.php',
                'post_status'    => 'publish',
                'orderby'        => 'title',
                'order'          => 'DESC', // Latest year first (e.g., 2568 before 2567)
            ) );
            
            $base_url = '';
            if ( ! empty( $year_pages ) ) {
                $base_url = get_permalink( $year_pages[0]->ID );
            }
            
            for ($i = 1; $i <= 7; $i++) :
                $result_icon = '📊';
                $result_title = "หมวดที่ {$i}";
                
                // Use the latest year page URL with category parameter
                if ( $base_url ) {
                    $result_link = add_query_arg( 'category', $i, $base_url );
                } else {
                    // Fallback if no year page exists
                    $result_link = home_url( "/green-office/" );
                }
            ?>
                <a href="<?php echo esc_url($result_link); ?>" class="result-card">
                    <div class="result-icon"><?php echo $result_icon; ?></div>
                    <h3 class="result-title"><?php echo esc_html($result_title); ?></h3>
                </a>
            <?php
            endfor;
            ?>
        </div>
    </section>
    
    <!-- Statistics/Graph Section -->
    <section class="green-office-statistics">
        <div class="section-container">
            <h2 class="section-title text-center">สถิติการดำเนินงาน</h2>
            <div class="statistics-grid">
                <?php
                // Query posts from 'graph' or 'กราฟ' category
                $stats_query = new WP_Query( array(
                    'post_type'      => 'post',
                    'posts_per_page' => 6,
                    'category_name'  => 'graph,กราฟ',
                    'post_status'    => 'publish',
                ) );
                
                if ( $stats_query->have_posts() ) :
                    while ( $stats_query->have_posts() ) : $stats_query->the_post();
                        if ( has_post_thumbnail() ) :
                ?>
                    <a href="<?php the_permalink(); ?>" class="stat-graph-card">
                        <div class="stat-graph-image">
                            <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                        </div>
                        <div class="stat-graph-overlay">
                            <span class="stat-graph-title"><?php the_title(); ?></span>
                            <span class="stat-graph-view">ดูรายละเอียด →</span>
                        </div>
                    </a>
                <?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="no-stats-message">
                        <p>ยังไม่มีข้อมูลสถิติ</p>
                        <p class="small-text">สร้างโพสต์ใหม่และเพิ่มในหมวดหมู่ "กราฟ" หรือ "graph"</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <!-- Latest Posts Section -->
    <?php
    // Get graph category ID to exclude
    $graph_cat = get_category_by_slug( 'graph' );
    $graph_cat_th = get_category_by_slug( 'กราฟ' );
    $exclude_cats = array();
    if ( $graph_cat ) $exclude_cats[] = $graph_cat->term_id;
    if ( $graph_cat_th ) $exclude_cats[] = $graph_cat_th->term_id;
    
    // Query posts from 'main' category, excluding 'graph'
    $latest_posts = new WP_Query( array(
        'post_type'        => 'post',
        'posts_per_page'   => 6,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'category_name'    => 'main',
        'category__not_in' => $exclude_cats,
    ) );
    
    if ( $latest_posts->have_posts() ) :
        ?>
        <section class="latest-posts-section mt-3">
            <h2 class="section-title text-center mb-2">ข่าวสารและกิจกรรมล่าสุด</h2>
            
            <div class="posts-grid">
                <?php
                while ( $latest_posts->have_posts() ) :
                    $latest_posts->the_post();
                    ?>
                    
                    <article class="post-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-card-content">
                            <h3 class="post-card-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <div class="post-card-meta">
                                <?php echo get_the_date(); ?>
                            </div>
                            
                            <div class="post-card-excerpt">
                                <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="post-card-link">
                                อ่านเพิ่มเติม &rarr;
                            </a>
                        </div>
                    </article>
                    
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <?php
    endif;
    ?>
</div>

<?php
get_footer();
