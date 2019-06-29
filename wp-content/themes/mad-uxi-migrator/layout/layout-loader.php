<?php

if (!function_exists("get_field")) {
	die("Looks like you don't have ACF installed. That's gonna be a problem.");
}

$layout = get_field("layout");
if (is_home() || is_archive()) {
	$main_id = get_queried_object()->term_id;
} else {
	$main_id = get_the_ID();
}
if (have_rows('block', $main_id)) {
	$page_layout_id = $main_id;
} else  {
	$page_layout_id = $layout['uxi_main_layout'][0];
}

define("UXI_HEADER_LAYOUT", $layout['uxi_header_layout'][0]);
define("UXI_FOOTER_LAYOUT", $layout['uxi_footer_layout'][0]);
define("UXI_MAIN_LAYOUT", $page_layout_id);
define("MAIN_PAGE_ID",$main_id);

get_header();

$layout_id = $page_layout_id;
require(get_stylesheet_directory().'/layout/layout.php');
  
get_footer();