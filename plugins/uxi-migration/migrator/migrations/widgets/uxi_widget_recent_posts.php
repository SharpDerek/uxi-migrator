<?php

if (!UXI_ITEM) {
	return;
}

$xpath = new DOMXpath($dom);

foreach($xpath->query('//*[@class="content"]//style') as $child) {
	$content.= uxi_relative_url($dom->saveHTML($child));
}

foreach($xpath->query('//*[@class="content"]/*|//h2') as $title) {
	if ($title->hasAttribute('class')) {
		$title_class = $title->attributes->getNamedItem('class')->value;
	}
	$title_text = $title->textContent;
}

$post_items_query = $xpath->query('//*[@class="content"]/section/ol/li');

$num_posts = $post_items_query->length;

$num_columns = 1;

foreach($post_items_query as $post_item) {
	if ($post_item->hasAttribute('class')) {
		$column_width = (int)preg_replace("/\d/", "", $post_item->attributes->getNamedItem('class')->value);
		if ($column_width) {
			$num_columns = 12 / (int)preg_replace("/\d/", "", $post_item->attributes->getNamedItem('class')->value);
		}
	}
}

$content = uxi_strip_html($content);

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'id' => $id,
	'class' => $class,
	'content' => uxi_relative_asset_url($content),
	'title' => $title_text,
	'title_class' => $title_class,
	'num_posts' => $num_posts,
	'num_columns' => $num_columns
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');
