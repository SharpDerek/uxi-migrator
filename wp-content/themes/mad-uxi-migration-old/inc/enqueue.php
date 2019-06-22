<?php

// Enqueue all CSS files in /assets/css

function uxi_enqueue_styles() {
	foreach (scandir(UXI_THEME_DIR.'assets/css') as $css) {
		$path = UXI_THEME_DIR.'assets/css/'.$css;
		$url = UXI_THEME_URL.'assets/css/'.$css;
		if (is_file($path)) {
			$name = str_replace('.css','',$css);
			wp_enqueue_style($name,$url);
		}
	}
}

add_action('wp_enqueue_scripts','uxi_enqueue_styles');


