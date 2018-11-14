app.controller('leadsController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
		'city': '',
		'fecha_ini': '',
		'fecha_fin': '',
		'typeService': ''
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddComent = false;
	$scope.lead = {};
	$scope.idLead = '';
	$scope.comment = {
		comment: '',
		idLead: 0
	};
	$scope.comments = [];
	$scope.leads = [];
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

	$scope.getLeads = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/leads?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom+'&city='+$scope.q.city+'&fecha_ini='+$scope.q.fecha_ini+'&fecha_fin='+$scope.q.fecha_fin+'&typeService='+$scope.q.typeService,
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {
					$scope.leads.push(value);
				});
				$scope.cargando = false;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchLeads = function(){
		$scope.q.initFrom = 0;
		$scope.leads = [];
		$scope.getLeads();
	};

	$scope.vewLead = function(lead){
		$scope.lead = lead;
		$("#viewLead").modal("show");
	}

	$scope.viewComments = function(comments, name, lastName, idLead){
		angular.forEach(comments, function(value, key) {
			$scope.comments.push(value);
		});
		$scope.comments = comments;
		$scope.nameLead = name;
		$scope.idLead = idLead;
		$scope.lastNameLead = lastName;
		$("#viewComments").modal("show");
	};

	$scope.addComment = function(){
		$scope.comment.idLead = $scope.idLead;
		$http({
		  method: 'GET',
		  url: 'api/leads/addComent/'+$scope.comment.idLead+'/'+$scope.comment.comment
		}).then(function successCallback(response) {
			console.log(response);
			if(response.data != false){
				$scope.searchLeads();
				$scope.comment.comment = "";
				$scope.viewAddComent = false;
				$("#viewComments").modal("hide");			
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.getLeads();
})