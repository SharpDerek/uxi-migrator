<?php

if ($response) {
	
	define('UXI_MIGRATIONS_PATH',plugin_dir_path(__FILE__));
	define('UXI_MIGRATIONS_NAME',UXI_MIGRATIONS_PATH.'uxi-migration-');
	define('UXI_WIDGETS_PATH',plugin_dir_path(__FILE__).'widgets/');


	function uxi_do_migration($response) {

		$dom = new DOMDocument();
		@$dom->loadHTML($response);

		define('UXI_ASSET_URL',uxi_get_url($dom));

		require(UXI_MIGRATIONS_NAME.'do-local-img.php');
		require(UXI_MIGRATIONS_NAME.'do-external-assets.php');
		require(UXI_MIGRATIONS_NAME.'do-assets.php');
		require(UXI_MIGRATIONS_NAME.'do-rows.php');
		require(UXI_MIGRATIONS_NAME.'do-rows-header.php');
		require(UXI_MIGRATIONS_NAME.'do-mobile-header.php');

		//uxi_print_response($response);
		//uxi_do_assets($dom);
		uxi_do_header_rows($dom);
		uxi_do_mobile_header($dom);

	}

	uxi_do_migration($response);

}