<?php

$path = __DIR__;

if (file_exists("{$path}/vendor/autoload.php")) {
	// check if composer dependencies are distributed with the plugin
	require_once "{$path}/vendor/autoload.php";
}
