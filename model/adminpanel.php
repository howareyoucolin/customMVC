<?php

class ModelAdminpanel{
	
	public static function getStandardUsers(){
		$query = "SELECT * FROM users WHERE type = 0";
		$result = mysql_query($query);
		$rows = array();
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$rows[$i] = $row;
			$i++;
		}
		return $rows;
	}
	
	public static function getAllImages(){
		$query = "SELECT * FROM images JOIN users ON images.user_id = users.id";
		$result = mysql_query($query);
		$rows = array();
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$rows[$i] = $row;
			$i++;
		}
		return $rows;
	}
	
	public static function getSelectedImages($list){
		$list = '('.implode(',',$list).')';
		$query = "SELECT * FROM images JOIN users ON images.user_id = users.id WHERE user_id IN ".$list;
		$result = mysql_query($query);
		$rows = array();
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$rows[$i] = $row;
			$i++;
		}
		return $rows;
	}
	
	public static function getImageData($imgid){
		$query = "SELECT * FROM images JOIN users ON images.user_id = users.id WHERE img_id = ".$imgid;
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	public static function getUsersButThis($userid){
		$query = "SELECT * FROM users WHERE type = 0 AND id != ".$userid;
		$result = mysql_query($query);
		$rows = array();
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$rows[$i] = $row;
			$i++;
		}
		return $rows;
	}
	
	public static function shiftOwner($img_id,$user_id){
		$query = "UPDATE images SET user_id = ".$user_id." WHERE img_id = ".$img_id;
		$result = mysql_query($query);
	}
	
}