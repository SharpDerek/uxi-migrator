<?php

if (!UXI_ITEM) {
	return;
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'widget_uxi_menu' => uxi_menu_match($dom)
));