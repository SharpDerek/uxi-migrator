<?php
function uxi_replace_url($string) {
	if (defined('UXI_URL')) {
		if (UXI_URL) {
			return str_replace(UXI_URL,trailingslashit(wp_upload_dir()['baseurl']),$string);
		}
	}
	return $string;
}