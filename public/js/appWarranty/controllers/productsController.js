	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion productos
    **Fecha: 19/12/2018
     **/
app.controller('productsController', function($scope, $http, $rootScope, $ngBootbox, $location){
	$ngBootbox.setLocale('es');
	$scope.q = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false,
		'city': '',
		'brand': '',
		'line':'',

	};//object for index and filter 
	$scope.resource = {}; //object for index line
	$scope.resources = [];//list of resource returned by server
	$scope.lines = []; //list of lines returned by server
	$scope.brands = []; //list of brands returned by server
	$scope.cities = []; //list of cities returned by server
	$scope.filtros = false; // display a filter card
	$scope.activ  = true; // display delete action for each resourse if this is activ 
	$scope.imgs = [];

 
	$scope.addResource= function(){
		$scope.resource = {};
		$("#addResourceModal").modal("show");
	};
    
	// query of Resource index and with filter 
	$scope.getResource = function(){
		showLoader();
		//display or not the delete action
		if($scope.q.delete){
			$scope.activ = false;
		}else{
			$scope.activ = true;
		}
         
		$http({
		  method: 'GET',
		  url: '/products?q='+$scope.q.q+'&page='+$scope.q.page+'&actual='+$scope.q.actual+'&delete='+$scope.q.delete+'&city='+$scope.q.city+'&brand='+$scope.q.brand+'&line='+$scope.q.line
		}).then(function successCallback(response) {
			if(response != false){
				angular.forEach(response.data.products, function(value) {
					$scope.resources.push(value);
				});
				$scope.lines = response.data.lines;
				$scope.brands = response.data.brands;
				$scope.cities = response.data.cities;
				
				hideLoader();
			}	
		}, function errorCallback(response) {
			hideLoader();
		});
	};
	//clear the scope variables for do a index query 
	$scope.search = function(){
		$scope.resource = {};
		$scope.resources = [];
		$scope.q.actual = 1;
		$scope.q.page = 30;
		$scope.brands = [];
		$scope.lines = [];
		$scope.cities = [];
		$scope.getResource();
	};

	$scope.resetFilters = function(){

		$scope.q.city = '';
		$scope.q.brand = '';
		$scope.q.line = '';
	};

	$scope.moreRegister = function(){
		$scope.q.actual = $scope.q.actual + 1;
		getResource()
	};

	$scope.createResource = function(){
		
		showLoader();
		$http({
		  method: 'POST',
		  url: '/products',
		  data: $scope.resource
		}).then(function successCallback(response) {			
			hideLoader();
			$("#addResourceModal").modal("hide");
			if(response != false){
				$location.url("Products/" + response.data);
			}	
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.edtResource = function(idResource){
		$location.url("Products/" + idResource);
	};

	$scope.showDialog = function(resource){
		$("#Show").modal("show");
		$scope.resource = resource;
	};

	$scope.showDialogDelete = function(resource){
		$("#Delete").modal("show");
		$scope.resource = angular.extend({}, resource);
	};

	$scope.deleteResource = function(idResource){
		$http({
		  method: 'DELETE',
		  url: '/products/' + idResource
		}).then(function successCallback(response){	
			if(response.data != false){
				$("#Delete").modal("hide");
				$scope.search();
			}
		},function errorCallback(response){
		});
	}

	$scope.getResource();

});