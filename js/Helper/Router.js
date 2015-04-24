//
// FILE       : Router.js
// PROJECT    : EMS
// PROGRAMMER : Ben Lorantfy, Grigory Kozyrev, Kevin Li, Michael Dasilva
// DATE       : April 19, 2015
//

//
// Sets up routes for Backbone router (i.e. let user naviagte ajax app with back and forward buttons)
//
App.Router = new (Backbone.Router.extend({
	routes:{
		 "":"login"
		,"login":"login"
		,"search":"search"
		,"addEmployee":"addEmployee"
		,"audit":"audit"
		,"viewEmployee/:type/:id":"viewEmployee"
		,"reports":"reports"
		,"timecard/:id":"timecard"
	}
}));