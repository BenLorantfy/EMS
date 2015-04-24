//
// FILE       : TimecardView.js
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
App.Views.TimecardView = App.Views.SectionView.extend({
	events: {
		 "click .doneButton":"done"
		,"click .saveButton":"save"
	},
	
	done: function(){
		this.trigger("done");
	},
	
	generate:function(){
		this.trigger("save");
	},
	
	initialize: function(){
		var view = this;
		
	}
});