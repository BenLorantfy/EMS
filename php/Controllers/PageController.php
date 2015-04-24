<?php
//
// FILE       : PageController.php
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
namespace Controllers;
use Controllers\EmployeeController;
use Controllers\SessionController;
use Controllers\AuditController;
use Views\SectionView;

//
// NAME    : PageController
// PURPOSE : The page controller takes requests to generate pages
//
class PageController{

	//
	// FUNCTION    : navigateToLogin
	// DESCRIPTION : Renders, shows and hides views required to navigate to login section 
	// PARAMETERS  : none
	// RETURNS     : none
	//	
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
		$this->renderTimecard(false);
		$this->renderEnd();
	}

	//
	// FUNCTION    : navigateToSearch
	// DESCRIPTION : Renders, shows and hides views required to navigate to search section 
	// PARAMETERS  : none
	// RETURNS     : none
	//		
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
		$this->renderTimecard(false);	
		$this->renderEnd();		
	}

	//
	// FUNCTION    : navigateToAddEmployee
	// DESCRIPTION : Renders, shows and hides views required to navigate to add employee section 
	// PARAMETERS  : none
	// RETURNS     : none
	//		
	public function navigateToAddEmployee(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(true);
		$this->renderViewEmployee(false);
		$this->renderAudit(false);
		$this->renderReports(false);
		$this->renderTimecard(false);
		$this->renderEnd();		
	}

	//
	// FUNCTION    : navigateToAudit
	// DESCRIPTION : Renders, shows and hides views required to navigate to audit section 
	// PARAMETERS  : none
	// RETURNS     : none
	//		
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
		$this->renderTimecard(false);
		$this->renderEnd();		
	}

	//
	// FUNCTION    : navigateToViewEmployee
	// DESCRIPTION : Renders, shows and hides views required to navigate to view employee section 
	// PARAMETERS  : none
	// RETURNS     : none
	//		
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
		$this->renderTimecard(false);	
		$this->renderEnd();		
	}

	//
	// FUNCTION    : navigateToEditEmployee
	// DESCRIPTION : Renders, shows and hides views required to navigate to edit employee section 
	// PARAMETERS  : none
	// RETURNS     : none
	//		
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
		$this->renderTimecard(false);
		$this->renderEnd();		
	}
	
	//
	// FUNCTION    : navigateToReports
	// DESCRIPTION : Renders, shows and hides views required to navigate to reports section 
	// PARAMETERS  : none
	// RETURNS     : none
	//	
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
		$this->renderTimecard(false);
		$this->renderEnd();		
	}

	//
	// FUNCTION    : navigateToTimecard
	// DESCRIPTION : Renders, shows and hides views required to navigate to timecard section 
	// PARAMETERS  : none
	// RETURNS     : none
	//		
	public function navigateToTimecard(){
		// Contains information about session
		$session = new SessionController();
		
		$this->renderStart(true,$session->userType());
		$this->renderLogin();
		$this->renderSearch(true,true);
		$this->renderCover(true);
		$this->renderAddEmployee(false);		
		$this->renderEditEmployee(false);
		$this->renderAudit(false);	
		$this->renderReports(false);
		$this->renderTimecard(true);
		$this->renderEnd();			
	}

	//
	// FUNCTION    : renderStart
	// DESCRIPTION : Renders head info
	// PARAMETERS  : $isLogged - wether used is logged or not
	//				 $userType - type of user
	// RETURNS     : none
	//	
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

	//
	// FUNCTION    : renderEnd
	// DESCRIPTION : Renders footer info
	// PARAMETERS  : none
	// RETURNS     : none
	//		
	private function renderEnd(){
		SectionView::EndBodyRender();
		SectionView::EndPageRender();
	}

	//
	// FUNCTION    : renderLogin
	// DESCRIPTION : Renders login section
	// PARAMETERS  : none
	// RETURNS     : none
	//			
	private function renderLogin(){
		$login = new SectionView("login");
		$login->render();		
	}

	//
	// FUNCTION    : renderSearch
	// DESCRIPTION : Renders search section
	// PARAMETERS  : $show - wether or not to display section
	//				 $blurred - wether or not to blur section
	// RETURNS     : none
	//		
	private function renderSearch($show = true,$blurred = false){
		$employeeController = new EmployeeController();
		$search = new SectionView("search");
		$search->show = $show;
		$search->blurred = $blurred;
		$search->employees = $employeeController->searchEmployees();
		$search->render();		
	}
	
	//
	// FUNCTION    : renderAddEmployee
	// DESCRIPTION : Renders add employee section
	// PARAMETERS  : $show - wether or not to display section
	// RETURNS     : none
	//		
	private function renderAddEmployee($show = false){
		$employeeView = new SectionView("employee");
		$employeeView->show = $show;
		$employeeView->add = true;
		$employeeView->render();			
	}

	//
	// FUNCTION    : renderViewEmployee
	// DESCRIPTION : Renders view employee section
	// PARAMETERS  : $show - wether or not to display section
	// RETURNS     : none
	//		
	private function renderViewEmployee($show = false){
		$employeeView = new SectionView("employee");
		$employeeView->show = $show;
		$employeeView->view = true;
		$employeeView->render();			
	}

	//
	// FUNCTION    : renderEditEmployee
	// DESCRIPTION : Renders edit employee section
	// PARAMETERS  : $show - wether or not to display section
	// RETURNS     : none
	//		
	private function renderEditEmployee($show = false){
		$employeeView = new SectionView("employee");
		$employeeView->show = $show;
		$employeeView->edit = true;
		$employeeView->render();			
	}

	//
	// FUNCTION    : renderAudit
	// DESCRIPTION : Renders audit section
	// PARAMETERS  : $show - wether or not to display section
	// RETURNS     : none
	//			
	private function renderAudit($show = false){
		$auditController = new AuditController();
		$audit = new SectionView("audit");
		$audit->show = $show;
		$audit->auditInfo = $auditController->getAuditInfo();
		$audit->render();			
	}

	//
	// FUNCTION    : renderReports
	// DESCRIPTION : Renders reports section
	// PARAMETERS  : $show - wether or not to display section
	// RETURNS     : none
	//	
	private function renderReports($show = false){
		$search = new SectionView("reports");
		$search->show = $show;
		$search->render();			
	}
	
	//
	// FUNCTION    : renderCover
	// DESCRIPTION : Renders cover for blurring section
	// PARAMETERS  : $show - wether or not to display cover
	// RETURNS     : none
	//	
	private function renderCover($show = false){
		$cover = new SectionView("cover");
		$cover->show = $show;
		$cover->render();
	}
	
	//
	// FUNCTION    : renderTimecard
	// DESCRIPTION : Renders timecard section
	// PARAMETERS  : $show - wether or not to display cover
	// RETURNS     : none
	//	
	private function renderTimecard($show = false){
		$timecard = new SectionView("timecard");
		$timecard->show = $show;
		$timecard->render();		
	}
}