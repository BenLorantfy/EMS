<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");
require_once("php/hourlyEmployee.class.php");


class FullTimeEmployee extends HourlyEmployee{
	private $salary;
	
	public SetSalary($salary){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->salary = $salary;
		return true;
	}
}

?>