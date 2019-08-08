<?php

function uxi_do_scripts($dom) {

	$xpath = new DOMXpath($dom);
	$script_locations = array (
		'head' => '//head//script[contains(@src,"uxi-site")]',
		'footer' => '//body//script[contains(@src,"uxi-site")]',
	);

	foreach($script_locations as $location => $query) {

		foreach($xpath->query($query) as $script) {
			if ($script->hasAttributes()) {
				$src = $script->attributes->getNamedItem('src')->value;
				$js = uxi_curl($src);
				@$name = explode("?",end(explode("/",$src)))[0];
				uxi_write(
					"/js/".$location."/".$name,
					"wb",
					$js
				);
			}
		}
	}
}