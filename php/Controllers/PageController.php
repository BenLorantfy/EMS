<?php
namespace Controllers;
use Controllers\EmployeeController;
use Controllers\SessionController;
use Views\View;

class PageController{
	
	public function navigateToLogin(){
		// Contains information about session
		$session = new SessionController();
		$this->renderStart(true,$session->userType());
		$this->renderCover(false);
		$this->renderLogin();
		$this->renderSearch(false);
		$this->renderAddEmployee(false);
		$this->renderAudit(false);	
		$this->renderEnd();
	}
	
	public function navigateToSearch(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderCover(false);
		$this->renderLogin();
		$this->renderSearch();
		$this->renderAddEmployee(false);	
		$this->renderAudit(false);			
		$this->renderEnd();		
	}
	
	public function navigateToAddEmployee(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(true);
		$this->renderAudit(false);
		$this->renderEnd();		
	}
	
	public function navigateToAudit(){
		$session = new SessionController();
	
		$this->renderStart(true,"admin");
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(false);
		$this->renderAudit(true);		
		$this->renderEnd();		
	}
	
	private function renderStart($isLogged,$userType){
		View::StartPageRender();
		View::StartHeadRender();
		
		$head = new View("head");
		$head->isLogged = $isLogged ? "true" : "false";
		$head->userType = $userType;
		$head->render();
		
		View::EndHeadRender();
		View::StartBodyRender();		
	}
	
	private function renderEnd(){
		View::EndBodyRender();
		View::EndPageRender();
	}
	
	private function renderLogin(){
		$login = new View("login");
		$login->render();		
	}
	
	private function renderSearch($show = true,$blurred = false){
		$employeeController = new EmployeeController();
		$employees = array();
		
		$search = new View("search");
		$search->show = $show;
		$search->blurred = $blurred;
		$search->employees = $employees;
		$search->render();		
	}
	
	private function renderAddEmployee($show = true){
		$search = new View("addEmployee");
		$search->show = $show;
		$search->render();			
	}
	
	private function renderAudit($show = true){
		$search = new View("audit");
		$search->show = $show;
		$search->render();			
	}
	
	private function renderCover($show = false){
		$cover = new View("cover");
		$cover->show = $show;
		$cover->render();
	}
}