var ReportsBox = function(){
	var section = new Section("#reports");
	var onDone = $.customEvent();
	
	$("#reportsDone, #reports .sectionBackground").click(function(){
		onDone.trigger();
	})
	
	return $.extend({},section,{
		onDone:onDone
	});		
}
