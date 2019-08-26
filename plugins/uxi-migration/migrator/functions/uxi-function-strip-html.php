<?php

function uxi_strip_html($content) {
	$list = get_html_translation_table(HTML_ENTITIES);
	unset($list['"']);
	unset($list['<']);
	unset($list['>']);
	unset($list['&']);

	$content = strtr($content, $list);
	return $content;
}