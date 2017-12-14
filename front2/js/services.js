
brains.factory("brainsService", function(brainsConfig){
	var _calculateTicket = function(car){
		var departHour = new Date().getHours();
		var entranceHour = car.entrance.getHours() -1;

		var brainsPeriod = departHour - entranceHour;
		var brainsPrice = brainsPeriod * brainsConfig.brainsRate ;

		console.log("departHour" + departHour);
		console.log("entranceHour" + entranceHour);
		console.log("brainsPeriod" + brainsPeriod);
		console.log("brainsPrice" + brainsPrice);

		return {
			period : brainsPeriod,
			price : brainsprice
		};
	};

	return {
		calculateTicket : _calculateTicket
	}
});


brains.service("brainsService2", function(brainsConfig){
	this.calculateTicket = function(car){
		var departHour = new Date() . getHours();
		var entranceHour = car.entrance.getHours();

		var brainsPeriod = departHour - entranceHour;
		var brainsPrice = brainsPeriod * brainsConfig.brainsRate ;
		
		console.log("departHour" + departHour);
		console.log("entranceHour" + entranceHour);
		console.log("brainsPeriod" + brainsPeriod);
		console.log("brainsPrice" + brainsPrice);

		return {
			period : brainsPeriod,
			price : brainsprice
		};
	};
});


brains.factory("brainsHttpFacade", function($http){

	var _getExercices = function(){
		return $http.get("http://localhost/brainss/web/app_dev.php/api/exercices");
	};

	var _getExercice= function(id){
		return $http.get("http://localhost/brainss/web/app_dev.php/api/exercices/"+id+"/parties");
	};


	var _solveExercice= function(id){
		console.log("id : " + id);
        return $http.put('http://localhost/brainss/web/app_dev.php/api/exercices/'+id+'/solve');
	};



	return {
		getExercices: _getExercices,
		solveExercice: _solveExercice,
		getExercice: _getExercice
	};

});




brains.factory("AuthenticationService", function($http){

        var service = {};

        service.Login = Login;
        service.Logout = Logout;

        return service;

        function Login(username, password, callback) {
            var user = {username: username, password: password};
            $http.post('http://localhost/brainss/web/app_dev.php/api/authenticate',  user )
                .success(function (response) {
                    // login successful if there's a token in the response
                    if (response.token) {
                        // store username and token in local storage to keep user logged in between page refreshes
                        $localStorage.currentUser = { username: username, token: response.token };
                        console.log(response.user);

                        // add jwt token to auth header for all requests made by the $http service
                        $http.defaults.headers.common.Authorization = 'Bearer ' + response.token;

                        // execute callback with true to indicate successful login
                        callback(true);
                    } else {
                        // execute callback with false to indicate failed login
                        //console.log("bad token");
                        callback(false);
                    }
                });
        }

        function Logout() {
            // remove user from local storage and clear http auth header
            //delete $localStorage.currentUser;
            $http.defaults.headers.common.Authorization = '';
        }
    

});