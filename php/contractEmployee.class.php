<?php

class ContractEmployee{
	private $dateOfIncorporation;
	private $companyName;
	private $businessNumber;
	private $startDate;
	private $endDate;
	private $fixedAmount;
	
	public SetDateOfIncorporation($dateOfIncorporation){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfIncorporation = $dateOfIncorporation;
		return true;
	}
	
	public SetCompanyName($companyName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->companyName = $companyName;
		return true;
	}
	
	public SetBusinessNumber($businessNumber){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->businessNumber = $businessNumber;
		return true;		
	}
	
	public SetStartDate($startDate){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->startDate = $startDate;
		return true;		
	}
	
	public SetEndDate($endDate){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->endDate = $endDate;
		return true;		
	}
	
	public SetFixedAmount($fixedAmount){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->fixedAmount = $fixedAmount;
		return true;		
	}
}

?>