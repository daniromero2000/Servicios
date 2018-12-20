	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion productos marcas y lineas.
    **Fecha: 13/12/2018
     **/
app.controller('Controller', function($scope, $http, $rootScope){

	$scope.q = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.brand = {}; //object for index brand
	$scope.brands = []; //list of brands returned by server
	$scope.alert = "";	//text in create brand alert

	$scope.addBrand = function(){
		$("#addBrandModal").modal("show");
		$("#alertBrand").hide();
	};

	// query of faqs index and with filter 
	$scope.getBrands = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/brands?q='+$scope.q.q+'&page='+$scope.q.page+'&actual='+$scope.q.actual+'&delete='+$scope.q.delete
		}).then(function successCallback(response) {
			if(response != false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value) {
					$scope.brands.push(value);
				});
				hideLoader();
			}	
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.search = function(){
		$scope.brand = {};
		$scope.alert = "";
		$scope.brands = [];
		$scope.q.actual = 1;
		$scope.q.page = 30;
		$scope.getBrands();
	};

	$scope.createBrand = function(){
		$http({
		  method: 'POST',
		  url: 'brands',
		  data: $scope.brand
		}).then(function successCallback(response) {
			if(response.data != false){
				if(response.data=="23000"){
					document.getElementById('p').innerHTML = "La marca  <b>" + $scope.brand.name + "</b>  ya esta registrada en la base de datos";
					$("#alertBrand").show();
				}else if (response.data==true) {
					$scope.brand.name = "";
					$("#addBrandModal").modal("hide");
					$scope.search();
				}
				
			}
		}, function errorCallback(response) {
		});
	};


	$scope.showDialog = function(brand){
		$("#Show").modal("show");
		$scope.brand = brand;
	};
	

	$scope.showUpdateDialog = function(brand){
		$("#alertUpdate").hide();
		$("#Update").modal("show");
		$scope.brand = brand;
	};

	$scope.UpdateBrand = function(){
		$http({
		  method: 'PUT',
		  url: 'brands/'+$scope.brand.id,
		  data: $scope.brand
		}).then(function successCallback(response) {
			if(response.data != false){
				if(response.data=="23000"){
					document.getElementById('update').innerHTML = "La marca  <b>" + $scope.brand.name + "</b>  ya esta registrada en la base de datos";
					$("#alertUpdate").show();
				}else if (response.data==true) {
					$scope.brand.name = "";
					$("#Update").modal("hide");
					$scope.brand = {};
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDelete = function(brand){
		$("#Delete").modal("show");
		$scope.brand = brand;
	};

	$scope.deleteBrand=function(idBrand){
		$http({
		  method: 'DELETE',
		  url: 'brands/' + idBrand
		}).then(function successCallback(response){	
			if(response.data != false){
				$("#Delete").modal("hide");
				$scope.search();
			}
		},function errorCallback(response){
			
		});
	}

	$scope.getBrands();

});