//FILE			: SeasonalEmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and sign the 
//		  values for seasonal employee. 


<?php
namespace Models;
class SeasonalEmployeeModel extends EmployeeModel{
	private $piecePay;
	private $season;
	private $seasonYear;

	public function SetPiecePay($piecePay){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->piecePay = $piecePay;
		return true;
	}
		
	public function SetSeason($season){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->season = $season;
		return true;
	}
	
	public function SetSeasonYear($seasonYear){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->seasonYear = $seasonYear;
		return true;
	}
	
	public function __get($key){
		return $this->$key;
	}
}
