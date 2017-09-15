<?php

class Controller{

	public $user;
	public $admin;
	public $data = array();

	public function loadModel($path){
		include_once('model/'.$path.'.php');
	}
	
	public function renderView($path){
		include('view/'.$path.'.html');
	}
	
	public function redirect($path){
		define("HOME","/");
		header('Location:'.HOME.$path);
		exit();
	}
	
}