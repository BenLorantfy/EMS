App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		"click .addEmployeeButton":"openAddEmployee",
		"click .auditButton":"openAudit"
		 "click .addEmployeeButton":"openAddEmployee"
		,"click tr":"openViewEmployee"
	},
	
	openAddEmployee:function(){
		this.trigger("open.addEmployee");
	},
	
	openAudit:function(){
		this.trigger("open.audit");
	},
	
	openViewEmployee:function(){
		this.trigger("open.viewEmployee", { id:42 });
	},
	
	initialize: function(){
		var view = this;
		view.animation = { progress: 0 };
	}
});