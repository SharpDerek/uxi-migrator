<?php

if ($response) {
	

	define('MAD_UXI_THEME_PATH',get_stylesheet_directory());


	function uxi_get_head($response) {

		$dom = new DOMDocument();
		@$dom->loadHTML($response);

		function printResponse($response) {
			var_dump($response);
			//echo '<pre>'.htmlentities($response).'</pre>';
		}

		function getURL($dom) {
			foreach($dom->getElementsByTagName('link') as $link) {
				$href = $link->attributes->getNamedItem('href');
				$id = $link->attributes->getNamedItem('id');
				if ($id) {
					if ($id->value == 'uxi-site-custom-css')
					return explode('uxi-site-custom.css',$href->value)[0];
				}
			}
			return false;
		}

		function doHead($dom) {
			foreach($dom->getElementsByTagName('head') as $head) {
				uxi_write('/header.php',$dom->saveHTML($head),'a',false,'Header file rewritten.');
				//echo '<pre>'.htmlentities($dom->saveHTML($head)).'</pre>';
			}
		}

		function extractExternalAssets($css, $href) {
			foreach(explode('url(',$css) as $url) {
				$thisUrl = explode(')',$url)[0];
				$filepath = uxi_filepath_navigate($href,$thisUrl);
				if ($filepath) {
					$file_curl = uxi_curl($filepath);
					if ($file_curl) {
						@uxi_write(
							'/assets/'.explode('#',str_replace('../','',$thisUrl))[0],
							'xb',
							$file_curl
						);
					}
				}
			}
		}

		function doAssets($dom) {
			foreach($dom->getElementsByTagName('link') as $link) {
				$href = $link->attributes->getNamedItem('href');
				$id = $link->attributes->getNamedItem('id');

				if ($href) {
					if (strpos($href->value,'.css')) {
						$css = uxi_curl($href->value);
						if ($css) {
							if (strpos($css,'url(') > -1) {
								extractExternalAssets($css, $href->value);
							}
							$css = uxi_get_local_img($css);

							@uxi_write(
								'/assets/css/'.$id->value.'.css',
								'xb',
								"/*====".$id->value."====*/\n\n".
								uxi_unminify_css($css)
							);
						}
					}
				}
			}
		}
		define('UXI_URL',getURL($dom));
		//printResponse($response);
		//doHead($dom);
		doAssets($dom);

	}

	uxi_get_head($response);

}