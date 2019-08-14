<?php 

function mad_register_post_types(){
	
	// Testimonials
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
		'rewrite' => array( 'slug' => 'testimonials' ),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'editor', 'thumbnail' )
	);
	register_post_type( 'mad360_testimonial', $posttype_args );

	// Header Layouts
	$posttype_labels = array(
		'name' => __('Header Layouts', 'mad'),
		'singular_name' => __('Header Layout', 'mad'),
		'add_new' => __('Add Header Layout', 'mad'),
		'add_new_item' => __('Add New Header Layout', 'mad'),
		'edit_item' => __('Edit Header Layout', 'mad'),
		'new_item' => __('New Header Layout', 'mad'),
		'all_items' => __('All Header Layouts', 'mad'),
		'view_item' => __('View Header Layout', 'mad'),
		'search_items' => __('Search Header Layouts', 'mad'),
		'not_found' =>  __('No Header Layouts found', 'mad'),
		'not_found_in_trash' => __('No Header Layouts found in Trash', 'mad'),
		'parent_item_colon' => '',
		'menu_name' => __('Header Layouts', 'mad')
	);
	$posttype_args = array(
		'labels' => $posttype_labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => 'uxi-layout-templates',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'uxi-header-layout' ),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array( 'title', )
	);
	register_post_type( 'uxi-header-layout', $posttype_args );

	// Page Layouts
	$posttype_labels = array(
		'name' => __('Page Layouts', 'mad'),
		'singular_name' => __('Page Layout', 'mad'),
		'add_new' => __('Add Page Layout', 'mad'),
		'add_new_item' => __('Add New Page Layout', 'mad'),
		'edit_item' => __('Edit Page Layout', 'mad'),
		'new_item' => __('New Page Layout', 'mad'),
		'all_items' => __('All Page Layouts', 'mad'),
		'view_item' => __('View Page Layout', 'mad'),
		'search_items' => __('Search Page Layouts', 'mad'),
		'not_found' =>  __('No Page Layouts found', 'mad'),
		'not_found_in_trash' => __('No Page Layouts found in Trash', 'mad'),
		'parent_item_colon' => '',
		'menu_name' => __('Page Layouts', 'mad')
	);
	$posttype_args = array(
		'labels' => $posttype_labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => 'uxi-layout-templates',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'uxi-main-layout' ),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array( 'title', )
	);
	register_post_type( 'uxi-main-layout', $posttype_args );

	// Footer Layouts
	$posttype_labels = array(
		'name' => __('Footer Layouts', 'mad'),
		'singular_name' => __('Footer Layout', 'mad'),
		'add_new' => __('Add Footer Layout', 'mad'),
		'add_new_item' => __('Add New Footer Layout', 'mad'),
		'edit_item' => __('Edit Footer Layout', 'mad'),
		'new_item' => __('New Footer Layout', 'mad'),
		'all_items' => __('All Footer Layouts', 'mad'),
		'view_item' => __('View Footer Layout', 'mad'),
		'search_items' => __('Search Footer Layouts', 'mad'),
		'not_found' =>  __('No Footer Layouts found', 'mad'),
		'not_found_in_trash' => __('No Footer Layouts found in Trash', 'mad'),
		'parent_item_colon' => '',
		'menu_name' => __('Footer Layouts', 'mad')
	);
	$posttype_args = array(
		'labels' => $posttype_labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => 'uxi-layout-templates',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'uxi-footer-layout' ),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array( 'title', )
	);
	register_post_type( 'uxi-footer-layout', $posttype_args );
}
add_action( 'init', 'mad_register_post_types' );