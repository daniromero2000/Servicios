angular.module('appStep2', ['moment-picker'])
.controller("step2Ctrl", function($scope, $http) {
	$scope.leadInfo = {
		step: 2,
		identificationNumber: 1,
		dateDocumentExpedition: '',
		cityExpedition: '',
		housingType: '',
		housingTime: '',
		housingOwner: '',
		addres: '',
		leaseValue: '',
		housingTelephone: '',
		stratum: '',
		birthdate: '',
		gender: '',
		civilStatus: '',
		spouseName: '',
		spouseIdentificationNumber: '',
		spouseTelephone: '',
		spouseJobName: '',
		spouseProfession: '',
		spouseJob: '',
		spouseSalary: '',
		spouseEps: ''
	};

	$scope.genders = [
		{ label : 'Masculino',value: 'masculino' },
		{ label : 'Femenino',value: 'femenino' }
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

	$scope.housingTypes = [
		{
			label: 'Propia',
			value: 'propia'
		},
		{
			label: 'Arriendo',
			value: 'arriendo'
		},
		{
			label: 'Familiar',
			value: 'familiar'
		}
	];

	$scope.civilTypes = [
		{
			label: 'Soltero',
			value: 'soltero'
		},
		{
			label: 'Casado',
			value: 'casado'
		},
		{
			label: 'Unión Libre',
			value: 'union libre'
		},
		{
			label: 'Viudo',
			value: 'viudo'
		},
	];

	$scope.changeHousingType = function(){
		if($scope.leadInfo.housingType == 'familiar' || $scope.leadInfo.housingType == 'propia'){
			$scope.leadInfo.leaseValue = "";
		}
	};

	$scope.saveStep2 = function(){
		var csrftoken = document.getElementById('step2Form').children[0].value;
		$http({
		  method: 'POST',
		  url: '/oportuyaV2',
		  data: $scope.leadInfo,
		  headers: {
		     'X-CSRF-TOKEN': csrftoken
		   },
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.encryptText();
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	$scope.encryptText = function(){
		$http({
		  method: 'GET',
		  url: '/api/encryptText/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			if (response.data != false) {
				window.location = "/step3/"+response.data;
			}
		}, function errorCallback(response) {
		    
		});
	};
});