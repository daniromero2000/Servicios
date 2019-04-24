app.controller('simulatorController', function($scope, $http, $rootScope){
	
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddComent = false;
	$scope.lead = {};
	$scope.idLead = '';
	$scope.comment = {
		comment: '',
		idLead: 0,
		state: 0
	};
	$scope.tabs = 1;
	$scope.params=[];
	$scope.param={
		rate:0,
		gap:0,
		assurance:0
	}
	$scope.plazo={
		timeLimit:''
	};
	$scope.idPlazo='';
	$scope.plazos=[];
	$scope.idParam=1;

	$scope.getParams = function(){
		$scope.params=[];
		$scope.plazo={
			timeLimit:''
		};
		$scope.idPlazo='';
		$scope.plazos=[];
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/simulador/getDataSimulador',
		}).then(function successCallback(response) {
			if(response.data != false){
			
				angular.forEach(response.data.params, function(value, key) {
					$scope.params.push(value);
				});	
				angular.forEach(response.data.timeLimits, function(value, key) {
					$scope.plazos.push(value);
				});	
				
			}

			console.log(response);
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.deleteTimeLimit=function(id){
		$scope.idPlazo=id;
		showLoader();
		$http({
			method:'DELETE',
			url:'/simulator/'+$scope.idPlazo,
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
			}
		},function errorCallback(response){
			hideLoader();
		})
	}

	$scope.addTimeLimit=function(){
		showLoader();
		$http({
			method:'POST',
			url:'/simulator',
			data:$scope.plazo
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
				$scope.getParams();
				$scope.plazo.timeLimit='';
			}
		},function errorCallback(response){
			hideLoader();

		});
	}

	$scope.updateSimulator=function(){
		showLoader();
		$http({
			method:'PUT',
			url:'/simulator/'+$scope.idParam,
			data:$scope.params[0],
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
				$scope.getParams();
				$("#confirmModal").modal("hide");
			}
		},function errorCallback(response){
			hideLoader();
		});
	}

	$scope.confirmUpdate=function(){
		$("#confirmModal").modal("show");
	}
	

	$scope.getParams();
})