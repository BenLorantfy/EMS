App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		"click .addEmployeeButton":"openAddEmployee",
		"click .auditButton":"openAudit"
	},
	
	openAddEmployee:function(){
		this.trigger("open.addEmployee");
	},
	
	openAudit:function(){
		this.trigger("open.audit");
	},
	
	initialize: function(){
		var view = this;
		view.animation = { progress: 0 };
	}
});