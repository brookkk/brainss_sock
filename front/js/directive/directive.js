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
            scope.time = dateFilter(new Date(80), 'hh:mm:ss');

            element.on('$destroy', function(){
                $interval.cancel(interval);

            })

            interval = $interval(function(){
                scope.time = dateFilter(new Date(80), 'hh:mm:ss');
                console.log('time changed');
            }, 1000)
        }
    }

})
