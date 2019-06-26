<?php

define('UXI_FUNCTIONS_PATH',plugin_dir_path(__FILE__));
define('UXI_FUNCTIONS_NAME',UXI_FUNCTIONS_PATH.'uxi-function-');

//dom-dependent functions
require_once(UXI_FUNCTIONS_NAME.'get-url.php');
require_once(UXI_FUNCTIONS_NAME.'print-response.php');
require_once(UXI_FUNCTIONS_NAME.'menu-match.php');
require_once(UXI_FUNCTIONS_NAME.'find-layout-post.php');

//other functions
require_once(UXI_FUNCTIONS_NAME.'print.php');
require_once(UXI_FUNCTIONS_NAME.'get-widget.php');
require_once(UXI_FUNCTIONS_NAME.'curl.php');
require_once(UXI_FUNCTIONS_NAME.'filepath-navigate.php');
require_once(UXI_FUNCTIONS_NAME.'replace-url.php');
require_once(UXI_FUNCTIONS_NAME.'unminify-css.php');
require_once(UXI_FUNCTIONS_NAME.'write-copy.php');
