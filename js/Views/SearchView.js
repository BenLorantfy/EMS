App.Views.SearchView = App.Views.SectionView.extend({
	el: "#search",
	
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
			view.show();
		});
	}
});