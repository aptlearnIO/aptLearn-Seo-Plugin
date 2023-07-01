<?php
/**
 * Plugin Name: aptLearn Basic SEO
 * Plugin URI: https://aptlearn.io/
 * Description: A basic SEO plugin for aptLearn.io, including features like automatic alt tags for images, schema markup, XML sitemap generation, and more.
 * Version: 1.0.0
 * Author: aptLearn
 * Author URI: https://aptlearn.io
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: aptlearn-basic-seo
 * Domain Path: /languages
 */

// Function to add meta tags to the head section of the website
function aptlearn_basic_seo_add_meta_tags() {
    global $post;

    // Default meta title, description, and image URL
    $default_title = get_bloginfo('name');
    $default_description = "Uncover your potential and broaden your skillset with aptLearn! From beginner to advanced, we offer comprehensive, engaging, and practical courses in Engineering, Product, Design, Data Science, Business and more. Start your journey with us today, and transform your tech skills for a digital world. Don't wait, explore now!";
    $default_image_url = 'https://aptlearn.io/wp-content/uploads/2022/10/20220619_072419_0000.png';

    // Generate the meta title and description based on your custom logic
    $meta_title = is_singular() ? get_the_title($post) : $default_title;
    $meta_description = is_singular() ? wp_trim_words($post->post_content, 30, '...') : $default_description;
    $image_url = has_post_thumbnail($post) && is_singular() ? get_the_post_thumbnail_url($post, 'full') : $default_image_url;

    // Output the meta title and description
    echo '<title>' . esc_html($meta_title) . '</title>' . PHP_EOL;
    echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . PHP_EOL;

    // Output Open Graph tags
    echo '<meta property="og:title" content="' . esc_attr($meta_title) . '">' . PHP_EOL;
    echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . PHP_EOL;
    echo '<meta property="og:url" content="' . esc_url(get_permalink($post)) . '">' . PHP_EOL;
    echo '<meta property="og:type" content="article">' . PHP_EOL;
    echo '<meta property="og:image" content="' . esc_url($image_url) . '">' . PHP_EOL;

    // Output the Twitter card tags
    echo '<meta name="twitter:card" content="summary_large_image">' . PHP_EOL;
    echo '<meta name="twitter:site" content="@aptlearn_io">' . PHP_EOL;
    echo '<meta name="twitter:title" content="' . esc_attr($meta_title) . '">' . PHP_EOL;
    echo '<meta name="twitter:description" content="' . esc_attr($meta_description) . '">' . PHP_EOL;
    echo '<meta name="twitter:image" content="' . esc_url($image_url) . '">' . PHP_EOL;

    // Output schema.org JSON-LD markup
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $meta_title,
        'description' => $meta_description,
        'url' => get_permalink($post),
        'image' => $image_url,
        'author' => array(
            '@type' => 'Person',
            'name' => get_the_author_meta('display_name', $post->post_author),
        ),
        'datePublished' => get_the_date('c', $post),
        'dateModified' => get_the_modified_date('c', $post),
    );

    // Check if it's a Tutor LMS course, lesson, or topic
    if (get_post_type($post) === 'courses') {
        $schema['@type'] = 'Course';
        $schema['provider'] = array(
            '@type' => 'Organization',
            'name' => 'aptLearn',
            'sameAs' => 'https://aptlearn.io',
        );
    } elseif (get_post_type($post) === 'lessons' || get_post_type($post) === 'topics') {
        $schema['@type'] = 'WebPage';
    }

    echo '<script type="application/ld+json">' . PHP_EOL;
    echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo PHP_EOL . '</script>' . PHP_EOL;
}
add_action('wp_head', 'aptlearn_basic_seo_add_meta_tags');

