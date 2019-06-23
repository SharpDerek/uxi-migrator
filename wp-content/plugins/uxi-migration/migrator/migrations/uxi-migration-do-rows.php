<?php

function uxi_do_rows($dom, $xpath, $query_array, $query_index, $fields = array() ) {
	define("UXI_ITEM",true);
	if ($query_index < count($query_array)) {

		$this_query = $query_array[$query_index];

		foreach($xpath->query($this_query['query']) as $element) {

			$id="";
			$class="";
			if ($element->hasAttributes()) {
				$id = $element->attributes->getNamedItem('id')->value;
				$class = $element->attributes->getNamedItem('class')->value;
			}
			if ($this_query['layout'] == 'widget') {
				$widget_layout = $element->attributes->getNamedItem('uxi-widget')->value;
				require(
					UXI_WIDGETS_PATH.
					uxi_get_layout(
						'block',
						$widget_layout,
						'widget',
						'option'
					)
					.'.php'
				);
			} else {
				array_push($fields,array(
					'acf_fc_layout' => $this_query['layout'],
					'id' => $id,
					'class' => $class
				));
			}

			$elementHTML = $dom->saveHTML($element);
			$elementDom = new DOMDocument();
			@$elementDom->loadHTML($elementHTML);
			$elementXpath = new DOMXpath($elementDom);

			$fields = uxi_do_rows($elementDom, $elementXpath, $query_array, $query_index + 1, $fields);

			array_push($fields,array(
				'acf_fc_layout' => $this_query['layout'].'_close'
			));
		}
	}
	return $fields;
}