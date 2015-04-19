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
		$this->renderViewEmployee(false);
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
		$this->renderViewEmployee(false);		
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
		$this->renderViewEmployee(false);		
		$this->renderEnd();		
	}
	
	public function navigateToViewEmployee(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(false);		
		$this->renderViewEmployee(true);		
		$this->renderEnd();		
	}
	
	public function navigateToEditEmployee(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(false);		
		$this->renderEditEmployee(true);		
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
		$search = new View("search");
		$search->show = $show;
		$search->blurred = $blurred;
		$search->employees = array(array("firstName" => "Ben", "lastName" => "Lorantfy", "dateOfBirth" => "1995/11/10"),array("firstName" => "Ben", "lastName" => "Lorantfy", "dateOfBirth" => "1995/11/10"));
		$search->render();		
	}
	
	private function renderAddEmployee($show = true){
		$employeeView = new View("employee");
		$employeeView->show = $show;
		$employeeView->add = true;
		$employeeView->render();			
	}
	
	private function renderViewEmployee($show = true){
		$employeeView = new View("employee");
		$employeeView->show = $show;
		$employeeView->view = true;
		$employeeView->render();			
	}
	
	private function renderEditEmployee($show = true){
		$employeeView = new View("employee");
		$employeeView->show = $show;
		$employeeView->edit = true;
		$employeeView->render();			
	}
	
	private function renderCover($show = false){
		$cover = new View("cover");
		$cover->show = $show;
		$cover->render();
	}
}