// Function to add breadcrumbs schema.org JSON-LD markup
function aptlearn_basic_seo_add_breadcrumbs() {
    global $post;

    // Check if it's a single post and the post type is a Tutor LMS course, lesson, or topic
    if (is_singular() && (get_post_type($post) === 'courses' || get_post_type($post) === 'lessons' || get_post_type($post) === 'topics')) {
        $breadcrumbs = array();
        $breadcrumbs['@context'] = 'https://schema.org';
        $breadcrumbs['@type'] = 'BreadcrumbList';
        $breadcrumbs['itemListElement'] = array();

        // Add the home breadcrumb
        $breadcrumbs['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 1,
            'item' => array(
                '@id' => get_home_url(),
                'name' => 'Home',
            ),
        );

        // Add the post breadcrumb
        $breadcrumbs['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 2,
            'item' => array(
                '@id' => get_permalink($post),
                'name' => get_the_title($post),
            ),
        );

        echo '<script type="application/ld+json">' . PHP_EOL;
        echo wp_json_encode($breadcrumbs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo PHP_EOL . '</script>' . PHP_EOL;
    }
}
add_action('wp_head', 'aptlearn_basic_seo_add_breadcrumbs');

// Function to add the canonical URL to the head section of the website
function aptlearn_basic_seo_add_canonical_url() {
    global $post;
    $canonical_url = get_permalink($post);
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . PHP_EOL;
}
add_action('wp_head', 'aptlearn_basic_seo_add_canonical_url');

// Function to add the robots meta tag to the head section of the website
function aptlearn_basic_seo_add_robots_meta_tag() {
    // Customize the content attribute value based on your requirements
    $content = 'index, follow';
    echo '<meta name="robots" content="' . esc_attr($content) . '">' . PHP_EOL;
}
add_action('wp_head', 'aptlearn_basic_seo_add_robots_meta_tag');

// Function to manage links in the content and add nofollow attribute to external links
function aptlearn_basic_seo_manage_links($content) {
    global $post;

    // List of excluded domains
    $excluded_domains = array('google.com', 'github.com', 'stackoverflow.com', 'udacity.com');

    // Use DOMDocument to parse the content
    $doc = new DOMDocument();
    @$doc->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Find all links in the content
    $links = $doc->getElementsByTagName('a');
    foreach ($links as $link) {
        // Get the href attribute of the link
        $href = $link->getAttribute('href');

        // Check if the link is an external link
        if (strpos($href, get_site_url()) === false) {
            // Check if the link is not in the list of excluded domains
            $is_excluded = false;
            foreach ($excluded_domains as $domain) {
                if (strpos($href, $domain) !== false) {
                    $is_excluded = true;
                    break;
                }
            }

            // If the link is not excluded, check the 'nofollow' setting
            if (!$is_excluded) {
                $nofollow = $link->getAttribute('data-nofollow'); // This is a hypothetical attribute. Replace with your actual implementation.

                // If the 'nofollow' setting is not set to 'false', add nofollow
                if ($nofollow !== 'false') {
                    $rel = $link->getAttribute('rel');
                    if (empty($rel)) {
                        $link->setAttribute('rel', 'nofollow');
                    } else {
                        $rel_values = explode(' ', $rel);
                        if (!in_array('nofollow', $rel_values)) {
                            $rel_values[] = 'nofollow';
                            $link->setAttribute('rel', implode(' ', $rel_values));
                        }
                    }
                }
            }
        }
    }

    // Save the updated content
    $content = $doc->saveHTML();

    return $content;
}
add_filter('the_content', 'aptlearn_basic_seo_manage_links');

// Function to enqueue assets for the admin area
function aptlearn_basic_seo_enqueue_admin_assets($hook) {
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('aptlearn-basic-seo-title-counter', plugin_dir_url(__FILE__) . 'title-counter.js', array('jquery'), '1.0.0', true);
        wp_enqueue_style('aptlearn-basic-seo-title-counter', plugin_dir_url(__FILE__) . 'title-counter.css', array(), '1.0.0');
    }
}
add_action('admin_enqueue_scripts', 'aptlearn_basic_seo_enqueue_admin_assets');

// Function to redirect old URLs to new URLs
function aptlearn_basic_seo_redirect_old_urls() {
    $url_map = array(
        '/courses/learn-html-css-and-javascript-from-scratch/' => 'https://aptlearn.io/courses/html-css-and-javascript-course-for-web-developers/',
        '/courses/nodejs-for-backend-development/' => 'https://aptlearn.io/courses/html-css-and-javascript-course-for-web-developers/',
        '/courses/java-programming-masterclass-course-for-beginners/' => 'https://aptlearn.io/course-category/backend-web-development/?tutor-course-filter-category=255',
        '/courses/complete-ui-ux-design-course-for-all-levels/' => 'https://aptlearn.io/courses/complete-ui-ux-design-course-for-beginners/',
        '/teach/' => 'https://co.aptlearn.io/teach/',
        '/docs/' => 'https://co.aptlearn.io/docs/',
        '/courses/new-course-3/' => 'https://aptlearn.io/courses/mastering-linux-a-comprehensive-course/',
        // Add more URL mappings as needed
    );

    $current_request_uri = $_SERVER['REQUEST_URI'];

    foreach ($url_map as $old_url => $new_url) {
        if (strpos($current_request_uri, $old_url) !== false) {
            wp_redirect($new_url, 301); // 301 is the HTTP status code for "Moved Permanently"
            exit;
        }
    }
}
add_action('template_redirect', 'aptlearn_basic_seo_redirect_old_urls');

