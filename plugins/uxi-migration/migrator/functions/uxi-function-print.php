<?php

function uxi_print($message = "", $type = "message") {

	switch($type) {
		case "message":
			$GLOBALS['uxi_migrator_progress'].=$message."<br>";
			break;
		case "open":
			$GLOBALS['uxi_migrator_progress'].=$message.'<div class="message-block">';
			break;
		case "close":
			$GLOBALS['uxi_migrator_progress'].="</div>".$message."<br>";
			break;
	}
}