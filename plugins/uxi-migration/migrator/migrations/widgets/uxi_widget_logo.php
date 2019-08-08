<?php

if (!UXI_ITEM) {
	return;
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
));

$uxi_logo = get_field('uxi_logo','option');

if (!$uxi_logo) {
	foreach($xpath->query('//*[@class="uxi-logo"]/*') as $logo) {
		if ($logo->hasAttributes()) {
			$src = $logo->attributes->getNamedItem('src');
			$uxi_logo = uxi_replace_asset_url($src->value);
			update_field('uxi_logo', attachment_url_to_postid($uxi_logo), 'option');
		}
	}
}

uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');