<?php

require_once 'constants.php';
require_once OSSGEN_PATH . '/vendor/autoload.php';

spl_autoload_register(function ($className) {
	$fileName = lcfirst($className) . '.php';
	include OSSGEN_PATH . '/lib/' . $fileName;
});

$ossgen = new Ossgen();
