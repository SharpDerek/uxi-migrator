<?php

function uxi_migrator_admin_scripts() {
	wp_enqueue_script(
		'uxi-migrator-admin-js',
		plugin_dir_url(__FILE__).'uxi-migration.js',
		array('jquery'),
		false,
		true
	);
}
add_action('admin_enqueue_scripts', 'uxi_migrator_admin_scripts');