// Function to insert AdSense auto ads
function aptlearn_basic_seo_insert_adsense_auto_ads() {
    ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-000000000000000" crossorigin="anonymous"></script>
    <?php
}
add_action('wp_head', 'aptlearn_basic_seo_insert_adsense_auto_ads');

// Function to add meta description box
function aptlearn_basic_seo_add_meta_description_box() {
    $screens = ['post', 'courses', 'lessons', 'topics']; // Add more post types if needed
    foreach ($screens as $screen) {
        add_meta_box(
            'aptlearn_basic_seo_meta_description_box_id',          // Unique ID
            'Meta Description',                                   // Box title
            'aptlearn_basic_seo_meta_description_box_html',       // Content callback, must be of type callable
            $screen                                               // Post type
        );
    }
}
add_action('add_meta_boxes', 'aptlearn_basic_seo_add_meta_description_box');

// HTML for the meta description box
function aptlearn_basic_seo_meta_description_box_html($post) {
    $value = get_post_meta($post->ID, '_aptlearn_basic_seo_meta_description', true);
    echo '<textarea id="aptlearn_basic_seo_meta_description" name="aptlearn_basic_seo_meta_description" rows="4" style="width:100%;">' . esc_textarea($value) . '</textarea>';
}

// Save meta description box data
function aptlearn_basic_seo_save_meta_description_box_data($post_id) {
    if (array_key_exists('aptlearn_basic_seo_meta_description', $_POST)) {
        update_post_meta(
            $post_id,
            '_aptlearn_basic_seo_meta_description',
            $_POST['aptlearn_basic_seo_meta_description']
        );
    }
}
add_action('save_post', 'aptlearn_basic_seo_save_meta_description_box_data');

// Function to add keywords box
function aptlearn_basic_seo_add_keywords_box() {
    $screens = ['post', 'courses', 'lessons', 'topics']; // Add more post types if needed
    foreach ($screens as $screen) {
        add_meta_box(
            'aptlearn_basic_seo_keywords_box_id',          // Unique ID
            'Targeted Keywords',                            // Box title
            'aptlearn_basic_seo_keywords_box_html',        // Content callback, must be of type callable
            $screen                                        // Post type
        );
    }
}
add_action('add_meta_boxes', 'aptlearn_basic_seo_add_keywords_box');

// HTML for the keywords box
function aptlearn_basic_seo_keywords_box_html($post) {
    $value = get_post_meta($post->ID, '_aptlearn_basic_seo_keywords', true);
    echo '<input id="aptlearn_basic_seo_keywords" name="aptlearn_basic_seo_keywords" type="text" value="' . esc_attr($value) . '">';
    echo '<p>Enter up to 5 keywords, separated by commas.</p>';
}

// Save keywords box data
function aptlearn_basic_seo_save_keywords_box_data($post_id) {
    if (array_key_exists('aptlearn_basic_seo_keywords', $_POST)) {
        $keywords = explode(',', $_POST['aptlearn_basic_seo_keywords']);
        $keywords = array_slice($keywords, 0, 5); // Limit to 5 keywords
        $keywords = implode(',', $keywords);
        update_post_meta(
            $post_id,
            '_aptlearn_basic_seo_keywords',
            $keywords
        );
    }
}
add_action('save_post', 'aptlearn_basic_seo_save_keywords_box_data');

// Function to remove category base
function aptlearn_basic_seo_remove_category_base() {
    // Remove category base
    $GLOBALS['wp_rewrite']->category_base = '';

    // Refresh rewrite rules
    flush_rewrite_rules();
}
add_action('init', 'aptlearn_basic_seo_remove_category_base');

