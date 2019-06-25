<?php

if ($response) {
	
	define('UXI_MIGRATIONS_PATH',plugin_dir_path(__FILE__));
	define('UXI_MIGRATIONS_NAME',UXI_MIGRATIONS_PATH.'uxi-migration-do-');
	define('UXI_WIDGETS_PATH',plugin_dir_path(__FILE__).'widgets/');


	function uxi_do_migration($response) {

		$dom = new DOMDocument();
		@$dom->loadHTML($response);

		define('UXI_ASSET_URL',uxi_get_url($dom));

		require(UXI_MIGRATIONS_NAME.'local-img.php');
		require(UXI_MIGRATIONS_NAME.'external-assets.php');
		require(UXI_MIGRATIONS_NAME.'assets.php');
		require(UXI_MIGRATIONS_NAME.'create-layout-post.php');
		require(UXI_MIGRATIONS_NAME.'rows.php');
		require(UXI_MIGRATIONS_NAME.'layout.php');
		require(UXI_MIGRATIONS_NAME.'mobile-header.php');

		//uxi_print_response($response);
		uxi_do_assets($dom);
		uxi_do_layout($dom);
		uxi_do_mobile_header($dom);

	}

	uxi_do_migration($response);

}