<?php

if ($response) {
	
	define('UXI_MIGRATIONS_PATH',plugin_dir_path(__FILE__));
	define('UXI_MIGRATIONS_NAME',UXI_MIGRATIONS_PATH.'uxi-migration-do-');
	define('UXI_WIDGETS_PATH',plugin_dir_path(__FILE__).'widgets/');


	function uxi_do_migration(
			$response,
			$post_id = false,
			$slug = false,
			$post_type = false, 
			$do_assets = false,
			$do_scripts = false,
			$do_mobile = false,
			$do_location_settings = false,
			$finalize_post_type = false,
			$do_finalization = false
		) {

		$dom = new DOMDocument();
		@$dom->loadHTML(utf8_decode($response));

		define('UXI_ASSET_URL',uxi_get_url($dom));

		require_once(UXI_MIGRATIONS_NAME.'delete-layouts.php');
		require_once(UXI_MIGRATIONS_NAME.'locations.php');
		require_once(UXI_MIGRATIONS_NAME.'local-img.php');
		require_once(UXI_MIGRATIONS_NAME.'external-assets.php');
		require_once(UXI_MIGRATIONS_NAME.'assets.php');
		require_once(UXI_MIGRATIONS_NAME.'scripts.php');
		require_once(UXI_MIGRATIONS_NAME.'create-layout-post.php');
		require_once(UXI_MIGRATIONS_NAME.'rows.php');
		require_once(UXI_MIGRATIONS_NAME.'layout.php');
		require_once(UXI_MIGRATIONS_NAME.'mobile-header.php');
		require_once(UXI_MIGRATIONS_NAME.'layout-count.php');
		require_once(UXI_MIGRATIONS_NAME.'layout-assign.php');
		require_once(UXI_MIGRATIONS_NAME.'finalization.php');

		if ($post_id || $slug) {

			if ($post_id) {
				uxi_print("Post ".$post_id." (".$slug.")","open");
			} else {
				uxi_print($slug,"open");
			}

			uxi_do_layout($dom, $post_id, $slug);
			uxi_do_layout_assign($dom, $post_id, $slug);

			if ($post_id && $post_type) {
				switch($post_type) {
					case 'uxi_locations':
						uxi_do_location_data($post_id, $dom);
						$post_id = uxi_do_migrate_location($post_id);
						break;
				}
			}

			if ($post_id) {
				uxi_print("Migrated Post ".$post_id." (".$slug.")","close");
			} else {
				uxi_print("Migrated ".$slug,"close");
			}

		} elseif ($do_assets)  {
			uxi_do_assets($dom);
		} elseif ($do_scripts) {
			uxi_do_scripts($dom);
		} elseif ($do_mobile) {
			uxi_do_mobile_header($dom);
		} elseif ($do_location_settings) {
			uxi_do_locations();
		} elseif ($finalize_post_type) {
			uxi_finalize_post_type($finalize_post_type);
		} elseif ($do_finalization) {
			uxi_do_finalization();
		}
	}
	uxi_do_migration(
		$response,
		$post_id,
		$slug,
		$post_type,
		$do_assets,
		$do_scripts,
		$do_mobile,
		$do_location_settings,
		$finalize_post_type,
		$do_finalization
	);

}