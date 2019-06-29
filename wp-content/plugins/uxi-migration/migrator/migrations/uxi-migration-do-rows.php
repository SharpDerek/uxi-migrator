<?php

function uxi_do_rows($dom, $xpath, $query_array, $query_index, $fields = array() ) {
	if (function_exists('update_field')) {
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
					$widget_file = uxi_get_widget(
							$widget_layout,
							'widget'
						);
					require($widget_file);
				} else {
					array_push($fields,array(
						'acf_fc_layout' => $this_query['layout'],
						'id' => $id,
						'class' => $class
					));
					uxi_print('<i>'.$this_query['layout'].'</i> created. id: "'.$id.'", class: "'.$class.'"',"sub");
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
	}
	return $fields;
}