//
// FILE       : ReportsView.js
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//
App.Views.ReportsView = App.Views.SectionView.extend({
	events: {
		 "click .doneButton":"done"
		,"click .generateButton":"generate"
	},
	
	done: function(){
		this.trigger("done");
	},
	
	generate:function(){
		this.trigger("generate",{ type:this.$el.find(".reportOption:checked").val() });
	},
	
	initialize: function(){
		var view = this;
		
	}
});