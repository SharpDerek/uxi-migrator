<?php

function enqueue_uxi_styles() {
	foreach (scandir(get_stylesheet_directory().'/css') as $css) {
		$path = get_stylesheet_directory().'/css/'.$css;
		$url = get_stylesheet_directory_uri().'/css/'.$css;
		if (is_file($path) && strpos($path,'.css') > -1) {
			$name = str_replace('.','-',$css);
			wp_enqueue_style($name,$url);
		}
	}
}

add_action('wp_enqueue_scripts','enqueue_uxi_styles');