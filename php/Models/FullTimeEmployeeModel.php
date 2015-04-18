<?php
namespace Models;
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