//FILE			: HourlyEmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and asign the 
//		  values for hourly employee. 

<?php
namespace Models;
abstract class HourlyEmployeeModel extends EmployeeModel{
	protected $dateOfHire;
	protected $dateOfTermination;
	
	//
	// FUNCTION    : SetDateOfHire
	// DESCRIPTION : set dateOfHire of employee
	// PARAMETERS  : $dateOfHire
	// RETURNS     : bool : the result of asign
	//
	public function SetDateOfHire($dateOfHire){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfHire = $dateOfHire;
		return true;
	}
	
	//
	// FUNCTION    : SetDateOfTermination
	// DESCRIPTION : set dateOfTermination of employee
	// PARAMETERS  : $dateOfTermination
	// RETURNS     : bool : the result of asign
	//
	public function SetDateOfTermination($dateOfTermination){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfTermination = $dateOfTermination;
		return true;
	}
}
