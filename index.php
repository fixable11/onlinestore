<?php

session_start();
if(!isset($_SESSION['products'])){
	$_SESSION['products'] = array();
}

if(!empty($_SESSION['products'])){
	$_SESSION['cntItems'] = count($_SESSION['products']);
}
 

include_once 'config/config.php';
include_once 'components/mainFunctions.php';
include_once 'components/DB.php';

// 1. Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Autoload.php');

// 3. Вызов Router
$router = new Router();
$router->run();


//$cartCntItems = count($_SESSION['cart']);

//loadPage($controllerName, $actionName);
?>