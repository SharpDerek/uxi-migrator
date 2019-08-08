<?php
function uxi_replace_asset_url($string) {
	if (defined('UXI_ASSET_URL')) {
		if (UXI_ASSET_URL) {
			return str_replace(UXI_ASSET_URL,trailingslashit(wp_upload_dir()['baseurl']),$string);
		}
	}
	return $string;
}
function uxi_relative_asset_url($string) {
	if (defined('UXI_ASSET_URL')) {
		if (UXI_ASSET_URL) {
			return str_replace(UXI_ASSET_URL,'/wp-content/uploads/',$string);
		}
	}
	return $string;
}
function uxi_relative_url($string) {
	if (defined('UXI_URL')) {
		if (UXI_URL) {
			return str_replace(
				untrailingslashit(UXI_URL),
				'/',
				str_replace(
					UXI_URL,
					'/',
					$string
				)
			);
		}
	}
	return $string;
}
function uxi_site_url($string) {
	if (defined('UXI_URL')) {
		if (UXI_URL) {
			return str_replace(UXI_URL,trailingslashit(get_site_url()),$string);
		}
	}
	return $string;
}