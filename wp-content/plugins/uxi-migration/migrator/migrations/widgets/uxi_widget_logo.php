<?php

if (!UXI_ITEM) {
	return;
}

$uxi_logo = get_field('uxi_logo','option');


if (!$uxi_logo['logo_fallback_url']) {
	foreach($xpath->query('//*[@class="uxi-logo"]/*') as $logo) {
		if ($logo->hasAttributes()) {
			$src = $logo->attributes->getNamedItem('src');

			$uxi_logo['logo_fallback_url'] = $src->value;
			update_field('uxi_logo',$uxi_logo,'option');

		}
	}
}

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
));