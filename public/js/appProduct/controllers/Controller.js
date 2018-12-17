	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion productos marcas y lineas.
    **Fecha: 13/12/2018
     **/
app.controller('Controller', function($scope, $http, $rootScope){

	$scope.brand = {};	

	$scope.addBrand = function(){
		console.log("casa");
		$("#addBrandModal").modal("show");
	};

	$scope.createBrand = function(){
		$http({
		  method: 'POST',
		  url: 'brands',
		  data: $scope.brand
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.brand.name = "";
				console.log(response);
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	};

});