<?php

if (!UXI_ITEM) {
	return;
}

$widget_layout = 'widget_uxi_navigation';
$is_custom_menu = true;
require(plugin_dir_path(__FILE__).$widget_layout.'.php');