    app.controller('ExercicesContentCtrl', function($scope, PostFactory, $routeParams)
    {   $scope.loading = true;

        var post = PostFactory.getContent($routeParams.id, $routeParams.id_exo).then(function(post){

            $scope.loading=false;
        //console.log($routeParams.id);
        console.log("post exos : "); console.log(post);
        

       // console.log("post exos null : " + (post.exercices !==null));

       // if(post.annee.short === post.short)
       
        $scope.content = post.contenu;
        $scope.nom = post.nom;
           
        }, function(msg){
            alert(msg);
        });

        
    });