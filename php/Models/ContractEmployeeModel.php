//FILE			: ContractEmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and sign the 
//		  values for contract employee. 

<?php
namespace Models;
class ContractEmployeeModel{
	private $contractCompanyName;
	private $corporationName;
	private $dateOfIncorporation;
	private $businessNumber;
	private $startDate;
	private $endDate;
	private $fixedAmount;
	
	public function SetCompanyName($contractCompanyName){
		$this->contractCompanyName = $contractCompanyName;
		return true;
	}
	
	public function SetCorporationName($corporationName){
		$this->corporationName = $corporationName;
		return true;
	}
	
	public function SetDateOfIncorporation($dateOfIncorporation){
		$this->dateOfIncorporation = $dateOfIncorporation;
		return true;
	}
	
	public function SetBusinessNumber($businessNumber){
		$this->businessNumber = $businessNumber;
		return true;		
	}
	
	public function SetStartDate($startDate){
		$this->startDate = $startDate;
		return true;		
	}
	
	public function SetEndDate($endDate){
		$this->endDate = $endDate;
		return true;		
	}
	
	public function SetFixedAmount($fixedAmount){
		$this->fixedAmount = $fixedAmount;
		return true;		
	}
	
	public function __get($key){
		return $this->$key;
	}
	
}
