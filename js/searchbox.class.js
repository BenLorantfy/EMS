var SearchBox = function(){
	var section = new Section("#search");
	var onReports = $.customEvent();
	
	$("#reportsButton").click(function(){
		onReports.trigger();
	})
	
	return $.extend({},section,{
		onReports:onReports
	});		
}
