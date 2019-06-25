<?php

function uxi_get_widget($query, $fallback) {
	if (defined('UXI_WIDGETS_PATH')) {

		foreach(scandir(UXI_WIDGETS_PATH) as $widget) {
			$widget_name = str_replace('.php','',$widget);
			if ($widget_name == $query) {
				return UXI_WIDGETS_PATH.'/'.$query.'.php';
			}
		}

		return UXI_WIDGETS_PATH.'/'.$fallback.'.php';
	}
}