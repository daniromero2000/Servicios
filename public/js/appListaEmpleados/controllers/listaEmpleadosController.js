app.controller('listaEmpleadosController', function($scope, $http, $rootScope, $location, $ngBootbox){
	$ngBootbox.setLocale('es');
	$scope.existEmploye = false;
	$scope.q = {
		'q': '',
		'page': 30,
		'actual': 1
	};
	$scope.employe = {
		'nombre' : '',
		'num_documento': ''
	};
	$scope.employes = [];

	$scope.getEmployes = function(){
		showLoader();
		//display or not the delete action
		$http({
		  method: 'GET',
		  url: '/listaEmpleados?page='+$scope.q.page+'&actual='+$scope.q.actual+'&q='+$scope.q.q
		}).then(function successCallback(response) {
			if(response != false){
				angular.forEach(response.data.employes, function(value) {
					$scope.employes.push(value);
				});
			}
			hideLoader();
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.getMoreEmployes = function(){
		$scope.q.actual = $scope.q.actual + 1;
		$scope.getEmployes()
	};

	$scope.searchEmployes = function(){
		$scope.q.page = 30;
		$scope.q.actual = 1;
		$scope.employes = [];
		$scope.getEmployes();
	};

	$scope.showAddEmploye = function(){
		$("#addEmployeModal").modal("show");
		$scope.employe = {
			'nombre' : '',
			'num_documento': ''
		};
	};

	$scope.cerrar = function(){
		$("#addEmployeModal").modal("hide");
		$scope.employe = {
			'nombre' : '',
			'num_documento': ''
		};

	};

	$scope.addEmploye = function(){
		showLoader();
		$http({
			method: 'POST',
			url: '/listaEmpleados',
			data: $scope.employe
		}).then(function successCallback(response) {
			if(response.data == -1){
				$scope.existEmploye = true;
			}else if(response.data != false){
				$scope.searchEmployes();
				$scope.cerrar();
			}

			hideLoader();
		}, function errorCallback(response) {
			  hideLoader();
			  console.log(response);
		});
	};

	$scope.deleteEmploye = function(idEmploye){
		$ngBootbox.confirm('Desea eliminar el empleado ?')
      	.then(function() {
			$http({
				method: 'DELETE',
				url: '/listaEmpleados/'+idEmploye,
			}).then(function successCallback(response) {
				if(response.data != false){
					$scope.searchEmployes();
				}
				hideLoader();
			}, function errorCallback(response) {
				  hideLoader();
				  console.log(response);
			});
    	});
	};

	$scope.getEmployes();
});