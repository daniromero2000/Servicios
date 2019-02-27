app.controller('userController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
		'fecha_ini': '',
		'fecha_fin': '',
		'profileUser': '',
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddComent = false;
	$scope.user = {};
	$scope.errorFlag=0;
	$scope.successFlag=0;
	$scope.error='';
	$scope.profiles=[];
	$scope.idUser = '';
	$scope.assessors=[];
	$scope.assessor={};
	$scope.comment = {
		comment: '',
		idLead: 0,
		state: 0
	};
	$scope.comments = [];
	$scope.users = [];
	$scope.cities = [
		{ label : 'ARMENIA',value: 'ARMENIA' },
		{ label : 'MANIZALES',value: 'MANIZALES' },
		{ label : 'SINCELEJO',value: 'SINCELEJO' },
		{ label : 'YOPAL',value: 'YOPAL' },
		{ label : 'CERETÉ',value: 'CERETÉ' },
		{ label : 'TULUÁ',value: 'TULUÁ' },
		{ label : 'ACACÍAS',value: 'ACACÍAS' },
		{ label : 'ESPINAL',value: 'ESPINAL' },
		{ label : 'MARIQUITA',value: 'MARIQUITA' },
		{ label : 'CARTAGENA',value: 'CARTAGENA' },
		{ label : 'LA DORADA',value: 'LA DORADA' },
		{ label : 'IBAGUÉ',value: 'IBAGUÉ' },
		{ label : 'BOGOTÁ',value: 'BOGOTÁ' },
		{ label : 'MONTERÍA',value: 'MONTERÍA' },
		{ label : 'MAGANGUÉ',value: 'MAGANGUÉ' },
		{ label : 'PEREIRA',value: 'PEREIRA' },
		{ label : 'CALI',value: 'CALI' },
		{ label : 'MONTELIBANO',value: 'MONTELIBANO' },
		{ label : 'SAHAGÚN',value: 'SAHAGÚN' },
		{ label : 'PLANETA RICA',value: 'PLANETA RICA' },
		{ label : 'COROZAL',value: 'COROZAL' },
		{ label : 'CIÉNAGA',value: 'CIÉNAGA' },
		{ label : 'MONTELÍ',value: 'MONTELÍ' },
		{ label : 'PLATO',value: 'PLATO' },
		{ label : 'SABANALARGA',value: 'SABANALARGA' },
		{ label : 'GRANADA',value: 'GRANADA' },
		{ label : 'PUERTO BERRÍ',value: 'PUERTO BERRÍ' },
		{ label : 'VILLAVICENCIO',value: 'VILLAVICENCIO' },
		{ label : 'TAURAMENA',value: 'TAURAMENA' },
		{ label : 'PUERTO GAITÁN',value: 'PUERTO GAITÁN' },
		{ label : 'PUERTO BOYACÁ',value: 'PUERTO BOYACÁ' },
		{ label : 'PUERTO LÓPEZ',value: 'PUERTO LÓPEZ' },
		{ label : 'SEVILLA',value: 'SEVILLA' },
		{ label : 'CHINCHINÁ',value: 'CHINCHINÁ' },
		{ label : 'AGUACHICA',value: 'AGUACHICA' },
		{ label : 'BARRANCABERMEJA',value: 'BARRANCABERMEJA' },
		{ label : 'LA VIRGINIA',value: 'LA VIRGINIA' },
		{ label : 'SANTA ROSA DE CABAL',value: 'SANTA ROSA DE CABAL' },
		{ label : 'GIRARDOT',value: 'GIRARDOT' },
		{ label : 'VILLANUEVA',value: 'VILLANUEVA' },
		{ label : 'PITALITO',value: 'PITALITO' },
		{ label : 'GARZÓN',value: 'GARZÓN' },
		{ label : 'NEIVA',value: 'NEIVA' },
		{ label : 'LORICA',value: 'LORICA' },
		{ label : 'AGUAZUL', value: 'AGUAZUL' }
	];
	$scope.typeServices = [
		{
			label: 'Oportuya',
			value: 'terjeta de crédito Oportuya'
		},
		{
			label: 'Crédito Motos',
			value: 'Motos'
		},
		{
			label: 'Crédito Libranza',
			value: 'Credito libranza'
		},
		{
			label: 'Seguros',
			value: 'Seguros'
		},
		{
			label: 'Viajes',
			value: 'Viajes'
		},
	];

	$scope.typeStates = [
		{
			label: 'En estudio',
			value: 1
		},
		{
			label: 'En espera',
			value: 2
		},
		{
			label: 'Aprobado',
			value: 3
		},
		{
			label: 'Negado',
			value: 4
		}
	];

	$scope.selectedCode = function(assessorObject){
		
		$scope.assessor.code=assessorObject.originalObject.CODIGO;
	}

	$scope.getUsers = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/users?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom+'&profileUser='+$scope.q.profileUser+'&fecha_ini='+$scope.q.fecha_ini+'&fecha_fin='+$scope.q.fecha_fin,
		}).then(function successCallback(response) {
			if(response.data[0] != false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data[0], function(value, key) {					
					$scope.users.push(value);
				});
				$scope.cargando = false;
			}

			if(response.data[1] != false){
				angular.forEach(response.data[1], function(value, key) {					
					$scope.profiles.push(value);
				});	
			}

			if(response.data[2] != false){
				angular.forEach(response.data[2], function(value, key) {					
					$scope.assessors.push(value);
				});	
			}	
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchUsers = function(){
		$scope.q.initFrom = 0;
		$scope.profiles = [];
		$scope.users = [];
		$scope.getUsers();
	};

	$scope.resetFiltros = function (){
		$scope.users = [];
		$scope.profiles = [];
		$scope.q = {
			'q': '',
			'initFrom': 0,
			'fecha_ini': '',
			'fecha_fin': '',
			'profileUser': '',
		};
		$scope.filtros = false;
		$scope.getUsers();
	};

	$scope.addUser = function(){
		$http({
		  method: 'POST',
		  url: '/users',
		  data:$scope.user
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.searchUsers();
				$("#addUser").modal("hide");
			}
		}, function errorCallback(response) {
		   
		});
	};

	$scope.addUserForm = function(){
		
		$("#addUser").modal("show");
	
	};

	$scope.addAssessorForm = function(){
		
		$("#assessorAddProfile").modal("show");
	
	};

	$scope.addAssessorProfile = function(){
		$http({
				method:'POST',
				url:'profileAssessor',
				data: $scope.assessor
		}).then(function successCallback(response){
			if(response.data != false) {
				if(response.data == '-1'){
					$scope.errorFlag=1;
					$scope.error='El asesor no existe en oportudata';
				}else if((response.data == 'false') ){
					$scope.errorFlag=1;
					$scope.error='El asesor ya se le ha asignado un perfil';
				}else{
					$scope.errorFlag=0;
					$scope.successFlag=1;
					$scope.error='Perfil asignado correctamente';
				}
				$("#assessorAddProfile").modal("hide");		
			}

			console.log($scope.response);
		},function errorCallback(response){
			console.log(response);
			console.log($scope.assessor);
		});
	}

	$scope.updateUser = function(){
		$http({
			method:'PUT',
			url:'users/'+$scope.idUser,
			data:$scope.user,
		}).then(function successCallback(response){
			if(response.data != false){
				$scope.searchUsers();
				$('#updateUser').modal('hide');
			}
		},function errorCallback(response){
			
		});
	}

	$scope.updateUserForm=function(idUser){
		$scope.idUser=idUser;
		$('#updateUser').modal('show');
	}

	$scope.deleteUserDialog= function(idUser){
		$scope.idUser=idUser;
		$("#deleteModal").modal("show");
		
	}
	


	$scope.deleteUser=function(){
		$http({
		  method: 'DELETE',
		  url: 'users/'+$scope.idUser,
		}).then(function successCallback(response){	
			if(response.data != false){
				$scope.searchUsers();
				$("#deleteModal").modal("hide");
			}
		},function errorCallback(response){
				
		});
	}

	$scope.getUsers();
})