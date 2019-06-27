<?php

function enqueue_uxi_head_scripts() {
	foreach (scandir(get_stylesheet_directory().'/js/head') as $js) {
		$path = get_stylesheet_directory().'/js/head/'.$js;
		$url = get_stylesheet_directory_uri().'/js/head/'.$js;
		if (is_file($path) && strpos($path,'.js') > -1) {
			$name = str_replace('.','-',$js);
			wp_enqueue_script($name,$url,array('jquery'),false,false);
		}
	}
}

add_action('wp_enqueue_scripts','enqueue_uxi_head_scripts');