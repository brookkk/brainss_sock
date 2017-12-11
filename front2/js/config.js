brains.config(function($routeProvider){

	$routeProvider.
	when("/exercices", {
		templateUrl: "exercices.html",
		controller: "exercicesCtrl"
	}).
	when("/exercice/:id", {
		templateUrl: "exercice.html",
		controller: "exerciceCtrl"
	}).
	otherwise({
		redirectTo : 'exercices'
	});


});