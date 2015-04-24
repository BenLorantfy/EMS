<?php
//
// FILE       : ReportsController.php
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
namespace Controllers;
use Controllers\SessionController;
use Models\TimecardModel;
use Models\DatabaseModel;

//
// NAME    : TimecardController
// PURPOSE : The timecrad controller takes requests to manage timecards
//
class TimecardController{
	//
	// FUNCTION    : getTimecard
	// DESCRIPTION : gets a timecard information
	// PARAMETERS  : $request - id of employee timecard belongs to
	// RETURNS     : array - timecard
	//
	public function getTimecard($request){
        return $database->GetTimecard($request->id, "fulltimeemployee");
	}
	
	//
	// FUNCTION    : saveTimecard
	// DESCRIPTION : saves timecard information to database
	// PARAMETERS  : $request - id of employee to save timecard
	// RETURNS     : none
	//
    public function saveTimecard($request){
        $timecard = new TimecardModel();
        $timecard->SetEmployee_id($request->id);
        $timecard->SetInfo_title($request->id);
        $timecard->SetDate($request->id);
        $timecard->SetMonday($request->id);
        $timecard->SetTuesday($request->id);
        $timecard->SetWednesday($request->id);
        $timecard->SetThursday($request->id);
        $timecard->SetFriday($request->id);
        $timecard->SetSaturday($request->id);
        $timecard->SetSunday($request->id);
        
        $database = new DatabaseModel();
		//$database->SaveTimecard($timecard);
	}
    
}