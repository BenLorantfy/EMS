<?php
namespace Controllers;
use Helper\Connection;

//
// SessionController
// =================
// The session controller class takes requests to manipulate sessions
// For example, it can login a new user, check that the user is logged in,
// logout the user, etc.
//
class SessionController{
	private $db;
	public function __construct(){
		$this->db = Connection::connect();
	}
	
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
	
	public function userType(){
		if(isset($_SESSION["securityLevel"])){
			return $_SESSION["securityLevel"] == 1 ? "admin" : "general";
		}else{
			return "none";
		}
	}
	
	public function isLogged(){
		return isset($_SESSION["id"]) && isset($_SESSION["username"]) && isset($_SESSION["password"]) && isset($_SESSION["securityLevel"]);
	}
	
	public function logout(){
		return true;
	}
}