<?php
/**
 * Template Name: Green Office Results (ผลการดำเนินงาน)
 * Template for Green Office Performance Results by Year
 * 
 * Admin creates a page for each year (e.g., "ผลการดำเนินงาน ปี 2568")
 * and assigns this template. The year is extracted from the page title.
 *
 * @package Green_Library
 */

get_header('green-office');

// Get category from query parameter (default to 1)
$category_num = isset($_GET['category']) ? intval($_GET['category']) : 1;

// Validate category number (1-7)
if ($category_num < 1 || $category_num > 7) {
    $category_num = 1;
}

// Extract year from page title or slug
$page_title = get_the_title();
$page_slug = get_post_field('post_name', get_the_ID());

// Try to find year in title (e.g., "ผลการดำเนินงาน ปี 2568" or "2568")
preg_match('/(\d{4})/', $page_title, $matches);
$year = isset($matches[1]) ? intval($matches[1]) : 2568;

// Validate year (2560-2600)
if ($year < 2560 || $year > 2600) {
    $year = 2568;
}

// Get HTML content from customizer (format: green_office_year_2568_category_1_content)
$content_key = "green_office_year_{$year}_category_{$category_num}_content";
$category_content = get_theme_mod($content_key, '');

// Build category navigation links (use current page URL with category parameter)
$current_url = get_permalink();
$category_links = array();
for ($i = 1; $i <= 7; $i++) {
    $category_links[$i] = add_query_arg('category', $i, $current_url);
}
?>

<div class="green-office-category-page">
    <!-- Year & Category Header -->
    <section class="category-header-section">
        <div class="category-header-container">
            <h1 class="category-year-title">ผลการดำเนินงาน ปี <?php echo $year; ?></h1>
        </div>
    </section>

    <!-- Category Navigation Tabs -->
    <section class="category-tabs-section">
        <div class="category-tabs-container">
            <nav class="category-tabs">
                <?php for ($i = 1; $i <= 7; $i++) : ?>
                    <a href="<?php echo esc_url($category_links[$i]); ?>" 
                       class="category-tab <?php echo ($i === $category_num) ? 'active' : ''; ?>">
                        หมวดที่ <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </nav>
        </div>
    </section>

    <!-- Category Content -->
    <section class="category-content-section">
        <div class="category-content-container">
            <?php if (!empty($category_content)) : ?>
                <div class="category-html-content">
                    <?php echo wp_kses_post($category_content); ?>
                </div>
            <?php else : ?>
                <div class="no-content-message">
                    <p>ยังไม่มีเนื้อหาสำหรับหมวดนี้</p>
                    <p class="small-text">กรุณาเพิ่มเนื้อหาใน Appearance → Customize → Green Office Results (ปี <?php echo $year; ?>)</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
get_footer();
?>
