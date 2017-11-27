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

$scope.evaluation = 0;

//$scope.parties.reponses = [];



    $scope.eval_rep = function(reponses){
            var eval=0;
            for(var i=0; i<reponses.length; i++){
                //console.log("inside evel " + i + " responses[i] " + responses[i] );
                if(reponses[i]===true)
                    eval += Math.pow(2,i);
                }
            return eval;
        };





            $scope.evaluateForm = function(){
            $scope.evaluation = 0;
               





                $scope.parties.forEach(function(part){
 
                    part.exo_questions.forEach(function(question){
 
                $scope.answers = [question.rep_1, question.rep_2, question.rep_3, question.rep_4];
                var eval = $scope.eval_rep($scope.answers);

                if( eval == question.valeur)
                    {
                $scope.evaluation+= ( question.bareme );}
               


                    });
                });


                console.log ("votre score est  " + $scope.evaluation);
                return $scope.evaluation;
                
            };







    




    	});	


