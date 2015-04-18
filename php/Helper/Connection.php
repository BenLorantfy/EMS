<?php
namespace Helper;
class Connection{
	static public function connect(){
		$db = new \mysqli('localhost', 'root', 'root', 'ems');
		if($db->connect_errno > 0){
			throw new Exception("Connect failed: " . $db->connect_error);
		}
		return $db;		
	}
}