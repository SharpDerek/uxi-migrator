<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);

foreach($xpath->query($element->getNodePath().'//*[@class="content"]/*') as $child) {
	$content.= uxi_relative_url($dom->saveHTML($child));
}

$list = get_html_translation_table(HTML_ENTITIES);
unset($list['"']);
unset($list['<']);
unset($list['>']);
unset($list['&']);

$content = strtr($content, $list);

array_push($fields,array(
	'acf_fc_layout' => $layout,
	'id' => $id,
	'class' => $class,
	'content' => uxi_relative_asset_url($content)
));
uxi_print('<i>'.$layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
