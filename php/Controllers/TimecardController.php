<?php
namespace Controllers;
use Controllers\SessionController;
use Models\TimecardModel;
use Models\DatabaseModel;

class TimecardController{
	public function getTimecard($request){
        //return $database->GetTimecard($request->id);
	}
	
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
       // $database->SaveTimecard($timecard);
	}
    
}