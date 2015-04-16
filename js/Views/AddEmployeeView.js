App.Views.AddEmployeeView = App.Views.SectionView.extend({
	events: {
		 "change .field":"checkErrors"
		,"click addButton":"add"
	},
	
	checkErrors:function(e){
		this.model.set(e.target.className,e.target.value);
		this.model.validate();
	},
	
	add:function(){
	    this.model.save({
		    success:function(model,response){
			    console.log("success:",model,response);
		    }
		    ,error:function(model,response){
			    console.log("error:",model,response);
		    }
	    });		
	},
	
	initialize: function(){
		var view = this;
		
		//
		// Bind validation to model
		//
		Backbone.Validation.bind(this);
		this.model.bind("validated",function(isValid, model, errors){
			// Clear all current errors
			view.$el.find(".fieldError").empty();
			
			// Add all new errors
			for(var field in errors){
				console.log(errors[field]);
				view.$el.find("." + field).closest("tr").find(".fieldError").text(errors[field]);
			}
		});
	    
	    // When user wants to open add employee dialog, show employee
		Backbone.Events.on("openAddEmployee",function(){
			view.dialogyShow();
		});
	}
});