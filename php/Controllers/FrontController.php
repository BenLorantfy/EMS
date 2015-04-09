<?php
namespace Controllers;
use Controllers\EmployeeController;
use Controllers\PageController;

// https://github.com/chriso/klein.php/tree/v1.2.0
require "php/lib/klein.php";

class FrontController{
	public function __construct(){
		//
		// Autoloading
		//
		spl_autoload_register(function($class){
			require_once "php/" . str_replace("\\", "/", $class) . ".php";
		});
		
		//
		// Routing
		//
		respond("GET","/employees/[:type]/[:id]",array(new EmployeeController(),"get_employee"));
		
		respond("/",array(new PageController(),"get_home"));
		
		// Do Routing
		dispatch();
	}
}