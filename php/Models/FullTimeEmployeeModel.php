//FILE			: EmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and asign the 
//		  values for fulltime employee. 

<?php
namespace Models;
class FullTimeEmployeeModel extends HourlyEmployeeModel{
	private $salary;
	
	//
	// FUNCTION    : SetSalary
	// DESCRIPTION : set salary of employee
	// PARAMETERS  : $salary
	// RETURNS     : bool : the result of asign
	//
	public function SetSalary($salary){
		if($this->ValidNumber($salary)){
			$this->salary = $salary;
			return true;
		}else{
			$this->errors["salary"] = "Salary can't be negative";
			return false;
		}
	}
	
	//
	// FUNCTION    : ValidNumber
	// DESCRIPTION : set first name of employee
	// PARAMETERS  : $number
	// RETURNS     : bool : the result of asign
	//
	private function ValidNumber($number){
		return $number >= 0;
	}
	
	//
	// FUNCTION    : __get
	// DESCRIPTION : set first name of employee
	// PARAMETERS  : $key
	// RETURNS     : bool : the result of asign
	//
	public function __get($key){
		return $this->$key;
	}
}
