<?php

function uxi_register_posttypes() {
		if (class_exists('WP_Store_locator')) {
		// Locations
		$posttype_labels = array(
			'name' => __('Locations', 'mad'),
			'singular_name' => __('Location', 'mad'),
			'add_new' => __('Add Location', 'mad'),
			'add_new_item' => __('Add New Location', 'mad'),
			'edit_item' => __('Edit Location', 'mad'),
			'new_item' => __('New Location', 'mad'),
			'all_items' => __('All Location', 'mad'),
			'view_item' => __('View Location', 'mad'),
			'search_items' => __('Search Locations', 'mad'),
			'not_found' =>  __('No Locations found', 'mad'),
			'not_found_in_trash' => __('No Locations found in Trash', 'mad'),
			'parent_item_colon' => '',
			'menu_name' => __('Locations', 'mad')
		);
		$posttype_args = array(
			'labels' => $posttype_labels,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon'   => 'dashicons-location-alt',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'locations' ),
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => 2,
			'supports' => array( 'title', 'page-attributes', 'editor', 'thumbnail', 'excerpt' )
		);
		register_post_type( 'uxi_locations', $posttype_args );
	}
}

add_action('init', 'uxi_register_posttypes');