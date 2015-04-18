App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		"click .addEmployeeButton":"openAddEmployee"
	},
	
	openAddEmployee:function(){
		this.trigger("open.addEmployee");
	},
	
	initialize: function(){
		var view = this;
		view.animation = { progress: 0 };
	}
});