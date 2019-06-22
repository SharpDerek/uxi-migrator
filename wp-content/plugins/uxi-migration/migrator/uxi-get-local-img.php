<?php
function uxi_get_local_img($css) {
	if (defined('UXI_URL')) {
		if (UXI_URL) {
			foreach(explode('url(',$css) as $partial) {
				if (strpos($partial,UXI_URL) > -1) {
					$url = explode(')',$partial)[0];
					$url_array = explode('/',$url);
					$img_path = $url_array[count($url_array)-1];
					//var_dump($url);
					uxi_copy($url,'/img/'.$img_path);
					// uxi_write(
					// 	'/assets/img/'.$img_path,
					// 	'xb',
					// 	$url,
					// 	true
					// );
					$css = str_replace($url,'../img/'.$img_path,$css);
				}
			}
		}
	}
	return $css;
}