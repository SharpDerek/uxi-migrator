<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Layout Builder',
		'menu_title'	=> 'Layout Builder',
		'menu_slug' 	=> 'layout-builder',
		'capability'	=> 'edit_posts',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Builder',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'layout-builder',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Builder',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'layout-builder',
	));
	
}