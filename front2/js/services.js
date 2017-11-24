
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