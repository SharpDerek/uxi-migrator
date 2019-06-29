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

if (!$uxi_logo['logo_fallback_url']) {
	foreach($xpath->query('//*[@class="uxi-logo"]/*') as $logo) {
		if ($logo->hasAttributes()) {
			$src = $logo->attributes->getNamedItem('src');
			$uxi_logo['logo_fallback_url'] = uxi_relative_asset_url($src->value);
			update_field('uxi_logo',$uxi_logo,'option');
			uxi_print("Logo Fallback URL set to ".uxi_relative_asset_url($src->value));
		}
	}
} else {
	uxi_print("<i>Logo Fallback URL already set.</i>","sub-sub");
}

uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"',"sub");