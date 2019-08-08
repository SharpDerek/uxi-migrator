<?php

/**
 * Remove unnecessary dashboard widgets
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
*/

function mad_remove_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'mad_remove_dashboard_widgets');

/**
 * Removes the wordpress version from the head
*/

remove_action('wp_head', 'wp_generator');

/**
 * Removes WooCommerce Version tag from head
*/

function mad_remove_woocommerce_version_tag() {
  remove_action('wp_head',array($GLOBALS['woocommerce'], 'generator'));
}
add_action('get_header','mad_remove_woocommerce_version_tag');

/**
 * Allow more tags in TinyMCE including iframes
 * @link github.com/retlehs/roots/
*/

function mad_change_mce_options($options) {
  $ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]';  
  if (isset($initArray['extended_valid_elements'])) {
    $options['extended_valid_elements'] .= ',' . $ext;
  } else {
    $options['extended_valid_elements'] = $ext;
  }
  return $options;
}

/**
 * Wrap embedded media as suggested by Readability
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
*/

function mad_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  return '<div class="embed">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'mad_embed_wrap', 10, 4);
add_filter('embed_googlevideo', 'mad_embed_wrap', 10, 2);

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 * @link github.com/retlehs/roots
*/

function mad_remove_default_description($bloginfo) {
  $default_tagline = 'Just another WordPress site';

  return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
add_filter('get_bloginfo_rss', 'mad_remove_default_description');

/**
 * Add and remove body_class() classes
 * @link github.com/retlehs/roots
*/

function mad_body_class($classes) {
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }
  return $classes;
}
add_filter('body_class', 'mad_body_class');

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
*/

function mad_nice_search_redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
    wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
    exit();
  }
}
if (current_theme_supports('nice-search')) {
  add_action('template_redirect', 'mad_nice_search_redirect');
}

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
*/

function mad_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s'])) {
    $query_vars['s'] = ' ';
  }

  return $query_vars;
}
add_filter('request', 'mad_request_filter');


/**
 * Tell WordPress to use searchform.php from the templates/ directory
*/

function mad_get_search_form($argument) {
  if ($argument === '') {
    locate_template('/templates/searchform.php', true, false);
  }
}
add_filter('get_search_form', 'mad_get_search_form');

/**
 * remove CSS from recent comments widget
*/

function mad_remove_recent_comments_style() {  
    global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }  
add_action( 'widgets_init', 'mad_remove_recent_comments_style' );

/**
 * removes hentry class from post_class
*/
function remove_hentry( $classes ) {
  $classes = array_diff($classes, array('hentry'));
  return $classes;
}
add_filter( 'post_class', 'remove_hentry' );

/**
 * removes rel="category tag" of the category list
 * @link josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/
*/
function mad_remove_category_list_rel($output)
{
  $output = str_replace(' rel="category tag"', ' rel="tag"', $output);
  return $output;
}
add_filter('wp_list_categories', 'mad_remove_category_list_rel');
add_filter('the_category', 'mad_remove_category_list_rel');

/** 
 * First and last classes for widgets
 * @link wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
*/

function mad_widget_first_last_classes($params) {
  global $my_widget_num;
  $this_id = $params[0]['id'];
  $arr_registered_widgets = wp_get_sidebars_widgets();
  if (!$my_widget_num) {
    $my_widget_num = array();
  }
  if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
    return $params;
  }
  if (isset($my_widget_num[$this_id])) {
    $my_widget_num[$this_id] ++;
  } else {
    $my_widget_num[$this_id] = 1;
  }
  $class = 'class="widget-' . $my_widget_num[$this_id] . ' ';
  if ($my_widget_num[$this_id] == 1) {
    $class .= 'widget-first ';
  } elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) {
    $class .= 'widget-last ';
  }
  $params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);
  return $params;
}
add_filter('dynamic_sidebar_params', 'mad_widget_first_last_classes');

/**
 * Use <figure> and <figcaption> 
 * @link https://github.com/retlehs/roots/blob/master/lib/cleanup.php
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
*/

function mad_caption($output, $attr, $content) {
  if (is_feed()) {
    return $output;
  }
  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );
  $attr = shortcode_atts($defaults, $attr);
  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ($attr['width'] < 1 || empty($attr['caption'])) {
    return $content;
  }
  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';
  $output  = '<figure' . $attributes .'>';
  $output .= do_shortcode($content);
  $output .= '<figcaption class="wp-caption-text">' . $attr['caption'] . '</figcaption>';
  $output .= '</figure>';
  return $output;
}

add_filter('img_caption_shortcode', 'mad_caption', 10, 3);

/**
 * Clean up gallery_shortcode()
 * @link https://github.com/retlehs/roots/blob/master/lib/cleanup.php
*/

function mad_gallery($attr) {
  $post = get_post();
  static $instance = 0;
  $instance++;
  if (!empty($attr['ids'])) {
    if (empty($attr['orderby'])) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }
  $output = apply_filters('post_gallery', '', $attr);
  if ($output != '') {
    return $output;
  }
  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }
  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => '',
    'icontag'    => '',
    'captiontag' => '',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr));
  $id = intval($id);
  if ($order === 'RAND') {
    $orderby = 'none';
  }
  if (!empty($include)) {
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }
  if (empty($attachments)) {
    return '';
  }
  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) {
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    }
    return $output;
  }
  $output = '<ul class="gallery">';
  $i = 0;
  foreach ($attachments as $id => $attachment) {
    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
    $output .= '<li class="gallery-item">' . $link;
    if (trim($attachment->post_excerpt)) {
      $output .= '<div class="gallery-caption">' . wptexturize($attachment->post_excerpt) . '</div>';
    }
    $output .= '</li>';
  }
  $output .= '</ul>';
  return $output;
}
//deactivate WordPress function and activate own function
remove_shortcode('gallery');
add_shortcode('gallery', 'mad_gallery');
