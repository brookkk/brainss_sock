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
	when("/login", {
		templateUrl: "login.html",
		controller: "loginCtrl"
	}).
	otherwise({
		redirectTo : 'login'
	});


});