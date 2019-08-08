<?php

function uxi_filepath_navigate($destination, $current_path) {
	if (strpos($current_path,'../') > -1) {
		$destination_array = explode('/',$destination);
		$path_array = explode('/',$current_path);
		array_pop($destination_array);
		foreach(explode('../',$current_path) as $step) {
			if ($step != "") {
				array_pop($destination_array);
				array_shift($path_array);
			}
		}
		return implode('/',$destination_array).'/'.implode('/',$path_array);
	}
	return false;
}