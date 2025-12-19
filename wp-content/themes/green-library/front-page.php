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
    
    // Pagination - use 'page' for static front page, 'paged' for others
    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
    if ( $paged == 1 ) {
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    }
    
    // Query posts from 'main' category, excluding 'graph'
    $latest_posts = new WP_Query( array(
        'post_type'        => 'post',
        'posts_per_page'   => 6,
        'paged'            => $paged,
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
                ?>
            </div>
            
            <?php
            // Pagination
            $total_pages = $latest_posts->max_num_pages;
            if ( $total_pages > 1 ) :
                // Build pagination base URL for front page
                $big = 999999999;
            ?>
                <div class="posts-pagination">
                    <?php
                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, $paged ),
                        'total'     => $total_pages,
                        'prev_text' => '&laquo; ก่อนหน้า',
                        'next_text' => 'ถัดไป &raquo;',
                    ) );
                    ?>
                </div>
            <?php endif; ?>
            
            <?php wp_reset_postdata(); ?>
        </section>
        <?php
    endif;
    ?>
</div>

<?php
get_footer();
