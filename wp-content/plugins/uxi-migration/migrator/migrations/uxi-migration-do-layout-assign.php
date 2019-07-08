<?php

function uxi_do_layout_assign($dom, $slug) {

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
			$layout_id = uxi_find_layout_post($xpath,$query,$template);

			if ($layout_id) {
				$layout_assign[$layout.'_layout'] = array($layout_id);
			}
		}
		update_field('layout',$layout_assign,get_page_by_path($slug)->ID);
		return true;
	}
	return false;
}