(function(){
	var App = (function(){
		function run(){
			$.msgBox.init();
					
			var loginBox = new LoginBox();
			var searchBox = new SearchBox();
			
			loginBox.onLogin(function(){
				loginBox.hide();
				
				setTimeout(searchBox.show, 150);
			});
		}
		
		return{
			 run:run
		}
	})();
	
	var Section = function(selector){	
		function hide(){
			var section = $(selector);
			$({ progress:0 }).animate({ progress: 1},{
				 duration:800
				,easing:"easeOutQuart"
				,step:function(progress){
					section.css("transform","scale(" + (1 - progress*0.3) + "," + (1 - progress*0.3) + ")");
					section.css("opacity",1 - progress);
				}
			})
		}
		
		function show(){
			var section = $(selector);
			section.css("opacity",0);
			section.show();
			$({ progress:0 }).animate({ progress: 1},{
				 duration:800
				,easing:"easeOutQuart"
				,step:function(progress){
					section.css("transform","scale(" + (1.3 - progress*0.3) + "," + (1.3 - progress*0.3) + ")");
					section.css("opacity",progress);
				}
			})	
		}
		
		return{
			 hide:hide
			,show:show
		}
	}
	
	var LoginBox = function(){
		var loggedIn = false;
		var section = new Section("#login");
		
		var onLoginCallbacks = [];
		function onLogin(fn){
			onLoginCallbacks.push(fn);
		}
		
		$(document).keydown(function(e){
			if(e.keyCode == 13){
				tryLogin();
			}
		});
		
		function tryLogin(){
			if(!loggedIn){
				var username = $("#username").val();
				var password = $("#password").val();
				$.postCall("Users.login",username,password,function(validCreds){
					if(validCreds){
						loggedIn = true;
						for(var i = 0; i < onLoginCallbacks.length; i++){
							onLoginCallbacks[i]();
						}				
					}else{
						$.msgBox.error("Invalid Credentials");
					}
				},function(errorMessage){
					$.msgBox.error("An error occurred while trying to log in.");
				})
			}
		}
		
		return $.extend(section,{
			onLogin:onLogin
		});
	}
	
	var SearchBox = function(){
		var section = new Section("#search");
		
		return $.extend(section,{

		});		
	}
	
	$(document).ready(App.run);
})();