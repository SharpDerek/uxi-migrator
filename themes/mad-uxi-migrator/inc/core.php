<?

function mad_get_layout($layout_name = 'uxi_main_layout') {
	global $post;

	if (function_exists('get_field')) {

		$default_layouts = get_field('default_layouts', 'option');

		$site_default = array();
		$post_type_default = array();

		foreach ($default_layouts as $default_layout) {
			if ($default_layout['post_type'] == get_post_type()) {
				$post_type_default = $default_layout['layout'];
			} else if ($default_layout['post_type'] == 'mad_default') {
				$site_default = $default_layout['layout'];
			}
		}
		if (is_search() || is_404()) {
			return $site_default[$layout_name][0];
		} else if (is_home() || is_archive()) {
			if (is_category()) {
				$main_id = get_option('page_for_posts');
			} else {
				if (property_exists(get_queried_object(), 'rewrite')) {
					$archive_page = get_page_by_path(get_queried_object()->rewrite['slug']);
				}
				if ($archive_page) {
					$main_id = $archive_page->ID;
				} else {
					$main_id = get_queried_object_id();
				}
			}
		} else {
			$main_id = get_the_ID();
		}

		$layout = get_field("layout", $main_id);

		if ($layout_name == 'uxi_main_layout' && have_rows('block', $main_id)) { // Check individual post for rows ONLY if on a page layout
			return $main_id;

		} else if ($layout[$layout_name][0])  { // Check assigned layout
			return $layout[$layout_name][0];

		} else if ($post_type_default[$layout_name]) { // Check post type layout
			return $post_type_default[$layout_name][0];

		} else { // Check site default
			return $site_default[$layout_name][0];
		}
	}
	return false;
}

function mad_get_post_types($type = 'objects') {
	if ($type == 'objects') {
		$post_types = array (
			'mad_default' => new WP_Post_Type(
				'mad_default',
				array (
					'labels' => array (
					'singular_name' => 'Site Default'
					)
				)
			)
		);
	} else if ($type == 'names') {
		$post_types = array(
			'mad_default'
		);
	}
	$args = array (
		'public' => true
	);

	return array_merge($post_types, get_post_types($args, $type));
}

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

function mad_populate_post_types($field) {

	$field['choices'] = array();

	foreach(mad_get_post_types() as $post_type) {
		$field['choices'][$post_type->name] = $post_type->labels->singular_name;
	}
	return $field;
}
add_filter('acf/load_field/name=post_type', 'mad_populate_post_types');

function mad_populate_defaults() {

	if (function_exists('get_field')) {

		$post_types = mad_get_post_types('names');

		$rows = get_field('default_layouts', 'option');

		if ($rows) {
			foreach ($post_types as $post_type) {
				$has_post_type_row = false;
				foreach ($rows as $row) {
					if ($row['post_type'] == $post_type) {
						$has_post_type_row = true;
					}
				}
				if (!$has_post_type_row) {
					add_row('default_layouts', array (
						'post_type' => $post_type
					), 'option');
				}
			}
		}
	}
}
add_action('admin_init', 'mad_populate_defaults');

function mad_excerpt() {
	global $post;
	ob_start(); ?>
	<a href="<?php echo get_permalink($post->ID); ?>" class="read-more-link inline none" title="Read Full Post" rel="bookmark">Read More</a>
	<?php 
	$readmore = ob_get_contents();
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