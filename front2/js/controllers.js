


 	parking.controller("parkingCtrl", function($scope, parkingService2, $http){



    		$scope.cars = [];

    		$scope.colors=["white", "black", "blue", "red", "silver"];

    		$scope.appTitle="the app title";

    		$scope.park = function(car){
    			car.entrance = new Date();
    			$scope.cars.push(car);
    			delete $scope.car;
    		};

          $scope.calculateTicket = function(car){
                $scope.ticket = parkingService2.calculateTicket(car);
            };







            // EXERCICES


            $scope.exos = [];


            var retreiveExos = function(){

                 $http.get("http://localhost/brainss/web/app_dev.php/api/exercices")
                    .success(function(data, status, headers, config){
                        $sope.exos = data;
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