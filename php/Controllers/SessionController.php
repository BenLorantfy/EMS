<?php
//
// FILE       : SessionController.php
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
namespace Controllers;
use Helper\Connection;

//
// NAME    : SessionController
// PURPOSE : The session controller class takes requests to manipulate sessions
//           For example, it can login a new user, check that the user is logged in,
//           logout the user, etc.
//
class SessionController{
	private $db;

	//
	// FUNCTION    : __construct
	// DESCRIPTION : connects to database and sets the class db variable
	// PARAMETERS  : none
	// RETURNS     : none
	//
	public function __construct(){
		$this->db = Connection::connect();
	}
	
	//
	// FUNCTION    : login
	// DESCRIPTION : logs in user
	// PARAMETERS  : object : $request - username and password
	// RETURNS     : bool : wether login succeded or not
	//
	public function login($request){
		$success = false;
		
		//
		// Get credentials from request
		//
		$username = $request->username;
		$password = $request->password;
		
		//
		// Check database for user
		//
		$query = $this->db->prepare("SELECT id,password,securityLevel FROM User WHERE username = ? LIMIT 1");
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$username)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		if($query->num_rows == 1){
			if(!$query->bind_result($id,$hashedPassword,$securityLevel)) throw new Exception($this->db->error);
			
			//
			// Check if the provided password matches the db password
			//
			$query->fetch();
			if(password_verify($password,$hashedPassword)){
				$_SESSION["id"] 	  = $id;
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				$_SESSION["securityLevel"] = $securityLevel;
				$success = true;
			}
		}	
		
		return array("valid" => $success, "type" => $this->userType());
	}

	//
	// FUNCTION    : userType
	// DESCRIPTION : gets user type
	// PARAMETERS  : none
	// RETURNS     : string : the type of user logged in
	//	
	public function userType(){
		if(isset($_SESSION["securityLevel"])){
			return $_SESSION["securityLevel"] == 1 ? "admin" : "general";
		}else{
			return "none";
		}
	}

	//
	// FUNCTION    : isLogged
	// DESCRIPTION : checks if user is logged in
	// PARAMETERS  : none
	// RETURNS     : bool : true if logged
	//	
	public function isLogged(){
		return isset($_SESSION["id"]) && isset($_SESSION["username"]) && isset($_SESSION["password"]) && isset($_SESSION["securityLevel"]);
	}

	//
	// FUNCTION    : logout
	// DESCRIPTION : logs out user
	// PARAMETERS  : none
	// RETURNS     : bool : wether logout succeded or not
	//	
	public function logout(){
		return true;
	}
}