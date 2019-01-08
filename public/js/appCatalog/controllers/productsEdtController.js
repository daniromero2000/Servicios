app.controller('productsEdtController', function($scope, $http, $rootScope, $routeParams, $location){
	$scope.tabs = 1;
	$scope.resource = {};
	$scope.getResource = function(){
		showLoader()
		$http({
		  method: 'GET',
		  url: '/products/'+$routeParams.id_product+'/edit'
		}).then(function successCallback(response) {
			hideLoader()
			if(response != false){
				$scope.resource = response.data.product;
				$scope.lines = response.data.lines;
				$scope.brands = response.data.brands;
				$scope.cities = response.data.cities;
			}	
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});		
	}

	$scope.volver = function(){
		$location.url('/Products');
	};


	$scope.UpdateResource = function(){
		$http({
		  method: 'PUT',
		  url: '/products/'+$scope.resource.id,
		  data: $scope.resource
		}).then(function successCallback(response) {
			if(response.data != false){
				alert("Producto actualizado");
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.getResource();
});