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
	$scope.idProfile='';
	$scope.selectedLines=[];
	$scope.idParam=1;
	$scope.idPagaduria='';


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
			profiles:[]
		};

		$scope.cities=[];
		$scope.idProfile='';
		$scope.profile={
			id:'',
			name:''
		}
		$scope.idPlazo='';
		$scope.profiles=[];
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/simulador/getDataSimulador',
		}).then(function successCallback(response) {
			if(response.data != false){
			
				angular.forEach(response.data.dataProfile, function(value, key) {
					$scope.pagadurias.push(value);
				});	
				angular.forEach(response.data.libranzaProfiles, function(value, key) {
					$scope.profiles.push(value);
				});

				angular.forEach(response.data.cities, function(value, key) {
					$scope.cities.push(value);
				});
			}
		}, function errorCallback(response) {
			
		});
	};

	$scope.viewPagaduria = function(pagaduria){
			$scope.pagaduria = pagaduria;
			$('#viewPagaduria').modal('show');
	}

	$scope.showDeleteModal=function(id){
		$scope.idPagaduria=id;
		$('#deleteModal').modal('show');
	}

	$scope.deletePagaduria=function(){
		showLoader();

		$http({
			method:'DELETE',
			url:'/deletePagaduria/'+$scope.idPagaduria,
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
				$scope.getParams();
				$('#deleteModal').modal('hide');
			}
		},function errorCallback(response){
			hideLoader();
		})

	};

	$scope.showUpdate=function(pagaduria){
		$scope.pagaduria=pagaduria;
		$scope.idPagaduria=$scope.pagaduria.id;
		$('#updatePagaduria').modal('show');
	};

	$scope.updatePagaduria=function(){
		$http({
			method:'PUT',
			url:'/updatePagaduria/'+$scope.idPagaduria,
			data:$scope.pagaduria,
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
				console.log(response.data);
				$scope.getParams();
				$('#updatePagaduria').modal('hide');
			}
		},function errorCallback(response){
			console.log(response);
		});
	}

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
			console.log(response);
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

	
	$scope.addProfile=function(){
		showLoader();
		$http({
			method:'POST',
			url:'/createProfileLibranza',
			data:$scope.profile,
		}).then(function successCallback(response){
			hideLoader();
			if(response.data != false){
				$scope.getParams();
			}
		},function errorCallback(){
			hideLoader();
			alert('Error al guardar perfil');
		});
	};

	$scope.deleteProfile=function(id){
		$scope.idProfile = id;
		showLoader();
		$http({
			method:'DELETE',
			url:'/deleteProfileLibranza/'+$scope.idProfile
		}).then(function successCallback(response){
			hideLoader();
			if(response.data !=false){

			}
		},function errorCallback(response){
			hideLoader();
			alert('Error al eliminar perfil');
		});
	}
	

	$scope.getParams();
})