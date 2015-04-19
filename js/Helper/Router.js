App.Router = new (Backbone.Router.extend({
	routes:{
		 "":"login"
		,"login":"login"
		,"search":"search"
		,"addEmployee":"addEmployee"
		,"viewEmployee/:id":"viewEmployee"
	}
}));