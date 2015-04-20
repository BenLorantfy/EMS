App.Router = new (Backbone.Router.extend({
	routes:{
		 "":"login"
		,"login":"login"
		,"search":"search"
		,"addEmployee":"addEmployee"
		,"audit":"audit"
		,"viewEmployee/:id":"viewEmployee"
		,"reports":"reports"
	}
}));