<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);

$content = uxi_gravityform_shortcode($dom->saveHTML());

array_push($fields,array(
	'acf_fc_layout' => $layout,
	'id' => $id,
	'class' => $class,
	'content' => $content
));
uxi_print('<i>'.$layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
