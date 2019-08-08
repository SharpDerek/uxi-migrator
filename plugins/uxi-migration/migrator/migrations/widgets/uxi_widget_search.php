<?php

if (!UXI_ITEM) {
	return;
}

foreach ($xpath->query('//form[@role="search"]//input[@type="search"]') as $search_input) {
	if ($search_input->hasAttribute('placeholder')) {
		$placeholder = $search_input->attributes->getNamedItem('placeholder')->value;
	}
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'placeholder' => $placeholder
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'", placeholder: "'.$placeholder.'"');