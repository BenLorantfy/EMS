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