<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");

abstract class Employee{
	private $firstName;
	private $lastName;
	private $dateOfBirth;
	private $sin;
	
	public SetFirstName($firstName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->firstName = $firstName;
		return true;
	}
	
	public SetLastName($lastName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->lastName = $lastName;
		return true;
	}
	
	public SetDateOfBirth($dateOfBirth){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfBirth = $dateOfBirth;
		return true;		
	}
	
	public SetSIN($sin){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->sin = $sin;
		return true;		
	}
}

?>