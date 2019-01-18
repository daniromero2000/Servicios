angular.module('appAssessorStep1', [])
.controller("assessorStep1Ctrl", function($scope, $http) {
	$scope.myModel = "";
	$scope.emailValidate = false;
	$scope.disabledInputs = true;
	$scope.leadInfo = {
		'step' : 1,
		'channel' : 1,
		'typeService' : 'Terjeta de crédito Oportuya',
		'typeDocument' : '',
		'identificationNumber' : '',
		'assessor' : '',
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
			$scope.cities = response.data.cities;
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.getContactData = function(){
		var assessor = $scope.leadInfo.assessor;
		$scope.disabledInputs = false;
		showLoader();
		$http({
		  method: 'GET',
		  url: '/api/oportuya/getContactData/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			hideLoader();
			$scope.leadInfo = response.data;
			$scope.leadInfo.emailConfirm = response.data.email;
			$scope.leadInfo.step= 1 ;
			$scope.leadInfo.channel = 1;
			$scope.leadInfo.typeService = 'Terjeta de crédito Oportuya';
			$scope.leadInfo.assessor = assessor;
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

	$scope.saveStep1 = function(){
		if($scope.emailValidate == false){
			$('#proccess').modal('show');
			$http({
				method: 'POST',
				url: '/oportuyaV2',
				data: $scope.leadInfo,
			  }).then(function successCallback(response) {
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
				window.location = "/assessor/step2/"+response.data;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.getDataStep1();
});