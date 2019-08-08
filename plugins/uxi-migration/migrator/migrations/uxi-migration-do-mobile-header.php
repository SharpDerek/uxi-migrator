<?php

function uxi_do_mobile_header($dom) {
	if (function_exists('update_field')) {

		uxi_print("Start Mobile Header.").
		$mobile_nav = get_field('mobile_navigation', 'option');

		$field = array();

		$xpath = new DOMXpath($dom);

		$query_array = array(
			'header_content' => '//*[@class="mobile-navbar-header"]/*',
			'widget_uxi_menu' => '//*[@class="mobile-drawer mobile-drawer-left"]/*',
			'mobile_drawer_right_content' => '//*[@class="mobile-drawer mobile-drawer-right"]/*',
		);

		foreach($query_array as $element=>$query) {
			if ($xpath->query($query)->length > 0) {
				foreach($xpath->query($query) as $item) {
					if ($element == 'widget_uxi_menu') {
						$itemHTML = $dom->saveHTML($item);
						$itemDom = new DOMDocument();
						@$itemDom->loadHTML(utf8_decode($itemHTML));
						$field[$element] = uxi_menu_match($itemDom);
					} else {
						$field[$element] .= 
							uxi_relative_asset_url(
								uxi_relative_url(
									uxi_gravityform_shortcode(
										$dom->saveHTML($item)
									)
								)
							);
					}
				}
				uxi_print("<i>".$element."</i> Created.","sub");
			}
		}

		update_field('mobile_navigation',$field,'option');
		uxi_print("Mobile Header Created.");

	}
}