app.controller("libranzaLiquidadorCtrl", function($scope, $http) {
	
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


	$scope.lines=[];
	$scope.pagaduriaLibranza=[];
	$scope.libranzaProfiles=[];

	$scope.getData=function(){
		$http({
			method:'GET',
			url:'api/getDataLibranza'
		}).then(function successCallback(response){
			if(response.data != false){
				
				angular.forEach(response.data.lines, function(value, key) {
					$scope.lines.push(value);
				});

				angular.forEach(response.data.profiles, function(value, key) {
					$scope.libranzaProfiles.push(value);
				});
			}

			console.log($scope.pagaduriaLibranza);
		},function errorCallback(response){
			
		});
	}

	$scope.assignPagaduria = function(){

	}

	$scope.selectPagaduria = function (){

		$http({
			method:'GET',
			url:'/api/getPagadurias/'+$scope.libranza.customerType
		}).then(function successCallback(response){
			console.log(typeof $scope.libranza.customerType);
			angular.forEach(response.data, function(value, key) {
				$scope.pagaduriaLibranza.push(value);
			});
		},function errorCallback(response){	
			console.log(response);
		});
		
	};

	$scope.calculateData = function(){
		$scope.libranza.lawDesc = $scope.libranza.salary * 0.12;
		$scope.libranza.segMargen = ($scope.libranza.salary > 828116) ? 5300 : 2000 ;
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
						$('#solicitarModal').modal('hide');
					   	$('#simularModal').modal('show');
					}, function errorCallback(response) {
					    
					});
				}
			}
		}
	};

	$scope.solicitar = function(){
		
		window.location = "/LIB_gracias_FRM";		
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
				$('#solicitarModal').modal('show');
			}, function errorCallback(response) {
			    
			});
		}
	};
	
	$scope.getData();

});