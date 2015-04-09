<?php
namespace Controllers;
class EmployeeController{
	public function get_employee($request){
		echo $request->type;
	}
}