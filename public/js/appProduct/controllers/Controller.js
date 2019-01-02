	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion productos
    **Fecha: 19/12/2018
     **/
app.controller('Controller', function($scope, $http, $rootScope){

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


	$scope.addResource= function(){
		$scope.resource = {};
		$("#addResourceModal").modal("show");
	};

	// query of Resource index and with filter 
	$scope.getResource = function(){
		showLoader();
		//dsplay or not the delete action
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
				$scope.resources = response.data[0];
				$scope.lines = response.data[1];
				$scope.brands = response.data[2];
				$scope.cities = response.data[3];
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
		  url: 'products',
		  data: $scope.resource
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.search();
				$("#addResourceModal").modal("hide");
				hideLoader();
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};


	$scope.showDialog = function(resource){
		$("#Show").modal("show");
		$scope.resource = resource;
	};
	
	$scope.showUpdateDialog = function(resource){
		$("#Update").modal("show");
		$scope.resource = angular.extend({}, resource);
	};

	$scope.UpdateResource = function(){
		$http({
		  method: 'PUT',
		  url: 'products/'+$scope.resource.id,
		  data: $scope.resource
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.resource.name = "";
				$("#Update").modal("hide");
				$scope.resource = {};
				$scope.search();
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDelete = function(resource){
		$("#Delete").modal("show");
		$scope.resource = angular.extend({}, resource);
	};

	$scope.deleteResource = function(idResource){
		$http({
		  method: 'DELETE',
		  url: 'products/' + idResource
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