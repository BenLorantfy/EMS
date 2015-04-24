<?php
//FILE			: SeasonalEmployeeModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and sign the 
//		  values for seasonal employee. 

namespace Models;
class SeasonalEmployeeModel extends EmployeeModel{
	private $piecePay;
	private $season;
	private $seasonYear;

	//
	// FUNCTION    : SetHourlyRate
	// DESCRIPTION : set hourlyRate of employee
	// PARAMETERS  : $hourlyRate
	// RETURNS     : bool : the result of asign
	//
	public function SetPiecePay($piecePay){
		$this->piecePay = $piecePay;
		return true;
	}
	
	//
	// FUNCTION    : SetSeason
	// DESCRIPTION : set hourlyRate of employee
	// PARAMETERS  : $season
	// RETURNS     : bool : the result of asign
	//	
	public function SetSeason($season){
		$this->season = $season;
		return true;
	}
	
	//
	// FUNCTION    : SetSeasonYear
	// DESCRIPTION : set hourlyRate of employee
	// PARAMETERS  : $seasonYear
	// RETURNS     : bool : the result of asign
	//
	public function SetSeasonYear($seasonYear){
		$this->seasonYear = $seasonYear;
		return true;
	}
	
	//
	// FUNCTION    : __get
	// DESCRIPTION : set hourlyRate of employee
	// PARAMETERS  : $key
	// RETURNS     : bool : the result of asign
	//
	public function __get($key){
		return $this->$key;
	}
}
