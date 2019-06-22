<?php

function uxi_write($path, $mode = 'w', $write, $return = false) {
	$file = fopen(MAD_UXI_THEME_PATH.$path, $mode);
	if ($file) {
		fwrite($file, $write);
		if (fclose($file)) {
			if ($return) {
				echo $return;
				return true;
			}
		}
	}
	return false;
}