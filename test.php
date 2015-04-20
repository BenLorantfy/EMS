<?php
class Database{
	private $db;
	
	public function __construct()
	{
		$this->db = new \mysqli('localhost', 'root', 'Jratva-online1', 'ems');
		if($this->db->connect_errno > 0){
			throw new Exception("Connect failed: " . $db->connect_error);
		}
	}
	
	public function AddFullTime($input){
		$query = $this->db->prepare('SELECT id FROM person WHERE
		firstName = ? AND lastName = ? AND SIN = ? AND dateOfBirth = ? 
		LIMIT 1');
		$firstName = $input->firstName;
		$lastName = $input->lastName;
		$sin = $input->sin;
		$dateOfBirth = $input->dateOfBirth;
		
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("ssss",$firstName,$lastName,$sin,$dateOfBirth)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 1){
			if(!$query->bind_result($person_id)) throw new Exception($this->db->error);
			$query->fetch();
			
			$sql = "INSERT INTO Employee (id, company_id, person_id, workStatus, reasonForLeaving)
			VALUES (" . 120 . "," . 2 . "," . $person_id . ",'" . "inactive" . "','" . "swag" . "')";
			
			if ($this->db->query($sql) == FALSE){
				echo "Error: " . $sql . "<br>" . mysqli_error($this->db);
			}			
			echo "already exists";
		}else{
			$sql = "INSERT INTO Person (id, firstName, lastName, SIN, dateOfBirth)
			VALUES (" . 1 . ",'" . $firstName . "','" . $lastName . "','" . $sin . "','" . $dateOfBirth . "')";
			
			if ($this->db->query($sql) == FALSE){
				echo "Error: " . $sql . "<br>" . mysqli_error($this->db);
			}
		}
	}
}

abstract class EmployeeModel{
	protected $firstName;
	protected $lastName;
	protected $dateOfBirth;
	protected $sin;
	
	public function SetFirstName($firstName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->firstName = $firstName;
		return true;
	}
	
	public function SetLastName($lastName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->lastName = $lastName;
		return true;
	}
	
	public function SetDateOfBirth($dateOfBirth){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfBirth = $dateOfBirth;
		return true;		
	}
	
	public function SetSIN($sin){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->sin = $sin;
		return true;		
	}
	
}

abstract class HourlyEmployeeModel extends EmployeeModel{
	protected $dateOfHire;
	protected $dateOfTermination;
	
	public function SetDateOfHire($dateOfHire){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfHire = $dateOfHire;
		return true;
	}
	
	public function SetDateOfTermination($dateOfTermination){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfTermination = $dateOfTermination;
		return true;
	}
	
	public function GetAttributes(){
		return get_object_vars($this);
	}
}

class FullTimeEmployeeModel extends HourlyEmployeeModel{
	private $salary;
	
	public function SetSalary($salary){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		if($this->ValidNumber($salary)){
			$this->salary = $salary;
			return true;
		}else{
			$this->errors["salary"] = "Salary can't be negative";
			return false;
		}
	}
	
	// maybe move this to employee.class.php
	private function ValidNumber($number){
		return $number >= 0;
	}
	
	public function __get($key){
		return $this->$key;
	}
}

$obj = new FullTimeEmployeeModel;
$db = new Database;

$obj->SetFirstName("Greg");
$obj->SetLastName("Koz");
$obj->SetSIN("1234567890");
$obj->SetDateOfBirth("1996/01/22");
$db->AddFullTime($obj);
?>