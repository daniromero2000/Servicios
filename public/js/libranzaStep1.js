angular.module('appLibranzaStep1', [])
.controller("libranzaStep1Ctrl", function($scope, $http) {
	$scope.myModel = "";
	$scope.emailValidate = false;
	$scope.disabledInputs = true;
	$scope.showAlertCode = false;
	$scope.showWarningCode = false;
	$scope.showInfoCode = false;
	$scope.leadInfo = {
		'step' : 1,
		'channel' : 1,
		'typeService' : 'libranza',
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
	$scope.code = {
		'code' : ''
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
		  url: '/creditoLibranza/getDataStep1/',
		}).then(function successCallback(response) {
			hideLoader();
            $scope.cities = response.data;
            console.log(response.data);
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
	
	$scope.getValidationLead = function(){
		if($scope.emailValidate == false){
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/validationLead/'+$scope.leadInfo.identificationNumber,
			}).then(function successCallback(response) {
				hideLoader();
				if(response.data == -1){
					$('#cardExist').modal('show');
				}else if(response.data == -2){
					window.location = "/Employed";
				}else{
					$scope.confirmnumCel();
				}
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		}else{
			alert('Los correos no coinciden');
		}
		
	}

	$scope.confirmnumCel = function(){
		if($scope.leadInfo.typeDocument == ''){
			alert('Por favor selecciona el tipo de documento');
		}else if($scope.leadInfo.occupation == ''){
			alert('Por favor selecciona una ocupación');
		}else if($scope.leadInfo.occupation == ''){
			alert('Por favor selecciona una ciudad');
		}else{
			$('#confirmNumCel').modal('show');
		}
	};

	$scope.cerrar = function(){
		$('#confirmNumCel').modal('hide');
	};

	$scope.getCodeVerification = function(renew = false){
		$('#confirmNumCel').modal('hide');
		showLoader();
		$http({
			method: 'GET',
			url: '/api/oportudata/getCodeVerification/'+$scope.leadInfo.identificationNumber+'/'+$scope.leadInfo.telephone,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == true){
				if(renew == true){
					alert('Código generado exitosamente');
				}else{
					$('#confirmCodeVerification').modal('show');
				}
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
			url: '/api/oportuya/verificationCode/'+$scope.code.code+'/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == true){
				$('#confirmCodeVerification').modal('hide');
				$scope.saveStep1();
			}else if(response.data == -1){
				// En caso de que el codigo sea erroneo
				$scope.showAlertCode = true;
			}else if(response.data == -2){
				// en caso de que el codigo ya expiro
				$scope.showWarningCode = true;
			}
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.saveStep1 = function(){
		$('#proccess').modal('show');
		$http({
			method: 'POST',
			url: '/libranzaV2',
			data: $scope.leadInfo,
			}).then(function successCallback(response) {
				console.log(response.data);
				if(response.data[0] == "-1"){
					window.location = "/OPN_gracias_denied_advance"
				}
				if(response.data[0] == "-2"){
                    console.log('-2: error')
				/*$('#proccess').modal('hide');
				setTimeout(function(){ $('#cardExist').modal('show');}, 100);*/
				}
				if (response.data[0] == "1") {
					$scope.encryptText();
				}
			}, function errorCallback(response) {
				console.log(response);
			});
	};

	$scope.encryptText = function(){
		$http({
		  method: 'GET',
		  url: '/creditoLibranza/encryptText/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			if (response.data != false) {
				window.location = "/creditoLibranza/step2/"+response.data;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.getDataStep1();
});