<?php
//FILE			: EmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and asign the 
//		  values for three different type employee. 

namespace Models;
abstract class EmployeeModel{
	protected $firstName;
	protected $lastName;
	protected $dateOfBirth;
	protected $sin;
	protected $companyName;
	
	//
	// FUNCTION    : SetFirstName
	// DESCRIPTION : set first name of employee
	// PARAMETERS  : $firstName
	// RETURNS     : bool : the result of asign
	//
	public function SetFirstName($firstName){
		$this->firstName = $firstName;
		return true;
	}
	
	//
	// FUNCTION    : SetLastName
	// DESCRIPTION : set last name of employee
	// PARAMETERS  : $lastName
	// RETURNS     : bool : the result of asign
	//
	public function SetLastName($lastName){
		$this->lastName = $lastName;
		return true;
	}
	
	//
	// FUNCTION    : SetDateOfBirth
	// DESCRIPTION : set dateOfBirth
	// PARAMETERS  : $dateOfBirth
	// RETURNS     : bool : the result of asign
	//
	public function SetDateOfBirth($dateOfBirth){
		$this->dateOfBirth = $dateOfBirth;
		return true;		
	}
	
	//
	// FUNCTION    : SetSIN
	// DESCRIPTION : set sin of employee
	// PARAMETERS  : $sin
	// RETURNS     : bool : the result of asign
	//
	public function SetSIN($sin){
		$this->sin = $sin;
		return true;		
	}
	
	//
	// FUNCTION    : SetCompanyName
	// DESCRIPTION : set companyName name of employee
	// PARAMETERS  : $companyName
	// RETURNS     : bool : the result of asign
	//
	public function SetCompanyName($companyName){
		$this->companyName = $companyName;
		return true;		
	}
	
}
