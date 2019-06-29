<?php

function enqueue_uxi_footer_scripts() {
	foreach (scandir(get_stylesheet_directory().'/js/footer') as $js) {
		$path = get_stylesheet_directory().'/js/footer/'.$js;
		$url = get_stylesheet_directory_uri().'/js/footer/'.$js;
		if (is_file($path) && strpos($path,'.js') > -1) {
			$name = str_replace('.','-',$js);
			wp_enqueue_script($name,$url,array('jquery'),false,true);
		}
	}
}

add_action('wp_enqueue_scripts','enqueue_uxi_footer_scripts');