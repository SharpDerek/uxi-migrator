<?php

function uxi_do_create_layout_post($xpath, $query, $section) {
	if (function_exists('get_field')) {

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
	return false;
}