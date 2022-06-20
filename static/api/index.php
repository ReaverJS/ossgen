<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ossgen/include/init.php';

$method = $_GET['method'];
$file = $method  . '.php';
global $ossgen;

if (!$method || !file_exists($file)) {
	$ossgen->error('method not found');
}

require_once $file;
