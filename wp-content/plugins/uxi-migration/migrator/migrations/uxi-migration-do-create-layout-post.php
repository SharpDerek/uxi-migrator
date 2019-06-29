<?php

function uxi_do_create_layout_post($xpath, $query, $section) {
	if (function_exists('get_field')) {
		$first_layout = $xpath->query($query)[0];
		$data_layout = 0;
		if ($first_layout->hasAttributes()) {
			$data_layout = $first_layout->attributes->getNamedItem('data-layout')->value;
		}

		if ($data_layout) {
			if (!uxi_find_layout_post($xpath,$query,$section)) {
				return wp_insert_post(
					array (
						'post_status' => 'publish',
						'post_type' => $section.'-layout',
						'post_title' => $section.' layout '.$data_layout,
						'meta_input' => array (
							'uxi_data_layout' => $data_layout,
						)
					)
				);

			}
		}
	}
	return false;
}