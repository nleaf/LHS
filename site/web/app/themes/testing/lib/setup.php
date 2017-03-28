<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'quick_navigation' => __( 'Quick Navigation' ),
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_single(),
    tribe_is_month(),
    is_category(),
    is_page(array( 48,62 )),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  $CDNPATH = 'http://d2xvf5r7iyxulk.cloudfront.net';
  if (is_ssl()) {
    $CDNPATH = 'https://d2xvf5r7iyxulk.cloudfront.net';
  }

  //Angular script injection
  if (is_page(array( 48,62))){
    wp_register_script('roots_angular', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js', false, null, true);
    wp_register_script('roots_angular_routes',  '//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.min.js', false, null, true);
    wp_register_script('roots_angular_sani',  '//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-sanitize.js', false, null, true);
    wp_register_script('roots_angular_app', get_home_url() . '/Adopt_Angular/js/app.js', false, null, true);
    wp_register_script('roots_angular_touch', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-touch.js', false, null, true);
    //wp_register_script('roots_angular_controllers', get_template_directory_uri() . '/Adopt_Angular/js/controllers.js', false, null, true);
    wp_register_script('roots_angular_loading', get_home_url() . '/Adopt_Angular/js/loading-bar.js', false, null, true);
    wp_register_script('roots_angular_social', get_home_url() . '/Adopt_Angular/js/angulike.js', false, null, true);
    wp_register_script('roots_angular_meta', get_home_url() . '/Adopt_Angular/js/angularjs-viewhead.js', false, null, true);
    wp_register_script('roots_angular_tube', $CDNPATH . '/js/angular-youtube-embed.js', false, null, true);
    wp_register_script('roots_angular_twitter', 'http://platform.twitter.com/widgets.js', false, null, true);

    wp_register_script('roots_angular_lbjs', '//cdnjs.cloudflare.com/ajax/libs/ng-dialog/0.3.4/js/ngDialog.min.js', false, null, true);

    wp_enqueue_style('roots_angular_loading_style', get_home_url() . '/Adopt_Angular/css/loading-bar.css', false, null);
    wp_enqueue_script('roots_angular');
    wp_enqueue_script('roots_angular_routes');
    wp_enqueue_script('roots_angular_sani');
    wp_enqueue_script('roots_angular_app');
    wp_enqueue_script('roots_angular_touch');
    //wp_enqueue_script('roots_angular_controllers');
    wp_enqueue_script('roots_angular_loading');
    wp_enqueue_script('roots_angular_social');
    wp_enqueue_script('roots_angular_meta');
    wp_enqueue_script('roots_angular_tube');
    wp_enqueue_script('roots_angular_twitter');
    wp_enqueue_script('roots_angular_pin');
    wp_enqueue_script('roots_angular_lbjs');

    wp_enqueue_style('roots_angular_lbjs', get_home_url() . '/Adopt_Angular/css/ngDialog.min.css', false, null);
    wp_enqueue_style('roots_angular_lbcssdefault', get_home_url() . '/Adopt_Angular/css/ngDialog-theme-default.min.css', false, null);
    wp_enqueue_style('roots_angular_lbcssplain', get_home_url() . '/Adopt_Angular/css/ngDialog-theme-plain.min.css', false, null);
  }
  if (is_page(array( 48,62))){
        wp_register_script('roots_angular_controllers', get_home_url() . '/Adopt_Angular/js/controllers.js?v=032315', false, null, true);
        wp_enqueue_script('roots_angular_controllers');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

add_action( 'init', __NAMESPACE__ . '\\my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
