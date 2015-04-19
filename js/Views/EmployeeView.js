App.Views.EmployeeView = App.Views.SectionView.extend({
	events: {
		 "change .field":"checkErrors"
		,"click .addButton":"add"
		,"change .employeeType":"switchType"
		,"click .doneButton":"done"
	},
	
	checkErrors: function(e){
		this.model.set(e.target.className,e.target.value);
		this.model.validate();
	},
	
	add: function(){
		var request = this.model.save();
		
		if(request){
			request.done(function(data){
				console.log(data);
				$.msgBox.success("Employee added sucessfully");
			});
			
			request.fail(function(){
				$.msgBox.error("Failed to add employee");
			});
		}else{
			$.msgBox.error("There are outstanding errors.");
		}
	},
	
	done: function(){
		this.trigger("done");
	},
	
	switchType: function(){
		var $el = this.$el;
		var type = $el.find(".employeeType").val();
		var view = this;
		$el.find(".unselectedField").removeClass("unselectedField");
		$el.find(".field:not(." + type + "Field)").addClass("unselectedField");
		
		//
		// Update model type
		//
		switch(type){
			case "fullTime":
				view.model = new App.Models.FullTimeEmployeeModel();
				break;
			case "partTime":
				view.model = new App.Models.PartTimeEmployeeModel();
				break;
			case "seasonal":
				view.model = new App.Models.SeasonalEmployeeModel();
				break;
			case "contract":
				view.model = new App.Models.ContractEmployeeModel();
				break;
		}
		
		//
		// Update model attributes
		//
		$el.find(".field").each(function(){
			var input = $(this).find("input");
			var key = input.attr("class");
			var value = input.val();
			view.model.set(key,value);
		});
		
		//
		// Rebind backbone.validation
		//
		Backbone.Validation.bind(this);
		this.model.bind("validated",function(isValid, model, errors){
			view.displayErrors(view, isValid, model, errors)
		});
	},
	
	initialize: function(){
		var view = this;
		
		//
		// Bind validation to model
		//
		Backbone.Validation.bind(this);
		this.model.bind("validated",function(isValid, model, errors){
			view.displayErrors(view, isValid, model, errors)
		});
	},
	
	displayErrors:function(view, isValid, model, errors){
		//
		// Clear all current errors
		//
		view.$el.find(".fieldError").each(function(){
			// Don't clear errors of unselected fields
			if(!$(this).parent().hasClass("unselectedField")){
				$(this).empty();
			}
		})

		//
		// Add all new errors
		//
		for(var field in errors){
			var error = errors[field];
			view.$el.find("." + field).closest("tr").find(".fieldError").text(error);
		}		
	}
});