<?php

//require_once get_template_directory()   . '/inc/activation.php';     // theme activation
require_once get_stylesheet_directory() . '/inc/uxi-functions.php';  // UXI-specific functions
require_once get_stylesheet_directory() . '/inc/options.php';        // ACF Options Pages
require_once get_stylesheet_directory() . '/inc/config.php';         // theme configuration
require_once get_template_directory()   . '/inc/cleanup.php';        // wp code cleanup/removal
require_once get_template_directory()   . '/inc/widgets.php';        // sidebar and widget registration
require_once get_template_directory()   . '/inc/shortcodes.php';     // shortcodes
require_once get_template_directory()   . '/inc/posttypes.php';      // post types
require_once get_template_directory()   . '/inc/template-tags.php';  // template tags
require_once get_template_directory()   . '/inc/actions.php';        // actions
require_once get_template_directory()   . '/inc/hooks.php';          // hooks
require_once get_template_directory()   . '/inc/filters.php';        // filters
require_once get_stylesheet_directory() . '/inc/custom.php';         // custom functions
require_once get_stylesheet_directory() . '/inc/enqueue.php';        // scripts and styles enqueue
require_once get_stylesheet_directory() . '/inc/core.php';        	 // core theme functionality

/**
 * Make theme available for translation
 * Translations can be filed in the /lng/ directory * 
 */
load_theme_textdomain( 'mad', get_template_directory() . '/lng' );

$locale = get_locale();
$locale_file = get_template_directory() . "/lng/$locale.php";
if ( is_readable( $locale_file ) )
  require_once( $locale_file );

/**
 * Tell the TinyMCE editor to use a custom stylesheet
*/
//add_editor_style('css/editor.css');

/** 
 * add post thumbnail/featured image support
*/
add_theme_support('post-thumbnails');

/** 
 * adds rss feed links to the head
*/
add_theme_support('automatic-feed-links');

/**
 * add support for woocommerce
 * @link http://docs.woothemes.com/document/third-party-custom-theme-compatibility/#declarewoocommercesupport
*/
add_theme_support( 'woocommerce' );

/**
 * add nav menu support
*/
add_theme_support('menus');
// register_nav_menus(
//   array(
//     'primary_navigation' => 'Primary Navigation',
//     'utility_navigation' => 'Utility Navigation',
//     'footer_navigation' => 'Footer Navigation'
//   )
// );

?>