<?php

if ($response) {
	
	define('UXI_MIGRATIONS_PATH',plugin_dir_path(__FILE__));
	define('UXI_MIGRATIONS_NAME',UXI_MIGRATIONS_PATH.'uxi-migration-do-');
	define('UXI_WIDGETS_PATH',plugin_dir_path(__FILE__).'widgets/');


	function uxi_do_migration($response, $page_id = false) {

		$dom = new DOMDocument();
		@$dom->loadHTML(utf8_decode($response));

		define('UXI_ASSET_URL',uxi_get_url($dom));

		require_once(UXI_MIGRATIONS_NAME.'delete-layouts.php');
		require_once(UXI_MIGRATIONS_NAME.'local-img.php');
		require_once(UXI_MIGRATIONS_NAME.'external-assets.php');
		require_once(UXI_MIGRATIONS_NAME.'assets.php');
		require_once(UXI_MIGRATIONS_NAME.'scripts.php');
		require_once(UXI_MIGRATIONS_NAME.'create-layout-post.php');
		require_once(UXI_MIGRATIONS_NAME.'rows.php');
		require_once(UXI_MIGRATIONS_NAME.'layout.php');
		require_once(UXI_MIGRATIONS_NAME.'mobile-header.php');
		require_once(UXI_MIGRATIONS_NAME.'layout-assign.php');

		//uxi_print_response($response);
		if ($page_id) {
			uxi_do_layout($dom);
			uxi_do_layout_assign($dom,$page_id);
		} else  {
			//uxi_do_layout($dom);
			//uxi_delete_layouts();
			uxi_do_assets($dom);
			uxi_do_scripts($dom);
			uxi_do_mobile_header($dom);
		}


	}

	uxi_do_migration($response, $page_id);

}