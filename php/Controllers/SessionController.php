<?php
namespace Controllers;

//
// SessionController
// =================
// The session controller class takes requests to manipulate sessions
// For example, it can login a new user, check that the user is logged in,
// logout the user, etc.
//
class SessionController{
	public function login($username,$password){
		return true;
	}
	
	public function logout(){
		return true;
	}
}