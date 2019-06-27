<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);

foreach($xpath->query($element->getNodePath().'//*[@class="content"]/*') as $child) {
	$content.= uxi_relative_url($dom->saveHTML($child));
}

array_push($fields,array(
	'acf_fc_layout' => $this_query['layout'],
	'id' => $id,
	'class' => $class,
	'content' => uxi_relative_asset_url($content)
));
uxi_print('<i>'.$this_query['layout'].'</i> created. id: "'.$id.'", class: "'.$class.'"',"sub");
