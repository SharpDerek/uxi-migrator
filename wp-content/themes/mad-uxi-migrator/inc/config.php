<?php

add_theme_support('nice-search'); // Enable /?s= to /search/ redirect

mad_define_constants(array(
  'WP_JQUERY'             => true,
  'MOBILE'                => true,
  'FULLWIDTH_CLASS'       => 'col-sm-12',
  'MAIN_CLASS'            => 'col-md-8 col-sm-12',
  'SIDEBAR_CLASS'         => 'col-md-4 col-sm-12',
  'POST_EXCERPT_LENGTH'   => 55,
  'POSTS_NAV_LEFT'        => '&larr;',
  'POSTS_NAV_RIGHT'       => '&rarr;',
  'LOGIN_CSS'             => true,
  'CUSTOM_ADMIN_BAR_LOGO' => true,
  'ADMIN_CSS'             => true,
  'LOGIN_LOGO_URL'        => 'http://www.madwire.com',
  'ERROR_DISPLAY'         => true // Boolean = Turn PHP error display on then the switch //Errors
));

/* Define Constants: */
function mad_define_constants($constants){
  foreach($constants as $key => $value){
    if(!defined($key)) define($key,$value);
  }
}

if(ERROR_DISPLAY){ error_reporting(E_ALL ^ E_NOTICE); ini_set('display_errors','1'); }

/*
 * Set the content width based on the theme's design and stylesheet.
*/

if ( ! isset( $content_width ) )
  $content_width = 1140; /* pixels */

/**
 * Show or hide sidebar
*/

function mad_display_sidebar() {
  if (
    is_404() ||
    is_front_page() && 'page' == get_option('show_on_front') ||
    is_page_template('page-templates/page-full.php') ||
    is_page_template('page-templates/page-grid.php') ||
    is_page_template('page-templates/page-elements.php')
  ) {
    return false;
  } else {
    return true;
  }
}

/**
 * Class for #main
*/

if(!function_exists('mad_main_class')):
function mad_main_class(){
  if (
    is_404() ||
    is_front_page() && 'page' == get_option('show_on_front') ||
    is_page_template('page-templates/page-full.php') ||
    is_page_template('page-templates/page-grid.php') ||
    is_page_template('page-templates/page-elements.php')
  ) {
    return FULLWIDTH_CLASS;
  } else {
    return MAIN_CLASS;
  }
}
endif;

/**
* Change Password Protected Form
* @link wp.tutsplus.com/tutorials/customizing-and-styling-the-password-protected-form/
*/
add_filter( 'the_password_form', 'satus_password_form' );  
function satus_password_form() {  
  global $post;  
  $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );  
  $o = '<p>This post is password protected. To view it please enter your password below:</p><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><label class="pass-label visuallyhidden" for="' . $label . '">' . __( "Password:", "satus" ) . ' </label><input id="' . $label . '"  name="post_password" type="password" placeholder="Password"><input class="button" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '"></form>';  
  return $o;  
}

/**
 * goes inside #content
*/

function mad_content_before_grid() {
  echo '<div class="row">';
}
add_action('mad_content_before', 'mad_content_before_grid');

function mad_content_after_grid() {
  echo '</div>';
}
add_action('mad_content_after', 'mad_content_after_grid');

/**
 * remove woocommerce's default wrapper and use default mad structure
*/

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action('woocommerce_before_main_content', 'woo_mad_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'woo_mad_wrapper_end', 10);

function woo_mad_wrapper_start() {
  echo '<div class="row"><div class="main ' . mad_main_class() . '" role="main">';
}
 
function woo_mad_wrapper_end() {
  echo '</div>';
  get_sidebar();
  echo '</div>';
}

/**
 * remove woocommerce's pagination and use default mad pagination
*/

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'mad_posts_nav', 10 );

?>