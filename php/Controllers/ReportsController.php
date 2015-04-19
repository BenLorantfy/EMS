<?php
namespace Controllers;

class ReportsController{
	public function generateReport($request){
		$type = preg_replace('/\PL/u', '', $request->type);
		include("Views/Reports/" . $type . ".php");
	}
}