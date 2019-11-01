angular.module('asessorVentaContadoApp', ['moment-picker', 'ng-currency'])
.controller("asessorVentaContadoCtrl", function($scope, $http) {
	$scope.tipoCliente = "";
	$scope.lead = {};
	$scope.infoLead = {};
	$scope.code = {};
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
	$scope.citiesUbi = {};
	$scope.cities = {};
	$scope.banks = {};

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
			console.log(response);
		});
  	};
	
	$scope.getCodeVerification = function(renew = false){
		showLoader();
		$http({
			method: 'GET',
			url   : '/api/oportudata/getCodeVerification/'+$scope.lead.CEDULA+'/'+$scope.lead.CELULAR+'/SOLICITUD',
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
			if(response.data == 'false'){
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
			console.log(response);
		});
	};

	$scope.getNumCel = function(){
		$scope.lead.CEL_VAL = 0;
		$scope.lead.CELULAR = '';
		$http({
			method: 'GET',
			url: '/api/oportuya/getNumLead/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			if(typeof response.data.resp == 'number'){
				
			}else{
				var num = response.data.resp[0].NUM.substring(0,6);
				var CELULAR = response.data.resp[0].NUM.replace(num, "******");
				$scope.lead.CEL_VAL = response.data.resp[0].CEL_VAL;
				$scope.CELULAR = CELULAR;
				$scope.lead.CELULAR = response.data.resp[0].NUM;
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.verificationCode = function(){
		showLoader();
		$http({
			method: 'GET',
			url: '/api/oportuya/verificationCode/'+$scope.code.code+'/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == true){
				$('#confirmCodeVerification').modal('hide');
				$scope.addCliente('CREDITO');
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

	$scope.addCliente = function(tipoCreacion){
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
				$scope.execConsultasLead(response.identificationNumber, repsonse.tipoDoc, response.tipoCreacion, response.lastName, repsonse.dateExpIdentification);
			}
			hideLoader();
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};
	
	$scope.execConsultasLead = function(identificationNumber, tipoDoc, tipoCreacion, lastName, dateExpIdentification){
		$http({
			method: 'GET',
			url: '/api/oportuya/execConsultasLead/'+identificationNumber+'/'+tipoDoc+'/'+tipoCreacion,
		}).then(function successCallback(response) {
			if(response.data.resp == 'true'){
				$scope.infoLead = response.data.infoLead;
				setTimeout(() => {
					$('#proccess').modal('hide');
					$('#showResp').modal('show')
				}, 100);
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.showConfirm = function(ev) {
		// Appending dialog to document.body to cover sidenav in docs app
		/*var confirm = $mdDialog.confirm()
				.title('Usuario registrado')
				.textContent('Usuario registrado satisfactoriamente')
				.ariaLabel('Lucky day')
				.targetEvent(ev)
				.ok('Nuevo Registro')
				.cancel('Menú')
				.openFrom({
					top: -50,
					width: 30,
					height: 80
				})
				.closeTo({
					left: 500
				});

		$mdDialog.show(confirm).then(function() {
			$scope.resetInfo();
			location.reload();
		}, function() {
			$scope.resetInfo();
			window.location = '/assessor/dashboard';
		});*/
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
	$scope.getInfoVentaContado();
	$scope.resetInfo();
});