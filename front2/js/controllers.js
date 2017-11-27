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



    $scope.eval_rep = function(reponses){
            var eval=0;
            for(var i=0; i<reponses.length; i++){
                //console.log("inside evel " + i + " responses[i] " + responses[i] );
                if(reponses[i]===true)
                    eval += Math.pow(2,i);
                }
            return eval;
        };




        //console.log ("evaluation : " + $scope.eval_rep([false,false, false, true]));

            $scope.evaluateForm = function(valeur, reponse, partie, question){

               // console.log("valeur : " + valeur + " reponse : " + reponse.rep_4);
                //var repp = reponse.split("_");
               // console.log("partie : " + partie + " question " + question);
                //console.log("answer : " + repp[1]);
               // console.log( "difficult "  );console.log($scope.parties);





                $scope.parties.forEach(function(part){
                    //console.log(part.exo_questions);

                    part.exo_questions.forEach(function(question){
                        //console.log(question);
                    });
                });



                console.log("VALEUR " + valeur);
                $scope.answers = [reponse.rep_1, reponse.rep_2, reponse.rep_3, reponse.rep_4];
                //console.log("evaluation : " + $scope.eval_rep($scope.answers));

                var eval = $scope.eval_rep($scope.answers);

                //console.log("weird response " + (reponse.rep_+(valeur+1)));


                if( eval != valeur)
                    {console.log("mauvaise reponse");return 0;}
                else
                    {console.log("bonne reponse");return 1;}
            };







    




    	});	


