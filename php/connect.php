<?php
	//
	// The connect function is kept in a seperate file so the
	// connect info can be easily changed as needed
	//
	function connect(){
		$db = new mysqli('localhost', 'root', 'root', 'ems');
		if($db->connect_errno > 0){
			throw new Exception("Connect failed: " . $db->connect_error);
		}
		return $db;
	}
?>