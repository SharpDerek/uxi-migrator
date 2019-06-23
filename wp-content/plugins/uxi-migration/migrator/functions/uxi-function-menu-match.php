<?php

function uxi_menu_match($dom) {

	if (!function_exists('uxi_get_all_wordpress_menus')) {
		function uxi_get_all_wordpress_menus(){
			$menus = array();
			foreach(get_terms( 'nav_menu', array( 'hide_empty' => false )) as $menu) {
				$menu_atts = array();
				foreach(wp_get_nav_menu_items($menu->slug) as $menu_item) {
					array_push($menu_atts, array(
						'url' => $menu_item->url,
						'title' => $menu_item->title
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
				$title = $menu_item->textContent;

				if (uxi_site_url($url) == $menu[$index]['url'] && $title == $menu[$index]['title']) {
					$match++;
				} else {
					break;
				}

			}
			$index++;
		}
		if ($match == count($menu) && count($menu) == $query->length) {
			return $menu_name;
		}
	}
	return "";

}