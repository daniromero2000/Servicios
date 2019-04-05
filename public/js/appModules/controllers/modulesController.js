app.controller('modulesController', function($scope, $http, $rootScope){
    $scope.modules = [];
    $scope.q = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
    };

    $scope.getModules = function(){
		showLoader();
		//display or not the delete action
		if($scope.q.delete){
			$scope.activ = false;
		}else{
			$scope.activ = true;
		}
         
		$http({
		  method: 'GET',
		  url: 'Administrator/modules'
		}).then(function successCallback(response) {
			if(response != false){
				angular.forEach(response.data, function(value) {
					$scope.modules.push(value);
				});
				
				hideLoader();
			}	
		}, function errorCallback(response) {
			hideLoader();
		});
	};
});