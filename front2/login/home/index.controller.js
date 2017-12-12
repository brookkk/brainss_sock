(function () {
    'use strict';

    angular
        .module('app')
        .controller('Home.IndexController', Controller);

    function Controller($scope, $rootScope) {
        var vm = this;

        initController();

        $scope.user = $rootScope.response;
        console.log ("response : ");
        console.log ($scope.user);

        function initController() {
        }
    }

})();