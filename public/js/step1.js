angular.module('appStep1', ['moment-picker'])
	.controller("step1Ctrl", function ($scope, $http, $timeout) {
		$scope.myModel = "";
		$scope.reNewToken = false;
		$scope.emailValidate = false;
		$scope.showAlertCode = false;
		$scope.showWarningCode = false;
		$scope.showInfoCode = false;
		$scope.showWarningErrorData = false;
		$scope.totalErrorData = 0;
		$scope.validateNum = 0;
		$scope.telephone = '';
		$scope.code = {
			'code': ''
		};
		$scope.leadInfo = {
			'step': 1,
			'channel': 1,
			'typeService': 'Oportuya',
			'typeDocument': '',
			'identificationNumber': '',
			'dateDocumentExpedition': '',
			'name': '',
			'lastName': '',
			'email': '',
			'emailConfirm': '',
			'telephone': '',
			'occupation': '',
			'city': '',
			'termsAndConditions': '',
			'CEL_VAL': 0
		};

		$scope.typesDocuments = [
			{
				'value': '',
				'label': 'Seleccione...'
			},
			{
				'value': "1",
				'label': 'Cédula de ciudadanía'
			},
			{
				'value': "2",
				'label': 'NIT'
			},
			{
				'value': "3",
				'label': 'Cédula de extranjería'
			},
			{
				'value': "4",
				'label': 'Tarjeta de Identidad'
			},
			{
				'value': "5",
				'label': 'Pasaporte'
			},
			{
				'value': "6",
				'label': 'Tarjeta seguro social extranjero'
			},
			{
				'value': "7",
				'label': 'Sociedad extranjera sin NIT en Colombia'
			},
			{
				'value': "8",
				'label': 'Fidecoismo'
			},
			{
				'value': "9",
				'label': 'Registro Civil'
			},
			{
				'value': "10",
				'label': 'Carnet Diplomático'
			}
		];

		$scope.occupations = [
			{
				'value': '',
				'label': 'Seleccione...'
			},
			{
				'value': 'EMPLEADO',
				'label': 'Empleado'
			},
			{
				'value': 'SOLDADO-MILITAR-POLICÍA',
				'label': 'Soldado - Militar - Policía'
			},
			{
				'value': 'PRESTACIÓN DE SERVICIOS',
				'label': 'Prestación de Servicios'
			},
			{
				'value': 'INDEPENDIENTE CERTIFICADO',
				'label': 'Independiente Certificado - (Con cámara de comercio)'
			},
			{
				'value': 'NO CERTIFICADO',
				'label': 'No Certificado'
			},
			{
				'value': 'RENTISTA',
				'label': 'Administrador de bienes propios'
			},
			{
				'value': 'PENSIONADO',
				'label': 'Pensionado'
			}
		];

		$scope.cities = {};

		$scope.lead = {};

		$scope.getDataStep1 = function () {
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/getDataStep1/',
			}).then(function successCallback(response) {
				hideLoader();
				$scope.cities = response.data;
			}, function errorCallback(response) {
				hideLoader();
				response.url = '/api/oportuya/getDataStep1/';
				$scope.addError(response, $scope.leadInfo.identificationNumber);
				console.log(response);
			});
		};

		$scope.validateEmail = function () {
			if ($scope.leadInfo.email == $scope.leadInfo.emailConfirm) {
				$scope.emailValidate = false;
			} else {
				$scope.emailValidate = true;
			}
		};

		$scope.confirmnumCel = function () {
			if ($scope.leadInfo.typeDocument == '') {
				alert('Por favor selecciona el tipo de documento');
			} else if ($scope.leadInfo.occupation == '') {
				alert('Por favor selecciona una ocupación');
			} else if ($scope.leadInfo.city == '') {
				alert('Por favor selecciona una ciudad');
			} else {
				$scope.getValidationLead();
			}
		};

		$scope.getNumCel = function () {
			$scope.leadInfo.CEL_VAL = 0;
			$scope.leadInfo.telephone = '';
			if ($scope.leadInfo.identificationNumber != '') {
				$http({
					method: 'GET',
					url: '/api/oportuya/getNumLead/' + $scope.leadInfo.identificationNumber,
				}).then(function successCallback(response) {
					if (typeof response.data.resp == 'number') {

					} else {
						var num = response.data.resp.NUM.substring(0, 6);
						var telephone = response.data.resp.NUM.replace(num, "******");
						$scope.leadInfo.CEL_VAL = response.data.resp.CEL_VAL;
						$scope.telephone = telephone;
						$scope.leadInfo.telephone = response.data.resp.NUM;
					}
				}, function errorCallback(response) {
					response.url = '/api/oportuya/getNumLead/' + $scope.leadInfo.identificationNumber;
					$scope.addError(response, $scope.leadInfo.identificationNumber);
					console.log(response);
				});
			}
		};

		$scope.checkIfExistNum = function () {
			if ($scope.leadInfo.telephone != '') {
				$http({
					method: 'GET',
					url: '/api/checkIfExistNum/' + $scope.leadInfo.telephone + '/' + $scope.leadInfo.identificationNumbe,
				}).then(function successCallback(response) {
					if (response.data >= 1) {
						alert("Este número de celular ya esta registrado con otra cédula, por favor verifícalo");
						$scope.leadInfo.telephone = "";
					} else {
						console.log("Validado!!!");
					}
				}, function errorCallback(response) {
					response.url = '/api/checkIfExistNum/' + $scope.leadInfo.telephone;
					$scope.addError(response, $scope.leadInfo.identificationNumber);
					console.log(response);
				});
			}
		};

		$scope.getValidationLead = function () {
			if ($scope.emailValidate == false) {
				showLoader();
				$http({
					method: 'GET',
					url: '/api/oportuya/validationLead/' + $scope.leadInfo.identificationNumber,
				}).then(function successCallback(response) {
					hideLoader();
					if (response.data == -1) {
						$('#cardExist').modal('show');
					} else if (response.data == -2) {
						window.location = "/Employed";
					} else if (response.data == -3) {
						window.location = "/UsuarioPendiente";
					} else if (response.data == -4) {
						window.location = "/UsuarioMoroso";
					} else {
						if ($scope.totalErrorData >= 2) {
							$scope.deniedLeadForFecExp("1");
						} else {
							if ($scope.validateNum == 1) {
								$scope.saveStep1();
							} else {
								$('#confirmNumCel').modal('show');
								//$scope.saveStep1();
							}
						}
					}
				}, function errorCallback(response) {
					hideLoader();
					response.url = '/api/oportuya/validationLead/' + $scope.leadInfo.identificationNumber;
					$scope.addError(response, $scope.leadInfo.identificationNumber);
					console.log(response);
				});
			} else {
				alert('Los correos no coinciden');
			}
		}

		$scope.deniedLeadForFecExp = function (typeDenied) {
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/deniedLeadForFecExp/' + $scope.leadInfo.identificationNumber + '/' + typeDenied,
			}).then(function successCallback(response) {
				hideLoader();
				window.location = "/OPN_gracias_denied";
			}, function errorCallback(response) {
				response.url = '/api/oportuya/deniedLeadForFecExp/' + $scope.leadInfo.identificationNumber + '/' + typeDenied;
				$scope.addError(response, $scope.leadInfo.identificationNumber);
				hideLoader();
				console.log(response);
			});
		};

		$scope.cerrar = function () {
			$('#confirmNumCel').modal('hide');
		};

		$scope.getCodeVerification = function (renew = false) {
			$scope.reNewToken = false;
			$('#confirmNumCel').modal('hide');
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportudata/getCodeVerification/' + $scope.leadInfo.identificationNumber + '/' + $scope.leadInfo.telephone + '/SOLICITUD',
			}).then(function successCallback(response) {
				hideLoader();
				if (response.data == true) {
					if (renew == true) {
						alert('Código generado exitosamente');
						$timeout(function () {
							$scope.reNewToken = true;
						}, 15000);
					} else {
						$timeout(function () {
							$scope.reNewToken = true;
						}, 15000);
						$('#confirmCodeVerification').modal('show');
					}
				}

				if (response.data == -1) {
					$scope.saveStep1();
				}
			}, function errorCallback(response) {
				hideLoader();
				response.url = '/api/oportudata/getCodeVerification/' + $scope.leadInfo.identificationNumber + '/' + $scope.leadInfo.telephone + '/SOLICITUD';
				$scope.addError(response, $scope.leadInfo.identificationNumber);
				console.log(response);
			});
		};

		$scope.verificationCode = function () {
			if ($scope.code.code != '') {
				showLoader();
				$http({
					method: 'GET',
					url: '/api/oportuya/verificationCode/' + $scope.code.code + '/' + $scope.leadInfo.identificationNumber,
				}).then(function successCallback(response) {
					hideLoader();
					if (response.data == true) {
						$scope.validateNum = 1;
						$('#confirmCodeVerification').modal('hide');
						$scope.saveStep1();
					} else if (response.data == -1) {
						// En caso de que el codigo sea erroneo
						$scope.showAlertCode = true;
					} else if (response.data == -2) {
						// en caso de que el codigo ya expiro
						$scope.showWarningCode = true;
					}
				}, function errorCallback(response) {
					hideLoader();
					console.log(response);
					response.url = '/api/oportuya/verificationCode/' + $scope.code.code + '/' + $scope.leadInfo.identificationNumber;
					$scope.addError(response, $scope.leadInfo.identificationNumber);
				});
			} else {
				alert('Por favor ingresa el token correspondiente');
			}
		};

		$scope.saveStep1 = function () {
			$('#proccess').modal('show');
			$http({
				method: 'POST',
				url: '/oportuyaV2',
				data: $scope.leadInfo,
			}).then(function successCallback(response) {
				if (response.data == "1") {
					$scope.encryptText();
				}

				if (response.data == "-1") {
					$scope.deniedLeadForFecExp("2");
				}

				if (response.data == "-3" || response.data == "-4") {
					$scope.totalErrorData++;
					$scope.showWarningErrorData = true;
					setTimeout(function () { $('#proccess').modal('hide'); }, 800);
				}
				setTimeout(function () { $('#proccess').modal('hide'); }, 800);
			}, function errorCallback(response) {
				setTimeout(function () { $('#proccess').modal('hide'); }, 800);
				response.url = '/oportuyaV2';
				$scope.addError(response, $scope.leadInfo.identificationNumber);
			});
		};

		$scope.encryptText = function () {
			$http({
				method: 'GET',
				url: '/api/encryptText/' + $scope.leadInfo.identificationNumber,
			}).then(function successCallback(response) {
				if (response.data != false) {
					window.location = "/step2/" + response.data;
				}
			}, function errorCallback(response) {
				response.url = '/api/encryptText/' + $scope.leadInfo.identificationNumber;
				$scope.addError(response, $scope.leadInfo.identificationNumber);
			});
		};

		$scope.addError = function (response, cedula = '') {
			var arrayData = {
				url: response.url,
				mensaje: response.data.message,
				archivo: response.data.file,
				linea: response.data.line,
				cedula: cedula,
				datos: (response.datos) ? response.datos : [],
				origen: 'step1'
			}

			var data = {
				status: response.status,
				data: angular.toJson(arrayData)
			}
			$http({
				method: 'POST',
				url: '/api/appError',
				data: data,
			}).then(function successCallback(response) {
				setTimeout(() => {
					$('#congratulations').modal('hide');
					$('#proccess').modal('hide');
					$('#confirmCodeVerification').modal('hide');
					$('#validationLead').modal('hide');
					$('#decisionCredit').modal('hide');
					$('#error').modal('show');
				}, 100);
				$scope.numError = response.data.id;
			}, function errorCallback(response) {
				console.log(response);
			});
		};

		$scope.getDataStep1();
	});
