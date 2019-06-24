<?php

define('UXI_DO_WRITE',true);

function uxi_write($path, $mode = 'w', $write, $return = false) {

	if (!$return) {
		$return = get_stylesheet_directory_uri().$path." created.";
	}

	if (UXI_DO_WRITE) {
		$file = fopen(UXI_THEME_PATH.$path, $mode);
		if ($file) {
			fwrite($file, $write);
			if (fclose($file)) {
				uxi_print($return);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		uxi_print("UXI_DO_WRITE set to false for ".$return);
	}
	return false;
}

function uxi_copy($url, $path, $return = false) {
	if (!$return) {
		$return = get_stylesheet_directory_uri().$path."<br><b>copied from</b><br>".$url.".";
	}

	if  (UXI_DO_WRITE) {
		if (copy($url,UXI_THEME_PATH.$path)) {
			uxi_print($return);
			return true;
		} else {
			return false;
		}
	}
	uxi_print("UXI_DO_WRITE set to false for ".$return);
	return false;
}