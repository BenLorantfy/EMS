App.Views.ReportsView = App.Views.SectionView.extend({
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