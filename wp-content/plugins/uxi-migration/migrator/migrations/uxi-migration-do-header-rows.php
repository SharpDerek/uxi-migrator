<?php

function uxi_do_header_rows($dom) {
	if (function_exists('update_field')) {

		$xpath = new DOMXpath($dom);

		function uxi_get_items($dom, $xpath, $query_array, $query_index, $fields = array() ) {
			if ($query_index < count($query_array)) {

				$this_query = $query_array[$query_index];

				foreach($xpath->query($this_query['query']) as $element) {

					$id="";
					$class="";
					$content="";
					$layout = $this_query['layout'];
					if ($element->hasAttributes()) {
						$id = $element->attributes->getNamedItem('id')->value;
						$class = $element->attributes->getNamedItem('class')->value;
					}
					if ($this_query['layout'] == 'widget') {
						//$layout = $element->attributes->getNamedItem('uxi-widget')->value;
						if ($element->hasChildNodes()) {
							for($i = 0; $i < $element->childNodes->length; $i++) {
								$content.= uxi_relative_url($dom->saveHTML($element->childNodes->item($i)));
							}
						}
					}

					array_push($fields,array(
						'acf_fc_layout' => $layout,
						'id' => $id,
						'class' => $class,
						'content' => $content
					));

					$elementHTML = $dom->saveHTML($element);
					$elementDom = new DOMDocument();
					@$elementDom->loadHTML($elementHTML);
					$elementXpath = new DOMXpath($elementDom);

					$fields = uxi_get_items($elementDom, $elementXpath, $query_array, $query_index + 1, $fields);

					array_push($fields,array(
						'acf_fc_layout' => $this_query['layout'].'_close'
					));
				}
			}
			return $fields;
		}

		//var_dump(get_field('block','option'));
		//var_dump(get_field_object('block','option',true,false));
		update_field('block', array(), 'option');

		$query_array = array(
			array(
				'query' => '//*[@uxi-header]//*[@data-layout]',
				'layout' => 'row'
			),
			array(
				'query' => '//*[@data-layout]/*[@class="container"]/*[@class="container-inner"]/*[@class="row"]/*',
				'layout' => 'grid_item'
			),
			array(
				'query' => '//*[@class="row"]/*',
				'layout' => 'grid_item'
			),
			array(
				'query' => '//*[@uxi-widget]',
				'layout' => 'widget'
			)
		);

		$field_array = uxi_get_items(
			$dom,
			$xpath,
			$query_array,
			0
		);

		var_dump($field_array);

		update_field('block',$field_array,'option');

	}
}