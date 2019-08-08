<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);
$link_array = array();

foreach($xpath->query($element->getNodePath().'//*[@class="social-icons"]/li/a/span') as $linkspan) {
	if ($linkspan->hasAttribute('class')) {
		if (strpos($linkspan->attributes->getNamedItem('class')->value, 'sr-only') === false) {
			$link = $linkspan->parentNode;
			if ($link->hasAttribute('href')) {
				$href = $link->attributes->getNamedItem('href')->value;
			} else {
				$href = "";
			}
			$icon = $linkspan->attributes->getNamedItem('class')->value;
			$link_array[] = array (
				'link' => $href,
				'icon' => $icon
			);
		}
	}
}


array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'social_links' => $link_array,
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
