angular.module('appLibranzaLiquidador', [])
.controller("libranzaLiquidadorCtrl", function($scope, $http) {
	$scope.lineaCredito = [
		{
			label: 'Libre inversión',
			value: 'Libre inversion'
		},
		{
			label: 'Libre inversión + Compra de cartera',
			value: 'Libre inversion + Compra de cartera'
		}
	];
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
	$scope.typeProducts = [
		{
			label: 'Crédito para electrodomésticos', value: 'Crédito para electrodomésticos'
		},
		{
			label: 'Crédito para motos', value:'Crédito para motos'
		},
		{
			label: 'Credito para viajes', value: 'Credito para viajes'
		},
		{
			label: 'Compra de cartera', value: 'Compra de cartera'
		},
		{
			label: 'Libre inversión', value:'Libre inversión'
		}
	];
	$scope.tipoCliente = [
		{
			label : 'Pensionado',
			value : 'Pensionado'
		},
		{
			label : 'Docente',
			value : 'Docente'
		},
		{
			label : 'Militares Activos',
			value : 'Militares Activos'
		}
	];
	$scope.libranza = {
		creditLine: '',
		pagaduria : '',
		customerType: '',
		age : '',
		salary : '',
		lawDesc : '',
		otherDesc : '',
		segMargen : '',
		quotaBuy : '',
		quaotaAvailable : '',
		maxQuota : '',
		name : '',
		lastName : '',
		email: '',
		telephone: '',
		city: '',
		typeService: 'Credito libranza',
		typeProduct: '',
		termsAndConditions: 0,
		channel: 1
	};

	$scope.validateInt = function(){
		if($scope.libranza.salary < 0){
			$scope.libranza.salary = 0;
		}

		if($scope.libranza.otherDesc < 0){
			$scope.libranza.otherDesc = 0;
		}

		if($scope.libranza.age < 0){
			$scope.libranza.age = 0;
		}

		if($scope.libranza.quotaBuy < 0){
			$scope.libranza.quotaBuy = 0;
		}
	};

	$scope.selectPagaduria = function (){
		$scope.pagaduriasPensionados = [
			{label: 'ACALDIA DE IBAGUE',value: 'ACALDIA DE IBAGUE'},{label: 'ALCALDIA DE PEREIRA',value: 'ALCALDIA DE PEREIRA'},{label: 'ALCALDIA DE MANIZALES',value: 'ALCALDIA DE MANIZALES'},{label: 'ALCALDIA DE SINCELEJO',value: 'ALCALDIA DE SINCELEJO'},{label: 'BBVA SEGUROS ',value: 'BBVA SEGUROS '},{label: 'CASUR',value: 'CASUR'},{label: 'COLFONDOS',value: 'COLFONDOS'},{label: 'COLPENSIONES',value: 'COLPENSIONES'},{label: 'FOPEP',value: 'FOPEP'},{label: 'EMPOS -COLPENSIONES',value: 'EMPOS -COLPENSIONES'},{label: 'GOBERNACIÓN DE BOLIVAR',value: 'GOBERNACIÓN DE BOLIVAR'},{label: 'GOBERNACION DE CALDAS',value: 'GOBERNACION DE CALDAS'},{label: 'GOBERACION DE RISARALDA',value: 'GOBERACION DE RISARALDA'},{label: 'GOBERNACION QUINDIO',value: 'GOBERNACION QUINDIO'},{label: 'MAPFRE',value: 'MAPFRE'},{label: 'MIN DEFENSA',value: 'MIN DEFENSA'},{label: 'PORVENIR',value: 'PORVENIR'},{label: 'POSITIVA',value: 'POSITIVA'},{label: 'FIDUPREVISORA',value: 'FIDUPREVISORA'},{label: 'PROTECCION', value: 'PROTECCION'},{label: 'SEGUROS DE VIDA SURAMEICANA',value: 'SEGUROS DE VIDA SURAMEICANA'},{label: 'SEGUROS BOLIVAR RENTA VITALICIA',value: 'SEGUROS BOLIVAR RENTA VITALICIA'},{label: 'GLOBAL SEGUROS',value: 'GLOBAL SEGUROS'},{label: 'AXA COLPATRIA RENTA VITALICIA',value: 'AXA COLPATRIA RENTA VITALICIA'},{label: 'FONCEP',value: 'FONCEP'}
		];

		$scope.pagaduriasDocentes = [
			{label: 'ACALDIA DE IBAGUE',value: 'ACALDIA DE IBAGUE'},
			{label: 'ALCALDIA DE PEREIRA',value: 'ALCALDIA DE PEREIRA'},
			{label: 'ALCALDIA DE MANIZALES',value: 'ALCALDIA DE MANIZALES'},
			{label: 'ALCALDIA DE SINCELEJO',value: 'ALCALDIA DE SINCELEJO'},
			{label: 'ALCALDIA MAYOR DE BOGOTA',value: 'ALCALDIA MAYOR DE BOGOTA'},
			{label: 'FER BOYACA',value: 'FER BOYACA'},
			{label: 'GOBERNACION DE BOLIVAR',value: 'GOBERNACION DE BOLIVAR'},
			{label: 'GOBERNACION DE RISARALDA',value: 'GOBERNACION DE RISARALDA'},
			{label: 'GOBERNACION DEL QUINDIO',value: 'GOBERNACION DEL QUINDIO'}
		];

		$scope.pagaduriasMilitares = [
			{label: 'MINISTERIO DE DEFENSA NACIONAL',value: 'MINISTERIO DE DEFENSA NACIONAL'}
		];

		if($scope.libranza.customerType == 'Pensionado'){
			$scope.libranza.pagaduria = "ACALDIA DE IBAGUE";
			$scope.pagadurias = $scope.pagaduriasPensionados;
		}else if($scope.libranza.customerType == 'Docente'){
			$scope.libranza.pagaduria = "ACALDIA DE IBAGUE";
			$scope.pagadurias = $scope.pagaduriasDocentes;
		}else{
			$scope.libranza.pagaduria = "MINISTERIO DE DEFENSA NACIONAL";
			$scope.pagadurias = $scope.pagaduriasMilitares;
		}
	};

	$scope.calculateData = function(){
		$scope.libranza.lawDesc = $scope.libranza.salary * 0.12;
		$scope.libranza.segMargen = ($scope.libranza.salary > 781242) ? 5300 : 2000 ;
		$scope.libranza.quaotaAvailable = (($scope.libranza.salary - $scope.libranza.lawDesc)/2)-$scope.libranza.otherDesc-$scope.libranza.segMargen-$scope.libranza.quotaBuy;
		if($scope.libranza.age >= 18 && $scope.libranza.age < 80){
			$scope.libranza.maxQuota = 60000000;
		}else if($scope.libranza.age >= 80 && $scope.libranza.age < 86){
			$scope.libranza.maxQuota = 9000000;
		}else{
			$scope.libranza.maxQuota = 5000000;
		}
	};

	$scope.simular = function(){
		if($scope.libranza.age == '' || $scope.libranza.creditLine == '' || $scope.libranza.customerType == '' || $scope.libranza.pagaduria == ''){
			alert('Debes de llenar todos los datos');
		}else{
			if($scope.libranza.quaotaAvailable <= 148518 ){
				alert("No posee capacidad de pago");
			}else{
				if($scope.libranza.salary < 0 || $scope.libranza.salary == ''){
					alert("Para poder simular el Salario Básico no puede ser menor a 0");
				}else{
					$http({
					  method: 'GET',
					  url: 'api/libranza/liquidator/'+$scope.libranza.maxQuota+'/'+$scope.libranza.quaotaAvailable
					}).then(function successCallback(response) {
						$scope.plazos = response.data;
					   	$('#simularModal').modal('show');
					}, function errorCallback(response) {
					    
					});
				}
			}
		}
	};

	$scope.solicitar = function(){
		$('#simularModal').modal('hide');
		$('#solicitarModal').modal('show');
	};

	$scope.addLead = function(){
		if($scope.libranza.termsAndConditions == false){
			alert("Debes aceptar términos y condiciones y política de tratamiento de datos");
		}else{
			$http({
			  method: 'POST',
			  url: '/libranza',
			  data: $scope.libranza
			}).then(function successCallback(response) {
				window.location = "/LIB_gracias_FRM";
			}, function errorCallback(response) {
			    
			});
		}
	};
});