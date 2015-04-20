<?php
namespace Controllers;
use Controllers\SessionController;
use Models\FullTimeEmployeeModel;
use Models\PartTimeEmployeeModel;
use Models\SeasonalEmployeeModel;
use Models\ContractEmployeeModel;
use Models\DatabaseModel;
use Views\View;
use Helper\Connection;

class EmployeeController{
	public function getEmployee($request){
		$databae = new DatabaseModel();
	}
	
	public function searchEmployees($options = array("keywords" => "","type" => "fulltime")){
		$options = (object)$options;
		
		$database = new DatabaseModel();
		return $database->SearchEmployee($options);
	}
	
	public function createEmployee($request){
		switch($request->type){
			case "fulltime":
				$employee = new FullTimeEmployeeModel();
				if(isset($request->firstName))$employee->SetFirstName($request->firstName);
				if(isset($request->lastName))$employee->SetLastName($request->lastName);
				if(isset($request->dateOfBirth))$employee->SetDateOfBirth($request->dateOfBirth);
				if(isset($request->sin))$employee->SetSIN($request->sin);
				if(isset($request->dateOfHire))$employee->SetDateOfHire($request->dateOfHire);
				if(isset($request->dateOfTermination))$employee->SetDateOfTermination($request->dateOfTermination);
				if(isset($request->salary))$employee->SetSalary($request->salary);
				if(isset($request->companyName))$employee->SetCompanyName($request->companyName);
				
				$database = new DatabaseModel();
				$database->AddFullTime($employee,"incomplete",$_SESSION["id"]);
			break;
			case "parttime":
				$employee = new PartTimeEmployeeModel();
				if(isset($request->firstName))$employee->SetFirstName($request->firstName);
				if(isset($request->lastName))$employee->SetLastName($request->lastName);
				if(isset($request->dateOfBirth))$employee->SetDateOfBirth($request->dateOfBirth);
				if(isset($request->sin))$employee->SetSIN($request->sin);
				if(isset($request->dateOfHire))$employee->SetDateOfHire($request->dateOfHire);
				if(isset($request->dateOfTermination))$employee->SetDateOfTermination($request->dateOfTermination);
				if(isset($request->hourlyRate))$employee->SetHourlyRate($request->hourlyRate);
				if(isset($request->companyName))$employee->SetCompanyName($request->companyName);
				
				$database = new DatabaseModel();
				$database->AddPartTime($employee,"incomplete",$_SESSION["id"]);
			break;
			case "seasonal":
				$employee = new SeasonalEmployeeModel();
				if(isset($request->firstName))$employee->SetFirstName($request->firstName);
				if(isset($request->lastName))$employee->SetLastName($request->lastName);
				if(isset($request->dateOfBirth))$employee->SetDateOfBirth($request->dateOfBirth);
				if(isset($request->sin))$employee->SetSIN($request->sin);
				if(isset($request->piecePay))$employee->SetPiecePay($request->piecePay);
				if(isset($request->season))$employee->SetSeason($request->season);
				if(isset($request->seasonYear))$employee->SetSeasonYear($request->seasonYear);
				if(isset($request->companyName))$employee->SetCompanyName($request->companyName);
				
				$database = new DatabaseModel();
				$database->AddSeasonal($employee,"incomplete",$_SESSION["id"]);				
			break;
			case "contract":
				$employee = new ContractEmployeeModel();
				if(isset($request->corporationName))$employee->SetCorporationName($request->corporationName);
				if(isset($request->dateOfIncorporation))$employee->SetDateOfIncorporation($request->dateOfIncorporation);
				if(isset($request->businessNumber))$employee->SetBusinessNumber($request->businessNumber);
				if(isset($request->startDate))$employee->SetStartDate($request->startDate);
				if(isset($request->endDate))$employee->SetEndDate($request->endDate);
				if(isset($request->fixedAmount))$employee->SetFixedAmount($request->fixedAmount);
				if(isset($request->companyName))$employee->SetCompanyName($request->companyName);
				
				$database = new DatabaseModel();
				$database->AddContract($employee,"incomplete",$_SESSION["id"]);		
			break;
		}
		return $request->type;
	}
}