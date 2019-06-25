<?php

function uxi_do_create_layout_post($xpath, $query, $section) {
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

					if ($post_data_layout == $data_layout) { // If data layout of existing post is the same as the one we're looking at,
						wp_reset_postdata();
						return false; // Then we don't do anything
					}
				}
				wp_reset_postdata();

			} // If there aren't any posts, or the while loop couldn't find a match,
			return wp_insert_post( // Then create a new post and return the ID
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