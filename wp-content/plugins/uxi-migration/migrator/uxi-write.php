<?php

define('UXI_DO_WRITE',true);

function uxi_write($path, $mode = 'w', $write, $is_image = false, $return = false) {

	if ($return) {
		$return.='<br><br>';
	} else {
		$return = get_stylesheet_directory_uri().$path." created.<br><br>";
	}

	if (UXI_DO_WRITE) {
		$file = fopen(MAD_UXI_THEME_PATH.$path, $mode);
		if ($file) {
			if ($is_image) {
				var_dump("IS IMAGE");
				stream_filter_append($file, 'convert.base64-decode', STREAM_FILTER_WRITE);
			}
			fwrite($file, $write);
			if (fclose($file)) {
				echo $return;
				return true;
			} else {
				echo '<br>';
				return false;
			}
		} else {
			echo '<br>';
			return false;
		}
	} else {
		echo "UXI_DO_WRITE set to false for ".$return;
	}
	return false;
}

function uxi_copy($url, $path, $return = false) {
	if ($return) {
		$return.='<br><br>';
	} else {
		$return = get_stylesheet_directory_uri().$path."<br><b>copied from</b><br>".$url.".<br><br>";
	}

	if  (UXI_DO_WRITE) {
		if (copy($url,MAD_UXI_THEME_PATH.$path)) {
			echo $return;
			return true;
		} else {
			echo "<br>";
			return false;
		}
	}
	echo "UXI_DO_WRITE set to false for ".$return;
	return false;
}