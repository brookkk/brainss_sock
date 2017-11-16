   app.controller('CommentsCtrl', function($scope, PostFactory, $routeParams)
    {
        var post = PostFactory.getPost($routeParams.id).then(function(post){
        console.log(post);
        $scope.comments = post.comments;
        $scope.title = post.name;
            
        }, function(msg){
            alert(msg);
        });



    });