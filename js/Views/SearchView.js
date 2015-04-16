App.Views.SearchView = App.Views.SectionView.extend({
	el: "#search",
	
	events: {
		
	},
	
	initialize: function(){
		var view = this;
		Backbone.Events.on("login",function(){
			view.show();
		});
	},
	
	render: function(){
		
	}
});