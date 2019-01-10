app.controller('productsEdtController', function($scope, $http, $rootScope, $routeParams, $location){
	$scope.tabs = 1;
	$scope.resource = {};
	$scope.images = [];
	$scope.imgs = {};

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
				$scope.images = response.data.images;
			}
			console.log($scope.images)	
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

		$scope.deleteImage = function(id){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/Administrator/Catalog/deleteImage/'+id,
		}).then(function successCallback(response) {
			console.log(response);
			if(response.data != false){
				$scope.getResource();
				hideLoader();
			}
		}, function errorCallback(response) {
			console.log(response);
			hideLoader();
		});
	};

	$scope.AddImages = function(){

		var formData = new FormData();
		$scope.imgs.flow.upload();
		i=0;
		angular.forEach($scope.imgs.flow.files, function(value) {
		  formData.append('imgs' + i++,value.file);
		});
		formData.append('nImages', i);
		formData.append('idProduct', $scope.resource.id);
		showLoader();
		$http.post('/Administrator/Catalog/images',formData,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).then(function successCallback(response) {			
			if(response.data != false){
				while($scope.imgs.flow.files.length>0){
					$scope.imgs.flow.cancel();
				}
				console.log($scope.imgs.flow.files);
				$scope.getResource();
				hideLoader();
				console.log(response);
			}
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.getResource();
});