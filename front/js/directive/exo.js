app.directive('ngExo', function(){
    return {
        restrict: 'E',
        scope: {
            exercice :'='
        },
        templateUrl :"./partials/_exo.html	"
        };
})

app.directive('time', function(dateFilter, $interval){
    return{
        restrict: 'E',
        template: '{{time}}',
        scope:{

        },
        link: function(scope, element, attrs){
            scope.time = dateFilter(new Date(), 'hh:mm:ss');
        }
    }

})
