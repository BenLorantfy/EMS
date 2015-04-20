App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		 "click .addEmployeeButton":"openAddEmployee"
		,"click .auditButton":"openAudit"
		,"click .addEmployeeButton":"openAddEmployee"
		,"click .reportsButton":"openReports"
		,"click tr":"openViewEmployee"
		,"click .timecardIcon":"openTimecard"
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