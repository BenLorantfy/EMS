var App = {
	 Models:{}
	,Views:{}	
	,start:function(){
		App.isLogged = $("meta[name=isLogged]").attr("content") == "true";
		App.userType = $("meta[name=userType]").attr("content");
		var loginView = new App.Views.LoginView();
		Backbone.Events.on("login",function(){
			console.log("nicccce");
		});
	}
};