<?php
namespace Controllers;
use Views\View;
class PageController{
	public function get_home($request){
		View::StartPageRender();
		View::StartHeadRender();
		
		$head = new View("head");
		$head->isLogged = "true";
		$head->userType = "admin";
		$head->render();
		
		View::EndHeadRender();
		View::StartBodyRender();
		
		$login = new View("login");
		$login->render();
		
		View::EndBodyRender();
		View::EndPageRender();
	}
}