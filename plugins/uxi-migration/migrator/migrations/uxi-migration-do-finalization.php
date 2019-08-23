<?php

function uxi_finalize_post_type($post_type) {
	if (function_exists('update_field')) {

		$post_type_templates = get_option('uxi_layout_counts')[$post_type];

		$args = array (
			'post_type' => $post_type,
			'posts_per_page' => -1
		);

		$post_type_query = new WP_Query($args);

		while($post_type_query->have_posts()) {
			$post_type_query->the_post();
			$templates_used = get_field('layout', get_the_ID());
			$post_used_template = false;
			foreach ($templates_used as $template_name => $template_id) {
				if ($template_id[0] == $post_type_templates[$template_name]['most_used_layout']) {
					unset($templates_used[$template_name]);
					$post_used_template = true;
				}
			}
			if ($post_used_template) {
				update_field('layout', $templates_used, get_the_ID());
			}
		}

		wp_reset_query();

		$default_layouts = get_field('default_layouts', 'option');

		foreach($default_layouts as $index => $default_layout) {
			if ($default_layout['post_type'] == $post_type) {
				foreach($post_type_templates as $post_type_template_name => $post_type_template) {
					$default_layouts[$index]['layout'][$post_type_template_name] = array($post_type_template['most_used_layout']);
				}
			}
		}

	}

}

function uxi_do_finalization() {
	uxi_print("FINALIZING EVERYTHING");
}