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
	
	$("#addEmployeeAdd").click(function(){
		var type = $("#addEmployee .employeeType").val();
		$.msgBox.success("Adding employee...",true);
		if(type != "contract"){
			var firstName = $("#addEmployee .firstName").val();
			var lastName = $("#addEmployee .lastName").val();
			var dateOfBirth = $("#addEmployee .dateOfBirth").val();
			var sin = $("#addEmployee .sin").val();
			
			if(type != "seasonal"){
				var dateOfHire = $("#addEmployee .dateOfHire").val();
				var dateOfTermination = $("#addEmployee .dateOfTermination").val();
				
				if(type == "fullTime"){
					var salary = $("#addEmployee .salary").val();
					$.postCall("Employees.AddFullTimeEmployee",firstName,lastName,dateOfBirth,sin,dateOfHire,dateOfTermination,salary,function(){
						$.msgBox.success("Full time employee added");
						$("#addEmployee .field input").val("");
					},function(){
						$.msgBox.error("An error occurred");
					})
				}else{
					var hourlyRate = $("#addEmployee .hourlyRate").val();
					$.postCall("Employees.AddPartTimeEmployee",firstName,lastName,dateOfBirth,sin,dateOfHire,dateOfTermination,hourlyRate,function(){
						$.msgBox.success("Part time employee added");
						$("#addEmployee .field input").val("");
					},function(){
						$.msgBox.error("An error occurred");
					})					
				}
			}else{
				var season = $("#addEmployee .season").val();
				var seasonYear = $("#addEmployee .seasonYear").val();
				var piecePay = $("#addEmployee .piecePay").val();
				
				$.postCall("Employees.AddSeasonalEmployee",firstName,lastName,dateOfBirth,sin,season,seasonYear,piecePay,function(){
					$.msgBox.success("Seasonal employee added");
					$("#addEmployee .field input").val("");
				},function(){
					$.msgBox.error("An error occurred");
				})	
			}
		}else{
			var dateOfIncorporation = $("#addEmployee .dateOfIncorporation").val();
			var companyName = $("#addEmployee .companyName").val();
			var businessNumber = $("#addEmployee .businessNumber").val();
			var startDate = $("#addEmployee .startDate").val();
			var endDate = $("#addEmployee .endDate").val();
			var fixedAmount = $("#addEmployee .fixedAmount").val();
			
			$.postCall("Employees.AddContractEmployee",dateOfIncorporation,companyName,businessNumber,startDate,endDate,fixedAmount,function(){
				$.msgBox.success("Contract employee added");
				$("#addEmployee .field input").val("");
			},function(){
				$.msgBox.error("An error occurred");
			})				
		}
	})
	
	
	
	return $.extend({},section,{
		onDone:onDone
	});		
}
