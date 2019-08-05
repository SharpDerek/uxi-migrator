<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);
$link_array = array();

foreach($xpath->query($element->getNodePath().'//*[@class="social-icons"]/li/a') as $link) {
	if ($link->hasAttribute('href')) {
		$href = $link->attributes->getNamedItem('href')->value;
	} else {
		$href = "";
	}
	foreach($link->childNodes as $span) {
		if ($span->hasAttribute('class')) {
			if ($span->attributes->getNamedItem('class')->value !== 'sr-only') {
				$icon = $span->attributes->getNamedItem('class')->value;
				break;
			}
		}
	}
	$link_array[] = array (
		'link' => $href,
		'icon' => $icon
	);
}


array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'social_links' => $link_array,
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
