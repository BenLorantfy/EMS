<?php
namespace Models;
class Database{
	private $db;
	
	public function __construct()
	{
		//Connect will be here
		$this->db = Connection::connect();
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
		
		return $parttimeemployee_id;
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
	
	public function AddContract($input, $status, $user_id){
		$companyName = $input->companyName;
		$dateOfIncorporation = $input->dateOfIncorporation;
		$corporationName = $input->corporationName;
		$businessNumber = $input->businessNumber;
		$startDate = $input->startDate;
		$endDate = $input->endDate;
		$fixedAmount = $input->fixedAmount;
				
		//
		//	Look for Companies
		//
		$query = $this->db->prepare('SELECT id FROM company WHERE
		companyName = ?	LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$companyName)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
	
		if($query->num_rows == 0){		
			echo "Company is not there<br>";
			
			$sql = "INSERT INTO Company (id, companyName)
			VALUES (" . $user_id . ",'" . $companyName . "')";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	Company added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM company WHERE
		companyName = ?	LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$companyName)) throw new Exception($this->db->error);
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
		//	Look for Contract Employee
		//
		$query = $this->db->prepare('SELECT id FROM contractor WHERE
		company_id = ? AND corporationName = ? AND dateOfIncorporation = ? AND buisnessNumber = ? AND
		contractStartDate = ? AND contractStopDate = ? AND fixedContractAmount = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("isssssd",$company_id, $corporationName, $dateOfIncorporation, $businessNumber, $startDate, $endDate, $fixedAmount)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
	
		if($query->num_rows == 0){		
			echo "Contractor is not there<br>";
			
			$sql = "INSERT INTO Contractor(id, company_id, corporationName, dateOfIncorporation, buisnessNumber, contractStartDate, contractStopDate, fixedContractAmount)
			VALUES (" . $user_id . "," . $company_id . ",'" . $corporationName . "','" . $dateOfIncorporation . "','" . $businessNumber . "','"
			. $startDate . "','" . $endDate . "'," . $fixedAmount . ")";
			
			if ($this->db->query($sql) == FALSE){
				throw new Exception("Error: " . $sql . "<br>" . mysqli_error($this->db));
			}else{
				echo "	Contractor added<br>";
			}
		}
		
		$query = $this->db->prepare('SELECT id FROM contractor WHERE
		company_id = ? AND corporationName = ? AND dateOfIncorporation = ? AND buisnessNumber = ? AND
		contractStartDate = ? AND contractStopDate = ? AND fixedContractAmount = ? LIMIT 1');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("isssssd",$company_id, $corporationName, $dateOfIncorporation, $businessNumber, $startDate, $endDate, $fixedAmount)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		if($query->num_rows == 1){		
			echo "Found a Contractor<br>";
			
			if(!$query->bind_result($contractor_id)) throw new Exception($this->db->error);
			$query->fetch();
		}else{
			throw new Exception("Database error<br>");
		}
		
		return $contractor_id;
	}
	
	public function GetAudit(){
		$query = $this->db->prepare('SELECT user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra FROM audit');
		if(!$query) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);

		$table = "";
		if($query->num_rows > 0){
			if($query->bind_result($user_id, $changeTime, $changedTable, $recordId, $changedField, $oldValue, $newValue, $extra)){
				$success = true;
				while($query->fetch()){
					$table .= "<tr>";
					$table .= "<td>$user_id</td>";
					$table .= "<td>$changeTime</td>";
					$table .= "<td>$changedTable</td>";
					$table .= "<td>$recordId</td>";
					$table .= "<td>$changedField</td>";
					$table .= "<td>$oldValue</td>";
					$table .= "<td>$newValue</td>";
					$table .= "<td>$extra</td>";
					$table .= "</tr>"; 					
				}								
			}
		}else{
			$success = true;
			$table = "
				<tr id = 'noResults'>
					<td colspan='4'>No Results</td>
				</tr>
			";				
		}

		return $table;
	}
}