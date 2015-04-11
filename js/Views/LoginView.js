App.Views.LoginView = App.Views.SectionView.extend({
	el: "#login",
	
	events: {
		"click .button" : "login",
		"keyup .credential" : "enterLogin"
	},
	
	enterLogin: function(e){
		//
		// If user pressed enter within a credential box, login user
		//
		if(e.keyCode == 13){
			this.login();
		}
	},
	
	login: function(){
		//
		// Save this reference to variable
		//
		var view = this;
		
		//
		// Get username and password from login view
		//
		var username = this.$el.find(".username").val();
		var password = this.$el.find(".password").val();
		
		//
		// Create a session on server with username and password
		//
		$.ajax({
		    url: '/session',
		    type: 'POST',
		    data:{
			     username:username
			    ,password:password
		    },
		    dataType:"json",
		    success: function(loggedIn){
		        if(loggedIn){
			        Backbone.Events.trigger("login");
			        view.hide();
		        }else{
			        console.log("bad info");
		        }
		    }
		});
	},
	
	
	initialize: function(){
		this.show();
	},
	
	render: function(){
		
	}
});