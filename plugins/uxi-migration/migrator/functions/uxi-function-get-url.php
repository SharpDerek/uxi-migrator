<?php

function uxi_get_url($dom) {
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