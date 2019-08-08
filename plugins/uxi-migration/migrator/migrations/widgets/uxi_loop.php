<?php

if (!UXI_ITEM) {
	return;
}

$title_query = $xpath->query('//*[@id="main-title"]');

if ($title_query->length > 0) {
	foreach($title_query as $title) {
		if ($title->hasAttributes()) {
			$title_class = $title->attributes->getNamedItem('class')->value;

			$class_array = explode(" ",$title_class);
			$heading_tag = $class_array[count($class_array)-1];
		}
	}
} else {
	$heading_tag = 'hidden';
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'heading_tag' => $heading_tag
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');