app.directive('ngExo', function(){
    return {
        restrict: 'E',
        scope: {
            exercice :'='
        },
        templateUrl :"./partials/_exo.html	"
        };
})
