var App = {
	 Models:{}
	,Views:{}	
	,start:function(){
		App.isLogged = $("meta[name=isLogged]").attr("content") == "true";
		App.userType = $("meta[name=userType]").attr("content");
		
		new App.Views.LoginView({ el:"#login" });
		new App.Views.SearchView({ el:"#search" });
		new App.Views.AddEmployeeView({ el:"#addEmployee", model:new App.Models.EmployeeModel() });
		
		Backbone.Events.on("login",function(){
			
		});
	}
};