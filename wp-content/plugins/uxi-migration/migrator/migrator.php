<?php

if ($response) {
	//echo '<pre>'.htmlentities($response).'</pre>';

	define('MAD_UXI_THEME_PATH',get_stylesheet_directory());



	function uxi_get_head($response) {

		//echo "TEST!!!!";

		$dom = new DOMDocument();
		@$dom->loadHTML($response);

		//var_dump($dom);

		foreach($dom->getElementsByTagName('head') as $head) {

			$header = fopen(MAD_UXI_THEME_PATH.'/header.php','w');
			if ($header) {
				fwrite($header, $dom->saveHTML($head));
				if (fclose($header)) {
					echo "Header file rewritten.";
				}
			}
			//echo '<pre>'.htmlentities($dom->saveHTML($head)).'</pre>';
		}
	}

	uxi_get_head($response);

}