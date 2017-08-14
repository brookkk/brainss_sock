    app.controller('ExercicesCtrl', function($scope, PostFactory, $routeParams)
    {   $scope.loading = true;
        var post = PostFactory.getPost($routeParams.id).then(function(post){
            $scope.loading=false;
        //console.log($routeParams.id);
        //console.log("post exos : " + post.exercices);
        //console.log("post exos null : " + (post.exercices !==null));

       // if(post.annee.short === post.short)
       if(post.exercices !=""){
        $scope.exercices = post.exercices;
        $scope.nom = post.nom;
        $scope.id = post.id;

           }
           else
            $scope.nom = "Cette filiere ne contient aucun exercice";
        }, function(msg){
            alert(msg);
        });

        
    });