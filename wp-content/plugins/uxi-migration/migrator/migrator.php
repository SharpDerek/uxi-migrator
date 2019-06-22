<?php

if ($response) {
	

	define('MAD_UXI_THEME_PATH',get_stylesheet_directory());


	function uxi_get_head($response) {

		//echo "TEST!!!!";

		$dom = new DOMDocument();
		@$dom->loadHTML($response);

		function printResponse($response) {
			echo '<pre>'.htmlentities($response).'</pre>';
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
				uxi_write('/header.php',$dom->saveHTML($head),'Header file rewritten.');
				//echo '<pre>'.htmlentities($dom->saveHTML($head)).'</pre>';
			}
		}

		function doCSS($dom) {
			foreach($dom->getElementsByTagName('link') as $link) {
				$href = $link->attributes->getNamedItem('href');
				$id = $link->attributes->getNamedItem('id');

				if ($href) {
					if (strpos($href->value,'.css')) {
						$css = uxi_curl($href->value);
						if ($css) {
							uxi_write(
								'/assets/css/theme.css',
								'a',
								"/*====".$id->value."====*/\n\n".
								uxi_replace_url(
									str_replace(';',";\n",
										str_replace('{'," {\n",
											str_replace('}',"\n}\n\n",
												str_replace('*/',"*/\n",
													$css
												)
											)
										)
									)
								),
								"CSS file rewritten.\n"
							);
						}
					}
				}
			}
		}
		define('UXI_URL',getURL($dom));
		//printResponse($response);
		//doHead($dom);
		doCSS($dom);

	}

	uxi_get_head($response);

}