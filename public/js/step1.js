angular.module('appStep1', [])
.controller("step1Ctrl", function($scope, $http) {
	$scope.myModel = "";
	$scope.emailValidate = false;
	$scope.disabledInputs = true;
	$scope.endTime = 1546318800000;
	$scope.code = {
		'code' : ''
	}
	$scope.leadInfo = {
		'step' : 1,
		'channel' : 1,
		'typeService' : 'Terjeta de crédito Oportuya',
		'typeDocument' : '',
		'identificationNumber' : '',
		'name' : '',
		'lastName' : '',
		'email' : '',
		'emailConfirm' : '',
		'telephone' : '',
		'occupation' : '',
		'city' : '',
		'termsAndConditions' : ''
	};

	$scope.typesDocuments = [
		{
			'value' : '',
			'label' : 'Seleccione...'
		},
		{
			'value' : "1",
			'label' : 'Cédula de ciudadanía'
		},
		{
			'value' : "2",
			'label' : 'NIT'
		},
		{
			'value' : "3",
			'label' : 'Cédula de extranjería'
		},
		{
			'value' : "4",
			'label' : 'Tarjeta de Identidad'
		},
		{
			'value' : "5",
			'label' : 'Pasaporte'
		},
		{
			'value' : "6",
			'label' : 'Tarjeta seguro social extranjero'
		},
		{
			'value' : "7",
			'label' : 'Sociedad extranjera sin NIT en Colombia'
		},
		{
			'value' : "8",
			'label' : 'Fidecoismo'
		},
		{
			'value' : "9",
			'label' : 'Registro Civil'
		},
		{
			'value' : "10",
			'label' : 'Carnet Diplomático'
		}
	];

	$scope.occupations = [
		{
			'value'	: '',
			'label' : 'Seleccione...'
		},
		{
			'value'	: 'EMPLEADO',
			'label' : 'Empleado'
		},
		{
			'value'	: 'SOLDADO-MILITAR-POLICÍA',
			'label' : 'Soldado - Militar - Policía'
		},
		{
			'value'	: 'PRESTACIÓN DE SERVICIOS',
			'label' : 'Prestación de Servicios'
		},
		{
			'value'	: 'INDEPENDIENTE CERTIFICADO',
			'label' : 'Independiente Certificado'
		},
		{
			'value'	: 'NO CERTIFICADO',
			'label' : 'No Certificado'
		},
		{
			'value'	: 'RENTISTA',
			'label' : 'Administrador de bienes propios'
		},
		{
			'value'	: 'PENSIONADO',
			'label' : 'Pensionado'
		}
	];

	$scope.cities = {};

	$scope.lead = {};

	$scope.getDataStep1 = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/api/oportuya/getDataStep1/',
		}).then(function successCallback(response) {
			hideLoader();
			$scope.cities = response.data;
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.validateEmail = function(){
		if($scope.leadInfo.email == $scope.leadInfo.emailConfirm){
			$scope.emailValidate = false;
		}else{
			$scope.emailValidate = true;
		}
	};
	
	$scope.confirmnumCel = function(){
		$('#confirmNumCel').modal('show');
	};

	$scope.getCodeVerification = function(){
		$('#confirmNumCel').modal('hide');
		showLoader();
		$http({
			method: 'GET',
			url: 'api/oportuya/getCode/'+$scope.leadInfo.identificationNumber+'/'+$scope.leadInfo.telephone,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == true){
				$('#confirmCodeVerification').modal('show');
			}
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.verificationCode = function(){
		showLoader();
		$http({
			method: 'GET',
			url: 'api/oportuya/verificationCode/'+$scope.code.code+'/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == true){
				$('#confirmCodeVerification').modal('show');
				$scope.saveStep1();
			}else if(response.data == -1){
				// en caso de que el codigo ya expiro
			}else if(response.data == -2){
				// En caso de que el codigo sea erroneo
			}
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.saveStep1 = function(){
		if($scope.emailValidate == false){
			$('#proccess').modal('show');
			$http({
				method: 'POST',
				url: '/oportuyaV2',
				data: $scope.leadInfo,
			  }).then(function successCallback(response) {
				  console.log(response.data);
				  if(response.data == "-1"){
					  window.location = "/OPN_gracias_FRM"
				  }
				  if(response.data == "-2"){
					$('#proccess').modal('hide');
					setTimeout(function(){ $('#cardExist').modal('show');}, 100);
				  }
				  if (response.data == "1") {
					  $scope.encryptText();
				  }
			  }, function errorCallback(response) {
				  console.log(response);
			  });
		}else{
			alert('Los correos no coinciden');
		}
		
	};

	$scope.encryptText = function(){
		$http({
		  method: 'GET',
		  url: '/api/encryptText/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			if (response.data != false) {
				window.location = "/step2/"+response.data;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.getDataStep1();
});