<?php

function uxi_get_layout($selector, $query, $fallback, $post_id = false) {
	if (function_exists('get_field_object')) {
		$field = get_field_object($selector,$post_id,true,false);

		foreach($field['layouts'] as $layout) {
			if ($layout['name'] == $query) {
				return $query;
			}
		}

		return $fallback;
	}
}