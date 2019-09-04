<?php

if (!function_exists("get_field")) {
	die("Looks like you don't have ACF installed. That's gonna be a problem.");
}
if (is_search()) {
	$main_id = mad_get_layout('uxi_main_layout');
} else if (is_home() || is_archive()) {
	$main_id = get_queried_object_id();
} else {
	$main_id = get_the_ID();
}

define("UXI_HEADER_LAYOUT", mad_get_layout('uxi_header_layout'));
define("UXI_FOOTER_LAYOUT", mad_get_layout('uxi_footer_layout'));
define("UXI_MAIN_LAYOUT", mad_get_layout('uxi_main_layout'));
define("MAIN_PAGE_ID", $main_id);

get_header(); ?>


<div class="mobile-site-wrap site-wrap">
	<div class="mobile-site-wrap-inner">
		<div uxi-main id="content" class="content clearfix">
			<?php
				$layout_id = UXI_MAIN_LAYOUT;
				require(get_stylesheet_directory().'/layout/layout.php');
			?>
		</div>
	</div>
</div>
<?php get_footer();