	brains.controller("brainsCtrl", function($scope, brainsService2, $http,$q){

    		$scope.cars = [];
    		$scope.colors=["white", "black", "blue", "red", "silver"];
    		$scope.appTitle="Exercices";

         // EXERCICES

            $scope.parties = [];

            var retreiveExos = function(){

                 $http.get('../web/app_dev.php/api/exercices/3/parties')
                    .success(function(data, status, headers, config){
                        $scope.parties = data;
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
                        
                    });
            };

            retreiveExos();

            console.log($scope.parties);

$scope.rep = '';

//$scope.parties.reponses = [];

            $scope.evaluateForm = function(valeur, reponse, partie, question){

                //console.log("valeur : " + valeur + " reponse : " + reponse);
                var repp = reponse.split("_");
                console.log("partie : " + partie + " question " + question);
                //console.log("answer : " + repp[1]);
                console.log( "difficult "  + $scope.parties.7);
                if(valeur != repp[1])
                    {console.log("mauvaise reponse");return 0;}
                else
                    {console.log("bonne reponse");return 1;}
            };

console.log("reponse : " + $scope.rep);

    	});	


