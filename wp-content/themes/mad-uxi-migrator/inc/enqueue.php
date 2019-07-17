<?php

require_once(get_stylesheet_directory().'/css/css-enqueue.php');
require_once(get_stylesheet_directory().'/js/head/head-enqueue.php');
require_once(get_stylesheet_directory().'/js/footer/footer-enqueue.php');

// Enqueuing Admin Scripts.
if (!function_exists('mad_admin_scripts')) {
	function mad_admin_scripts() {
		wp_enqueue_script('mad-admin-js', get_stylesheet_directory_uri().'/js/admin/admin.js', array('jquery'));
	}
	add_action('admin_enqueue_scripts', 'mad_admin_scripts');
}