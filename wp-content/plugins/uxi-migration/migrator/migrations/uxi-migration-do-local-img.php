<?php
function uxi_do_local_img($css) {
	if (defined('UXI_ASSET_URL')) {
		if (UXI_ASSET_URL) {
			foreach(explode('url(',$css) as $partial) {
				if (strpos($partial,UXI_ASSET_URL) > -1) {
					$url = explode(')',$partial)[0];
					$url_array = explode('/',$url);
					$img_path = $url_array[count($url_array)-1];
					uxi_copy($url,'/img/'.$img_path);
					$css = str_replace($url,'../img/'.$img_path,$css);
				}
			}
		}
	}
	return $css;
}