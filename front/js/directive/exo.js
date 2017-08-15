

    app.factory('PostFactory', function($http, $q, $timeout){

        var factory={
            posts:false,
            getPosts: function(){
                var deferred = $q.defer();
                if(factory.posts!==false){
                    deferred.resolve(factory.posts);
                }else{

                $http.get('http://localhost/brainss/web/app_dev.php/api/filieres')
                    .success(function(data, status) {
                        factory.posts=data;
                        $timeout(function(){
                            deferred.resolve(factory.posts);
                        });
                        deferred.resolve(factory.posts);
                    }).error(function(data, status) {
                        deferred.reject('Impossible de récupérer les exercices.');
                });
                }

                return deferred.promise;
               // return factory.posts;
            },
            getPost: function(id){

                var deferred = $q.defer();
                var post={};
                var posts = factory.getPosts().then(function(posts){
                angular.forEach(posts, function(value, key) {
                    if(id==value.id){
                        post=value;}
                });
                deferred.resolve(post);
                }, function(msg){
                    deferred.reject(msg);
                });
                
                return deferred.promise;
                },


                 getContent: function(id1, id2){

                var deferred = $q.defer();
                var content={};
                var posts = factory.getPosts().then(function(posts){
                angular.forEach(factory.getPost(id1), function(value, key) {
                    
                    if(id2==value.id){
                        content=value;}
                });
                deferred.resolve(content);
                }, function(msg){
                    deferred.reject(msg);
                });
                return deferred.promise;
                },

            }


        return factory;
    }  )