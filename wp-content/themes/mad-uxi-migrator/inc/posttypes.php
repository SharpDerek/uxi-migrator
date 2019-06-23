<?php 

function mad_register_post_types(){
	
	// Example Post Type
	$posttype_labels = array(
		'name' => __('Testimonials', 'mad'),
		'singular_name' => __('Testimonial', 'mad'),
		'add_new' => __('Add Testimonial', 'mad'),
		'add_new_item' => __('Add New Testimonial', 'mad'),
		'edit_item' => __('Edit Testimonial', 'mad'),
		'new_item' => __('New Testimonial', 'mad'),
		'all_items' => __('All Testimonials', 'mad'),
		'view_item' => __('View Testimonial', 'mad'),
		'search_items' => __('Search Testimonials', 'mad'),
		'not_found' =>  __('No Testimonials found', 'mad'),
		'not_found_in_trash' => __('No Testimonials found in Trash', 'mad'),
		'parent_item_colon' => '',
		'menu_name' => __('Testimonials', 'mad')
	);
	$posttype_args = array(
		'labels' => $posttype_labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon'   => 'dashicons-editor-quote',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'mad360_testimonial' ),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'editor', 'thumbnail' )
	);
	register_post_type( 'mad360_testimonial', $posttype_args );
}
add_action( 'init', 'mad_register_post_types' );