	brains.controller("partiesCtrl", function($scope, brainsService2, $http,$q, $rootScope){

    		$scope.cars = [];
    		$scope.colors=["white", "black", "blue", "red", "silver"];
    		$scope.appTitle="Exercice";

         // retreiveParties : se charge de la récupération des exos du BO (Rest API) et les mettre dans "scope.parties"

            $scope.loading=true;

            $scope.parties = [];

            var retreiveParties = function(){

                 $http.get('../web/app_dev.php/api/exercices/3/parties')
                    .success(function(data, status, headers, config){
                        $scope.parties = data;
                        $scope.loading= false;
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

            retreiveParties();

            //$scope.evaluateForm();


});	


brains.controller("exercicesCtrl", function($scope, $rootScope, brainsService2, $http,$q, $localStorage){

            $scope.appTitle="Exercices";

        $scope.user = $localStorage.currentUser;
        console.log("user : ");console.log($localStorage.currentUser);








             // retreiveExos : se charge de la récupération des exos du BO (Rest API) et les mettre dans "scope.exos"

            $scope.exos = [];
            $scope.loading=true;

            var retreiveExos = function(){

                 $http.get('../web/app_dev.php/api/exercices')
                    .success(function(data, status, headers, config){
                        $scope.exos = data;
            $scope.loading=false;

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



        $scope.user.exo_views = new Array();

 

 

        // for preventing the infinite loop

        $scope.nb_seen=-1;
        $scope.first_show = 0;





var nb_seen=5;

    $scope.has_seen = function(exo_id, user_id){
        
        if($scope.first_show<$scope.exos.length){
            $scope.first_show++;
          $http.get('http://localhost/brainss/web/app_dev.php/api/exercices/'+exo_id+'/user/'+user_id+'/seen')
                    .success(function(data, status, headers, config){
                        console.log ("has seen daata : " + data);
                       // nb_seen =  data;
                        $scope.user.exo_views[exo_id] = data;
                        
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
                    });}
        
                    //return nb_seen;

    };






 




             $scope.view = function(id){

                $http.put('http://localhost/brainss/web/app_dev.php/api/exercices/'+id+'/view')
                    .success(function(data, status, headers, config){
                        console.log("success");

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

            $scope.solve = function(id){

                $http.put('http://localhost/brainss/web/app_dev.php/api/exercices/'+id+'/solve')
                    .success(function(data, status, headers, config){
                        console.log("success");})
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

    });



    brains.controller("exerciceCtrl", function($scope, brainsService2, $http, $q, brainsHttpFacade, $routeParams,$localStorage){

    $scope.loading=true;
    $scope.parties= [];


    $scope.user = $localStorage.currentUser;

    $scope.appTitle="Exercice";


    var retreiveExercice = function(id){

     brainsHttpFacade.getExercice(id)
         .success(function(data, status, headers, config){
         $scope.parties = data;
         $scope.loading=false;

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

    retreiveExercice($routeParams.id);







    $scope.solve_bool=0;
    $scope.view_bool=0;
    $scope.exo_id = $routeParams.id;

     $scope.view = function(id_exo, id_user){
    if($scope.view_bool==0){
    $scope.view_bool=1;


                //incrémenter le nombre des vues de l'exo (point de vue exo)
                $http.put('http://localhost/brainss/web/app_dev.php/api/exercices/'+id_exo+'/view')
                    .success(function(data, status, headers, config){

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



                //incrémenter le nombre de fois le user a vu l'exo (pt de vue user)
                $http.put('http://localhost/brainss/web/app_dev.php/api/exercices/'+id_exo+'/user/'+id_user)
                    .success(function(data, status, headers, config){
 
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

            }                        
            };

        $scope.solve = function(id){
            if($scope.solve_bool==0){
                $scope.solve_bool=1;

                brainsHttpFacade.solveExercice(id)
                    .success(function(data, status, headers, config){
                        console.log("success");})
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
                            default : {
                                $scope.message = "Something went wrong!";
                                break;
                            }
                        }
                        
                    });           
            }                        
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

            if($scope.evaluation>0 && $scope.evaluation==$scope.max)
                $scope.solve(9); // ????


    });




    brains.controller("loginCtrl", function($scope, $location, AuthenticationService,$localStorage, $rootScope){

 
        $scope.username = '';
        $scope.password = '';

 
        initController();

        function initController() {
            // reset login status
            AuthenticationService.Logout();
        };


        $scope.login2 = function(){

            $scope.loading = true;
            AuthenticationService.Login($scope.username, $scope.password, function (result) {
                if (result === true) {
                    $location.path('/exercices');
                } else {
                    $scope.error = 'Username or password is incorrect';
                    $scope.loading = false;
                }
            });
        };


    });
    
