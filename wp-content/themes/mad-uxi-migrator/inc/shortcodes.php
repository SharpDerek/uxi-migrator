<?php

/**
 * Add iframes, image maps, html etc, via custom fields and shortcode [field name="name-of-your-custom-field"]
*/

function mad_field_func($atts) {
   global $post;
   $name = $atts['name'];
   if (empty($name)) return;
   return get_post_meta($post->ID, $name, true);
}
add_shortcode('field', 'mad_field_func');

/**
 * This allows for adding custom wrapper html tags with attributes
 * [html tag="article" atr='class="cool"']
 * [close-html tag="article"]
*/

function mad_html($atts) {
  extract(shortcode_atts(array(
    'tag' => '',
    'atr' => ''
  ), $atts)); 
    return '<'.$tag.' '.$atr.'>'; 
}
add_shortcode('html','mad_html');

function mad_close_html($atts) {
  extract(shortcode_atts(array(
    'tag'   => ''
  ), $atts)); 
    return '</'.$tag.'>'; 
}
add_shortcode('close-html','mad_close_html');


/** 
* Use the following YouTube and Vimeo shortcodes for videos for fluid videos
* @link http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* @link graphicbeacon.com/web-design-development/embed-an-iframe-into-a-post-or-page-without-using-a-plugin/
*/

// YouTube
function mad_youtube_shortcode($atts) { 
extract(shortcode_atts(array( 
  'id'   => 'YE7VzlLtp-4',
  'ratio'   => ''
), $atts)); 
return '<div class="flex-video '.$ratio.'"><iframe src="http://www.youtube.com/embed/'.$id.'?wmode=opaque" frameborder="0" width="560" height="315" allowfullscreen></iframe></div>';
 
}
add_shortcode('youtube','mad_youtube_shortcode');

// Vimeo
function mad_vimeo_shortcode($atts) { 
extract(shortcode_atts(array( 
  'id'   => '1084537',
  'ratio'   => ''
), $atts)); 
return '<div class="flex-video '.$ratio.' vimeo"><iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&wmode=opaque" frameborder="0" width="560" height="315" webkitAllowFullScreen allowFullScreen></iframe></div>';
 
} 
add_shortcode('vimeo','mad_vimeo_shortcode');

/**
 * Grid Shortcodes
 * [grid-row class='test']
 * [end-grid-row]
 * [grid-unit size='1of3' class='test']
 * [end-grid-unit]
*/

function mad_grid_row($atts) {
  extract(shortcode_atts(array(
    'class' => ''
  ), $atts)); 
  return '<div class="'.$class.' grid-row">'; 
}
add_shortcode('grid-row','mad_grid_row');

function mad_end_grid_row() {
  return '</div>'; 
}
add_shortcode('end-grid-row','mad_end_grid_row');

function mad_grid_unit($atts) {
  extract(shortcode_atts(array(
    'class' => '',
    'size'   => '1of2'
  ), $atts)); 
    return '<div class="'.$class.' grid-unit size'.$size.'">'; 
}
add_shortcode('grid-unit','mad_grid_unit');

function mad_end_grid_unit() {
  return '</div>'; 
}
add_shortcode('end-grid-unit','mad_end_grid_unit');

/**
* Shortcode Dropdown
*/

add_action('media_buttons','add_mad_sc_select',11);
function add_mad_sc_select(){
  echo '&nbsp;<select id="sc_select">
    <option selected>Shortcodes</option>
    <option value="[grid-row class=&quot;&quot;]">[grid-row]</option>
    <option value="[end-grid-row]">[end-grid-row]</option>
    <option value="[grid-unit size=&quot;1of2&quot; class=&quot;&quot;]">[grid-unit]</option>
    <option value="[end-grid-unit]">[end-grid-unit]</option>
    <option value="[html tag=&quot;section&quot; atr=&#39;id=&quot;test&quot;&#39;]">[html]</option>
    <option value="[close-html tag=section]">[close-html]</option>
    <option value="[youtube id=&quot;YE7VzlLtp-4&quot; ratio=&quot;widescreen&quot;]">[youtube]</option>
    <option value="[vimeo id=&quot;6284199&quot; ratio=&quot;widescreen&quot;]">[vimeo]</option>
    <option value="[field name=&quot;custom-field-name&quot;]">[field]</option>
  </select>';
}
add_action('admin_head', 'mad_sc_button_js');

function mad_sc_button_js() {
  echo '<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("#sc_select").first().css("display","inline");
    jQuery("#sc_select").change(function() {
      send_to_editor(jQuery("#sc_select :selected").val());
      return false;
    });
  });
  </script>';
}

?>