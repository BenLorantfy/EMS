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
		
		//
		// Create navigation events
		//
		loginView.on("login",function(){
			App.Router.navigate("search", { trigger: true });
		});
		
		searchView.on("open.addEmployee",function(){
			App.Router.navigate("addEmployee",{ trigger: true });
		});
		
		addEmployeeView.on("done",function(){
			App.Router.navigate("search",{ trigger: true });
		});
		
		//
		// Initilize navigation
		//
		Backbone.history.start({ pushState:true });
		
	}
};