<!doctype html>
<!--[if IE 6]><html class="ie6 oldie" <?php language_attributes(); ?>><![endif]--> 
<!--[if IE 7]><html class="ie7 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie8 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if gte IE 9]><!--><html class="not-oldie <?php mad_mobile_class(); ?>" <?php language_attributes(); ?>><!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  
  <?php if ( class_exists('WPSEO_Frontend') ) : ?>
    <title><?php wp_title(''); ?></title>
  <?php else : ?>
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title> 
  <?php endif; ?>
  
  <?php mad_mobile_viewport(); ?> 

  <!-- visit http://www.modernizr.com/ if you need to create a different custom build -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/modernizr.js"></script>

  <?php wp_head(); ?>
  
</head>