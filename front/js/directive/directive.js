app.directive('ngExo', function(){
    return {
        restrict: 'E',
        scope: {
            exercice :'='
        },
        templateUrl :"./partials/_exo.html"
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

            element.on('$destroy', function(){
                $interval.cancel(interval);

            })

            interval = $interval(function(){
                scope.time = dateFilter(new Date(), 'hh:mm:ss');
                console.log('time changed');
            }, 1000)
        }
    }

})

app.directive('ngTabs', function(){

    return{
        restrict: 'E',
        transclude: true,
        scope: {},
        templateUrl:'partials/tabs.html',
        controller: function(){
            this.clic = function(title){
                alert(title);
            }
        }
    }
})

app.directive('ngTab', function(){

    return{
        restrict: 'E',
        transclude: true,
        scope: {
            title: '@'
        },
        templateUrl:'partials/tab.html',
        require: '^ngTabs',
        link: function(scope, element, attrs, tabsCtrl){
            element.click(function(){
                tabsCtrl(scope.title);
            })
        }
    }
})