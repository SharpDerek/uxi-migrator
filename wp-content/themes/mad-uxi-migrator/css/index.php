<?php

function enqueue_uxi_styles() {
	foreach (scandir(plugin_dir_path(__FILE__)) as $css) {
		$path = plugin_dir_path(__FILE__).'/'.$css;
		$url = plugin_dir_url(__FILE__).'/'.$css;
		if (is_file($path)) {
			$name = str_replace('.','-',$css);
			wp_enqueue_style($name,$url);
		}
	}
}

add_action('wp_enqueue_scripts','uxi_enqueue_styles');