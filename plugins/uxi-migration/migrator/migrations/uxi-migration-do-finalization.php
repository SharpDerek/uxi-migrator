<?php

function uxi_finalize_post_type($post_type) {
	if (function_exists('update_field')) {

		$post_type_templates = get_option('uxi_layout_counts')[$post_type];

		uxi_print("Finalizing Post Type: " . $post_type, "open");

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
					if ($post_type_template_name !== "_layout") {
						$default_layouts[$index]['layout'][$post_type_template_name] = array($post_type_template['most_used_layout']);
						uxi_print("<i>".$post_type." ".$post_type_template_name."</i> set to <i>" . get_the_title($post_type_template['most_used_layout'])."</i>");
					}
				}
			}
		}
		update_field('default_layouts', $default_layouts, 'option');

		uxi_print("Finished Finalizing Post Type: " . $post_type, "close");

	}

}

function uxi_do_finalization() {
	if (function_exists('update_field')) {

		uxi_print('Starting Global Finalization', 'open');

		$post_type_templates = get_option('uxi_layout_counts');

		$post_type_defaults = array(
			'uxi_header_layout' => array (
				'most_uses' => 0,
				'most_used_layout' => 0
			),
			'uxi_main_layout' => array (
				'most_uses' => 0,
				'most_used_layout' => 0
			),
			'uxi_footer_layout' => array (
				'most_uses' => 0,
				'most_used_layout' => 0
			)
		);

		foreach($post_type_templates as $post_type_template) {
			foreach($post_type_template as $template_name => $template_layout) {
				if ($template_name !== '_layout') {
					if ($template_layout['most_uses'] > $post_type_defaults[$template_name]['most_uses']) {
						$post_type_defaults[$template_name] = $template_layout;
					}
				}
			}
		}
		
		$default_layouts = get_field('default_layouts', 'option');

		foreach ($default_layouts as $index => $default_layout) {
			if ($default_layout['post_type'] !== 'mad_default') {
				foreach($default_layout['layout'] as $assigned_layout_name => $assigned_layout_id) {
					if ($assigned_layout_id[0] == $post_type_defaults[$assigned_layout_name]['most_used_layout']) {
						unset($default_layouts[$index]['layout'][$assigned_layout_name]);
					}
				}
			} else {
				foreach($post_type_defaults as $post_type_default_name => $post_type_default) {
					$default_layouts[$index]['layout'][$post_type_default_name] = array($post_type_default['most_used_layout']);
					uxi_print('<i>Site default '.$post_type_default_name . "</i> set to ".get_the_title($post_type_default['most_used_layout']));
				}
			}
		}

		update_field('default_layouts', $default_layouts, 'option');

		uxi_print('Finishing Global Finalization', 'close');
	}
}