app.controller('dashboardAppController', function($scope, $http){
    $modules = {};
    $scope.getCreditPolicy = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/api/dashBoard/getModules'
		}).then(function successCallback(response) {
			hideLoader();
			if(response.status == 401){
				window.location = "/login";
            }
            if(response.data != false){
                $scope.modules = response.data;
            }
		}, function errorCallback(response) {
            console.log(response);
			hideLoader();
		});
    };
    
    $scope.getCreditPolicy();
});