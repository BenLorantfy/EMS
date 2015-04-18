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
		return $request->type;
	}
}