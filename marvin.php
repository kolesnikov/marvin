<?php
$autoload = function ($class) {

	$path = explode('\\', $class);

	if ( 'MARVIN' != array_shift($path) )
		throw new \MARVIN\EXCEPTIONS\SYSTEM\NamespaceIsWrong();

	$filename = array_pop($path);

	require __DIR__ . DIRECTORY_SEPARATOR .
		implode(DIRECTORY_SEPARATOR, array_map('strtolower', $path)) . DIRECTORY_SEPARATOR . 
		$filename . '.php';

};

spl_autoload_register($autoload);