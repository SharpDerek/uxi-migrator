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

function mad_body_classes($classes) {
  $classes[] = 'lazyload';
  return $classes;
}
add_filter('body_class', 'mad_body_classes');