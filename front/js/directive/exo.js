app.directive('ngExo', function(){
    return {
        restrict: 'E',
        scope: {
            exercice :'='
        },
        templateUrl :"./partials/_exo.html	"
        };
})

app.directive('time', function(){
    return{
        restrict: 'E',
        template: '{{time}}',
        scope:{

        },
        link: function(scope, )
    }

})
