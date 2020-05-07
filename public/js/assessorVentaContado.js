angular.module('asessorVentaContadoApp', ['moment-picker', 'ng-currency', 'ngSanitize'])
.controller("asessorVentaContadoCtrl", function($scope, $http, $timeout) {
	$scope.code                    = {};
	$scope.formConfronta           = {};
	$scope.citiesUbi               = {};
	$scope.professions             = {};
	$scope.cities                  = {};
	$scope.banks                   = {};
	$scope.kinships                = {}
	$scope.tipoCliente             = "";
	$scope.estadoCliente           = "";
	$scope.messageValidationLead   = "";
	$scope.showWarningErrorData    = false;
	$scope.reNewToken              = false;
	$scope.totalErrorData          = 0;
	$scope.validateNum             = 0;
	$scope.numError                = 0;
	$scope.decisionCredit          = "";
	$scope.disabledDecisionCredit  = false;
	$scope.disabledButton          = false;
	$scope.disabledButtonCode      = false;
	$scope.disabledButtonSolic     = false;
	$scope.showAlertCiudUbi        = false;
	$scope.showAlertCiudExp        = false;
	$scope.showAlertCel            = false;
	$scope.disabledButtonStep2     = false;
	$scope.showAlertCiudUbiContado = false;
	$scope.showAlertSalary         = false;
	$scope.step                   = 1;
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

	$scope.scolarities = [
		{
			value: 'PRIMARIA',
			label: 'Primaria'
		},
		{
			value: 'BACHILLERATO',
			label: 'Bachillerato'
		},
		{
			value: 'TECN/TECNOLOGICO',
			label: 'Tecn/Tecnológico'
		},
		{
			value: 'UNIVERSITARIO',
			label: 'Universitario'
		},
		{
			value: 'ESPECIALIZACION',
			label: 'Especialización'
		}
	];

	$scope.stratum = [
		{
			value:'1',
			label:'1'
		},
		{
			value:'2',
			label:'2'
		},
		{
			value:'3',
			label:'3'
		},
		{
			value:'4',
			label:'4'
		},
		{
			value:'5',
			label:'5'
		},
		{
			value:'6',
			label:'6'
		}
	];

	$scope.concepts = [
		{
			value: 'EXCELENTE',
			label: 'Excelente'
		},
		{
			value: 'BUENO',
			label: 'Bueno'
		},
		{
			value: 'REGULAR',
			label: 'Regular'
		},
		{
			value: 'MALO',
			label: 'Malo'
		},
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
			$scope.professions = response.data.professions;
			$scope.kinships = response.data.kinships;
		}, function errorCallback(response) {
			hideLoader();
			response.url = '/assessor/api/ventaContado/getInfoVentaContdado';
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.addError = function(response, cedula = ''){
		var arrayData = {
			url: response.url,
			mensaje: response.data.message,
			archivo: response.data.file,
			linea: response.data.line,
			cedula: cedula,
			datos: (response.datos) ? response.datos : []
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

	$scope.validateStep1 = function(){
		$scope.disabledButton = true;
		if($scope.lead.CIUD_UBI == '' || typeof $scope.lead.CIUD_UBI == 'undefined' || $scope.lead.CIUD_UBI == null){
			$scope.showAlertCiudUbi = true;
			$scope.disabledButton   = false;
		}else if($scope.lead.CELULAR == '' || typeof $scope.lead.CELULAR == 'undefined' || $scope.lead.CELULAR == null){
			$scope.showAlertCel   = true;
			$scope.disabledButton = false;
		}else{
			$scope.addTemporaryCustomer();
		}
	};

	$scope.validateStep2 = function(){
		$scope.disabledButtonStep2    = true;
		if($scope.lead.CIUD_EXP == '' || typeof $scope.lead.CIUD_EXP == 'undefined' || $scope.lead.CIUD_EXP == null){
			$scope.showAlertCiudExp    = true;
			$scope.disabledButtonStep2 =  false;
		}else {
			$scope.addCliente('CREDITO');
		}
	};

	$scope.validateStep4 = function(){
		if($scope.lead.ACTIVIDAD == 'EMPLEADO' || $scope.lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || $scope.lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'){
			if($scope.lead.SUELDO < 100000){
				$scope.showAlertSalary = true;
			}else{
				$scope.addCliente('CREDITO');
			}
		}else if($scope.lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $scope.lead.ACTIVIDAD == 'NO CERTIFICADO' || $scope.lead.ACTIVIDAD == 'RENTISTA'){
			if($scope.lead.SUELDOIND < 100000){
				$scope.showAlertSalary = true;
			}else{
				$scope.addCliente('CREDITO');
			}
		}else if($scope.lead.ACTIVIDAD == 'PENSIONADO'){
			if($scope.lead.SUELDOIND < 100000){
				$scope.showAlertSalary = true;
			}else{
				$scope.addCliente('CREDITO');
			}
		}
	}

	$scope.validateVentaContado = function(){
		if($scope.lead.CIUD_UBI == '' || typeof $scope.lead.CIUD_UBI == 'undefined' || $scope.lead.CIUD_UBI == null){
			$scope.showAlertCiudUbiContado = true;
		}else {
			$scope.addCliente('CONTADO');
		}
	};

	$scope.addTemporaryCustomer = function(){
		$http({
			method: 'POST',
			url: '/Administrator/temporaryCustomer',
			data: $scope.lead,
		}).then(function successCallback(response) {
			$scope.getCodeVerification();
		}, function errorCallback(response) {
			response.url = '/Administrator/temporaryCustomer';
			response.datos = $scope.lead;
			hideLoader();
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.deleteTemporaryCustomer = function(){
		$http({
			method: 'DELETE',
			url: '/Administrator/temporaryCustomer/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			console.log("Eliminado !!");
		}, function errorCallback(response) {
			response.url = '/Administrator/temporaryCustomer/'+$scope.lead.CEDULA;
			hideLoader();
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.getCodeVerification = function(renew = false){
		$scope.disabledButtonCode = false;
		$scope.reNewToken = false;
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
						}, 900000);
					}else{
						$timeout(function() {
							$scope.reNewToken = true;
						}, 900000);
						$('#confirmCodeVerification').modal('show');
					}
				}

				if(response.data == '-1'){
					$scope.addCliente('CREDITO');
				}
			}, function errorCallback(response) {
				hideLoader();
				response.url = '/api/oportudata/getCodeVerification/'+$scope.lead.CEDULA+'/'+$scope.lead.CELULAR+'/SOLICITUD';
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
				$scope.lead = response.data;
				$scope.lead.CEL_VAL = 0;
				$scope.lead.CELULAR = '';
			}
		}, function errorCallback(response) {
			response.url = '/assessor/api/ventaContado/getinfoLeadVentaContado/'+$scope.lead.CEDULA;
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.getValidationLead = function(){
		if($scope.lead.CEDULA > 0){
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/validationLead/'+$scope.lead.CEDULA,
			}).then(function successCallback(response) {
				hideLoader();
				if(response.data == -2){
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
				$scope.addError(response, $scope.lead.CEDULA);
			});
		}
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
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.checkIfExistNum = function(){
		if($scope.lead.CELULAR != '' && $scope.lead.CEDULA != ''){
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
				$scope.addError(response, $scope.lead.CEDULA);
			});
		}
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
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.addCliente = function(tipoCreacion){
		$scope.deleteTemporaryCustomer();
		$('#proccess').modal('show');
		$scope.disabledButtonStep2    = false;
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
			if(tipoCreacion == 'CREDITO' && $scope.step == 1){
				$scope.execConsultasLead(response.data.identificationNumber);
			}else{
				setTimeout(() => {
					$('#proccess').modal('hide');
				}, 1000);
				$scope.step++;
				$scope.lead.PARENTESCO = 'YERNO';
				$scope.lead.PARENTESC2 = 'YERNO';
			}
		}, function errorCallback(response) {
			response.url = '/assessor/api/ventaContado/addVentaContado';
			response.datos = $scope.lead;
			hideLoader();
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.changeDesicionCredit = function(value){
		$scope.decisionCredit = value;
	};

	$scope.close = function(){
		$('#showWarningErrorData').modal('hide');

	};

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
				$scope.step ++;
			}

			if ($scope.resp.resp == -3 || $scope.resp.resp == -4 || $scope.resp.resp == -1) {
				$scope.totalErrorData ++;
				$scope.showWarningErrorData = true;
				$scope.disabledButton = false;
				if($scope.totalErrorData >= 2){
					$scope.deniedLeadForFecExp('1');
				}else{
					$('#showWarningErrorData').modal('show');
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
		$scope.disabledDecisionCredit = true;
		$scope.step = 2;
	};

	$scope.addSolic = function(){
		$scope.disabledButtonSolic = true;
		if($scope.decisionCredit == 1){
			$scope.creditCard();
		}else{
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
			+$scope.lead.DIR_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFPE2+'/'
			+$scope.lead.DIR_REFPE2+'/'
			+$scope.lead.TEL_REFPE2+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.DIR_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/'
			+$scope.lead.PARENTESCO+'/'
			+$scope.lead.NOM_REFFA2+'/'
			+$scope.lead.DIR_REFFA2+'/'
			+$scope.lead.TEL_REFFA2+'/'
			+$scope.lead.PARENTESC2+'/'
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
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.DIR_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFPE2+'/'
			+$scope.lead.DIR_REFPE2+'/'
			+$scope.lead.TEL_REFPE2+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.DIR_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/'
			+$scope.lead.PARENTESCO+'/'
			+$scope.lead.NOM_REFFA2+'/'
			+$scope.lead.DIR_REFFA2+'/'
			+$scope.lead.TEL_REFFA2+'/'
			+$scope.lead.PARENTESC2+'/'
			+$scope.resp.policy.fuenteFallo+'/';
			hideLoader();
			$scope.addError(response, $scope.lead.CEDULA);
		});
	};

	$scope.traditionalCredit = function(){
		$http({
			method: 'GET',
			url: '/assessor/api/decisionTraditionalCredit/'
			+$scope.lead.CEDULA+'/'
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.DIR_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFPE2+'/'
			+$scope.lead.DIR_REFPE2+'/'
			+$scope.lead.TEL_REFPE2+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.DIR_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/'
			+$scope.lead.PARENTESCO+'/'
			+$scope.lead.NOM_REFFA2+'/'
			+$scope.lead.DIR_REFFA2+'/'
			+$scope.lead.TEL_REFFA2+'/'
			+$scope.lead.PARENTESC2+'/'
		}).then(function successCallback(response) {
			$scope.numSolic = response.data.infoLead.numSolic;
			$scope.estadoCliente = "TRADICIONAL";
			setTimeout(() => {
				$('#confronta').modal('hide');
			}, 800);
			setTimeout(() => {
				$('#proccess').modal('hide');
				$('#congratulations').modal('show');
			}, 1800);
			hideLoader();
		}, function errorCallback(response) {
			response.url = '/assessor/api/decisionTraditionalCredit/'
			+$scope.lead.CEDULA+'/'
			+$scope.lead.NOM_REFPER+'/'
			+$scope.lead.DIR_REFPER+'/'
			+$scope.lead.TEL_REFPER+'/'
			+$scope.lead.NOM_REFPE2+'/'
			+$scope.lead.DIR_REFPE2+'/'
			+$scope.lead.TEL_REFPE2+'/'
			+$scope.lead.NOM_REFFAM+'/'
			+$scope.lead.DIR_REFFAM+'/'
			+$scope.lead.TEL_REFFAM+'/'
			+$scope.lead.PARENTESCO+'/'
			+$scope.lead.NOM_REFFA2+'/'
			+$scope.lead.DIR_REFFA2+'/'
			+$scope.lead.TEL_REFFA2+'/'
			+$scope.lead.PARENTESC2+'/';
			hideLoader();
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
			response.datos = $scope.infoConfronta;
			hideLoader();
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
			  $scope.addError(response, $scope.lead.CEDULA);
		  });
	};
})
