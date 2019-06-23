<?php

if ($response) {
	
	define('UXI_MIGRATIONS_PATH',plugin_dir_path(__FILE__));
	define('UXI_MIGRATIONS_NAME',UXI_MIGRATIONS_PATH.'uxi-migration-');


	function uxi_do_migration($response) {

		$dom = new DOMDocument();
		@$dom->loadHTML($response);

		define('UXI_URL',uxi_get_url($dom));

		require(UXI_MIGRATIONS_NAME.'do-local-img.php');
		require(UXI_MIGRATIONS_NAME.'do-external-assets.php');
		require(UXI_MIGRATIONS_NAME.'do-assets.php');
		require(UXI_MIGRATIONS_NAME.'do-header-rows.php');

		//uxi_print_response($response);
		//uxi_do_assets($dom);
		uxi_do_header_rows($dom);


	}

	uxi_do_migration($response);

}