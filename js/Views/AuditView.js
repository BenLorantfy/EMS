//
// FILE       : AuditView.js
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
App.Views.AuditView = App.Views.SectionView.extend({
	events: {
		"click .doneButton":"done"
	},
	
	done: function(){
		this.trigger("done");
	},
	
	initialize: function(){
		var view = this;
		
	}
});