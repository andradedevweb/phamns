<?php
		
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('vendor/autoload.php');
	include 'App/Application.php';

	define('INCLUDE_PATH_STATIC','http://localhost/phamns/App/Views/pages/');
	define('INCLUDE_PATH','http://localhost/pahms/');
	$app = new App\Application();

	$app->run();
?>