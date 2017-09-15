<?php

class User{
	
	public $id;
	public $user;
	public $email;
	public $password;
	public $type;
	
	public function __construct(){	
		$this->id = isset($_SESSION['id'])?$_SESSION['id']:'';
		$this->user = isset($_SESSION['user'])?$_SESSION['user']:'';
		$this->email = isset($_SESSION['email'])?$_SESSION['email']:'';
		$this->password = isset($_SESSION['password'])?$_SESSION['password']:'';
		$this->type = isset($_SESSION['type'])?$_SESSION['type']:'';
	}
	
	public function login($username,$password){
		$query = "SELECT * FROM users WHERE user = '".mysql_real_escape_string($username)."' AND password = '".mysql_real_escape_string($password)."'";
		$result = mysql_query($query);
		$num_rows = @mysql_num_rows($result); 
		if($num_rows == 1){
			//Set Sessions:
			$row = mysql_fetch_array($result);
			$_SESSION['id'] = $row['id'];
			$_SESSION['user'] = $row['user'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['type'] = $row['type'];
			return true;
		}else{
			return false;
		}
	}
	
	public function register($username,$password){
		//Check for Dupicate Users:
		$query = "SELECT * FROM users WHERE user = '".mysql_real_escape_string($username)."'";
		$result = mysql_query($query);
		$num_rows = @mysql_num_rows($result); 
		if($num_rows > 0){
			return false;
		}
		//Add User:
		$query = "INSERT INTO users VALUES('','".mysql_real_escape_string($username)."','','".mysql_real_escape_string($password)."','0')";
		$result = mysql_query($query);
		return true;
	}
	
	public function isLoggedin(){
		$query = "SELECT * FROM users WHERE user = '".mysql_real_escape_string($this->user)."' AND password = '".mysql_real_escape_string($this->password)."'";
		$result = mysql_query($query);
		$num_rows = @mysql_num_rows($result); 
		if($num_rows == 1){
			return true;
		}
		return false;
	}
	

}