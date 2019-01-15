app.controller('productsEdtController', function($scope, $http, $rootScope, $routeParams, $location){
	$scope.tabs = 1;//init in first tab
	$scope.resource = {};//resource to edit 
	$scope.images = [];//list of images
	$scope.imgs = {};// image of flow

	//update the images position agording to drag androp position list
	$scope.sortableOptions = {
		stop: function(){
			$http({
			  method: 'POST',
			  url: '/Administrator/Catalog/imagesUpdate',
			  data: $scope.images
			}).then(function successCallback(response) {			
			}, function errorCallback(response) {
			});
		}
	};

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
				$scope.list = $scope.images;
			}
				
		}, function errorCallback(response) {
			hideLoader();
		});		
	}
	//back to products admin
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
			
		});
	};

	$scope.deleteImage = function(id){
		$('#Delete').modal('hide');
		showLoader();
		$http({
		  method: 'GET',
		  url: '/Administrator/Catalog/deleteImage/'+id,
		}).then(function successCallback(response) {
			
			if(response.data != false){
				$scope.getResource();
				hideLoader();
			}
		}, function errorCallback(response) {
			
			hideLoader();
		});
	};
	$scope.deleteImageModal = function(id){
		$('#Delete').modal('show');
		$scope.id = id;
	}

	$scope.AddImages = function(){

		var formData = new FormData();
		$scope.imgs.flow.upload();
		//add images to FormData
		i=0;
		angular.forEach($scope.imgs.flow.files, function(value) {
		  formData.append('imgs' + i++,value.file);
		});
		formData.append('nImages', i);//num images to upload
		formData.append('idProduct', $scope.resource.id);//id product to attach images 
		showLoader();
		$http.post('/Administrator/Catalog/images',formData,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).then(function successCallback(response) {			
			if(response.data != false){
				//clear a flow  objet of images uploads
				while($scope.imgs.flow.files.length>0){
					$scope.imgs.flow.cancel();
				}
				//to  updete the uploaded images
				$scope.getResource();
				hideLoader();
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.getResource();
});