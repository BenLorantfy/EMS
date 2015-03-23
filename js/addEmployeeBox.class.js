var AddEmployeeBox = function(){
	var section = new Section("#addEmployee");
	var onDone = $.customEvent();
	
	$("#addEmployeeDone, #addEmployee .sectionBackground").click(function(){
		onDone.trigger();
	})
	
	$("#addEmployee .employeeType").change(function(){
		var type = $(this).val();
		$(".unselectedField").removeClass("unselectedField");
		$("#addEmployeeTable .field:not(." + type + "Field)").addClass("unselectedField");
	})
	
	return $.extend({},section,{
		onDone:onDone
	});		
}
