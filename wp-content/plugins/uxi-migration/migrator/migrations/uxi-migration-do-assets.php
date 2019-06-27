<?php

function uxi_do_assets($dom) {
	foreach($dom->getElementsByTagName('link') as $link) {
		$href = $link->attributes->getNamedItem('href');
		$id = $link->attributes->getNamedItem('id');

		if ($href) {
			if (strpos($href->value,'.css')) {
				$css = uxi_curl($href->value);
				if ($css) {
					if (strpos($css,'url(') > -1) {
						uxi_do_external_assets($css, $href->value);
					}
					$css = uxi_do_local_img($css);

					uxi_write(
						'/css/'.$id->value.'.css',
						'wb',
						"/*====".$id->value."====*/\n\n".
						uxi_unminify_css($css)
					);
				}
			}
		}
	}
}