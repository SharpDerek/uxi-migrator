<?php

if (!UXI_ITEM) {
	return;
}

foreach($xpath->query('//*[@id="main-title"]') as $title) {
	if ($title->hasAttributes()) {
		$title_class = $title->attributes->getNamedItem('class')->value;

		$class_array = explode(" ",$title_class);
		$heading_tag = $class_array[count($class_array)-1];
	}
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'heading_tag' => $heading_tag
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');