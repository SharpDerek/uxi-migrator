<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);

foreach($xpath->query($element->getNodePath().'//*[@class="content"]/*|//*[@class="content"]/text()') as $child) {
	$content.= uxi_relative_url($dom->saveHTML($child));
}

$content = uxi_strip_html($content);

array_push($fields,array(
	'acf_fc_layout' => $layout,
	'id' => $id,
	'class' => $class,
	'content' => uxi_relative_asset_url($content)
));
uxi_print('<i>'.$layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
