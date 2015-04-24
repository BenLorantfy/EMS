//FILE			: TimecardModel.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: This file contains the server side validation before the data goes into database, and sign the 
//		  values for time card. 

<?php
namespace Models;
class TimecardModel{
	private $employee_id;
    private $info_title;
    private $date;
    private $monday;
    private $tuesday;
    private $wednesday;
    private $thursday;
    private $friday;
    private $saturday;
    private $sunday;
    
    	//
	// FUNCTION    : SetEmployee_id
	// DESCRIPTION : set employee_id of employee
	// PARAMETERS  : $employee_id
	// RETURNS     : bool : the result of asign
	//
    public function SetEmployee_id($employee_id){
		$this->employee_id = $employee_id;
	
		return true;
	}
	
    	//
	// FUNCTION    : SetInfo_title
	// DESCRIPTION : set hourlyRate of employee
	// PARAMETERS  : $info_title
	// RETURNS     : bool : the result of asign
	//
    public function SetInfo_title($info_title){
		$this->info_title = $info_title;
		return true;
	}
    
    	//
	// FUNCTION    : SetDate
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $date
	// RETURNS     : bool : the result of asign
	//
	public function SetDate($date){
		$this->date = $date;
		return true;
	}
	
	//
	// FUNCTION    : SetMonday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $monday
	// RETURNS     : bool : the result of asign
	//	
	public function SetMonday($monday){
		$this->monday = $monday;
		return true;
	}
	
	//
	// FUNCTION    : SetTuesday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $tuesday
	// RETURNS     : bool : the result of asign
	//
	public function SetTuesday($tuesday){
		$this->tuesday = $tuesday;
		return true;
	}
	
	//
	// FUNCTION    : SetWednesday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $wednesday
	// RETURNS     : bool : the result of asign
	//
    public function SetWednesday($wednesday){
		$this->wednesday = $wednesday;
		return true;
	}
	
	//
	// FUNCTION    : SetThursday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $thursday
	// RETURNS     : bool : the result of asign
	//
    public function SetThursday($thursday){
		$this->thursday = $thursday;
		return true;
	}
	
	//
	// FUNCTION    : SetFriday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $friday
	// RETURNS     : bool : the result of asign
	//
    public function SetFriday($friday){
		$this->friday = $friday;
		return true;
	}
	
	//
	// FUNCTION    : SetSaturday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $saturday
	// RETURNS     : bool : the result of asign
	//
    public function SetSaturday($saturday){
		$this->saturday = $saturday;
		return true;
	}
	
	//
	// FUNCTION    : SetSunday
	// DESCRIPTION : set data of employee's tiem card
	// PARAMETERS  : $sunday
	// RETURNS     : bool : the result of asign
	//
    public function SetSunday($sunday){
		$this->sunday = $sunday;
		return true;
	}
	
	//
	// FUNCTION    : __get
	// DESCRIPTION : 
	// PARAMETERS  : $key
	// RETURNS     : bool : the result of asign
	//
	public function __get($key){
		return $this->$key;
	}
}
