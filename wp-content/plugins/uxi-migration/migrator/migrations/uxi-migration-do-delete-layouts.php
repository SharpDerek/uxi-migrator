<?php

function uxi_delete_layouts() {
	$args = array (
		'post_type' => array (
			'uxi-header-layout',
			'uxi-main-layout',
			'uxi-footer-layout',
		),
		'post_status' => 'any'
	);
	$the_query = new WP_Query( $args );

	while ($the_query->have_posts()) {
		$the_query->the_post();
		var_dump("Deleting post ".get_the_ID());
		wp_delete_post(get_the_ID(),true);
	}
}