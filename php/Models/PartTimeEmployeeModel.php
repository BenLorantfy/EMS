<?php
namespace Models;
class PartTimeEmployeeModel extends HourlyEmployeeModel{
	private $hourlyRate;
	
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