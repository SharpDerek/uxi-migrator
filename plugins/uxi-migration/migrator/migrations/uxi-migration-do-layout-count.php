<?php

function uxi_do_layout_count($post_id, $layout_id) {
	$layout_uses = get_post_meta($layout_id, 'uxi_template_uses', true) + 1;

	update_post_meta(
		$layout_id,
		'uxi_template_uses',
		$layout_uses
	);

	if (get_option('uxi_layout_counts')) {
		$layout_counts = get_option('uxi_layout_counts');

		if ($layout_uses > $layout_counts[get_post_type($post_id)][$layout.'_layout']['most_uses']) {
			$layout_counts[get_post_type($post_id)][$layout.'_layout'] = array(
				'most_uses' => $layout_uses,
				'most_used_layout' => $layout_id
			);
		}

		update_option(
			'uxi_layout_counts',
			$layout_counts
		);

	} else {
		add_option(
			'uxi_layout_counts',
			array (
				get_post_type($post_id) => array (
					$layout.'_layout' => array (
						'most_uses' => $layout_uses,
						'most_used_layout' => $layout_id
					)
				)
			)
		);
	}
}