App.Views.EmployeeView = App.Views.SectionView.extend({
	events: {
		 "change .field":"checkErrors"
		,"click .addButton":"add"
		,"change .employeeType":"switchType"
		,"click .doneButton":"done"
		,"click .editButton":"edit"
		,"click .saveButton":"save"
		,"click .cancelButton":"cancel"
	},
	
	checkErrors: function(e){
		this.model.set(e.target.className,e.target.value);
		this.model.validate();
	},
	
	edit:function(){
		this.$el.find(".field").each(function(){
			var input = $(this).find("input");
			var div = $(this).find("div");
			input.show();
			div.hide();
		});
		this.$el.find(".editButton").hide();
		this.$el.find(".saveButton").show();
		this.$el.find(".cancelButton").show();
		
	},
	
	cancel:function(){
		this.$el.find(".field").each(function(){
			var input = $(this).find("input");
			var div = $(this).find("div");
			div.show();
			input.hide();
		});
		this.$el.find(".editButton").show();
		this.$el.find(".saveButton").hide();
		this.$el.find(".cancelButton").hide();
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
		if(this.$el.find(".editButton").length != 0){
			this.cancel();
		}
		this.trigger("done");
	},
	
	switchType: function(override,id){
		var $el = this.$el;
		if(override){
			var type = override.toLowerCase();
			
			$.ajax({
			    url: '/employees/' + type + "/" + id,
			    type: 'GET',
			    dataType:"json",
			    success: function(data){
			    	console.log(data);
			       	for(var key in data){
			       		var td = $el.find("." + key);
			       		console.log(td[0]);
			       		td.find("div").html(data[key]);
			       		td.find("input").val(data[key]);
			       	}
			    }
			    ,error:function(data){
				    console.log(data);
			    }
			});
			
			
		}else{
			var type = $el.find(".employeeType").val().toLowerCase();
		}
		var view = this;
		$el.find(".unselectedField").removeClass("unselectedField");
		$el.find(".field:not(." + type + "Field)").addClass("unselectedField");
		
		//
		// Update model type
		//
		switch(type){
			case "fulltime":
				view.model = new App.Models.FullTimeEmployeeModel();
				break;
			case "parttime":
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