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
	$scope.idUser = '';
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

	$scope.getUsers = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/users?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom+'&profileUser='+$scope.q.profileUser+'&fecha_ini='+$scope.q.fecha_ini+'&fecha_fin='+$scope.q.fecha_fin,
		}).then(function successCallback(response) {
			if(response.data != false){
				
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {
					
					$scope.users.push(value);
				});
				$scope.cargando = false;

			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	$scope.searchUsers = function(){
		$scope.q.initFrom = 0;
		$scope.users = [];
		$scope.getUsers();
	};

	$scope.resetFiltros = function (){
		$scope.users = [];
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
		    console.log($scope.user);
		    console.log(response);
		});
	};

	$scope.addUserForm = function(){
		
		$("#addUser").modal("show");
	
	};

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
			console.log(response);
		}
		);
	}

	$scope.updateUserForm=function(idUser){
		$scope.idUser=idUser;
		$('#updateUser').modal('show');
	}

	$scope.deleteUserDialog= function(idUser){
		$scope.idUser=idUser;
		$("#deleteModal").modal("show");
		console.log(idUser);
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
				console.log(response);
				console.log($scope.idUser);
		});
	}


	/*$scope.vewLead = function(lead){
		$scope.lead = lead;
		$("#viewLead").modal("show");
	};

	$scope.viewComments = function(name, lastName, state, idLead, init=true){
		$scope.comments = [];
		$scope.idLead = idLead;
		$http({
		  method: 'GET',
		  url: 'api/leads/getComentsLeads/'+idLead
		}).then(function successCallback(response) {
			if(response.data != false){
				angular.forEach(response.data, function(value, key) {
					$scope.comments.push(value);
				});
			}
			if(init){
				$("#viewComments").modal("show");
				$scope.nameLead = name;
				$scope.lastNameLead = lastName;
				$scope.state = state;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.addComment = function(){
		$scope.comment.idLead = $scope.idLead;
		$http({
		  method: 'GET',
		  url: 'api/leads/addComent/'+$scope.comment.idLead+'/'+$scope.comment.comment
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.viewComments("","",$scope.state,$scope.idLead, false);
				$scope.comment.comment = "";
				$scope.viewAddComent = false;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.changeStateLead = function(name, lastName, idLead, state, title){
		$scope.title = title;
		$scope.nameLead = name;
		$scope.lastNameLead = lastName;
		$scope.comment.idLead = idLead;
		$scope.comment.state = state;
		$("#changeStateLead").modal("show");
	};

	$scope.viewCommentChange = function(){
		$scope.viewAddComent = !$scope.viewAddComent;
	};


	$scope.changeStateLeadComment = function(){
		$http({
		  method: 'GET',
		  url: 'api/leads/cahngeStateLead/'+$scope.comment.idLead+'/'+$scope.comment.comment+'/'+$scope.comment.state
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.comment.comment = "";
				$scope.searchLeads();
				$("#changeStateLead").modal("hide");			
			}
		}, function errorCallback(response) {
		    
		});
	};*/

	$scope.getUsers();
})