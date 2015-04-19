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
		var addEmployeeView = new App.Views.AddEmployeeView({ el:"#addEmployee", model:new App.Models.FullTimeEmployeeModel() });
		var auditView = new App.Views.AuditView({ el:"#audit" });
		
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
			}else if(auditView.visible()){
				searchView.focus();
				auditView.dialogyHide();
			}else{
				// more sections
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
		
		addEmployeeView.on("done",function(){
			App.Router.navigate("search",{ trigger: true });
		});
		
		auditView.on("done", function(){
			App.Router.navigate("search", {trigger: true});
		});
		
		//
		// Initilize navigation
		//
		Backbone.history.start({ pushState:true });
		
	}
};