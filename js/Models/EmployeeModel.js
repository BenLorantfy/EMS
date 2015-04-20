//
// Use a self-executing function to protect the global scope
//
(function(){
	
	//
	//check for invalid character for name
	//
	function alphabetical(value){
		if(typeof value !== "undefined")
		{
			var letters = /^[A-Za-z '-]+$/;
			if(!value.match(letters))
			{
				return 'Contains illegal characters';
			}
		}
	}
	
	//
	//check for numerical (sin)
	//
	function checkSin(value) {   
		if(typeof value !== "undefined")
		{
			value.trim(); 
			var number = /^[0-9 ]+/;
			var pattern = /^\d{3} \d{3} \d{3}$/;
			inStr = value;
			sin = value;
			inLen = inStr.length;
			var ch_sum = "";
			var esum = 0;
			
			if (!value.match(number)) {
				return 'Contains illegal characters';
			}
			if(!value.match(pattern))
			{
				return 'Incorrect format. e.g. 123 123 123';
			}

			lastdigit = value.substring(10, 10 + 1);
			// add numbers in odd positions; IE 1, 3, 6, 8		
			var odd = ((value.substring(0,0 + 1)) * (1.0)  + (value.substring(2,2 + 1)) * (1.0) 
			+(value.substring(5, 5+1)) * (1.0) + (value.substring(8,8 + 1)) * (1.0));
										
			// form valueing of numbers in even positions IE 2, 4, 6, 8
			var enumbers =  (value.substring(1,1 + 1)) + (value.substring(4,4 + 1))+
			(value.substring(6,6 + 1)) + (value.substring(9,9 + 1));
							
			// add together numbers in new value string
			// take numbers in even positions; IE 2, 4, 6, 8
			// and double them to form a new value string
			// EG if numbers are 2,5,1,9 new value string is 410218
			for (var i = 0; i < enumbers.length; i++) {
					var ch = (enumbers.substring(i, i + 1) * 2);
					ch_sum = ch_sum + ch;
					}
			
			for (var i = 0; i < ch_sum.length; i++) {
					var ch = (ch_sum.substring(i, i + 1));
					esum = ((esum * 1.0) + (ch * 1.0));
					}
			checknum = (odd + esum);
				
			// subvalueact checknum from next highest multiple of 10
			// to give check digit which is last digit in valid SIN
			if (checknum <= 10) {
				(checdigit = (10 - checknum));
			}
			if (checknum > 10 && checknum <= 20) {
				(checkdigit = (20 - checknum));
			}
			if (checknum > 20 && checknum <= 30) {
				(checkdigit = (30 - checknum));
			}
			if (checknum > 30 && checknum <= 40) {
				(checkdigit = (40 - checknum));
			}
			if (checknum > 40 && checknum <= 50) {
				(checkdigit = (50 - checknum));
			}
			if (checknum > 50 && checknum <= 60) {
				(checkdigit = (60 - checknum));
			}
							
			if (checkdigit != lastdigit) {
				return "This is an invalid SIN";
			}					  			
		}	  
	}
	
    //
    //check for numerical (bn)
    //
	function checkBn(value) {
		if(typeof value !== "undefined")
		{
			value.trim(); 
			var number = /^[0-9 ]+/;
			var pattern = /^(0|\d{5} \d{4})$/;
			if (!value.match(number)) {
				return 'Contains illegal characters';
			}
			if (!value.match(pattern)) {
				return 'Incorrect format. e.g. 12345 1234';
			}
		}
	}

    //
    //check for date format (birthday, dateOfHire)
    //
	function checkDateFormat(value) {
		if(typeof value !== "undefined")
		{	 
			value.trim();
			var pattern = /^0$|^((19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01]))$/;
			if (!value.match(pattern)) {
				return 'Incorrect format. e.g. yyyy-mm-dd';
			}
		}
	}

	//
    //check for date in the future (birthday, dateOfHire)
    //
	function checkFutureDate(value) {
		if(typeof value !== "undefined")
		{	 
			value.trim();
			var date = new Date(value);
			var today = new Date();
			if(date > today)
			{
				return 'This date cannot be set to the day in the future';
			}
		}
	}
	
    //
    //check for date format (DateOftermination)
    //
	function checkTDateFormat(value) {
		if(typeof value !== "undefined")
		{
			value.trim(); 
			var result = checkDateFormat(value);
			
			
			//cross field check
			var date = new Date(value);
			var birthday = new Date(this.get("dateOfBirth"));
			if(typeof birthday !== "undefined")
			{
				if (date > birthday) {
					return 'This date cannot be greater than birthday';
				}
			}
		}    
	}

	//
    //check for date format (DateOfHire)
    //
	function checkHDateFormat(value) {
		if(typeof value !== "undefined")
		{
			value.trim(); 
			var pattern = /^0$|^(N[/]A)$|^((19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01]))$/;
			if (!value.match(pattern)) {
				return 'Incorrect format. e.g. yyyy-mm-dd';
			}

			//cross field check
			var date = new Date(value);
			var birthday = new Date(this.get("dateOfBirth"));
			var dateOfTermination = new Date(this.get("dateOfTermination"));
			if(typeof birthday !== "undefined")
			{
				if (date > birthday) {
					return 'This date cannot be greater than birthday';
				}
			}
			if(typeof dateOfTermination !== "undefined")
			{
				if (date > dateOfTermination) {
					return 'This date cannot be greater than date of terminated';
				}
			}
		}    
	}
	
	//
	//change the visibility of the leaving reason 
	//
	function visibilityOfLeavingReason(value) {
		if(/\S/.test(value))
		{
			$("#reasonOfLeavingTr").show();
		}
		else
		{
			$("#reasonOfLeavingTr").hide();
		}
	}
	
	// 
	// Base employee validation rules
	// Should contain required:false for all fields, beacuse employees can be inserted into the db incomplete
	//
	var baseRules = {
		// base employee validation rules go here (i.e. names, date of birth)
		firstName:{
			 required:false
			 ,fn:alphabetical
		}, 
		lastName:{
			required:false
			,fn:alphabetical
		},
		sin:{
			required:false
			,fn:checkSin
		},
		dateOfBirth:{
			required:false
			, fn: function (value) {
				if(typeof value !== "undefined")
				{	
					value.trim();
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					var futureDay = checkFutureDate(value);
					if(typeof futureDay !== "undefined")
					{
						return futureDay;
					}
				}
			}
		},
		companyName:{
			required:false
			,fn:alphabetical
		}
    }
    
    //
    // Extend base employee validation rules with full time employee validation rules
    //
	var fullTimeRules = _.extend({
	    // full time validation rules go here
	    salary:{
			required: false
			,min:0
	    }
	    ,dateOfHire:{
	        required: false
			, fn: function (value) {
				if(typeof value !== "undefined")
				{		
					value.trim();
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					var futureDay = checkFutureDate(value);
					if(typeof futureDay !== "undefined")
					{
						return result;
					}
					
					//cross field check
					var date = new Date(value);
					var birthday = new Date(this.get("dateOfBirth"));
					if(typeof birthday !== "undefined"){
						if (date < birthday) {
							return 'This date cannot be set before birthday';
						}
					}
					var dateOfTermination = new Date(this.get("dateOfTermination"));
					if(typeof dateOfTermination !== "undefined"){
						if (date > dateOfTermination) {
							return 'This date cannot be set after the date of termination';
						}
					}
				}
			}
	    }
        , dateOfTermination: {
            required: false
            , fn: function (value) {
				if(typeof value !== "undefined")
				{
					value.trim();
					visibilityOfLeavingReason(value);
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					
					//cross field check
					var date = new Date(value);
					var birthday = new Date(this.get("dateOfBirth"));
					if(typeof birthday !== "undefined"){
						if (date < birthday) {
							return 'This date cannot be set before birthday';
						}
					}
					var dateOfHire = new Date(this.get("dateOfHire"));
					if(typeof dateOfHire !== "undefined"){
						if (date < dateOfHire) {
							return 'This date cannot be set before the date of hired';
						}
					}
				}
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
		    , required: false
	    }
        , dateOfHire: {
            required: false
			, fn: function (value) {
				if(typeof value !== "undefined")
				{
					value.trim();
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					var futureDay = checkFutureDate(value);
					if(typeof futureDay !== "undefined")
					{
						return result;
					}
					
					//cross field check
					var date = new Date(value);
					var birthday = new Date(this.get("dateOfBirth"));
					if(typeof birthday !== "undefined"){
						if (date < birthday) {
							return 'This date cannot be set before birthday';
						}
					}
					var dateOfTermination = new Date(this.get("dateOfTermination"));
					if(typeof dateOfTermination !== "undefined"){
						if (date > dateOfTermination) {
							return 'This date cannot be set after the date of termination';
						}
					}
				}
			}
        }
        , dateOfTermination: {
            required: false 
			, fn: function (value) {
				if(typeof value !== "undefined")
				{
					value.trim();
					visibilityOfLeavingReason(value);
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					
					//cross field check
					var date = new Date(value);
					var birthday = new Date(this.get("dateOfBirth"));
					if(typeof birthday !== "undefined"){
						if (date < birthday) {
							return 'This year cannot be set before birthday';
						}
					}
					var dateOfHire = new Date(this.get("dateOfHire"));
					if(typeof dateOfHire !== "undefined"){
						if (date < dateOfHire) {
							return 'This date cannot be set before the date of hired';
						}
					}
				}
			}			
        }
    },baseRules);
    
    //
    // Extend base employee validation rules with seasonal employee validation rules
    //
    var seasonalRules = _.extend({
        // seasonal employee validation rules go here 
        season: {
            required: false
            , fn: function (value) {
				if(typeof value !== "undefined")
				{
					value.trim();
					if ((value !== 'WINTER') && (value !== 'SPRING')
						&& (value !== 'SUMMER') && (value !== 'FALL')) {
						return 'false';
					}
				}	
            }
        }
        , piecePay: {
            min: 0
            , required: false

        }
        , seasonYear: {
            min: 0
            , required: false
            , fn: function (value) {
				if(typeof value !== "undefined")
				{
					value.trim();
					var number = /^[0-9 ]+/;
					var pattern = /^((19|20)\d\d)$/;
					if (!value.match(number)) {
						return 'Contains illegal characters';
					}
					if (!value.match(pattern)) {
						return 'Incorrect format. e.g. yyyy';
					}

					//cross field check
					var date = new Date(value);
					var birthday = new Date(this.get("dateOfBirth"));
					if(typeof birthday !== "undefined"){	
						if (date.getFullYear() < birthday.getFullYear()) {
							return 'This year cannot be set before birthday';
						}
					}
				}
            }
        }
            
    },baseRules);
    
    //
    // Contract employee validation rules
    //
    var contractRules = {
        // contract employee validation rules go here
        fixedContractAmount: {
            min: 0
		    , required: false
        }
		,contractCompanyName:{
			required: false
			,fn:alphabetical
		}
		,dateOfIncorporation:{
				fn: function (value) {
				if(typeof value !== "undefined")
				{
					value.trim();
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					var futureDay = checkFutureDate(value);
					if(typeof futureDay !== "undefined")
					{
						return result;
					}
					
					//cross field check
					var date = new Date(value);
					var startDate = new Date(this.get("startDate"));
					if(typeof startDate !== "undefined"){	
						if (date > startDate) {
							return 'This date cannot be set after the date contract started';
						}
					}
					var endDate = new Date(this.get("endDate"));
					if(typeof endDate !== "undefined"){	
						if (date > endDate) {
							return 'This date cannot be set after the date of contract stopped';
						}
					}
				}
            }
			, required: false
		}
		,businessNumber:{
			fn:checkBn
			, required: false
		}
		,startDate:{
			fn: function(value)
			{
				if(typeof value !== "undefined")
				{
					value.trim();
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}
					var futureDay = checkFutureDate(value);
					if(typeof futureDay !== "undefined")
					{
						return result;
					}
					
					//cross field check
					var date = new Date(value);
					var dateOfIncorporation = new Date(this.get("dateOfIncorporation"));
					if(typeof dateOfIncorporation !== "undefined"){	
						if (date < dateOfIncorporation) {
							return 'This date cannot be set before the date of incorporation';
						}
					}
					var endDate = new Date(this.get("endDate"));
					if(typeof endDate !== "undefined"){	
						if (date > endDate) {
							return 'This date cannot be set after the date of contract stopped';
						}
					}
				}
			}
			, required: false
		}
		,endDate:{
			fn: function(value)
			{
				if(typeof value !== "undefined")
				{
					value.trim();
					visibilityOfLeavingReason(value);
					var result = checkDateFormat(value);
					if(typeof result !== "undefined")
					{
						return result;
					}

					//cross field check
					var date = new Date(value);
					var dateOfIncorporation = new Date(this.get("dateOfIncorporation"));
					if(typeof dateOfIncorporation !== "undefined"){	
						if (date < dateOfIncorporation) {
							return 'This date cannot be set before the date of incorporation';
						}
					}
					var startDate = new Date(this.get("startDate"));
					if(typeof startDate !== "undefined"){	
						if (date < startDate) {
							return 'This date cannot be set before the date of contract started';
						}
					}
				}
			}
			, required: false
		}
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


