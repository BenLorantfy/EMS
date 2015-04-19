App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		 "click .addEmployeeButton":"openAddEmployee"
		,"click tr":"openViewEmployee"
	},
	
	openAddEmployee:function(){
		this.trigger("open.addEmployee");
	},
	
	openViewEmployee:function(){
		console.log("yo0");
		this.trigger("open.viewEmployee", { id:42 });
	},
	
	initialize: function(){
		var view = this;
		view.animation = { progress: 0 };
	}
});