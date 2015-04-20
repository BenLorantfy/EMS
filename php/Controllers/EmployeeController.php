<?php
namespace Controllers;
use Controllers\SessionController;
use Models\FullTimeEmployeeModel;
use Models\PartTimeEmployeeModel;
use Models\SeasonalEmployeeModel;
use Models\ContractEmployeeModel;
use Views\View;
use Helper\Connection;

class EmployeeController{
	public function getEmployee($request){
	
	}
	
	public function searchEmployees($options){
		
	}
	
	public function createEmployee($request){
		switch($request->type){
			case "fulltime":
				$employee = new FullTimeEmployeeModel();
				$employee->SetFirstName($request->firstName);
				$employee->SetLastName($request->lastName);
				$employee->SetDateOfBirth($request->dateOfBirth);
				$employee->SetSIN($request->sin);
				return $employee;
			break;
			case "parttime":
			break;
			case "seasonal":
			break;
			case "contract":
			break;
		}
		return $request->type;
	}
}