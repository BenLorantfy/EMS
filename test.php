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
	
	private function AddEmployee($input, $status, $user_id){
		$firstName = $input->firstName;
		$lastName = $input->lastName;
		$sin = $input->sin;
		$dateOfBirth = $input->dateOfBirth;
		$company = $input->company;
		
		//
		//	Look for Companies
		//
		$query = $this->db->prepare('SELECT id FROM company WHERE
		companyName = ?	LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$company)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
	
		if($query->num_rows == 0){		
			echo "Company is not there<br>";
			
			$sql = "INSERT INTO Company (id, companyName)
			VALUES (" . $user_id . ",'" . $company . "')";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	Company added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM company WHERE
		companyName = ?	LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$company)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a company<br>";
			
			if(!$query->bind_result($company_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error<br>");
		}
	
		//
		//	Look for Persons
		//
		$query = $this->db->prepare('SELECT id FROM person WHERE
		firstName = ? AND lastName = ? AND SIN = ? AND dateOfBirth = ? 
		LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("ssss",$firstName,$lastName,$sin,$dateOfBirth)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 0){		
			echo "Person is not there<br>";
			
			$sql = "INSERT INTO Person (id, firstName, lastName, SIN, dateOfBirth)
			VALUES (" . $user_id . ",'" . $firstName . "','" . $lastName . "','" . $sin . "','" . $dateOfBirth . "')";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	Person added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM person WHERE
		firstName = ? AND lastName = ? AND SIN = ? AND dateOfBirth = ? 
		LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("ssss",$firstName,$lastName,$sin,$dateOfBirth)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a Person<br>";
			
			if(!$query->bind_result($person_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error");
		}
		
		//
		//	Look for Employee
		//
		$query = $this->db->prepare('SELECT id FROM employee WHERE
		company_id = ? AND person_id = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("ii",$company_id, $person_id)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 0){		
			echo "Employee is not there<br>";
			
			$sql = "INSERT INTO Employee (id, company_id, person_id, workStatus, reasonForLeaving)
			VALUES (" . $user_id . "," . $company_id . "," . $person_id . ",'" . $status . "','" . "" . "')";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	Employee added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM employee WHERE
		company_id = ? AND person_id = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("ii",$company_id, $person_id)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a Employee<br>";
			
			if(!$query->bind_result($employee_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error");
		}
		
		return $employee_id;
	}
	
	public function AddFullTime($input, $status, $user_id){
		$employee_id = $this->AddEmployee($input, $status, $user_id);
		$dateOfHire = $input->dateOfHire;
		$dateOfTermination = $input->dateOfTermination;
		$salary = $input->salary;
		
		//
		//	Look for Full Time Employee
		//
		$query = $this->db->prepare('SELECT id FROM fulltimeemployee WHERE
		employee_id = ? AND dateOfHire = ? AND dateOfTermination = ? AND salary = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("issd",$employee_id, $dateOfHire, $dateOfTermination, $salary)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 0){		
			echo "FullTimeEmployee is not there<br>" ;
			
			$sql = "INSERT INTO FullTimeEmployee (id, employee_id, dateOfHire, dateOfTermination, salary)
			VALUES (" . $user_id . "," . $employee_id . ",'" . $dateOfHire . "','" . $dateOfTermination . "','" . $salary . "')";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	FullTimeEmployee added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM fulltimeemployee WHERE
		employee_id = ? AND dateOfHire = ? AND dateOfTermination = ? AND salary = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("issd",$employee_id, $dateOfHire, $dateOfTermination, $salary)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a FullTimeEmployee<br>";
			
			if(!$query->bind_result($fulltimeemployee_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error");
		}
		
		return $fulltimeemployee_id;
	}
	
	public function AddPartTime($input, $status, $user_id){
		$employee_id = $this->AddEmployee($input, $status, $user_id);
		$dateOfHire = $input->dateOfHire;
		$dateOfTermination = $input->dateOfTermination;
		$hourlyRate = $input->hourlyRate;
		
		//
		//	Look for Part Time Employee
		//
		$query = $this->db->prepare('SELECT id FROM parttimeemployee WHERE
		employee_id = ? AND dateOfHire = ? AND dateOfTermination = ? AND hourlyRate = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("issd",$employee_id, $dateOfHire, $dateOfTermination, $hourlyRate)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 0){		
			echo "PartTimeEmployee is not there<br>" ;
			
			$sql = "INSERT INTO PartTimeEmployee (id, employee_id, dateOfHire, dateOfTermination, hourlyRate)
			VALUES (" . $user_id . "," . $employee_id . ",'" . $dateOfHire . "','" . $dateOfTermination . "','" . $hourlyRate . "')";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	PartTimeEmployee added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM parttimeemployee WHERE
		employee_id = ? AND dateOfHire = ? AND dateOfTermination = ? AND hourlyRate = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("issd",$employee_id, $dateOfHire, $dateOfTermination, $hourlyRate)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a PartTimeEmployee<br>";
			
			if(!$query->bind_result($parttimeemployee_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error");
		}
		
		return $$parttimeemployee_id;
	}
	
	public function AddSeasonal($input, $status, $user_id){
		$employee_id = $this->AddEmployee($input, $status, $user_id);
		$piecePay = $input->piecePay;
		$season = $input->season;
		$seasonYear = $input->seasonYear;
		
		//
		//	Look for Seasonal Employee
		//
		$query = $this->db->prepare('SELECT id FROM seasonalemployee WHERE
		employee_id = ? AND piecePay = ? AND season = ? AND seasonYear = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("idsi",$employee_id, $piecePay, $season, $seasonYear)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 0){		
			echo "SeasonalEmployee is not there<br>" ;
			
			$sql = "INSERT INTO SeasonalEmployee (id, employee_id, piecePay, season, seasonYear)
			VALUES (" . $user_id . "," . $employee_id . "," . $piecePay . ",'" . $season . "'," . $seasonYear . ")";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	SeasonalEmployee added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM seasonalemployee WHERE
		employee_id = ? AND piecePay = ? AND season = ? AND seasonYear = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("idsi",$employee_id, $piecePay, $season, $seasonYear)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a SeasonalEmployee<br>";
			
			if(!$query->bind_result($seasonalemployee_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error");
		}
		
		return $seasonalemployee_id;
	}
}

abstract class EmployeeModel{
	protected $firstName;
	protected $lastName;
	protected $dateOfBirth;
	protected $sin;
	protected $company;
	
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
	
	public function SetCompany($company){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->company = $company;
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

class PartTimeEmployeeModel extends HourlyEmployeeModel{
	private $hourlyRate;
	
	public function SetHourlyRate($hourlyRate){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->hourlyRate = $hourlyRate;
		return true;
	}
	
	public function __get($key){
		return $this->$key;
	}
}

class SeasonalEmployeeModel extends EmployeeModel{
	private $piecePay;
	private $season;
	private $seasonYear;

	public function SetPiecePay($piecePay){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->piecePay = $piecePay;
		return true;
	}
		
	public function SetSeason($season){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->season = $season;
		return true;
	}
	
	public function SetSeasonYear($seasonYear){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->seasonYear = $seasonYear;
		return true;
	}
	
	public function __get($key){
		return $this->$key;
	}
}

$obj = new FullTimeEmployeeModel;
$db = new Database;

$obj->SetFirstName("Grogg");
$obj->SetLastName("Koz");
$obj->SetSIN("1234567890");
$obj->SetDateOfBirth("1996/01/22");
$obj->SetCompany("Google");
$obj->SetDateOfHire("2015/5/1");
$obj->SetDateOfTermination("2015/8/31");
$obj->SetSalary(10000);
$db->AddFullTime($obj, "inactive", 1);
?>