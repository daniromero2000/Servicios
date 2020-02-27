angular.module('asessorVentaContadoApp', ['moment-picker', 'ng-currency', 'ngSanitize'])
.controller("asessorVentaContadoCtrl", function($scope, $http, $timeout) {
	$timeout(function() {
		$scope.lead.CIUD_EXP = 5002;
		$scope.lead.CIUD_UBI = 144;
	}, 1500);
	$scope.code = {};
	$scope.formConfronta = {};
	$scope.citiesUbi = {};
	$scope.cities = {};
	$scope.banks = {};
	$scope.tipoCliente = "";
	$scope.estadoCliente = "";
	$scope.messageValidationLead = "";
	$scope.showWarningErrorData = false;
	$scope.reNewToken = false;
	$scope.totalErrorData = 0;
	$scope.validateNum = 0;
	$scope.numError = 0;
	$scope.decisionCredit = "";
	$scope.disabledDecisionCredit = false;
	$scope.disabledButton = false;
	$scope.disabledButtonCode = false;
    $scope.typesDocuments = [
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
			'label' : 'Independiente Certificado - (Con cámara de comercio)'
		},
		{
			'value'	: 'NO CERTIFICADO',
			'label' : 'No Certificado'
		},
		{
			'value'	: 'RENTISTA',
			'label' : 'Rentista'
		},
		{
			'value'	: 'PENSIONADO',
			'label' : 'Pensionado'
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
			{ label : 'Masculino',value: 'M' },
			{ label : 'Femenino',value: 'F' }
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

	$scope.getInfoVentaContado = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/assessor/api/ventaContado/getInfoVentaContado',
		}).then(function successCallback(response) {
			hideLoader();
			$scope.citiesUbi = response.data.ubicationsCities;
			$scope.cities = response.data.cities;
			$scope.banks = response.data.banks;
		}, function errorCallback(response) {
			hideLoader();
			response.url = '/assessor/api/ventaContado/getInfoVentaContdado';
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.addError = function(response, cedula = ''){
		var arrayData = {
			url: response.url,
			mensaje: response.data.message,
			archivo: response.data.file,
			linea: response.data.line,
			cedula: cedula
		}

		var data = {
			status : response.status,
			data: angular.toJson(arrayData)
		}
		$http({
			method: 'POST',
			url: '/Administrator/appError',
			data: data,
		}).then(function successCallback(response) {
			setTimeout(() => {
				$('#congratulations').modal('hide');
				$('#proccess').modal('hide');
				$('#confirmCodeVerification').modal('hide');
				$('#validationLead').modal('hide');
				$('#decisionCredit').modal('hide');
				$('#error').modal('show');
			}, 1800);
			$scope.numError = response.data.id;
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.getCodeVerification = function(renew = false){
		$scope.disabledButtonCode = false;
		$scope.reNewToken = false;
		$scope.disabledButton = true;
		if($scope.validateNum > 0){
			$scope.addCliente('CREDITO');
		}else{
			showLoader();
			$http({
				method: 'GET',
				url   : '/api/oportudata/getCodeVerification/'+$scope.lead.CEDULA+'/'+$scope.lead.CELULAR+'/SOLICITUD',
			}).then(function successCallback(response) {
				hideLoader();
				if(response.data == true){
					if(renew == true){
						alert('Código generado exitosamente');
						$timeout(function() {
							$scope.reNewToken = true;
						}, 15000);
					}else{
						$timeout(function() {
							$scope.reNewToken = true;
						}, 15000);
						$('#confirmCodeVerification').modal('show');
					}
				}
			}, function errorCallback(response) {
				hideLoader();
				response.url = '/api/oportudata/getCodeVerification/'+$scope.lead.CEDULA+'/'+$scope.lead.CELULAR+'/SOLICITUD';
				console.log(response);
				$scope.addError(response, $scope.lead.CEDULA);
			});
		}
	};

	$scope.getInfoLead = function(){
		$scope.getinfoLeadVentaContado();
		setTimeout(() => {
			$scope.getNumCel();
		}, 1000);
	};

	$scope.getinfoLeadVentaContado = function(){
		$http({
			method: 'GET',
			url: '/assessor/api/ventaContado/getinfoLeadVentaContado/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			if(response.data == false){
				var cedula = angular.extend({}, $scope.lead);
				$scope.resetInfo();
				$scope.lead.CEDULA = cedula.CEDULA;
				delete cedula;
			}else{
				$scope.lead = response.data[0];
				$scope.lead.CEL_VAL = 0;
				$scope.lead.CELULAR = '';
				$scope.lead.EMAIL = '';
			}
		}, function errorCallback(response) {
			response.url = '/assessor/api/ventaContado/getinfoLeadVentaContado/'+$scope.lead.CEDULA;
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.getValidationLead = function(){
		showLoader();
		$http({
			method: 'GET',
			url: '/api/oportuya/validationLead/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == -1){
				$('#validationLead').modal('show');
				$scope.messageValidationLead = "Actualmente ya cuentas <br> con una <b>Tarjeta Oportuya</b>.<br>Te invitamos a que la utilices en <br>cualquiera de nuestros puntos de venta! <br><br>Para más información comunicate  <br>a la línea <strong>01 8000 11 77 87</strong>";
			}else if(response.data == -2){
				$('#validationLead').modal('show');
				$scope.messageValidationLead = "En nuestra base de datos se registra que tienes una relación laboral con la organización, comunícate a nuestras líneas de atención, para conocer las opciones que tenemos para ti .";
			}else if(response.data == -3){
				$('#validationLead').modal('show');
				$scope.messageValidationLead = "Actualmente ya cuentas con una solicitud que está siendo procesada.";
			}else if(response.data == -4){
				$('#validationLead').modal('show');
				$scope.messageValidationLead = "Estimado usuario, no es posible continuar con el proceso de crédito ya que presenta mora con Almacenes Oportunidades.";
			}else{
				$scope.getInfoLead();
				console.log("Validado !!");
			}
		}, function errorCallback(response) {
			hideLoader();
			response.url = '/api/oportuya/validationLead/'+$scope.lead.CEDULA;
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	}

	$scope.getNumCel = function(){
		$scope.lead.CEL_VAL = 0;
		$scope.lead.CELULAR = '';
		$http({
			method: 'GET',
			url: '/api/oportuya/getNumLead/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			if(typeof response.data.resp == 'number'){
			}else{
				var num = response.data.resp.NUM.substring(0,6);
				var CELULAR = response.data.resp.NUM.replace(num, "******");
				$scope.lead.CEL_VAL = response.data.resp.CEL_VAL;
				$scope.CELULAR = CELULAR;
				$scope.lead.CELULAR = response.data.resp.NUM;
			}
		}, function errorCallback(response) {
			response.url = '/api/oportuya/getNumLead/'+$scope.lead.CEDULA;
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.checkIfExistNum = function(){
		$http({
			method: 'GET',
			url: '/api/checkIfExistNum/'+$scope.lead.CELULAR+'/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			if(response.data >= 1){
				alert("Este número de celular ya esta registrado con otra cédula, por favor verifícalo");
				$scope.lead.CELULAR = "";
			}else{
				console.log("Validado!!!");
			}
		}, function errorCallback(response) {
			response.url = '/api/checkIfExistNum/'+$scope.lead.CELULAR+'/'+$scope.lead.CEDULA;
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.verificationCode = function(){
		$scope.disabledButtonCode = true;
		showLoader();
		$http({
			method: 'GET',
			url: '/api/oportuya/verificationCode/'+$scope.code.code+'/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			if(response.data == true){
				$scope.validateNum = 1;
				$('#confirmCodeVerification').modal('hide');
				$scope.addCliente($scope.tipoCliente);
			}else if(response.data == -1){
				$scope.disabledButtonCode = false;

				// En caso de que el codigo sea erroneo
				$scope.showAlertCode = true;
			}else if(response.data == -2){
				$scope.disabledButtonCode = false;
				// en caso de que el codigo ya expiro
				$scope.showWarningCode = true;
			}
			hideLoader();
		}, function errorCallback(response) {
			response.url='/api/oportuya/verificationCode/'+$scope.code.code+'/'+$scope.lead.CEDULA;
			hideLoader();
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.addCliente = function(tipoCreacion){
		$('#proccess').modal('show');
		$scope.lead.tipoCliente = tipoCreacion;
		showLoader();
		$http({
			method: 'POST',
			url: '/assessor/api/ventaContado/addVentaContado',
			data: $scope.lead,
		}).then(function successCallback(response) {
			if(tipoCreacion == 'CONTADO'){
				setTimeout(() => {
					$('#proccess').modal('hide');
					$scope.showConfirm();
				}, 1000);
			}
			if(tipoCreacion == 'CREDITO'){
				$scope.execConsultasLead(response.data.identificationNumber);
			}
		}, function errorCallback(response) {
			response.url = '/assessor/api/ventaContado/addVentaContado';
			hideLoader();
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.changeDesicionCredit = function(value){
		$scope.decisionCredit = value;
	}

	$scope.execConsultasLead = function(identificationNumber){
		$('#proccess').modal('show');
		$http({
			method: 'GET',
			url: '/assessor/api/execConsultasLead/'+identificationNumber,
		}).then(function successCallback(response) {
			$timeout(function() {
				$('#proccess').modal('hide');
			}, 800);

			$scope.resp = response.data;
			if ($scope.resp.resp == "true" || $scope.resp.resp == "-2") {
				$('#decisionCredit').modal('show');
			}

			if ($scope.resp.resp == -3 || $scope.resp.resp == -4 || $scope.resp.resp == -1) {
				$scope.totalErrorData ++;
				$scope.showWarningErrorData = true;
				$scope.disabledButton = false;
				if($scope.totalErrorData >= 2){
					$scope.deniedLeadForFecExp('1');
				}
			}

			if(response.data.resp == 'false'){
				$scope.estadoCliente = "NEGADO";
				setTimeout(() => {
					$('#congratulations').modal('show');
				}, 1800);
			}
		}, function errorCallback(response) {
			response.url = '/assessor/api/execConsultasLead/'+identificationNumber;
			console.log(response);
			$('#proccess').modal('hide');
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.desistCredit = function(){
		var opcion = confirm("Desea desistir la solicitud de crédito ?");
		if(opcion == true){
			$('#decisionCredit').modal('hide');
			$http({
				method: 'GET',
				url: '/assessor/api/desistCredit/'+$scope.lead.CEDULA,
			}).then(function successCallback(response) {
				location.reload(); 
			});
		}
	};

	$scope.sendDecisionCredit = function(){
		$('#decisionCredit').modal('hide');
		$('#proccess').modal('show');
		$scope.disabledDecisionCredit = true;
		if($scope.decisionCredit == 1){
			$scope.creditCard();
		}else if($scope.decisionCredit == 2){
			$scope.traditionalCredit();
		}
	};

	$scope.creditCard = function(){
		showLoader();
		$http({
			method: 'GET',
			url: '/assessor/api/decisionCreditCard/'
			+$scope.lead.APELLIDOS+'/'
			+$scope.lead.CEDULA+'/'
			+$scope.resp.quotaApprovedProduct+'/'
			+$scope.resp.quotaApprovedAdvance+'/'
			+$scope.lead.FEC_EXP+'/'
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/'
			+$scope.resp.policy.fuenteFallo+'/',
		}).then(function successCallback(response) {
			if (response.data.resp == 'true') {
				$scope.quota = response.data.quotaApprovedProduct;
				$scope.quotaAdvance = response.data.quotaApprovedAdvance;
				$scope.numSolic = response.data.infoLead.numSolic;
				$scope.estadoCliente = response.data.estadoCliente;
				setTimeout(() => {
					$('#confronta').modal('hide');
				}, 800);
				setTimeout(() => {
					$('#proccess').modal('hide');
					$('#congratulations').modal('show');
				}, 1800);
			}

			if(response.data.resp == 'confronta'){
				$scope.formConfronta = response.data.form;
				$('#confronta').modal('show');
				$('#proccess').modal('hide');
			}
			setTimeout(() => {
				$('#proccess').modal('hide');
			}, 1000);
			hideLoader();
		}, function errorCallback(response) {
			response.url = '/assessor/api/decisionCreditCard/'
			+$scope.lead.APELLIDOS+'/'
			+$scope.lead.CEDULA+'/'
			+$scope.resp.quotaApprovedProduct+'/'
			+$scope.resp.quotaApprovedAdvance+'/'
			+$scope.lead.FEC_EXP+'/'
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/'
			+$scope.resp.policy.fuenteFallo+'/';
			hideLoader();
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.traditionalCredit = function(){
		$http({
			method: 'GET',
			url: '/assessor/api/decisionTraditionalCredit/'
			+$scope.lead.CEDULA+'/'
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/',
		}).then(function successCallback(response) {
			$scope.numSolic = response.data.infoLead.numSolic;
			$scope.estadoCliente = "TRADICIONAL";
			setTimeout(() => {
				$('#proccess').modal('hide');
				$('#congratulations').modal('show');
			}, 1500);
			hideLoader();
		}, function errorCallback(response) {
			response.url = '/assessor/api/decisionTraditionalCredit/'
			+$scope.lead.CEDULA+'/'
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/';
			hideLoader();
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.sendConfronta = function(){
		$scope.infoConfronta = {
			'confronta' : $scope.formConfronta,
			'leadInfo' : $scope.lead
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
		}, function errorCallback(response) {
			response.url = '/assessor/api/validateFormConfronta';
			hideLoader();
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.showConfirm = function(ev) {
		$scope.estadoCliente = "CONTADO";
		$timeout(function() {
			$('#congratulations').modal('show');
		}, 1500);
	};

	$scope.resetInfoLead = function(){
		showLoader();
		hideLoader();
	};

	$scope.resetInfo = function(){
		$scope.lead = {
			'TIPO_DOC' : '1',
			'ACTIVIDAD' : 'EMPLEADO',
			'MEDIO_PAGO' : '12',
			'TRAT_DATOS' : 'SI',
			'CEL_VAL' : 0
		};
		$scope.code = {
			'code' : ''
		};
	};

	$scope.deniedLeadForFecExp = function(typeDenied){
		showLoader();
		$http({
			method: 'GET',
			url: '/api/oportuya/deniedLeadForFecExp/'+$scope.lead.CEDULA+'/'+typeDenied,
		}).then(function successCallback(response) {
			hideLoader();
			$('#validationLead').modal('show');
				$scope.messageValidationLead = "Lo sentimos, en este momento por políticas de crédito,<br />tu solicitud no ha sido aprobada";
		}, function errorCallback(response) {
			response.url = '/api/oportuya/deniedLeadForFecExp/'+$scope.lead.CEDULA+'/'+typeDenied;
			hideLoader();
			console.log(response);
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.getInfoVentaContado();
	$scope.resetInfo();
})

.controller("realizarAnalisisCtrl", function($scope, $http, $timeout) {
	$scope.infoLead = {};
	$scope.lead = {};
	$scope.showResp = false;

	$scope.getInfoLead = function(){
		$http({
			method: 'GET',
			url: '/assessor/api/getInfoLead/'+$scope.lead.cedula,
		  }).then(function successCallback(response) {
			$scope.infoLead = response.data;
			$scope.showResp = true;
			hideLoader();
		  }, function errorCallback(response) {
			  response.url = '/assessor/api/getInfoLead/'+$scope.lead.cedula;
			  hideLoader();
			  console.log(response);
			  $scope.addError(response, $scope.lead.CEDULA);
		  });
	};
})
