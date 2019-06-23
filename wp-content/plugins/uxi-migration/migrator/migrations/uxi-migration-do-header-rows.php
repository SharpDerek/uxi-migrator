<?php

function uxi_do_header_rows($dom) {
	if (function_exists('update_field')) {

		$xpath = new DOMXpath($dom);

		function uxi_get_items($dom, $xpath, $query_array, $query_index, $layout_array, $layout_index, $fields = array() ) {
			if ($query_index < count($query_array)) {
				foreach($xpath->query($query_array[$query_index]) as $element) {

					$id="";
					$class="";
					if ($element->hasAttributes()) {
						$id = $element->attributes->getNamedItem('id')->value;
						$class = $element->attributes->getNamedItem('class')->value;
					}

					array_push($fields,array(
						'acf_fc_layout' => $layout_array[$layout_index],
						'id' => $id,
						'class' => $class
					));

					$elementHTML = $dom->saveHTML($element);
					$elementDom = new DOMDocument();
					@$elementDom->loadHTML($elementHTML);
					$elementXpath = new DOMXpath($elementDom);

					$fields = uxi_get_items($elementDom, $elementXpath, $query_array, $query_index + 1, $layout_array, $layout_index + 1, $fields);
				}
			}
			return $fields;
		}

		update_field('block',array(),'option');

		$query_array = array(
			'//*[@uxi-header]//*[@data-layout]',
			'//*[@class="container"]/*[@class="container-inner"]/*[@class="row"]/div'
		);

		$layout_array = array(
			'row',
			'grid_item'
		);

		$field_array = uxi_get_items(
			$dom,
			$xpath,
			$query_array,
			0,
			$layout_array,
			0
		);

		var_dump($field_array);

		update_field('block',$field_array,'option');

	}
}