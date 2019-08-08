<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);

$content = "";

foreach($xpath->query($element->getNodePath().'//*[@class="content"]/*') as $child) {
	$content.= $dom->saveHTML($child);
}

$content = uxi_gravityform_shortcode($content);

array_push($fields,array(
	'acf_fc_layout' => $layout,
	'id' => $id,
	'class' => $class,
	'content' => $content
));
uxi_print('<i>'.$layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
