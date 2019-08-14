<?php
	
function uxi_do_locations() {
	if (class_exists('WP_Store_locator')) {

		// Change WPSL Settings
		$wpsl_settings = get_option('wpsl_settings');

		$wpsl_settings['permalinks'] = 1;
		$wpsl_settings['permalink_remove_front'] = 1;
		$wpsl_settings['permalink_slug'] = "locations";
		$wpsl_settings['category_slug'] = "locations-category";

		update_option('wpsl_settings', $wpsl_settings);

		// Move UXI Locations to WPSL Stores
		$args = array(
			'post_type' => 'uxi_locations',
			'posts_per_page' => -1,
			'post_status' => 'any'
		);

		$locations = new WP_Query($args);

		while($locations->have_posts()): $locations->the_post();

		$location = get_post()->to_array();
		$location['post_type'] = 'wpsl_stores';
		$location_id = $location['ID'];
		unset($location['guid']);
		unset($location['ID']);
		wp_insert_post(
			$location
		);
		wp_delete_post($location_id);
		endwhile;
	}
}

function uxi_do_location_data($post_id, $dom) {
	if (class_exists('WP_Store_locator')) {
		
	}
}