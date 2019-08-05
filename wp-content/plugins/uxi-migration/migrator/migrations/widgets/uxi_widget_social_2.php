<?php

if (!UXI_ITEM) {
	return;
}

$widget_layout = 'uxi_widget_social';
require(plugin_dir_path(__FILE__).$widget_layout.'.php');
