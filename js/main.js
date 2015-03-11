var App = (function(){
	var isLogged;
	function run(){
		isLogged = $("[name='isLogged']").attr("content") === "true";
		
		$.msgBox.init();
		$.postCall.config({
			 prefix: "php/"
			,suffix: ".class.php"
		})
				
		var loginBox = new LoginBox();
		var searchBox = new SearchBox();
		
		if(!isLogged){
			setTimeout(loginBox.show,200);
		}
		
		loginBox.onLogin(function(){
			loginBox.hide();
			setTimeout(searchBox.show, 150);
		});
		
		var focused = true;
		$("#search").click(function(){
			searchBox.blur();
		})
	}
	
	return{
		 run:run
	}
})();

$(window).load(App.run);