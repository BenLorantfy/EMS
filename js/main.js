var App = (function(){
	function run(){		
		$.msgBox.init();
		$.postCall.config({
			 prefix: "php/"
			,suffix: ".class.php"
		})
				
		var loginBox 	= new LoginBox();
		var searchBox 	= new SearchBox();
		var reportsBox 	= new ReportsBox();
		var usersBox 	= new UsersBox();
		
		if(!isLogged()){
			setTimeout(loginBox.show,200);
		}
		
		loginBox.onLogin(function(e){
			//
			// Update login status
			//
			isLogged(true);
			userType(e.type);
			
			//
			// If admin logged in, show admin controls
			//
			if(e.type == "admin"){
				$(".adminControl").show();
			}

			//
			// Hide login box and show main search section
			//
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
		
		searchBox.onUsers(function(){
			searchBox.blur();
			usersBox.dialogyShow();
		})
		
		usersBox.onDone(function(){
			usersBox.dialogyHide();
			searchBox.focus();
		})
	}
	
	function isLogged(logged){
		if(typeof logged === "undefined") return $("meta[name='isLogged']").attr("content") === "true";
		$("meta[name='userType']").attr("content",logged?"true":"false");
	}
	
	function userType(type){
		if(typeof type === "undefined") return $("meta[name='userType']").attr("content");
		$("meta[name='userType']").attr("content",type);
	}
	
	return{
		 run:run
	}
})();

$(window).load(App.run);