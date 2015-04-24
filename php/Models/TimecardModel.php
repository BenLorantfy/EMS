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
    
    public function SetEmployee_id($employee_id){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->employee_id = $employee_id;
		return true;
	}
    
    public function SetInfo_title($info_title){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->info_title = $info_title;
		return true;
	}
    
	public function SetDate($date){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->date = $date;
		return true;
	}
		
	public function SetMonday($monday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->monday = $monday;
		return true;
	}
	
	public function SetTuesday($tuesday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->tuesday = $tuesday;
		return true;
	}
    public function SetWednesday($wednesday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->wednesday = $wednesday;
		return true;
	}
    public function SetThursday($thursday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->thursday = $thursday;
		return true;
	}
    public function SetFriday($friday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->friday = $friday;
		return true;
	}
    public function SetSaturday($saturday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->saturday = $saturday;
		return true;
	}
    public function SetSunday($sunday){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->sunday = $sunday;
		return true;
	}
	
	public function __get($key){
		return $this->$key;
	}
}
