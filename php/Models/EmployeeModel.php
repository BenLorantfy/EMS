<?php
namespace Models;
abstract class EmployeeModel{
	protected $firstName;
	protected $lastName;
	protected $dateOfBirth;
	protected $sin;
	
	public function SetFirstName($firstName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		
		// Evaluates to true because $var is empty
		if (empty($firstName)) {
			return false;
		}
		else{
			$this->firstName = $firstName;
			return true;
		}	
	}
	
	public function SetLastName($lastName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		
		// Evaluates to true because $var is empty
		if (empty($lastName)) {
			return false;
		}
		else{
			$this->lastName = $lastName;
			return true;
		}
		
		
	}
	
	public function SetDateOfBirth($dateOfBirth){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		
		// Evaluates to true because $var is empty
		if (empty($dateOfBirth)) {
			return false;
		}
		else{
			$this->dateOfBirth = $dateOfBirth;
			return true;
		}		
	}
	
	public function SetSIN($sin){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		
		// Evaluates to true because $var is empty
		if (empty($sin)) {
			return false;
		}
		else{
			$this->sin = $sin;
			return true;
		}
				
	}
	
}