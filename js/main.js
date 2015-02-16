(function(){
	var App = (function(){
		var isLogged;
		function run(){
			isLogged = $("[name='isLogged']").attr("content") === "true";
			
			$.msgBox.init();
					
			var loginBox = new LoginBox();
			var searchBox = new SearchBox();
			
			if(!isLogged){
				setTimeout(loginBox.show,200);
			}
			
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
		var section = $(selector);
		var cover = $("#cover");
		
		function hide(){
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
		
		function blur(){
			cover.css("opacity",0);
			cover.insertAfter(section);
			cover.stop().animate({ opacity:1 },400,"easeOutQuart");
		}
		
		function focus(){
			cover.stop().animate({ opacity:0 },400,"easeOutQuart");			
		}
		
		return{
			 hide:hide
			,show:show
			,blur:blur
			,focus:focus
		}
	}
	
	var LoginBox = function(){
		var tryingLogin = false;
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
		
		$("#loginButton").click(tryLogin);
		
		function tryLogin(){
			if(!tryingLogin){
				tryingLogin = true;
				var username = $("#username").val();
				var password = $("#password").val();
				$.postCall("Users.login",username,password,function(validCreds){
					if(validCreds){
						for(var i = 0; i < onLoginCallbacks.length; i++){
							onLoginCallbacks[i]();
						}				
					}else{
						tryingLogin = false;
						$.msgBox.error("Invalid Credentials");
					}
				},function(errorMessage){
					$.msgBox.error("An error occurred while trying to log in.");
				})
			}
		}
		
		// Add functionality to section.show
		function show(){
			section.show();
			
			// When the login box is shown, focus on username box so user doesn't have to click it to focus on it
			$("#username").focus();
		}
		
		//
		// Extend (inherit) section functionality (i.e. show, hide) with specific login box functionality
		//
		return $.extend({},section,{
			onLogin:onLogin,
			
			// Override section.show with custom show function with more speicifc funtionality
			show:show
		});
	}
	
	var SearchBox = function(){
		var section = new Section("#search");
		
		return $.extend({},section,{

		});		
	}
	
	$(window).load(App.run);
})();