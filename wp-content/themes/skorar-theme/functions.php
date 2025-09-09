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

    // Gutenberg/Block Editor Support
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('align-full');
    
    // Editor styles (will load editor-style.css in admin)
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Custom block patterns
    add_theme_support('core-block-patterns');
    
    // Add custom color palette for Gutenberg
    add_theme_support('editor-color-palette', [
        [
            'name' => __('Primary Pink', 'skorar-theme'),
            'slug' => 'primary-pink',
            'color' => '#ff014f',
        ],
        [
            'name' => __('Secondary Yellow', 'skorar-theme'),
            'slug' => 'secondary-yellow',
            'color' => '#FFDC60',
        ],
        [
            'name' => __('Tertiary Pink', 'skorar-theme'),
            'slug' => 'tertiary-pink',
            'color' => '#FAB8C4',
        ],
        [
            'name' => __('Dark Base', 'skorar-theme'),
            'slug' => 'dark-base',
            'color' => '#212428',
        ],
        [
            'name' => __('Dark Header', 'skorar-theme'),
            'slug' => 'dark-header',
            'color' => '#1F2125',
        ],
        [
            'name' => __('Dark Secondary', 'skorar-theme'),
            'slug' => 'dark-secondary',
            'color' => '#27272E',
        ],
        [
            'name' => __('Text Default', 'skorar-theme'),
            'slug' => 'text-default',
            'color' => '#C4CFDE',
        ],
        [
            'name' => __('White', 'skorar-theme'),
            'slug' => 'white',
            'color' => '#ffffff',
        ],
        [
            'name' => __('Light Gray', 'skorar-theme'),
            'slug' => 'light-gray',
            'color' => '#abb8c3',
        ],
    ]);

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

    // Color scheme settings
    $wp_customize->add_setting('skorar_primary_color', [
        'default' => '#ff014f',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_setting('skorar_secondary_color', [
        'default' => '#FFDC60',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_setting('skorar_base_dark', [
        'default' => '#212428',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_setting('skorar_header_dark', [
        'default' => '#1F2125',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    // Add color controls
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'skorar_primary_color', [
        'label' => __('Primary Color (Pink)', 'skorar-theme'),
        'section' => 'skorar_theme_options',
    ]));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'skorar_secondary_color', [
        'label' => __('Secondary Color (Yellow)', 'skorar-theme'),
        'section' => 'skorar_theme_options',
    ]));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'skorar_base_dark', [
        'label' => __('Base Dark Color', 'skorar-theme'),
        'section' => 'skorar_theme_options',
    ]));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'skorar_header_dark', [
        'label' => __('Header Dark Color', 'skorar-theme'),
        'section' => 'skorar_theme_options',
    ]));
}
add_action('customize_register', 'skorar_customize_register');

/**
 * Custom CSS for accent color
 */
function skorar_custom_css() {
    $primary_color = get_theme_mod('skorar_primary_color', '#ff014f');
    $secondary_color = get_theme_mod('skorar_secondary_color', '#FFDC60');
    $base_dark = get_theme_mod('skorar_base_dark', '#212428');
    $header_dark = get_theme_mod('skorar_header_dark', '#1F2125');
    
    echo "<style type='text/css'>
        :root {
            --skorar-primary: {$primary_color};
            --skorar-secondary: {$secondary_color};
            --skorar-tertiary: #FAB8C4;
            --skorar-base-dark: {$base_dark};
            --skorar-header-dark: {$header_dark};
            --skorar-dark-secondary: #27272E;
            --skorar-text-default: #C4CFDE;
            --skorar-white: #ffffff;
            --skorar-light-gray: #abb8c3;
        }
        
        body {
            background-color: var(--skorar-base-dark);
            color: var(--skorar-text-default);
        }
        
        .site-header {
            background-color: var(--skorar-header-dark);
        }
        
        .post-title a:hover,
        .read-more,
        a:hover {
            color: var(--skorar-primary);
        }
        
        .button,
        .wp-block-button__link {
            background-color: var(--skorar-primary);
            color: var(--skorar-white);
        }
        
        .button:hover,
        .wp-block-button__link:hover {
            background-color: var(--skorar-secondary);
            color: var(--skorar-base-dark);
        }
    </style>";
}
add_action('wp_head', 'skorar_custom_css');

/**
 * Register Block Patterns
 */
function skorar_register_block_patterns() {
    register_block_pattern_category('skorar', [
        'label' => __('Skorar Theme', 'skorar-theme'),
    ]);
}
add_action('init', 'skorar_register_block_patterns');

/**
 * Enable wide/full alignment for additional blocks
 */
function skorar_enable_block_alignments() {
    // Enable wide/full alignment for paragraph blocks
    add_filter('block_editor_settings_all', function($settings) {
        if (!isset($settings['alignWide'])) {
            $settings['alignWide'] = true;
        }
        return $settings;
    });
}
add_action('init', 'skorar_enable_block_alignments');

/**
 * Enqueue block editor assets
 */
function skorar_block_editor_assets() {
    // Enable alignment for paragraph and other blocks
    wp_enqueue_script(
        'skorar-block-editor',
        get_template_directory_uri() . '/assets/js/block-editor.js',
        ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
        wp_get_theme()->get('Version')
    );
    
    // Content Block
    wp_enqueue_script(
        'skorar-content-block',
        get_template_directory_uri() . '/blocks/content-block/index.js',
        ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n'],
        wp_get_theme()->get('Version')
    );
    
    // Content Block Editor Styles
    wp_enqueue_style(
        'skorar-content-block-editor',
        get_template_directory_uri() . '/blocks/content-block/editor.css',
        ['wp-edit-blocks'],
        wp_get_theme()->get('Version')
    );
}
add_action('enqueue_block_editor_assets', 'skorar_block_editor_assets');

/**
 * Add editor color palette support
 */
function skorar_add_editor_color_palette() {
    add_theme_support('editor-color-palette', [
        [
            'name' => __('Primary Pink', 'skorar-theme'),
            'slug' => 'primary-pink',
            'color' => '#ff014f',
        ],
        [
            'name' => __('Secondary Yellow', 'skorar-theme'),
            'slug' => 'secondary-yellow',
            'color' => '#FFDC60',
        ],
        [
            'name' => __('Text Default', 'skorar-theme'),
            'slug' => 'text-default',
            'color' => '#C4CFDE',
        ],
        [
            'name' => __('White', 'skorar-theme'),
            'slug' => 'white',
            'color' => '#ffffff',
        ],
        [
            'name' => __('Dark Base', 'skorar-theme'),
            'slug' => 'dark-base',
            'color' => '#212428',
        ],
    ]);
}
add_action('after_setup_theme', 'skorar_add_editor_color_palette');

/**
 * Enqueue frontend block assets
 */
function skorar_block_assets() {
    // Content Block Frontend Styles
    wp_enqueue_style(
        'skorar-content-block-style',
        get_template_directory_uri() . '/blocks/content-block/style.css',
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'skorar_block_assets');

/**
 * Enqueue admin theme styles
 */
function skorar_admin_theme_styles() {
    wp_enqueue_style(
        'skorar-admin-theme',
        get_template_directory_uri() . '/assets/css/admin-theme.css',
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('admin_enqueue_scripts', 'skorar_admin_theme_styles');

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