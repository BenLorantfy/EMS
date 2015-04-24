<?php
//FILE			: ContractEmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and sign the 
//		  values for contract employee. 

namespace Models;
class ContractEmployeeModel{
	private $contractCompanyName;
	private $corporationName;
	private $dateOfIncorporation;
	private $businessNumber;
	private $startDate;
	private $endDate;
	private $fixedAmount;
	
	//
	// FUNCTION    : SetCompanyName
	// DESCRIPTION : Set company name
	// PARAMETERS  : contractCompanyName
	// RETURNS     : bool : the result of asign
	//
	public function SetCompanyName($contractCompanyName){
		$this->contractCompanyName = $contractCompanyName;
		return true;
	}
	
	//
	// FUNCTION    : SetCorporationName
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $corporationName
	// RETURNS     : bool : the result of asign
	//
	public function SetCorporationName($corporationName){
		$this->corporationName = $corporationName;
		return true;
	}
	
	//
	// FUNCTION    : SetDateOfIncorporation
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $dateOfIncorporation
	// RETURNS     : bool : the result of asign
	//
	public function SetDateOfIncorporation($dateOfIncorporation){
		$this->dateOfIncorporation = $dateOfIncorporation;
		return true;
	}
	
	//
	// FUNCTION    : SetBusinessNumber
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $businessNumber
	// RETURNS     : bool : the result of asign
	//
	public function SetBusinessNumber($businessNumber){
		$this->businessNumber = $businessNumber;
		return true;		
	}
	
	//
	// FUNCTION    : SetStartDate
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $startDate
	// RETURNS     : bool : the result of asign
	//
	public function SetStartDate($startDate){
		$this->startDate = $startDate;
		return true;		
	}
	
	//
	// FUNCTION    : SetEndDate
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $endDate
	// RETURNS     : bool : the result of asign
	//
	public function SetEndDate($endDate){
		$this->endDate = $endDate;
		return true;		
	}
	
	//
	// FUNCTION    : SetFixedAmount
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $fixedAmount
	// RETURNS     : bool : the result of asign
	//
	public function SetFixedAmount($fixedAmount){
		$this->fixedAmount = $fixedAmount;
		return true;		
	}
	
	//
	// FUNCTION    : __get
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : $key
	// RETURNS     : bool : the result of asign
	//
	public function __get($key){
		return $this->$key;
	}
	
}
