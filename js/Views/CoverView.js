App.Views.Cover = Backbone.View.extend({
	el: "#cover",
	
	events: {
		"click":function(){
			Backbone.Events.trigger("dismiss");
		}
	}
});