<?php

if (!UXI_ITEM) {
	return;
}

foreach($xpath->query('//*[@class="content"]/style') as $style) {
	$content.=$dom->saveHTML($style);
}

foreach($xpath->query('//*[@class="content"]//*[contains(@class, "jumbotron-heading")][not(contains(@class, "-inner"))]') as $heading) {
	$titleclass = $heading->attributes->getNamedItem("class")->value;
}

foreach($xpath->query('//*[@class="content"]//*[contains(@class, "jumbotron-subheading")][not(contains(@class, "-inner"))]') as $subheading) {
	$subtitle = $subheading->textContent;
	$subtitleclass = $subheading->attributes->getNamedItem("class")->value;
}

foreach($xpath->query('//*[@class="content"]//*[@class="jumbotron-paragraph-inner"]/*|//*[@class="content"]//*[@class="jumbotron-paragraph-inner"]/text()') as $body) {
	$body_content .= $dom->saveHTML($body);
}

foreach($xpath->query('//*[@class="content"]//*[contains(@class, "jumbotron-body")][not(contains(@class, "-inner"))]') as $body) {
	$bodyclass = $body->attributes->getNamedItem("class")->value;
}

$content = uxi_strip_html($content);

array_push($fields,array(
	'acf_fc_layout' => $widget_layout,
	'title_class' => $titleclass,
	'subtitle' => $subtitle,
	'subtitle_class' => $subtitleclass,
	'body_class' => $bodyclass,
	'body' => $body_content,
	'id' => $id,
	'class' => $class,
	'content' => $content
));
uxi_print('<i>'.$widget_layout.'</i> created. id: "'.$id.'", class: "'.$class.'"');