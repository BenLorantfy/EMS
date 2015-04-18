<?php
class Connection{
	static public connect(){
		$db = new mysqli('localhost', 'root', 'root', 'ems');
		if($db->connect_errno > 0){
			throw new Exception("Connect failed: " . $db->connect_error);
		}
		return $db;		
	}
}