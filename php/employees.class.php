<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");
require_once("php/users.class.php");

//
// Utilities
//
require_once("php/connect.php");
require_once("php/postcall.php");

/*
 * NAME 	: Employees
 *
 * PURPOSE 	: 
 *
 */
class Employees{
	private $db;
	private $users;
	
	function __construct(){
		$this->users = new Users();
		$this->db = connect();
	}
	
	function CheckFullTimeInfoErrors($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$salary){
		// todo
	}
	
	function CheckPartTimeInfoErrors($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$hourlyRate){
		// todo
	}
	
	function CheckSeasonalInfoErrors($firstName,$lastName,$dateOfBirth,$sin,$season,$seasonYear,$piecePay){
		// todo
	}
	
	function CheckContractInfoErrors($dateOfIncorporation,$companyName,$businessNumber,$startDate,$endDate,$fixedAmount){
		// todo
	}
	
	function AddFullTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$salary){
		// todo
	}
	
	function AddPartTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$hourlyRate){
		// todo
	}
	
	function AddSeasonalEmployee($firstName,$lastName,$dateOfBirth,$sin,$season,$seasonYear,$piecePay){
		// todo
	}
	
	function AddContractEmployee($dateOfIncorporation,$companyName,$businessNumber,$startDate,$endDate,$fixedAmount){
		// todo
	}
	
	function SaveFullTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$salary){
		// todo
	}
	
	function SavePartTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$hourlyRate){
		// todo
	}
	
	function SaveSeasonalEmployee($firstName,$lastName,$dateOfBirth,$sin,$season,$seasonYear,$piecePay){
		// todo
	}
	
	function SaveContractEmployee($dateOfIncorporation,$companyName,$businessNumber,$startDate,$endDate,$fixedAmount){
		// todo
	}
}



?>