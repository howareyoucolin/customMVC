<?php

class ControllerUser extends Controller{

	public function login(){	
		
		//Validation:
		if(isset($_POST['user']) and !empty($_POST['user'])){
			$user = $_POST['user'];
		}
		if(isset($_POST['password']) and !empty($_POST['password'])){
			$password = $_POST['password'];
		}

		//Check Username and Password for Login:
		if($this->user->login($user,$password)){
			$this->redirect('dashboard');
		}else{
			$_SESSION['message'] = 'Incorrect Username or Password!';
			$this->redirect('home');
		}
		
	}

	public function register(){	
		
		//Validation:
		if(isset($_POST['user1']) and !empty($_POST['user1'])){
			$user = $_POST['user1'];
		}
		if(isset($_POST['password1']) and !empty($_POST['password1'])){
			$password = $_POST['password1'];
		}

		//Register:
		if($this->user->register($user,$password)){
			$_SESSION['message'] = 'Successfully Registered!';
			$this->redirect('home');
		}else{
			$_SESSION['message'] = 'Failed! Username has been taken!';
			$this->redirect('home');
		}
		
	}
	
}