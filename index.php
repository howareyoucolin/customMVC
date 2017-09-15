<?php

//Connect to Databse:

define("DB_HOSTNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_DATABASE","pixafy"); 

$conn=mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);

if(!$conn){
	die('Failed to connect to host!');
}

mysql_select_db(DB_DATABASE, $conn) or ('Failed to connect to database!');

//Start Session:
session_start();

//Load Classes:
require_once('system/controller.php');


//Get Action:
if(isset($_GET['action']) and !empty($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = 'home';
}
//Get Method:
if(isset($_GET['method']) and !empty($_GET['method'])){
	$method =$_GET['method'];
}else{
	$method = 'index';
}

//Load Controller:
require_once('controller/'.$action.'.php');
$class = 'Controller'.ucfirst($action);
$controller = new $class();

//Initialize:
require_once('system/user.php');
$controller->user = new User();

require_once('system/admin.php');
$controller->admin = new Admin();

//var_dump($controller->admin );die();

//Execute:
$controller->$method();



