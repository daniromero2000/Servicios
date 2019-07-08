angular.module('asessorVentaContadoApp', ['ngMaterial', 'ngMessages'])
.config(function($mdDateLocaleProvider) {
    $mdDateLocaleProvider.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $mdDateLocaleProvider.shortMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    $mdDateLocaleProvider.formatDate = function(date) {
       return moment(date).format('YYYY-MM-DD');
    };
})
.controller("asessorVentaContadoCtrl", function($scope, $http) {
    $scope.lead = {
        'TIPO_DOC' : '01', 
        'CEDULA' : '', 
        'APELLIDOS' : '',
        'NOMBRES' : '', 
        'TIPOCLIENTE' : '',
        'SUBTIPO' : '',
        'EDAD' : '',
        'FEC_EXP' : '', 
        'CIUD_EXP' : '', 
        'SEXO' : '', 
        'PERSONAS' : '',
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
        'MEDIO_PAGO' : '12', 
		'TRAT_DATOS' : 'SI', 
		'BANCOP' : '', 
		'CAMARAC' : '', 
		'CEL_VAL' : 0
    };

    $scope.typesDocuments = [
		{
			'value' : "01",
			'label' : 'Cédula de ciudadanía'
		},
		{
			'value' : "02",
			'label' : 'NIT'
		},
		{
			'value' : "03",
			'label' : 'Cédula de extranjería'
		},
		{
			'value' : "04",
			'label' : 'Tarjeta de Identidad'
		},
		{
			'value' : "05",
			'label' : 'Pasaporte'
		},
		{
			'value' : "06",
			'label' : 'Tarjeta seguro social extranjero'
		},
		{
			'value' : "07",
			'label' : 'Sociedad extranjera sin NIT en Colombia'
		},
		{
			'value' : "08",
			'label' : 'Fidecoismo'
		},
		{
			'value' : "09",
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
  
  $scope.getInfoVentaContado();
});