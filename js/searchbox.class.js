var SearchBox = function(){
	var section = new Section("#search");
	var onReports = $.customEvent();
	var onUsers = $.customEvent();
	
	$("#reportsButton").click(function(){
		onReports.trigger();
	})

	$("#usersButton").click(function(){
		onUsers.trigger();
	})
		
	return $.extend({},section,{
		 onReports:onReports
		,onUsers:onUsers
	});		
}
