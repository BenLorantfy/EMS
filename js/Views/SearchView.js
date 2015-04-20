App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		 "click .addEmployeeButton":"openAddEmployee"
		,"click .auditButton":"openAudit"
		,"click .addEmployeeButton":"openAddEmployee"
		,"click .reportsButton":"openReports"
		,"keyup .searchInput":"search"
		,"click tr":"openViewEmployee"
		,"click .timecardIcon":"openTimecard"
	},
	
	search:function(){
		var view = this;
		var keywords = view.$el.find(".searchInput").val();
		var type = view.$el.find(".employeeType").val().toLowerCase();
		$.ajax({
		    url: '/employeelist',
		    type: 'POST',
		    data:JSON.stringify({
			      keywords:keywords
			     ,type:type
		    }),
		    dataType:"json",
		    success: function(employees){
		    	var resultsTable = view.$el.find(".resultTable");
		    	resultsTable.empty();
		    	for(var i = 0; i < employees.length; i++){
			    	var employee = employees[i];
			    	if(type != "contract"){
			    		resultsTable.append('<tr id = "employee' + employee.id + '"><td>' + employee.firstName + '</td><td>' + employee.lastName + '</td><td>' + employee.dateOfBirth + '</td><td><img class = "timecardIcon rowIcon" src = "/assets/images/clock.png"/><img class = "rowIcon" src = "/assets/images/pen.png"/></td></tr>');				    	
			    	}else{
				    	
			    	}
		    	}
		    }
		});
	},
	
	openAddEmployee:function(){
		this.trigger("open.addEmployee");
	},
	
	openReports:function(){
		this.trigger("open.reports");
	},
	
	openAudit:function(){
		this.trigger("open.audit");
	},
	
	openViewEmployee:function(e){
		if(!$(e.target).hasClass("timecardIcon")){
			this.trigger("open.viewEmployee", { id:42 });
		}
	},
	
	openTimecard:function(){
		this.trigger("open.timecard");	
	},
	
	initialize: function(){
		var view = this;
		view.animation = { progress: 0 };
	}
});