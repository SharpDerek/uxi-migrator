<?php
function uxi_replace_url($string) {
	if (defined('UXI_ASSET_URL')) {
		if (UXI_ASSET_URL) {
			return str_replace(UXI_ASSET_URL,trailingslashit(wp_upload_dir()['baseurl']),$string);
		}
	}
	return $string;
}
function uxi_relative_url($string) {
	if (defined('UXI_URL')) {
		if (UXI_URL) {
			return str_replace(UXI_URL,'',$string);
		}
	}
	return $string;
}