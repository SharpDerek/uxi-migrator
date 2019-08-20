<?php
	
function uxi_do_locations() {
	if (class_exists('WP_Store_locator')) {

		// Change WPSL Settings
		$wpsl_settings = get_option('wpsl_settings');

		$wpsl_settings['permalinks'] = 1;
		$wpsl_settings['permalink_remove_front'] = 1;
		$wpsl_settings['permalink_slug'] = "location";
		$wpsl_settings['category_slug'] = "location-category";
		$wpsl_settings['editor_country'] = "United States";

		update_option('wpsl_settings', $wpsl_settings);
	}
	uxi_print("WP Store Locator Settings Updated.");
}

function uxi_do_migrate_location($post_id) {
	if (class_exists('WP_Store_locator')) {
		$location_post = get_post($post_id)->to_array();
		$location_meta = get_post_meta($post_id);

		$wpsl_post = $location_post;

		$wpsl_post['post_type'] = 'wpsl_stores';
		unset($wpsl_post['guid']);
		unset($wpsl_post['ID']);

		$new_post_id = wp_insert_post($wpsl_post);

		if ($new_post_id) {

			foreach($location_meta as $key => $value) {
				update_post_meta($new_post_id, $key, implode("", $value));
			}
			wp_delete_post($post_id, true);

			return $new_post_id;
		}
	}
	return $post_id;
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
		foreach($xpath->query('//*[@class="company-info-address"]/span/*') as $address_item) {
			switch ($address_item->nodeName) {
				case 'span':
					if (strpos($dom->saveHTML($address_item), "<br>") > -1) {
						foreach($address_item->childNodes as $childNode) {
							if ($childNode->textContent) {
								update_post_meta($post_id, $address_items[$address_index], trim($childNode->textContent));
								$address_index++;
							}
						}
					} else {
						update_post_meta($post_id, $address_items[$address_index], trim($address_item->textContent));
						$address_index++;
					}
					break;
				case 'br':
					$address_index=2;
					break;
			}
		}
		foreach($xpath->query('//*[@class="company-info-phone"]//a') as $phone_item) {
			update_post_meta($post_id, 'wpsl_phone', trim($phone_item->textContent));
		}
		foreach($xpath->query('//*[@class="company-info-fax"]//a') as $fax_item) {
			update_post_meta($post_id, 'wpsl_fax', trim($fax_item->textContent));
		}
		foreach($xpath->query('//*[@class="company-info-email"]//a') as $email_item) {
			update_post_meta($post_id, 'wpsl_email', trim($email_item->textContent));
		}
		foreach($xpath->query('//*[@class="company-info-ext-link"]//a') as $url_item) {
			if ($url_item->hasAttribute('href')) {
				update_post_meta($post_id, 'wpsl_url', $url_item->attributes->getNamedItem('href')->value);
			}
		}
	}
}