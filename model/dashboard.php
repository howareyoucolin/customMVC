<?php

class ModelDashboard{
	
	public static function getImages(){
		$query = "SELECT * FROM images WHERE user_id = '".mysql_real_escape_string($_SESSION['id'])."'";
		$result = mysql_query($query);
		$rows = array();
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$rows[$i] = $row;
			$i++;
		}
		return $rows;
	}
	
	public static function deleteImages($id,$user_id){
		$query = "DELETE FROM images WHERE img_id = ".mysql_real_escape_string($id)." AND user_id = ".mysql_real_escape_string($user_id)." ";
		$result = mysql_query($query);
		if($result){
			return '1';
		}else{
			return '0';
		}
	}
	
	public static function multiDeleteImages($list,$user_id){
		$list = '('.implode(',',$list).')';
		$query = "DELETE FROM images WHERE img_id IN ".mysql_real_escape_string($list)." AND user_id = ".mysql_real_escape_string($user_id)." ";
		$result = mysql_query($query);
	}
	
	public static function insertImages($id,$filename){
		$query = "INSERT INTO images VALUES('','".mysql_real_escape_string($id)."','".mysql_real_escape_string($filename)."')";
		$result = mysql_query($query);
	}
	
	public static function changeEmail($id,$email){
		$query = "UPDATE users SET email = '".mysql_real_escape_string($email)."' WHERE id = ".mysql_real_escape_string($id);
		$result = mysql_query($query);
	}

}