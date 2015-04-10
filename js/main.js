var App = (function(){
	var LoginView = Backbone.View.extend({
		
		el: "#login",
		
		events: {
			"click .button" : "authenticate"
		},
		
		authenticate: function(){
			alert("hi");
		},
		
		initialize: function(){
			
		},
		
		render: function(){
			
		}
	
	});
	
	return{
		run:function(){
			new LoginView();
		}
	}
})();

$(document).ready(App.run);