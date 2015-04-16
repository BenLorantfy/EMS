var App = {
	 Models:{}
	,Views:{}	
	,start:function(){
		App.isLogged = $("meta[name=isLogged]").attr("content") == "true";
		App.userType = $("meta[name=userType]").attr("content");
		
		new App.Views.LoginView();
		new App.Views.SearchView();
		
		Backbone.Events.on("login",function(){
			
		});
	}
};