<?php

function uxi_print_response($response, $echo = true) {
	if ($echo) {
		echo '<pre>'.htmlentities($response).'</pre>';
	} else {
		var_dump($response);
	}
}