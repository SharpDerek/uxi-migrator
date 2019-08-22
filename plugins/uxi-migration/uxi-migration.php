<?php
/*
Plugin Name: UXI Migrator
Description: Used to Migrate UXI Sites to Wordpress
Version: 0.0.0
Author: Madwire
*/

define('UXI_MIGRATOR_URL',plugin_dir_url(__FILE__));
define('UXI_MIGRATOR_PATH',plugin_dir_path(__FILE__));

define('UXI_THEME_PATH',get_stylesheet_directory());
define('UXI_THEME_INSTALLED',wp_get_theme()->name === 'UXi Migrator');


function uxi_menu_page() {

	require(UXI_MIGRATOR_PATH.'migrator/functions/uxi-functions-loader.php');

	function uxi_options_page() {
		require_once(UXI_MIGRATOR_PATH.'menu/migration-menu.php');
	}

	add_menu_page(
	 'UXI Migration Settings',
	 'Migration',
	 'manage_options',
	 'uxi-migration',
	 'uxi_options_page',
	 'dashicons-migrate',
	 1
	);
}

add_action('admin_menu','uxi_menu_page');

function uxi_rest() {
	require(UXI_MIGRATOR_PATH.'rest/uxi-rest-endpoint.php');
}
add_action('plugins_loaded','uxi_rest');


function uxi_migrator_admin_styles() {
	wp_enqueue_style(
		'uxi_migrator_css',
		plugin_dir_url(__FILE__).'assets/css/uxi-migration.css'
	);
}
add_action('admin_enqueue_scripts', 'uxi_migrator_admin_styles');

function uxi_migrator_admin_scripts() {
	wp_enqueue_script(
		'uxi-migrator-admin-js',
		plugin_dir_url(__FILE__).'assets/js/uxi-migration.js',
		array('jquery'),
		false,
		true
	);
}
add_action('admin_enqueue_scripts', 'uxi_migrator_admin_scripts');

function uxi_migrator_inc() {
	require_once(plugin_dir_path(__FILE__).'inc/posttypes.php');
}
add_action('plugins_loaded', 'uxi_migrator_inc');