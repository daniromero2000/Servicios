angular.module('insurancesCreditApp', ['moment-picker', 'ng-currency', 'ngSanitize'])
	.controller("insurancesCreditCtrl", function ($scope, $http, $timeout) {
		$scope.messageValidationLead = "";
		$scope.showWarningErrorData = false;
		$scope.totalErrorData = 0;
		$scope.formConfronta = {};
		$scope.estadoCliente = "";
		$scope.datosCliente = {};
		$scope.validateNum = 0;
		$scope.tipoCliente = "";
		$scope.citiesUbi = {};
		$scope.cities = {};
		$scope.banks = {};
		$scope.lead = {};
		$scope.code = {};

		$scope.typesDocuments = [
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
				'label': 'Rentista'
			},
			{
				'value': 'PENSIONADO',
				'label': 'Pensionado'
			}
		];

		$scope.housingTypes = [
			{
				label: 'Propia',
				value: 'PROPIA'
			},
			{
				label: 'Arriendo',
				value: 'ARRIENDO'
			},
			{
				label: 'Familiar',
				value: 'FAMILIAR'
			}
		];

		$scope.genders = [
			{ label: 'Masculino', value: 'M' },
			{ label: 'Femenino', value: 'F' }
		];

		$scope.civilTypes = [
			{
				label: 'Soltero',
				value: 'SOLTERO'
			},
			{
				label: 'Casado',
				value: 'CASADO'
			},
			{
				label: 'Unión Libre',
				value: 'UNION LIBRE'
			},
			{
				label: 'Viudo',
				value: 'VIUDO'
			},
		];

		$scope.typesContracts = [
			{
				value: 'FIJO',
				label: 'Fijo'
			},
			{
				value: 'INDEFINIDO',
				label: 'Indefinido'
			},
			{
				value: 'SERVICIOS',
				label: 'Servicios'
			}
		];

		$scope.getInfoForm = function () {
			$scope.lead.TIPO_DOC = '1';
			$scope.lead.CIUD_UBI = 144;
			$scope.lead.ACTIVIDAD = "EMPLEADO";
			$scope.lead.TIPO_CONT = "FIJO";
			$scope.lead.ORIGEN = "Seguros";
			showLoader();
			$http({
				method: 'GET',
				url: '/api/seguros/credito/getInfoForm',
			}).then(function successCallback(response) {
				hideLoader();
				$scope.citiesUbi = response.data.ubicationsCities;
				$scope.cities = response.data.cities;
				$scope.banks = response.data.banks;
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		};

		$scope.getValidationLead = function () {
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/validationLead/' + $scope.lead.CEDULA,
			}).then(function successCallback(response) {
				hideLoader();
				if (response.data == -1) {
					$('#validationLead').modal('show');
					$scope.messageValidationLead = "Actualmente ya cuentas <br> con una <b>Tarjeta Oportuya</b>.<br>Te invitamos a que la utilices en <br>cualquiera de nuestros puntos de venta! <br><br>Para más información comunicate  <br>a la línea <strong>01 8000 18 05 20</strong>";
				} else if (response.data == -2) {
					$('#validationLead').modal('show');
					$scope.messageValidationLead = "En nuestra base de datos se registra que tienes una relación laboral con la organización, comunícate a nuestras líneas de atención, para conocer las opciones que tenemos para ti .";
				} else if (response.data == -3) {
					$('#validationLead').modal('show');
					$scope.messageValidationLead = "Actualmente ya cuentas con una solicitud que está siendo procesada.";
				} else if (response.data == -4) {
					$('#validationLead').modal('show');
					$scope.messageValidationLead = "Estimado usuario, no es posible continuar con el proceso de crédito ya que presenta mora con Almacenes Oportunidades.";
				} else {
					$scope.getNumCel();
					console.log("Validado !!");
				}
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		}

		$scope.getNumCel = function () {
			$scope.lead.CEL_VAL = 0;
			$scope.lead.CELULAR = '';
			$scope.lead.ORIGEN = "SEGUROS";
			$http({
				method: 'GET',
				url: '/api/oportuya/getNumLead/' + $scope.lead.CEDULA,
			}).then(function successCallback(response) {
				if (typeof response.data.resp == 'number') {

				} else {
					var num = response.data.resp.NUM.substring(0, 6);
					var CELULAR = response.data.resp.NUM.replace(num, "******");
					$scope.lead.CEL_VAL = response.data.resp.CEL_VAL;
					$scope.CELULAR = CELULAR;
					$scope.lead.CELULAR = response.data.resp.NUM;
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		};

		$scope.getCodeVerification = function (renew = false) {
			if ($scope.validateNum > 0) {
				$scope.addCliente();
			} else {
				$scope.reNewToken = true;
				showLoader();
				$http({
					method: 'GET',
					url: '/api/oportudata/getCodeVerification/' + $scope.lead.CEDULA + '/' + $scope.lead.CELULAR + '/SOLICITUD',
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
				}, function errorCallback(response) {
					hideLoader();
					console.log(response);
				});
			}
		};

		$scope.verificationCode = function () {
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/verificationCode/' + $scope.code.code + '/' + $scope.lead.CEDULA,
			}).then(function successCallback(response) {
				if (response.data == true) {
					$scope.validateNum = 1;
					$('#confirmCodeVerification').modal('hide');
					$scope.addCliente();
				} else if (response.data == -1) {
					// En caso de que el codigo sea erroneo
					$scope.showAlertCode = true;
				} else if (response.data == -2) {
					// en caso de que el codigo ya expiro
					$scope.showWarningCode = true;
				}
				hideLoader();
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		};

		$scope.addCliente = function () {
			showLoader();
			$http({
				method: 'POST',
				url: '/seguros',
				data: $scope.lead,
			}).then(function successCallback(response) {
				hideLoader();
				$scope.execConsultasLead($scope.lead.CEDULA);
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		};

		$scope.execConsultasLead = function (identificationNumber) {
			$http({
				method: 'GET',
				url: '/api/oportuya/execConsultasLead/' + identificationNumber,
			}).then(function successCallback(response) {
				if (response.data == "-3" || response.data == "-4" || response.data == "-1") {
					$scope.totalErrorData++;
					$scope.showWarningErrorData = true;
					if ($scope.totalErrorData >= 2) {
						$scope.deniedLeadForFecExp('1.1');
					}
				}

				if (response.data.resp == 'confronta') {
					$scope.formConfronta = response.data.form;
					$('#confronta').modal('show');
				}

				if (response.data.resp == 'true') {
					$scope.quota = response.data.quotaApprovedProduct;
					$scope.quotaAdvance = response.data.quotaApprovedAdvance;
					$scope.numSolic = response.data.infoLead.numSolic;
					$scope.estadoCliente = response.data.estadoCliente;
					setTimeout(() => {
						$('#confronta').modal('hide');
					}, 800);
					setTimeout(() => {
						$('#congratulations').modal('show');
					}, 1800);
				}

				if (response.data.resp.resp == 'false') {
					$scope.estadoCliente = "NEGADO";
					setTimeout(() => {
						$('#congratulations').modal('show');
					}, 1800);
				}

				if (response.data.resp.resp == "-2") {
					$scope.estadoCliente = "TRADICIONAL";
					setTimeout(() => {
						$('#congratulations').modal('show');
					}, 1800);
				}
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		};

		$scope.sendConfronta = function () {
			$scope.infoConfronta = {
				'confronta': $scope.formConfronta,
				'leadInfo': $scope.lead
			};
			$http({
				method: 'POST',
				url: '/assessor/api/validateFormConfronta',
				data: $scope.infoConfronta,
			}).then(function successCallback(response) {
				if (response.data.data == true) {
					$scope.quota = response.data.quota;
					$scope.quotaAdvance = response.data.quotaAdvance;
					$scope.numSolic = response.data.numSolic;
					$scope.estadoCliente = response.data.estado;
					setTimeout(() => {
						$('#confronta').modal('hide');
					}, 800);
					setTimeout(() => {
						$('#congratulations').modal('show');
					}, 1800);
				}
			});
		};

		$scope.deniedLeadForFecExp = function (typeDenied) {
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/deniedLeadForFecExp/' + $scope.lead.CEDULA + '/' + typeDenied,
			}).then(function successCallback(response) {
				hideLoader();
				$('#validationLead').modal('show');
				$scope.messageValidationLead = "Lo sentimos, en este momento por políticas de crédito,<br />tu solicitud no ha sido aprobada";
			}, function errorCallback(response) {
				hideLoader();
				console.log(response);
			});
		};

		$scope.getInfoForm();
	});