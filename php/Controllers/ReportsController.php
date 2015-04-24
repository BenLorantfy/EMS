<?php
//
// FILE       : ReportsController.php
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
namespace Controllers;

//
// NAME    : ReportsController
// PURPOSE : The reports controller takes requests to generate reports
//
class ReportsController{

	//
	// FUNCTION    : generateReport
	// DESCRIPTION : Generates a PDF report
	// PARAMETERS  : object : $request - object containing type of report to generate
	// RETURNS     : none
	//	
	public function generateReport($request){
		$type = preg_replace('/\PL/u', '', $request->type);
		include("Views/Reports/" . $type . ".php");
	}
}