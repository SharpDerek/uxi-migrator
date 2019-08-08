<?php

if (!UXI_ITEM) {
	return;
}

$menu = uxi_menu_match($dom);

$menu_class = "nav";

if ($is_custom_menu) {
	$menu_style = 'custom';
	foreach ($xpath->query('//nav/*[contains(@class,"header-font")]') as $nav_title) {
		$menu_title = $nav_title->textContent;
		$menu_classes = $nav_title->attributes->getNamedItem("class")->value;
	}
} else {
	$menu_style = 'header';
	$menu_title = '';
	$menu_classes = '';
}

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
	'menu_classes' => $menu_class,
	'menu_style' => $menu_style,
	'menu_title' => $menu_title,
	'menu_title_classes' => $menu_classes
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'", menu: "'.$menu.'"');