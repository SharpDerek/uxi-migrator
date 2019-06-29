<?php

function mad_add_options() {
	add_menu_page(
	 'Layout Templates',
	 'Layouts',
	 'manage_options',
	 'uxi-layout-templates',
	 '',
	 'dashicons-layout',
	 -1
	);
}
add_action('admin_init','mad_add_options');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Layout Settings',
		'menu_title'	=> 'Layout Settings',
		'menu_slug' 	=> 'layout-settings',
		'capability'	=> 'edit_posts',
	));
	
}