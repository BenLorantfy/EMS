<?php
namespace Controllers;
use Views\View;
class PageController{
	
	
	public function navigateToLogin(){
		$this->renderStart();
		$this->renderLogin(true);
		$this->renderSearch(false);
		$this->renderAddEmployee(false);
		$this->renderEnd();
	}
	
	public function navigateToSearch(){
		$this->renderStart();
		$this->renderLogin(false);
		$this->renderSearch(true);
		$this->renderAddEmployee(false);		
		$this->renderEnd();		
	}
	
	public function navigateToAddEmployee(){
		$this->renderStart();
		$this->renderLogin(false);
		$this->renderSearch(false);
		$this->renderAddEmployee(true);		
		$this->renderEnd();		
	}
	
	
	private function renderStart(){
		View::StartPageRender();
		View::StartHeadRender();
		
		$head = new View("head");
		$head->isLogged = "true";
		$head->userType = "admin";
		$head->render();
		
		View::EndHeadRender();
		View::StartBodyRender();		
		
		$common = new View("common");
		$common->render();
	}
	
	private function renderEnd(){
		View::EndBodyRender();
		View::EndPageRender();
	}
	
	private function renderLogin($display){
		$login = new View("login");
		$login->show = $display;
		$login->render();		
	}
	
	private function renderSearch($display){
		$search = new View("search");
		$search->show = $display;
		$search->render();		
	}
	
	private function renderAddEmployee($display){
		$search = new View("addEmployee");
		$search->show = $display;
		$search->render();			
	}
}