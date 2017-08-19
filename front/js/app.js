 var app= angular.module('MonApp', ['ngRoute']);
    app.config(function($routeProvider){
        $routeProvider
            .when('/', {templateUrl: 'partials/filieres.html', controller: 'FilieresCtrl'})
            //.when('/comments/:id', {templateUrl: 'partials/comments.html', controller: 'CommentsCtrl'})
            .when('/exercices/:id', {templateUrl: 'partials/exercices.html', controller: 'ExercicesCtrl'})
            .when('/exercices/:id/contenu/:id_exo', {templateUrl: 'partials/contenu.html', controller: 'ExercicesContentCtrl'})
            .otherwise({redirectTo: '/'});
    });