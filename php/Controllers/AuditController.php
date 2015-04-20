<?php
namespace Controllers;
use Helper\Connection;
use Models\DatabaseModel;

//
// SessionController
// =================
// The session controller class takes requests to manipulate sessions
// For example, it can login a new user, check that the user is logged in,
// logout the user, etc.
//
class AuditController{
	public function getAuditInfo(){
		$database = new DatabaseModel();
		return $database->GetAudit();
	}
}