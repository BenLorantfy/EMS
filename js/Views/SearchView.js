App.Views.SearchView = App.Views.SectionView.extend({
	
	events: {
		"click .addEmployeeButton":"openAddEmployee"
	},
	
	openAddEmployee:function(){
		var view = this;
		view.blur();
		Backbone.Events.trigger("openAddEmployee");
	},
	
	initialize: function(){
		var view = this;
		Backbone.Events.on("login",function(){
			window.history.pushState("search", "search", "/search");
			view.show();
		});
	}
});