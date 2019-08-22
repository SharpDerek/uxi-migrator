<?php

function uxi_do_layout_assign($dom, $post_id, $slug = false) {

	$xpath = new DOMXpath($dom);

	$layout_assign = array();

	if (function_exists('update_field')) {
		$template_array = array(
			'uxi-header' => 'uxi_header',
			'uxi-main' => 'uxi_main',
			'uxi-footer' => 'uxi_footer'
		);

		foreach($template_array as $template => $layout) {
			$query = '//*[@'.$template.']//*[@data-layout]';
			$layout_id = uxi_find_layout_post($xpath, $query, $template);

			if ($layout_id) {
				$layout_assign[$layout.'_layout'] = array($layout_id);
				uxi_do_layout_count($post_id, $layout_id);
			}
		}
		update_field('layout', $layout_assign, $post_id);
		return true;
	}
	return false;
}