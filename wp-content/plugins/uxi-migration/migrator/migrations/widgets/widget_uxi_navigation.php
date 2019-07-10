<?php

if (!UXI_ITEM) {
	return;
}

$menu = uxi_menu_match($dom);

$menu_class = "nav";

foreach($xpath->query('//nav//ul[contains(@class,"nav")]') as $nav_list) {
	if ($nav_list->hasAttribute('class')) {
		$menu_class = $nav_list->attributes->getNamedItem('class')->value;
	}
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'widget_uxi_menu' => $menu,
	'menu_classes' => $menu_class
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'", menu: "'.$menu.'"');