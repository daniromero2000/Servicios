app.controller('pagaduriaController', function($scope, $http, $rootScope){
	
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
	$scope.pagadurias=[];
		$scope.pagaduria={
			name:'',
			office:'',
			address:'',
			city:'',
			departament:'',
			phoneNumber:'',
			active:1,
			category:0,
		};
	$scope.profile={
		id:'',
		name:''
	}
	$scope.libProf=[];
	$scope.idPlazo='';
	$scope.profiles=[];
	$scope.idParam=1;

	$scope.getParams = function(){
		$scope.pagadurias=[];
		$scope.pagaduria={
			name:'',
			office:'',
			address:'',
			city:'',
			departament:'',
			phoneNumber:'',
			active:1,
			category:0,
		};
		$scope.profile={
			id:'',
			name:''
		}
		$scope.idPlazo='';
		$scope.profiles=[];
		$scope.libProf=[];
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/simulador/getDataSimulador',
		}).then(function successCallback(response) {
			if(response.data != false){
			
				angular.forEach(response.data.pagadurias, function(value, key) {
					$scope.pagadurias.push(value);
				});	
				angular.forEach(response.data.libranzaProfiles, function(value, key) {
					$scope.profiles.push(value);
				});	
				
				console.log(typeof $scope.profiles);
			}
		}, function errorCallback(response) {
			
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

	$scope.currentNavItem = 'page1';

    $scope.goto = function(page) {
      $scope.status = "Goto " + page;
	};
	
	$scope.addPagaduriaForm= function(){
		$('#addPagaduria').modal('show');
	}

	$scope.addPagaduria=function(){
		showLoader();
		$http({
			method:'POST',
			url:'/createPagaduria',
			data:$scope.pagaduria
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
				$scope.getParams();
				$('#addPagaduria').modal('hide');
			}
		},function errorCallback(response){
			hideLoader();

		});
	}

	$scope.updateSimulator=function(){
		showLoader();
		$http({
			method:'PUT',
			url:'simulator/'+$scope.idParam,
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