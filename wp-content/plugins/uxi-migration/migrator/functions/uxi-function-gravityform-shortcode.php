<?php

function uxi_gravityform_shortcode($dom) {
	$xpath = new DOMXpath($dom);

	foreach ($xpath->query('//*[contains(@class,"gform_wrapper")]|//iframe[contains(@name,"gform_ajax")]|//script[contains(text(),"gform")]') as $gform_element) {
		
	}
}