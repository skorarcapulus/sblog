<?php
/**
 * Skorar Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function skorar_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);
    add_theme_support('customize-selective-refresh-widgets');

    // Register navigation menu
    register_nav_menus([
        'primary' => __('Primary Menu', 'skorar-theme'),
    ]);

    // Add custom image sizes
    add_image_size('skorar-featured', 1200, 600, true);
}
add_action('after_setup_theme', 'skorar_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function skorar_theme_assets() {
    // Theme stylesheet
    wp_enqueue_style(
        'skorar-theme-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    // Main theme JavaScript
    wp_enqueue_script(
        'skorar-theme-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    // Add JavaScript variables
    wp_localize_script('skorar-theme-script', 'skorarTheme', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('skorar_nonce'),
        'homeUrl' => home_url('/'),
    ]);
}
add_action('wp_enqueue_scripts', 'skorar_theme_assets');

/**
 * Custom Excerpt Length
 */
function skorar_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'skorar_excerpt_length');

/**
 * Custom Excerpt More
 */
function skorar_excerpt_more($more) {
    return '... <a href="' . get_permalink() . '" class="read-more">Read more</a>';
}
add_filter('excerpt_more', 'skorar_excerpt_more');

/**
 * Add body classes for styling
 */
function skorar_body_classes($classes) {
    // Add class for development mode
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $classes[] = 'debug-mode';
    }
    
    return $classes;
}
add_filter('body_class', 'skorar_body_classes');

/**
 * Customizer Settings
 */
function skorar_customize_register($wp_customize) {
    // Add a section for theme options
    $wp_customize->add_section('skorar_theme_options', [
        'title' => __('Theme Options', 'skorar-theme'),
        'priority' => 30,
    ]);

    // Add a setting for accent color
    $wp_customize->add_setting('skorar_accent_color', [
        'default' => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    // Add control for accent color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'skorar_accent_color', [
        'label' => __('Accent Color', 'skorar-theme'),
        'section' => 'skorar_theme_options',
    ]));
}
add_action('customize_register', 'skorar_customize_register');

/**
 * Custom CSS for accent color
 */
function skorar_custom_css() {
    $accent_color = get_theme_mod('skorar_accent_color', '#0073aa');
    
    echo "<style type='text/css'>
        .post-title a:hover { color: {$accent_color}; }
        .read-more { color: {$accent_color}; }
    </style>";
}
add_action('wp_head', 'skorar_custom_css');

/**
 * Development helpers
 */
if (defined('WP_DEBUG') && WP_DEBUG) {
    /**
     * Show template name in HTML comments
     */
    function skorar_show_template() {
        if (is_super_admin()) {
            global $template;
            echo "\n<!-- Template: " . basename($template) . " -->\n";
        }
    }
    add_action('wp_head', 'skorar_show_template');
}