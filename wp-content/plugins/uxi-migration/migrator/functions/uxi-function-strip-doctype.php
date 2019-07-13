<?php

function uxi_strip_doctype($html) {
	return preg_replace("/(^<!DOCTYPE+[\s\S]+<body>)|(^<!DOCTYPE+[\s\S]+<html>)|(<\/body><\/html>)|(<\/html>)/", "", $html);
}