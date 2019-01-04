app.controller('creditPolicyController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddComent = false;
	$scope.user = {};
	$scope.errorFlag=0;
	$scope.successFlag=0;
	$scope.error='';
	$scope.profiles=[];
	$scope.creditPolicyId ='';
	$scope.creditPolicies=[];
	$scope.creditPolicy={};
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

$scope.months=[];


	$scope.getCreditPolicy = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/creditPolicy',
		}).then(function successCallback(response) {
			if(response.data!= false){
				
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {	
					value.timeLimit=value.timeLimit.split('-')[1].split(' ')[0];			
					$scope.creditPolicies.push(value);
					
				});
				
				$scope.cargando = false;

			}
			
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchCreditPolicies = function(){
		$scope.q.initFrom = 0;
		$scope.creditPolicies = [];
		$scope.getCreditPolicy();
	};

	$scope.resetFiltros = function (){
		$scope.creditPolicies = [];
		$scope.q = {
			'q': '',
			'initFrom': 0,
		};
		$scope.filtros = false;
		$scope.getCreditPolicy();
	};

	$scope.showUpdate = function(id){
		$scope.creditPolicyId=id;
		$('#modalUpdate').modal('show');
	}

	$scope.updateCreditPolicy=function(){
		$http({
			method:'PUT',
			url:'/creditPolicy/'+$scope.creditPolicyId,
			data:$scope.creditPolicy,
		}).then(function successCallback(response){
			if(response.data != false){
				$scope.searchCreditPolicies();
				$('#modalUpdate').modal('hide');
			}
		},function errorCallback(response){
				console.log(response);
		});
	}

	$scope.getCreditPolicy();
})