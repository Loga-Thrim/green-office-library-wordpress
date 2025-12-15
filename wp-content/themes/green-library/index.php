<?php
/**
 * The main template file
 *
 * @package Green_Library
 */

get_header();
?>

<div class="content-area">
    <?php if ( have_posts() ) : ?>
        
        <header class="page-header">
            <?php
            if ( is_home() && ! is_front_page() ) :
                ?>
                <h1 class="page-title"><?php single_post_title(); ?></h1>
                <?php
            endif;
            ?>
        </header>

        <div class="posts-list">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;
                        ?>
                        
                        <div class="entry-meta">
                            <?php
                            green_library_posted_on();
                            echo ' | ';
                            green_library_posted_by();
                            ?>
                        </div>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        if ( is_singular() ) :
                            the_content();
                        else :
                            the_excerpt();
                        endif;
                        ?>
                    </div>

                    <?php if ( ! is_singular() ) : ?>
                        <div class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                อ่านต่อ &rarr;
                            </a>
                        </div>
                    <?php endif; ?>
                </article>

                <?php
            endwhile;

            the_posts_navigation();
            ?>
        </div>

    <?php
    else :
        ?>
        <div class="no-results">
            <h1 class="page-title">ไม่พบเนื้อหา</h1>
            <p>ขออภัย ไม่พบเนื้อหาที่คุณต้องการ</p>
        </div>
        <?php
    endif;
    ?>
</div>

<?php
get_footer();
