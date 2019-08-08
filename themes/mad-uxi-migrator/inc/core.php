<?php

function mad_get_all_wordpress_menus(){
	return get_terms( 'nav_menu', array( 'hide_empty' => false ) ); 
}

function mad_populate_menus( $field ) {
    
    $field['choices'] = array();
        foreach(mad_get_all_wordpress_menus() as $menu) {
            $field['choices'][$menu->slug] = $menu->name;
            
        }
    return $field;
    
}

add_filter('acf/load_field/name=widget_uxi_menu', 'mad_populate_menus');

function mad_excerpt() {
	global $post;
	ob_start(); ?>
	<a href="<?php echo get_permalink($post->ID); ?>" class="read-more-link inline none" title="Read Full Post" rel="bookmark">Read More</a>
	<?php 
	$readmore = ob_get_contents();
	var_dump($readmore);
	ob_end_clean();
	$excerpt = wp_trim_words($post->post_content, 53, "&hellip;".$readmore);
	echo $excerpt;
}

function mad_post_class($classes, $class, $post_id) {
	if (get_post_type($post_id) !== 'page') {
		$classes[] = "post-archive";
	}
	return $classes;
}

add_filter('post_class','mad_post_class', 10, 3);


add_image_size ('mad_gallery', get_option('mad_gallery_size_w'), get_option('mad_gallery_size_h'), get_option('mad_gallery_crop'));
add_image_size ('mad_slideshow', get_option('mad_slideshow_size_w'), get_option('mad_slideshow_size_h'), get_option('mad_slideshow_crop'));
add_image_size ('mad_featured_archive', get_option('mad_featured_archive_size_w'), get_option('mad_featured_archive_size_h'), get_option('mad_featured_archive_crop'));
add_image_size ('mad_featured_single', get_option('mad_featured_single_size_w'), get_option('mad_featured_single_size_h'), get_option('mad_featured_single_crop'));
add_image_size ('mad_featured_page', get_option('mad_featured_page_size_w'), get_option('mad_featured_page_size_h'), get_option('mad_featured_page_crop'));