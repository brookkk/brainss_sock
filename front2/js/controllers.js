	brains.controller("brainsCtrl", function($scope, brainsService2, $http,$q){

    		$scope.cars = [];
    		$scope.colors=["white", "black", "blue", "red", "silver"];
    		$scope.appTitle="Exercices";

         // EXERCICES

            $scope.exos = [];

            var retreiveExos = function(){

                 $http.get('../web/app_dev.php/api/exercices')
                    .success(function(data, status, headers, config){
                        $scope.exos = data;
                        //console.log(data);
                    })
                    .error(function(data, status, headers, config){
                        switch(status){
                            case 401 : {
                                $scope.message = "You must be Authenticated!";
                                break;
                            }
                            case 500 : {
                                $scope.message = "Something went wrong!";
                                break;
                            }
                        }
                        console.log(data,status);
                    });
            };

            retreiveExos();

    	});	

