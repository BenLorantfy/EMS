//FILE			: EmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the code that access the database. It can create, insert and updatas the databse.
//		  The data will be sent to view to display to user.

<?php
namespace Models;
abstract class EmployeeModel{
	protected $firstName;
	protected $lastName;
	protected $dateOfBirth;
	protected $sin;
	protected $companyName;
	
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
	
	public function SetCompanyName($companyName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->companyName = $companyName;
		return true;		
	}
	
}
