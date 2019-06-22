<?php
/*
Plugin Name: UXI Migrator
Description: Used to Migrate UXI Sites to Wordpress
Version: 0.0.0
Author: Madwire
*/

define('UXI_MIGRATOR_URL',plugin_dir_url(__FILE__));
define('UXI_MIGRATOR_PATH',plugin_dir_path(__FILE__));
define('UXI_THEME_INSTALLED',wp_get_theme()->name === 'UXi Migration');



function uxi_menu_page() {
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

function uxi_options_page() {
	require_once(plugin_dir_path(__FILE__).'menu/migration.php');
}
add_action('admin_menu','uxi_menu_page');