var App = {
	 Models:{}
	,Views:{}	
	,Router:{}
	,start:function(){
		//
		// Initilize msgbox plugin
		//
		$.msgBox.init();
		
		//
		// Initilize app properties
		//
		App.isLogged = $("meta[name=isLogged]").attr("content") == "true";
		App.userType = $("meta[name=userType]").attr("content");
		
		//
		// Create section views
		//
		var loginView = new App.Views.LoginView({ el:"#login" });
		var searchView = new App.Views.SearchView({ el:"#search" });
		var auditView = new App.Views.AuditView({ el:"#audit" });
		var addEmployeeView = new App.Views.EmployeeView({ el:"#addEmployee", model:new App.Models.FullTimeEmployeeModel() });
		var viewEmployeeView = new App.Views.EmployeeView({ el:"#employee", model:new App.Models.FullTimeEmployeeModel() });
		var reportsView = new App.Views.ReportsView({ el:"#reports" });
		var timecardView = new App.Views.ReportsView({ el:"#timecard" });
		
		//
		// Create view routes
		//
		App.Router.on("route:login",function(){
			if(searchView.visible()){
				loginView.reverseShow();
				searchView.reverseHide();
			}else{
				loginView.show();
			}
		});
		
		App.Router.on("route:search",function(){
			if(loginView.visible()){
				searchView.show();
				loginView.hide(); 
			}else if(addEmployeeView.visible()){
				searchView.focus();
				addEmployeeView.dialogyHide();
			}else if(viewEmployeeView.visible()){
				searchView.focus();
				viewEmployeeView.dialogyHide();
			}else if(auditView.visible()){
				searchView.focus();
				auditView.dialogyHide();
			}else if(reportsView.visible()){
				searchView.focus();
				reportsView.dialogyHide();
			}else if(timecardView.visible()){
				searchView.focus();
				timecardView.dialogyHide();
			}
		});

		App.Router.on("route:viewEmployee",function(){
			if(!viewEmployeeView.visible()){
				searchView.blur();
				viewEmployeeView.dialogyShow();				
			}
		});
		
		App.Router.on("route:addEmployee",function(){
			if(!addEmployeeView.visible()){
				searchView.blur();
				addEmployeeView.dialogyShow();				
			}
		});
		
		App.Router.on("route:audit",function(){
			if(!auditView.visible()){
				searchView.blur();
				auditView.dialogyShow();				
			}
		});

		App.Router.on("route:reports",function(){
			if(!reportsView.visible()){
				searchView.blur();
				reportsView.dialogyShow();				
			}
		});
		
		App.Router.on("route:timecard",function(){
			if(!timecardView.visible()){
				searchView.blur();
				timecardView.dialogyShow();				
			}
		});
		
		//
		// Create navigation events
		//
		loginView.on("login",function(session){
			//
			// Update controls based on security levels
			//
			if(session.type == "admin"){
				$("#admin").remove();
			}else{
				if($("#admin").length == 0){
					$("head").append("<style id = 'admin'>.adminControl{ display:none; }</style>");
				}
			}
			
			// Navigates to search page
			App.Router.navigate("search", { trigger: true });
		});
		
		searchView.on("open.addEmployee",function(){
			App.Router.navigate("addEmployee",{ trigger: true });
		});

		searchView.on("open.audit",function(){
			App.Router.navigate("audit",{ trigger: true });
		});
		
		searchView.on("open.viewEmployee",function(employee){
			App.Router.navigate("viewEmployee/" + employee.id,{ trigger: true });
		});
		
		searchView.on("open.reports",function(){
			App.Router.navigate("reports",{ trigger: true });
		});
		
		searchView.on("open.timecard",function(){
			App.Router.navigate("timecard/42",{ trigger: true });
		});
				
		addEmployeeView.on("done",function(){
			App.Router.navigate("search",{ trigger: true });
		});

		viewEmployeeView.on("done",function(){
			App.Router.navigate("search",{ trigger: true });
		});
		
		auditView.on("done", function(){
			App.Router.navigate("search", { trigger: true });
		});
		
		reportsView.on("done",function(){
			App.Router.navigate("search", { trigger: true });
		});
		
		timecardView.on("done",function(){
			App.Router.navigate("search", { trigger: true })
		});
		
		reportsView.on("generate",function(report){
			window.open("/reports/" + report.type);
		});		
		
		//
		// Initilize navigation
		//
		Backbone.history.start({ pushState:true });
		
	}
};