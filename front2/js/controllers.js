	brains.controller("brainsCtrl", function($scope, brainsService2, $http,$q){

    		$scope.cars = [];
    		$scope.colors=["white", "black", "blue", "red", "silver"];
    		$scope.appTitle="Exercices";






         // retreiveExos : se charge de la récupération des exos du BO (Rest API) et les mettre dans "scope.parties"

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


            // eval_rep : pour un tableau de réponses [t, t, f, f] (récupéré depuis le view) on donne 2^t comme évaluation ->
            // utile pour évaluer le cas où y a plus qu'une réponse correcte

            $scope.eval_rep = function(reponses){
            var eval=0;
            for(var i=0; i<reponses.length; i++){
                if(reponses[i]===true)
                    eval += Math.pow(2,i);
                }
            return eval;
            };




            retreiveExos();


$scope.evaluation = 0;
$scope.max = 0;


                // fct qui se charge de l'évaluation des réponses : comparaison des réponses données vs la réponse ->
                // récupérée depuis le BO ; cette fct est appelée depuis le view

                $scope.evaluateForm = function(){
                //réinitialiser l'évaluation pour que ça n'icrémente pas à chaque clic
                $scope.evaluation = 0;
                $scope.max=0;
               
               //boucle sur les parties
                $scope.parties.forEach(function(part){
                    //boucle sur les questions
                    part.exo_questions.forEach(function(question){
                        $scope.answers = [question.rep_1, question.rep_2, question.rep_3, question.rep_4];
                        var eval = $scope.eval_rep($scope.answers);
                        if( eval == question.valeur){
                            // L'évaluation de l'exo est incrémentée par 1* le barême de la question
                            $scope.evaluation+= ( question.bareme );
                            }
                        $scope.max += question.bareme;
               


                    });
                });


                console.log ("votre score est  " + $scope.evaluation + " / " + $scope.max);
                //console.log ("Le max est  " + $scope.max);
                return $scope.evaluation;
                
            };


    //$scope.evaluateForm();



    	});	


