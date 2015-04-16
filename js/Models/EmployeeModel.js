App.Models.EmployeeModel = Backbone.Model.extend({
    urlRoot: '/employees',
    validation:{
	    salary:{
		     min:0
		    ,required:false
		    ,fn:function(value){
		    	// list of validators (e.g. min:0): https://github.com/thedersen/backbone.validation/wiki
		    	// full documentation: https://github.com/thedersen/backbone.validation/blob/master/README.md
			    // use this.get("dateOfBirth"); to get another field's value
		    }
	    }
    }
});