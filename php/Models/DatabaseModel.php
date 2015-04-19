<?php
namespace Models;
use Helper\Connection;

class Database{
	private $db;
	public function __construct(){
		$this->db = Connection::connect();
	}
	
	public function AddFullTime($input){
		$sql = "INSERT INTO Company (id, corporationName, dateOfIncorporation)
		VALUES (" . 1 . ",'" . $input->name . "','" . $input->date . "')";
		
		if ($this->db->query($sql) == FALSE){
			echo "Error: " . $sql . "<br>" . mysqli_error($this->db);
		}
	}
}