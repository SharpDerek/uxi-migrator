<?php

function uxi_finalize_post_type($post_type) {
	if (function_exists('update_field')) {
		$template_uses_array = array(
			'uxi_header_layout' => array (
				'most_used_id' => 0,
				'most_uses' => 0
			),
			'uxi_main_layout' => array (
				'most_used_id' => 0,
				'most_uses' => 0
			),
			'uxi_footer_layout' => array (
				'most_used_id' => 0,
				'most_uses' => 0
			)
		);

		$args = array (
			'post_type' => $post_type,
			'posts_per_page' => -1
		);

		$post_type_query = new WP_Query($args);

		while($post_type_query->have_posts()) {
			$post_type_query->the_post();
			$templates_used = get_field('layout', get_the_ID());

			foreach ($templates_used as $template_name => $template_id) {
				$template_uses = get_post_meta($template_id[0], 'uxi_template_uses', true);
				if ($template_uses > $template_uses_array[$template_name]['most_uses']) {
					$template_uses_array[$template_name] = array (
						'most_used_id' => $template_id[0],
						'most_uses' => $template_uses
					);
				}
			}
		}

		wp_reset_query();

		foreach($template_uses_array as $template => $value) {
			uxi_print($post_type . ': ' . $template . ': default-layout: ' . $value['most_used_id'] . '<br>');
		}

	}

}

function uxi_do_finalization() {
	uxi_print("FINALIZING EVERYTHING");
}