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
