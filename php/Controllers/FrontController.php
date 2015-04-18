<?php
namespace Controllers;
use Controllers\EmployeeController;
use Controllers\PageController;
use Helper\Route;

//
// FrontController
// ===============
// The front controller class serves as the entry point of the application
// All non-file requests are redirected to index.php by htaccess and the only job 
// index.php has is to include this file and instantiate a FrontController
// At that point, code in __construct() gets called to setup the application and
// process requests
//
class FrontController{
	public function __construct(){
		//
		// Start Session
		// =============
		// Tells php to start sessions
		// Since HTTP is stateless, php sessions are used to identify users with a session token
		// This allows users to be identified across requests
		//
		session_start();
		
		//
		// Autoloading
		// ===========
		// spl_autoload_register calls the passed callback right before an unknown class is used
		// Callback includes the class file so it can be used
		// Included class defintioins get declared globally, even if they are included within a function
		// The namespace tree of the class is converted to a file path
		// Class name should have same name as file
		// Directory path to class file should follow class's namespace tree
		//
		spl_autoload_register(function($class){
			require_once "php/" . str_replace("\\", "/", $class) . ".php";
		});
		
		//
		// Routing
		// =======
		// Maps a request URI to a controller method
		// Curly brackets indicate a placeholder
		// Ex. /employees/contract/5 would match /employees/{type}/{id}
		// Follows REST principles using GET,POST,PUT,DELETE, which are HTTP versions of CRUD
		// POST   = CREATE
		// GET    = READ
		// PUT    = UPDATE
		// DELETE = DELETE
		//
		Route::get("/employees/{type}/{id}",array(new EmployeeController(),"getEmployee"));
		Route::post("/employees/{type}",array(new EmployeeController(),"createEmployee"));
		
		Route::post("/session",array(new SessionController(),"login"));
		Route::delete("/session",array(new SessionController(),"logout"));
		
		Route::get("/",array(new PageController(),"navigateToLogin"));
		Route::get("/login",array(new PageController(),"navigateToLogin"));
		Route::get("/search",array(new PageController(),"navigateToSearch"));
		Route::get("/addEmployee",array(new PageController(),"navigateToAddEmployee"));
	}
}