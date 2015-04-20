<?php
namespace Controllers;
use Controllers\EmployeeController;
use Controllers\SessionController;
use Controllers\AuditController;
use Views\SectionView;

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
		$this->renderViewEmployee(false);
		$this->renderReports(false);
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
		$this->renderAudit(false);
		$this->renderReports(false);	
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
		$this->renderViewEmployee(true);
		$this->renderAudit(false);
		$this->renderReports(false);
		$this->renderEnd();		
	}
	
	public function navigateToAudit(){
		$session = new SessionController();
	
		$this->renderStart(true,"admin");
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(false);
		$this->renderViewEmployee(false);		
		$this->renderAudit(true);		
		$this->renderReports(false);
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
		$this->renderAudit(false);
		$this->renderReports(false);	
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
		$this->renderAudit(false);	
		$this->renderReports(false);
		$this->renderEnd();		
	}
	
	public function navigateToReports(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(false);		
		$this->renderEditEmployee(false);
		$this->renderAudit(false);	
		$this->renderReports(true);
		$this->renderEnd();		
	}
	
	private function renderStart($isLogged,$userType){
		SectionView::StartPageRender();
		SectionView::StartHeadRender();
		
		$head = new SectionView("head");
		$head->isLogged = $isLogged ? "true" : "false";
		$head->userType = $userType;
		$head->render();
		
		SectionView::EndHeadRender();
		SectionView::StartBodyRender();		
	}
	
	private function renderEnd(){
		SectionView::EndBodyRender();
		SectionView::EndPageRender();
	}
	
	private function renderLogin(){
		$login = new SectionView("login");
		$login->render();		
	}
	
	private function renderSearch($show = true,$blurred = false){
		$search = new SectionView("search");
		$search->show = $show;
		$search->blurred = $blurred;
		$search->employees = array(array("firstName" => "Ben", "lastName" => "Lorantfy", "dateOfBirth" => "1995/11/10"),array("firstName" => "Ben", "lastName" => "Lorantfy", "dateOfBirth" => "1995/11/10"));
		$search->render();		
	}
	
	private function renderAddEmployee($show = true){
		$employeeView = new SectionView("employee");
		$employeeView->show = $show;
		$employeeView->add = true;
		$employeeView->render();			
	}
	
	private function renderViewEmployee($show = true){
		$employeeView = new SectionView("employee");
		$employeeView->show = $show;
		$employeeView->view = true;
		$employeeView->render();			
	}
	
	private function renderEditEmployee($show = true){
		$employeeView = new SectionView("employee");
		$employeeView->show = $show;
		$employeeView->edit = true;
		$employeeView->render();			
	}
	
	private function renderAudit($show = true){
		$auditController = new AuditController();
		$audit = new SectionView("audit");
		$audit->show = $show;
		$audit->auditInfo = $auditController->getAuditInfo();
		$audit->render();			
	}

	private function renderReports($show = true){
		$search = new SectionView("reports");
		$search->show = $show;
		$search->render();			
	}
	
	private function renderCover($show = false){
		$cover = new SectionView("cover");
		$cover->show = $show;
		$cover->render();
	}
}