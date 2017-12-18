<?php
session_start();
define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
require(ROOT.'core/Model.php');
require(ROOT.'core/Controller.php');

$params = explode('/',$_GET['p']);
$controller = !empty($params[0]) ? $params[0] : 'acceuil';
$action = isset($params[1]) && !empty($params[1]) ? $params[1] : 'index';

$controller = strtolower($controller);
$action = strtolower($action);

if (!file_exists('controllers/'.$controller.'.controller.php')){
	var_dump("Fichier inexistant");
	var_dump($controller);
	require('views/error404.php');
} else {
	require('controllers/'.$controller.'.controller.php');
	$controller = ucfirst($controller) . 'Controller';
	$controller = new $controller();
	if (!method_exists($controller, $action)){
		var_dump("Mauvaise méthode ou action");
		var_dump($controller);
		require('views/error404.php');
	} else {
		unset($params[0]);
		unset($params[1]);
		call_user_func_array(array($controller,$action),$params);
	}
}