// Function to generate sitemap
function aptlearn_basic_seo_generate_sitemap() {
    // Check if the current request is for the sitemap
    $current_request_uri = $_SERVER['REQUEST_URI'];
    $sitemap_type = null;

    if (strpos($current_request_uri, '/sitemap.xml') !== false) {
        $sitemap_type = 'general';
    } elseif (strpos($current_request_uri, '/courses-sitemap.xml') !== false) {
        $sitemap_type = 'courses';
    } elseif (strpos($current_request_uri, '/course-categories-sitemap.xml') !== false) {
        $sitemap_type = 'course_categories';
    } elseif (strpos($current_request_uri, '/post-categories-sitemap.xml') !== false) {
        $sitemap_type = 'post_categories';
    } elseif (strpos($current_request_uri, '/sitemap-index.xml') !== false) {
        $sitemap_type = 'sitemap_index';
    }

    if ($sitemap_type) {
        // Set the content type to XML
        header('Content-Type: application/xml; charset=UTF-8');

        // Output the XML declaration
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

        if ($sitemap_type === 'sitemap_index') {
            // Output the sitemap index
            echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            echo '<sitemap><loc>' . home_url('/sitemap.xml') . '</loc></sitemap>' . "\n";
            echo '<sitemap><loc>' . home_url('/courses-sitemap.xml') . '</loc></sitemap>' . "\n";
            echo '<sitemap><loc>' . home_url('/course-categories-sitemap.xml') . '</loc></sitemap>' . "\n";
            echo '<sitemap><loc>' . home_url('/post-categories-sitemap.xml') . '</loc></sitemap>' . "\n";
            echo '</sitemapindex>' . "\n";
        } else {
            // Output the sitemap
            echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            if ($sitemap_type === 'general') {
                // Generate sitemap for general content (excluding courses)
                $posts_pages = get_posts(array(
                    'post_type' => array('post', 'page'),
                    'posts_per_page' => -1,
                ));

                foreach ($posts_pages as $post_page) {
                    echo '<url>' . "\n";
                    echo '<loc>' . get_permalink($post_page) . '</loc>' . "\n";
                    echo '<lastmod>' . get_the_modified_date('c', $post_page) . '</lastmod>' . "\n";
                    echo '</url>' . "\n";
                }
            } elseif ($sitemap_type === 'courses') {
                // Generate sitemap for courses
                $courses = get_posts(array(
                    'post_type' => 'courses',
                    'posts_per_page' => -1,
                ));

                foreach ($courses as $course) {
                    echo '<url>' . "\n";
                    echo '<loc>' . get_permalink($course) . '</loc>' . "\n";
                    echo '<lastmod>' . get_the_modified_date('c', $course) . '</lastmod>' . "\n";
                    echo '</url>' . "\n";
                }
            } elseif ($sitemap_type === 'course_categories') {
                // Generate sitemap for course categories
                $categories = get_categories(array(
                    'taxonomy' => 'course-category',
                    'hide_empty' => false,
                ));

                foreach ($categories as $category) {
                    echo '<url>' . "\n";
                    echo '<loc>' . get_category_link($category->term_id) . '</loc>' . "\n";
                    echo '</url>' . "\n";
                }
            } elseif ($sitemap_type === 'post_categories') {
                // Generate sitemap for post categories
                $categories = get_categories(array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ));

                foreach ($categories as $category) {
                    echo '<url>' . "\n";
                    echo '<loc>' . get_category_link($category->term_id) . '</loc>' . "\n";
                    echo '</url>' . "\n";
                }
            }

            echo '</urlset>' . "\n";
        }

        exit;
    }
}
add_action('init', 'aptlearn_basic_seo_generate_sitemap');

// Add rewrite rules for sitemap
function aptlearn_basic_seo_add_sitemap_rewrite_rules() {
    add_rewrite_rule('sitemap.xml$', 'index.php?sitemap=general', 'top');
    add_rewrite_rule('courses-sitemap.xml$', 'index.php?sitemap=courses', 'top');
    add_rewrite_rule('course-categories-sitemap.xml$', 'index.php?sitemap=course_categories', 'top');
    add_rewrite_rule('post-categories-sitemap.xml$', 'index.php?sitemap=post_categories', 'top');
    add_rewrite_rule('sitemap-index.xml$', 'index.php?sitemap=sitemap_index', 'top');
}
add_action('init', 'aptlearn_basic_seo_add_sitemap_rewrite_rules');

// Add query var for sitemap
function aptlearn_basic_seo_add_sitemap_query_var($vars) {
    $vars[] = 'sitemap';
    return $vars;
}
add_filter('query_vars', 'aptlearn_basic_seo_add_sitemap_query_var');

// Enqueue script for link editor
function aptlearn_basic_seo_enqueue_link_editor_script($hook) {
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('aptlearn-basic-seo-link-editor', plugin_dir_url(__FILE__) . 'link-editor.js', array('jquery'), '1.0.0', true);
    }
}
add_action('admin_enqueue_scripts', 'aptlearn_basic_seo_enqueue_link_editor_script');

// Inline CSS for link editor
function aptlearn_basic_seo_inline_css($hook) {
    if ('post.php' == $hook || 'post-new.php' == $hook) {
        echo '<style>
            .wp-link-editor .link-target,
            .wp-link-editor .link-nofollow {
                display: block;
            }
        </style>';
    }
}
add_action('admin_head', 'aptlearn_basic_seo_inline_css');

?>
