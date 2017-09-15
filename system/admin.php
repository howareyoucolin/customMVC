<?php

class Admin extends User{

	public function register($username,$password){
		//Check for Dupicate Users:
		$query = "SELECT * FROM users WHERE user = '".mysql_real_escape_string($username)."'";
		$result = mysql_query($query);
		$num_rows = @mysql_num_rows($result); 
		if($num_rows > 0){
			return false;
		}
		//Add User:
		$query = "INSERT INTO users VALUES('','".mysql_real_escape_string($username)."','','".mysql_real_escape_string($password)."','1')";
		$result = mysql_query($query);
		return true;
	}

	public function isAdmin(){
		if($this->type == '1'){
			return true;
		}else{
			return false;
		}
	}
	
}