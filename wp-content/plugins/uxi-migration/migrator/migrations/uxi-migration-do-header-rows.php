<?php

function uxi_do_header_rows($dom) {
	if (function_exists('update_field')) {

		$xpath = new DOMXpath($dom);

		update_field('block',array(),'option');
		//var_dump(get_field('block','option'));
		$field_array = array();

		foreach($xpath->query("//*[@uxi-header]//*[@data-layout]") as $element) {
			$element_attributes = array();
			if ($element->hasAttributes()) {
				foreach($element->attributes as $attr) {
					array_push($element_attributes,array(
						'attribute_name' => $attr->nodeName,
						'attribute_value' => $attr->nodeValue,
					));
				}
			}
			//var_dump($element->attributes);
			array_push($field_array,array(
				'acf_fc_layout' => 'row',
				'attributes' => $element_attributes,
			));
		}
		update_field('block',$field_array,'option');
	}
}