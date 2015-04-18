//
// Use a self-executing function to protect the global scope
//
(function(){
	/*
		List of field names
		===================
		
		Common
		======
		firstName
		lastName
		dateOfBirth
		sin
		
		Full Time
		=========
		dateOfHire
		dateOfTermination
		salary
		
		Part Time
		=========
		dateOfHire
		dateOfTermination
		hourlyRate
		
		Seasonal
		========
		season
		seasonYear
		piecePay
		
		Contract
		========
		companyName
		dateOfIncorporation
		businessNumber
		startDate
		endDate
		fixedAmount
	*/
	
	//
	// Base employee validation rules
	// Should contain required:false for all fields, beacuse employees can be inserted into the db incomplete
	//
	var baseRules = {
		// base employee validation rules go here (i.e. names, date of birth)
		firstName:{
			 min:0 // testing only
			,required:false
		}, 
		lastName:{
			 min:0 // testing only
			,required:false
		},
		SIN:{
			 min:0 // testing only
			,required:false
		},
		dateOfBirth:{
			 min:0 // testing only
			,required:false
		}
		
    }
    
    //
    // Extend base employee validation rules with full time employee validation rules
    //
    var fullTimeRules = _.extend({
    	// full time validation rules go here
	    salary:{
		     min:0
		    ,required:false
		    ,fn:function(value){
		    	// return error message if invalid, otherwise return nothing
		    	// list of validators (e.g. min:0): https://github.com/thedersen/backbone.validation/wiki
		    	// full documentation: https://github.com/thedersen/backbone.validation/blob/master/README.md
			    // use this.get("dateOfBirth"); to get another field's value
		    }
	    }	    
    },baseRules);
    
    //
    // Extend base employee validation rules with part time employee validation rules
    //
    var partTimeRules = _.extend({
	    // part time validation rules go here 
	    hourlyRate:{
		     min:0
		    ,required:false
	    }	   
    },baseRules);
    
    //
    // Extend base employee validation rules with seasonal employee validation rules
    //
    var seasonalRules = _.extend({
	    // seasonal employee validation rules go here    
    },baseRules);
    
    //
    // Contract employee validation rules
    //
    var contractRules = {
	    // contract employee validation rules go here
    }
	    
	//
	// Full Time Employee model
	//
	App.Models.FullTimeEmployeeModel = Backbone.Model.extend({
	    urlRoot: '/employees/fulltime',
	    validation:fullTimeRules
	});
	
	//
	// Part Time Employee Model
	//
	App.Models.PartTimeEmployeeModel = Backbone.Model.extend({
		urlRoot: '/employees/parttime',
		validation:partTimeRules
	});	
	
	//
	// Part Time Employee Model
	//
	App.Models.SeasonalEmployeeModel = Backbone.Model.extend({
		urlRoot: '/employees/seasonal',
		validation:seasonalRules
	});	
	
	//
	// Contract Employee Model
	//
	App.Models.ContractEmployeeModel = Backbone.Model.extend({
		urlRoot: '/employees/contract',
		validation:contractRules
	});		
	
})();
