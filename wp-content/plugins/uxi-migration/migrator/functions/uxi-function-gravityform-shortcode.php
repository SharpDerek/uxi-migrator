<?php

function uxi_remove_fake_shortcode_tag($html) {
	return preg_replace("/<shortcode>|<\/shortcode>/", "", $html);
}

function uxi_gravityform_shortcode($html) {
	$html = utf8_decode($html);
	$dom = new DOMDocument();
	@$dom->loadHTML($html);
	$xpath = new DOMXpath($dom);

	$shortcode = "<shortcode>[gravityform id=0 title=false description=false ajax=false]</shortcode>";

	$query = $xpath->query(
		'//*[contains(@class,"gform_wrapper")]|
		//*[contains(@class,"gform_title")]|
		//*[contains(@class,"gform_description")]|
		//iframe[contains(@name,"gform_ajax")]|
		//script[contains(text(),"gform")]');
	$query_index = $query->length-1;


	foreach ($query as $gform_element) {
		foreach ($gform_element->attributes as $attribute) {
			switch($attribute->nodeName) {
				case 'id':
					if (strpos($attribute->nodeValue,"gform_wrapper_") > -1) {
						$shortcode = str_replace(
							"id=0",
							"id=".str_replace(
								"gform_wrapper_",
								"",
								$gform_element->attributes->getNamedItem("id")->value),
							$shortcode
						);
					}
				break;
				case 'class':
					if (strpos($attribute->nodeValue,"gform_title") > -1) {
						$shortcode = str_replace(
							"title=false",
							"title=true",
							$shortcode
						);
					}
					if (strpos($attribute->nodeValue,"gform_description") > -1) {
						$shortcode = str_replace(
							"description=false",
							"description=true",
							$shortcode
						);
					}
				break;
				case 'name':
					if (strpos($attribute->nodeValue,"gform_ajax") > -1) {
						$shortcode = str_replace(
							"ajax=false",
							"ajax=true",
							$shortcode
						);
					}
				break;
			}
		}
		if ($query_index == 0) {
			$new_html = str_replace(
							uxi_strip_doctype($dom->saveHTML($gform_element)),
							$shortcode,
							uxi_strip_doctype($dom->saveHTML())
						);
			@$dom->loadHTML($new_html);
		} else {
			$gform_element->parentNode->removeChild($gform_element);
		}
		$query_index--;
	}

	return uxi_strip_doctype(uxi_remove_fake_shortcode_tag($dom->saveHTML()));
}