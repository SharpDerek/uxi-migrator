<?php

if (!UXI_ITEM) {
	return;
}

foreach ($xpath->query('//*[@class="content"]/*[not(self::ul)]') as $title_element) {
	$title = $title_element->textContent;
	if ($title_element->hasAttribute('class')) {
		$title_class = $title_element->attributes->getNamedItem('class')->value;
	}
}


$show_count = $xpath->query('//*[@class="content"]//li[text()]')->length > 0;

$hierarchical = $xpath->query('//*[@class="content"]//ul//ul')->length > 0;

$dropdown = $xpath->query('//*[@class="content"]/ul')->length <= 0;

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'title' => $title,
	'title_class' => $title_class,
	'show_count' => $show_count,
	'hierarchical' => $hierarchical,
	'dropdown' => $dropdown
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');

