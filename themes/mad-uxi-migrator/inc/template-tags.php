<?php

/**
* Enables viewport tag for mobile
*/

if(!function_exists('mad_mobile_viewport')) :
function mad_mobile_viewport(){
  if(MOBILE) echo '<meta name="viewport" content="width=device-width">';
}
endif;

/**
* Mobile class for html tag
*/

if(!function_exists('mad_mobile_class')):
function mad_mobile_class(){
  if(MOBILE) echo 'mobile';
}
endif;

/**
* Class for #sidebar
*/

if(!function_exists('mad_sidebar_class')):
  function mad_sidebar_class(){
    return SIDEBAR_CLASS;
  }
endif;


/**
* Truncate title on recent posts widget etc.,
* <?php mad_short_title(20) ?>
*/

function mad_short_title($limit = 40){
  $title = get_the_title();
  $pad = "&hellip;";
  if(strlen($title) <= $limit) {
    echo $title;
  } else {
    $title = substr($title, 0, $limit) . $pad;
  echo $title;
  }
}

/**
* Change default excerpt length
* This is used to set a large number for the excerpt length that way the following mad excerpt can make multiple lengths in multiple locations
*/

function mad_default_excerpt_length($length) {
  return 500;
}
//add_filter('excerpt_length', 'mad_default_excerpt_length');

/**
* Begin Custom Multiple Excerpts Lengths Thanks to Adam Nowak @link code.hyperspatial.com/
* <?php mad_the_excerpt(40,'characters') ?> (can remove ,'characters' if words rather than characters desired)
*/

// Limit String Characters
function mad_limit_string_chars($string,$char_limit)
{
  $newstring = substr($string,0,$char_limit);
  return $newstring;
}
// Limit String Words
function mad_limit_string_words($string,$word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
//The Excerpt
function mad_the_excerpt($max_length='',$limit_type='words'){
  if($max_length == ''){ $shorten_post_value = get_option('shorten_post_value'); }
  else $shorten_post_value = $max_length;
  $shortened_content = get_the_excerpt();
  if ($shorten_post_value == 'none'){ return; }
  else if($shorten_post_value == 'full'){ the_content(); }
  else {
    if($limit_type == 'characters'){
      echo '<p class="post-excerpt">' . mad_limit_string_chars($shortened_content,$shorten_post_value) . '&hellip;';
      }
    else {
      echo '<p class="post-excerpt">' . mad_limit_string_words($shortened_content,$shorten_post_value) . '&hellip;';
      }?>
    <a href="<?php the_permalink(); ?>" class="read-more" title="Read Full Post" rel="bookmark"><?php _e('read&nbsp;more', 'mad'); ?></a></p>
    <?php
  }
}

/**
* Checks not just if you are on a child page but any subpage including grandchildren
*/

function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
  global $post;         // load details about this page
  $anc = get_post_ancestors( $post->ID );
  foreach($anc as $ancestor) {
    if(is_page() && $ancestor == $pid) {
      return true;
    }
  }
  if(is_page()&&(is_page($pid)))
    return true;   // we're at the page or at a sub page
  else
    return false;  // we're elsewhere
};

/**
 * Posts Pagination
 * @link http://codex.wordpress.org/Function_Reference/paginate_links
 * @link http://wp-snippets.com/pagination-without-plugin/
*/

function mad_posts_nav() {
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => POSTS_NAV_LEFT,
    'next_text' => POSTS_NAV_RIGHT,
    'type' => 'list',
    'end_size'    => 1,
    'mid_size'    => 2
  );
  if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
  if ($wp_query->max_num_pages > 1)
    echo '<nav class="archive-pagination" role="navigation">'. paginate_links( $pagination ) .'</nav>';
};