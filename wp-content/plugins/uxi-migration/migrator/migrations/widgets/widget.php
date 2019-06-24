<?php

if (!UXI_ITEM) {
	return;
}

if ($element->hasChildNodes()) {
	for($i = 0; $i < $element->childNodes->length; $i++) {
		$content.= uxi_relative_url($dom->saveHTML($element->childNodes->item($i)));
	}
}

array_push($fields,array(
	'acf_fc_layout' => $this_query['layout'],
	'id' => $id,
	'class' => $class,
	'content' => uxi_relative_asset_url($content)
));
uxi_print('<i>'.$this_query['layout'].'</i> created. id: "'.$id.'", class: "'.$class.'"',"sub");
