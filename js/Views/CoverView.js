//
// FILE       : CoverView.js
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
App.Views.Cover = Backbone.View.extend({
	el: "#cover",
	
	events: {
		"click":function(){
			Backbone.Events.trigger("dismiss");
		}
	}
});