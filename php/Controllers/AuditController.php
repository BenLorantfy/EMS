<?php
//
// FILE       : AuditController.php
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
namespace Controllers;
use Helper\Connection;
use Models\DatabaseModel;

//
// NAME    : AuditController
// PURPOSE : The audit controller class takes requests to manage audit logs
//
class AuditController{
	//
	// FUNCTION    : getAuditInfo
	// DESCRIPTION : Get's information about audit from database
	// PARAMETERS  : none
	// RETURNS     : array : the audit info
	//
	public function getAuditInfo(){
		$database = new DatabaseModel();
		return $database->GetAudit();
	}
}