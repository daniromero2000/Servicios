angular.module('asessorVentaContadoApp', ['ngMaterial', 'ngMessages'])
.config(function($mdDateLocaleProvider) {
    $mdDateLocaleProvider.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $mdDateLocaleProvider.shortMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    $mdDateLocaleProvider.formatDate = function(date) {
       return moment(date).format('YYYY-MM-DD');
    };
})
.controller("asessorVentaContadoCtrl", function($scope, $http, $mdDialog) {
    $scope.lead = {
        'TIPO_DOC' : '1', 
        'CEDULA' : '', 
        'APELLIDOS' : '',
        'NOMBRES' : '', 
        'TIPOCLIENTE' : '',
        'SUBTIPO' : '',
        'EDAD' : '',
        'FEC_EXP' : '', 
        'CIUD_EXP' : '', 
        'SEXO' : '', 
        'FEC_NAC' : '', 
        'ESTADOCIVIL' : '', 
        'TIPOV' : '', 
        'PROPIETARIO' : '', 
        'VRARRIENDO' : '', 
        'DIRECCION' : '', 
        'TELFIJO' : '', 
        'CELULAR' : '',  
        'TIEMPO_VIV' : '', 
        'CIUD_UBI' : '', 
        'EMAIL' : '', 
        'ACTIVIDAD' : 'EMPLEADO', 
        'ACT_ECO' : '', 
        'NIT_EMP' : '', 
        'RAZON_SOC' : '', 
        'FEC_ING' : '', 
        'ANTIG' : '', 
        'CARGO' : '', 
        'DIR_EMP' : '', 
        'TEL_EMP' : '', 
        'TEL2_EMP' : '', 
        'TIPO_CONT' : '', 
        'SUELDO' : '', 
        'NIT_IND' : '', 
        'RAZON_IND' : '', 
        'ACT_IND' : '', 
        'EDAD_INDP' : '', 
        'FEC_CONST' : '', 
        'OTROS_ING' : '', 
        'ESTRATO' : '', 
        'SUELDOIND' : '', 
        'VCON_NOM1' : '', 
        'VCON_CED1' : '', 
        'VCON_TEL1' : '', 
        'VCON_NOM2' : '', 
        'VCON_CED2' : '', 
		'VCON_TEL2' : '',
		'VCON_DIR' : '',
        'MEDIO_PAGO' : '12', 
		'TRAT_DATOS' : 'SI', 
		'BANCOP' : '', 
		'CAMARAC' : '', 
		'CEL_VAL' : 0
    };
	$scope.code = {
		'code' : ''
	};
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
			'label' : 'Administrador de bienes propios'
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
			url: '/api/oportudata/getCodeVerification/'+$scope.lead.CEDULA+'/'+$scope.lead.CELULAR+'/SOLICITUD',
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
			$scope.lead = response.data[0];
			$scope.lead.CEL_VAL = 0;
			$scope.lead.CELULAR = '';
			$scope.lead.EMAIL = '';
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

	$scope.getCodeVerification = function(renew = false){
		showLoader();
		$http({
			method: 'GET',
			url: '/api/oportudata/getCodeVerification/'+$scope.lead.CEDULA+'/'+$scope.lead.CELULAR+'/SOLICITUD',
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
			url: '/api/oportuya/verificationCode/'+$scope.code.code+'/'+$scope.lead.CEDULA,
		}).then(function successCallback(response) {
			hideLoader();
			if(response.data == true){
				$('#confirmCodeVerification').modal('hide');
				$scope.addVentaContado();
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

	$scope.addVentaContado = function(){
		//$('#proccess').modal('show');
		$http({
			method: 'POST',
			url: '/assessor/api/ventaContado/addVentaContado',
			data: $scope.lead,
			}).then(function successCallback(response) {
				$scope.showConfirm();
				//$('#proccess').modal('hide');
			}, function errorCallback(response) {
				console.log(response);
			});
	};
	
	$scope.showConfirm = function(ev) {
		// Appending dialog to document.body to cover sidenav in docs app
		var confirm = $mdDialog.confirm()
				.title('Usuario registrado')
				.textContent('Usuario registrado satisfactoriamente')
				.ariaLabel('Lucky day')
				.targetEvent(ev)
				.ok('Nuevo Registro')
				.cancel('Volver')
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
		});
	};

	$scope.resetInfo = function(){
		$scope.lead = {
			'TIPO_DOC' : '1', 
			'CEDULA' : '', 
			'APELLIDOS' : '',
			'NOMBRES' : '', 
			'TIPOCLIENTE' : '',
			'SUBTIPO' : '',
			'EDAD' : '',
			'FEC_EXP' : '', 
			'CIUD_EXP' : '', 
			'SEXO' : '', 
			'FEC_NAC' : '', 
			'ESTADOCIVIL' : '', 
			'TIPOV' : '', 
			'PROPIETARIO' : '', 
			'VRARRIENDO' : '', 
			'DIRECCION' : '', 
			'TELFIJO' : '', 
			'CELULAR' : '',  
			'TIEMPO_VIV' : '', 
			'CIUD_UBI' : '', 
			'EMAIL' : '', 
			'ACTIVIDAD' : 'EMPLEADO', 
			'ACT_ECO' : '', 
			'NIT_EMP' : '', 
			'RAZON_SOC' : '', 
			'FEC_ING' : '', 
			'ANTIG' : '', 
			'CARGO' : '', 
			'DIR_EMP' : '', 
			'TEL_EMP' : '', 
			'TEL2_EMP' : '', 
			'TIPO_CONT' : '', 
			'SUELDO' : '', 
			'NIT_IND' : '', 
			'RAZON_IND' : '', 
			'ACT_IND' : '', 
			'EDAD_INDP' : '', 
			'FEC_CONST' : '', 
			'OTROS_ING' : '', 
			'ESTRATO' : '', 
			'SUELDOIND' : '', 
			'VCON_NOM1' : '', 
			'VCON_CED1' : '', 
			'VCON_TEL1' : '', 
			'VCON_NOM2' : '', 
			'VCON_CED2' : '', 
			'VCON_TEL2' : '',
			'VCON_DIR' : '',
			'MEDIO_PAGO' : '12', 
			'TRAT_DATOS' : 'SI', 
			'BANCOP' : '', 
			'CAMARAC' : '', 
			'CEL_VAL' : 0
		};
		$scope.code = {
			'code' : ''
		};
	};
	$scope.getInfoVentaContado();
});