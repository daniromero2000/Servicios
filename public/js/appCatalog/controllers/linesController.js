	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion productos marcas y lineas.
    **Fecha: 19/12/2018
     **/
app.controller('linesController', function($scope, $http, $rootScope){

	$scope.q = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.resource = {}; //object for index line
	$scope.resources = []; //list of brands returned by server
	$scope.alert = "";	//text in create alert text 
	$scope.activ  = true; // display delete action for each resourse if this is activ 

	$scope.addResource= function(){
		$("#addResourceModal").modal("show");
		$("#alertResource").hide();
	};

	// query of faqs index and with filter 
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
		  url: '/lines?q='+$scope.q.q+'&page='+$scope.q.page+'&actual='+$scope.q.actual+'&delete='+$scope.q.delete
		}).then(function successCallback(response) {
			if(response != false){
				angular.forEach(response.data, function(value) {
					$scope.resources.push(value);
				});
				hideLoader();
			}	
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.search = function(){
		$scope.resource = {};
		$scope.alert = "";
		$scope.resources = [];
		$scope.q.actual = 1;
		$scope.q.page = 30;
		$scope.getResource();
	};

	
	$scope.moreRegister = function(){
		$scope.q.actual = $scope.q.actual + 1;
		getResource()
	};

	$scope.createResource = function(){
		$http({
		  method: 'POST',
		  url: 'lines',
		  data: $scope.resource
		}).then(function successCallback(response) {
			if(response.data != false){
				if(response.data=="23000"){
					document.getElementById('p').innerHTML = "La Linea  <b>" + $scope.resource.name + "</b>  ya esta registrada en la base de datos";
					$("#alertResource").show();
				}else if (response.data==true) {
					$scope.resource.name = "";
					$("#addResourceModal").modal("hide");
					$scope.search();
				}	
			}
		}, function errorCallback(response) {
		});
	};


	$scope.showDialog = function(resource){
		$("#Show").modal("show");
		$scope.resource = resource;
	};
	

	$scope.showUpdateDialog = function(resource){
		$("#alertUpdate").hide();
		$("#Update").modal("show");
		$scope.resource = angular.extend({}, resource);
	};

	$scope.UpdateResource = function(){
		$http({
		  method: 'PUT',
		  url: 'lines/'+$scope.resource.id,
		  data: $scope.resource
		}).then(function successCallback(response) {
			if(response.data != false){
				if(response.data=="23000"){
					document.getElementById('update').innerHTML = "La linea  <b>" + $scope.resource.name + "</b>  ya esta registrada en la base de datos";
					$("#alertUpdate").show();
				}else if (response.data==true) {
					$scope.resource.name = "";
					$("#Update").modal("hide");
					$scope.resource = {};
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDelete = function(resource){
		$("#Delete").modal("show");
		$scope.resource = resource;
	};

	$scope.deleteResource = function(idResource){
		$http({
		  method: 'DELETE',
		  url: 'lines/' + idResource
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