<?php

function uxi_menu_match($dom) {

	uxi_print("Begin Menu Match","open");

	if (!function_exists('uxi_get_all_wordpress_menus')) {
		function uxi_get_all_wordpress_menus(){
			$menus = array();
			foreach(get_terms( 'nav_menu', array( 'hide_empty' => false )) as $menu) {
				$menu_atts = array();
				foreach(wp_get_nav_menu_items($menu->slug) as $menu_item) {
					array_push($menu_atts, array(
						'url' => $menu_item->url,
						'title' => html_entity_decode($menu_item->title)
					));
				}
				$menus[$menu->slug] = $menu_atts;
			}
			return $menus;
		}
	}

	$xpath = new DOMXpath($dom);

	$query = $xpath->query('//ul[contains(@class,"nav")]//li/a');

	foreach (uxi_get_all_wordpress_menus() as $menu_name => $menu) {
		$match = 0;
		$index = 0;
		foreach($query as $menu_item) {
			if ($menu_item->hasAttributes()) {
				$url = $menu_item->attributes->getNamedItem('href')->value;
				$title = html_entity_decode($menu_item->nodeValue);
				uxi_print("URL:".uxi_site_url($url)." == ". $menu[$index]['url']);
				uxi_print("TITLE:".$title." == ". $menu[$index]['title']);
				if (uxi_site_url($url) == $menu[$index]['url'] && $title == $menu[$index]['title']) {
					$match++;
				} else {
					break;
				}

			}
			$index++;
		}
		if ($match == count($menu) && count($menu) == $query->length) {
			uxi_print("End Menu Match. Matching Menu Found","close");
			return $menu_name;
		}
	}
	uxi_print("End Menu Match. No Match Found","close");
	return "";

}