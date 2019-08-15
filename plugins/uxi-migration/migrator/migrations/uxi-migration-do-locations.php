<?php
	
function uxi_do_locations() {
	if (class_exists('WP_Store_locator')) {

		// Change WPSL Settings
		$wpsl_settings = get_option('wpsl_settings');

		$wpsl_settings['permalinks'] = 1;
		$wpsl_settings['permalink_remove_front'] = 1;
		$wpsl_settings['permalink_slug'] = "location";
		$wpsl_settings['category_slug'] = "location-category";

		update_option('wpsl_settings', $wpsl_settings);
	}
}

function uxi_do_location_data($post_id, $dom) {
	if (class_exists('WP_Store_locator')) {
		$xpath = new DOMXPath($dom);

		$address_index = 0;
		$address_items = array(
			'wpsl_address',
			'wpsl_address2',
			'wpsl_city',
			'wpsl_state',
			'wpsl_zip',
		);
		foreach($xpath->query('//*[@class="company-info-address"]/span/span') as $address_item) {
			if (strpos($dom->saveHTML($address_item), "<br>") > -1) {
				foreach($address_item->childNodes as $childNode) {
					if ($childNode->textContent) {
						update_post_meta($post_id, $address_items[$address_index], $childNode->textContent);
						$address_index++;
					}
				}
			} else {
				update_post_meta($post_id, $address_items[$address_index], $address_item->textContent);
				$address_index++;
			}
		}
		// foreach($xpath->query('//*[@class="company-info"]') as $info_block) {
		// 	$post = array(
		// 		'ID' => $post_id,
		// 		'post_excerpt' => $dom->saveHTML($info_block),
		// 	);

		// 	wp_update_post($post);
		// }
	}
}