<?php

function uxi_do_rows($dom, $xpath, $query, $layout, $nested, $fields = array() ) {
	if (function_exists('update_field')) {
		define("UXI_ITEM",true);

			foreach($xpath->query($query) as $element) {

				$id="";
				$class="";

				if ($element->hasAttributes()) {
					$id = $element->attributes->getNamedItem('id')->value;
					$class = $element->attributes->getNamedItem('class')->value;
				}
				if ($layout !== 'widget') {
					array_push($fields,array(
						'acf_fc_layout' => $layout,
						'id' => $id,
						'class' => $class
					));
					uxi_print('<i>'.$layout.'</i> created. id: "'.$id.'", class: "'.$class.'"',"open");
				}

				switch($layout) {
					case 'row':
						if ($nested) {
							$new_query = '//*[@class="row"]/*';
							$new_layout = 'grid_item';
							$new_nested = true;
						} else {
							$new_query = '//*[@data-layout]/*[@class="container"]/*[@class="container-inner"]/*[@class="row"]/*';
							$new_layout = 'grid_item';
						}
						break;
					case 'grid_item':
						if ($nested) {
							$new_query = '//*[@uxi-widget]';
							$new_layout = 'widget';
							break;
						} else {
							$gridHTML = $dom->saveHTML($element);
							$gridDom = new DOMDocument();
							@$gridDom->loadHTML(utf8_decode($gridHTML));
							$gridXpath = new DOMXpath($gridDom);

							foreach($gridXpath->query('/*/*/*/*/*') as $child) {
								$childHTML = $gridDom->saveHTML($child);
								$childDom = new DOMDocument();
								@$childDom->loadHTML(utf8_decode($childHTML));
								$childXpath = new DOMXpath($childDom);
								if ($child->hasAttribute('uxi-row')) { // Looking for nested row
									$fields = uxi_do_rows(
										$childDom,
										$childXpath,
										'/*/*/*',
										'row',
										true,
										$fields
									);
								} else { // Assume it is a widget
									$fields = uxi_do_rows(
										$childDom,
										$childXpath,
										'/*/*/*',
										'widget',
										false,
										$fields
									);
								}
							}
							$new_query = false;
							$new_layout = false;
							break;
						}
						break;
					case 'widget':
						$widget_layout = $element->attributes->getNamedItem('uxi-widget')->value;
						if ($widget_layout == 'widget_uxi_navigation') {
							$is_custom_menu = false;
						}
						$widget_file = uxi_get_widget(
								$widget_layout,
								'widget'
							);
						require($widget_file);
						break;
					default:
						break;
				}

				if ($new_query && $new_layout) {
					$elementHTML = $dom->saveHTML($element);
					$elementDom = new DOMDocument();
					@$elementDom->loadHTML(utf8_decode($elementHTML));
					$elementXpath = new DOMXpath($elementDom);

					$fields = uxi_do_rows($elementDom, $elementXpath, $new_query, $new_layout, $new_nested, $fields);
				}

				if ($layout !== 'widget') {
					array_push($fields,array(
						'acf_fc_layout' => $layout.'_close'
					));
					uxi_print('<i>'.$layout.'_close</i> created.',"close");
				}
			}
	}
	return $fields;
}