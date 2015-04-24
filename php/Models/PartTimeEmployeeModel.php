//FILE			: PartTimeEmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and sign the 
//		  values for partime employee. 


<?php
namespace Models;
class PartTimeEmployeeModel extends HourlyEmployeeModel{
	private $hourlyRate;
	
	//
	// FUNCTION    : SetHourlyRate
	// DESCRIPTION : set hourlyRate of employee
	// PARAMETERS  : $hourlyRate
	// RETURNS     : bool : the result of asign
	//
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
