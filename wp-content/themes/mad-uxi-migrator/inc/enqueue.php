<?php

/**
* Theme Styles
*/

require_once(get_stylesheet_directory().'/css/index.php');

function mad_register_styles(){
  wp_register_style(
    'mw-base', //handle
    get_stylesheet_directory_uri().'/css/base.css', //source
    null, //no dependencies
    null //version
  );
  wp_register_style(
    'mw-bootstrap', //handle
    get_stylesheet_directory_uri().'/css/bootstrap.min.css', //source
    null, //no dependencies
    null //version
  ); 
  wp_register_style(
    'mw-desktop',
    get_stylesheet_directory_uri().'/css/desktop.css',
    null,
    null
  ); 
  wp_register_style(
    'mw-mobile',
    get_stylesheet_directory_uri().'/css/mobile.css',
    null,
    null
  );
}
//add_action('init', 'mad_register_styles');  

if (!is_admin()):
  function mad_enqueue_styles(){
    wp_enqueue_style('mw-bootstrap'); //bootstrap.min.css
    wp_enqueue_style('mw-base'); //base.css
    wp_enqueue_style('mw-desktop'); //desktop.css
    if(MOBILE) {
      wp_enqueue_style('mw-mobile');
    }
  }
  //add_action('wp_enqueue_scripts', 'mad_enqueue_styles', 100);
endif;

/**
* Custom WordPress Login CSS
*/

if(LOGIN_CSS) {
function mad_login_css() {
    wp_enqueue_style( 'login_css', get_stylesheet_directory_uri() . '/css/login.css' );
  }
  //add_action('login_head', 'mad_login_css');
}

/**
* Custom WordPress Admin CSS
*/

if(ADMIN_CSS) {
function mad_admin_css() {
    wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/css/admin.css' );
  }
  //add_action('admin_print_styles', 'mad_admin_css' );
}

/**
* jQuery
*/

if(WP_JQUERY) {
  if (!is_admin()):
    function mad_enqueue_jquery() {
      wp_enqueue_script("jquery");      
    }
    //add_action('wp_enqueue_scripts', 'mad_enqueue_jquery');
  endif;
}

/**
* Theme Scripts
*/

function mad_register_scripts() {
  wp_register_script(
    'mad-fancybox-js', //handle
    get_stylesheet_directory_uri().'/js/plugins/jquery.fancybox.pack.js', //source
    null, //dependencies
    null, //version
    true //run in footer
  );
  wp_register_script(
    'mad-flexslider-js',
    get_stylesheet_directory_uri().'/js/plugins/jquery.flexslider-min.js',
    null,
    null,
    true
  );
  wp_register_script(
    'mad-plugins-js',
    get_stylesheet_directory_uri().'/js/plugins.js',
    null,
    null,
    true 
  );
  wp_register_script(
    'mad-main-js', 
    get_stylesheet_directory_uri().'/js/main.js',
    null,
    null,
    true
  );

}
//add_action('init', 'mad_register_scripts');
function mad_enqueue_scripts(){
  if (!is_admin()):
    // wp_enqueue_script('mad-fancybox-js');
    // wp_enqueue_script('mad-flexslider-js');
    wp_enqueue_script('mad-plugins-js');
    wp_enqueue_script('mad-main-js');
  endif;
}
//add_action('wp_enqueue_scripts', 'mad_enqueue_scripts', 100);

/**
* Enable threaded comments
*/

function mad_enable_threaded_comments(){
  if (!is_admin()) {
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
      wp_enqueue_script('comment-reply');
    }
}
//add_action('get_header', 'mad_enable_threaded_comments');

?>