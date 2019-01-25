	/**
     /Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controler to display a products public view.
    **Date: 22/01/2011
     **/
app.controller('Controller', function($scope, $http, $rootScope){

	$scope.linesBrands = [];

	// list the lines and with their associated brands
	$scope.getLinesBrands = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/Catalog/linesBrands'
		}).then(function successCallback(response) {
			if(response != false){
				$scope.linesBrands = response.data;
				console.log($scope.linesBrands); 
				hideLoader();
			}	
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.getLinesBrands();





/*




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
		$scope.resource = {};
		$scope.resource.city = 0;
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
		$scope.resource = angular.extend({}, resource);
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
*/
});