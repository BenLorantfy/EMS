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
		var reportsBox = new ReportsBox();
		
		if(!isLogged){
			setTimeout(loginBox.show,200);
		}
		
		loginBox.onLogin(function(){
			loginBox.hide();
			setTimeout(searchBox.show, 150);
		});
		
		searchBox.onReports(function(){
			searchBox.blur();
			reportsBox.dialogyShow();
		})
		
		reportsBox.onDone(function(){
			reportsBox.dialogyHide();
			searchBox.focus();
		})
	}
	
	return{
		 run:run
	}
})();

$(window).load(App.run);