<?php

function uxi_do_external_assets($css, $href) {
	foreach(explode('url(',$css) as $url) {
		$thisUrl = explode(')',$url)[0];
		$filepath = uxi_filepath_navigate($href,$thisUrl);
		if ($filepath) {
			$file_curl = uxi_curl($filepath);
			if ($file_curl) {
				uxi_write(
					'/'.explode('#',str_replace('../','',$thisUrl))[0],
					'wb',
					$file_curl
				);
			}
		}
	}
}