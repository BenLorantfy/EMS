<?php
namespace Models;
class Database{
	private $db;
	
	public function __construct()
	{
		//Connect will be here
		if($this->db->connect_errno > 0){
			throw new Exception("Connect failed: " . $db->connect_error);
		}
	}
	
	public function AddFullTime($input){
		$sql = "INSERT INTO Company (id, corporationName, dateOfIncorporation)
		VALUES (" . 1 . ",'" . $input->name . "','" . $input->date . "')";
		
		if ($this->db->query($sql) == FALSE){
			echo "Error: " . $sql . "<br>" . mysqli_error($this->db);
		}
	}
}