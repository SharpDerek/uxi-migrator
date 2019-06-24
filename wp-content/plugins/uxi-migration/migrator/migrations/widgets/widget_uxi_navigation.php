<?php

if (!UXI_ITEM) {
	return;
}

$menu = uxi_menu_match($dom);

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'widget_uxi_menu' => $menu
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'", menu: "'.$menu.'"',"sub");