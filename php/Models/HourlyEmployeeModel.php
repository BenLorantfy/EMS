<?php
namespace Models;
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
}