<?php

function uxi_find_layout_post($xpath, $query, $section) {
	if (function_exists('get_field')) {
		$first_layout = $xpath->query($query)[0];
		$data_layout = 0;
		if ($first_layout->hasAttributes()) {
			$data_layout = $first_layout->attributes->getNamedItem('data-layout')->value;
		}

		if ($data_layout) {
			$args = array (
				'post_type' => $section.'-layout',
			);
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) { // Looping through all posts in post type
					$the_query->the_post();
					$post_data_layout = get_post_meta(get_the_ID(),'uxi_data_layout',true); // Getting data layout

					if ($post_data_layout == $data_layout) { // If we find a matching layout
						wp_reset_postdata();
						return get_the_ID(); // Then return its ID
					}
				}
				wp_reset_postdata();

			}

		}
	}
	return false;
}