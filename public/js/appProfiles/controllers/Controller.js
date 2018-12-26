	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion productos marcas y lineas.
    **Fecha: 19/12/2018
     **/
app.controller('Controller', function($scope, $http, $rootScope){

	$scope.q = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.resource = {}; //object for index line
	$scope.resources = []; //list of brands returned by server
	$scope.alert = "";	//text in create alert text 

	$scope.addResource= function(){
		$("#addResourceModal").modal("show");
		$("#alertResource").hide();
	};

	// query of faqs index and with filter 
	$scope.getResource = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/profiles?q='+$scope.q.q+'&page='+$scope.q.page+'&actual='+$scope.q.actual+'&delete='+$scope.q.delete
		}).then(function successCallback(response) {
			if(response != false){
				angular.forEach(response.data, function(value) {
					$scope.resources.push(value);
				});
				hideLoader();
			}	
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
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

	$scope.createResource = function(){
		$http({
		  method: 'POST',
		  url: 'profiles',
		  data: $scope.resource
		}).then(function successCallback(response) {
			if(response.data != false){
				if(response.data=="23000"){
					document.getElementById('p').innerHTML = "El perfil <b>" + $scope.resource.name + "</b>  ya esta registrado en la base de datos";
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
		$scope.resource = resource;
	};

	$scope.UpdateResource = function(){
		$http({
		  method: 'PUT',
		  url: 'profiles/'+$scope.resource.id,
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
		  url: 'profiles/' + idResource
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