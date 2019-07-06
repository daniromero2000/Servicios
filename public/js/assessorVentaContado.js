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
        'ESTUDIOS' : '',
        'POSEEVEH' : '',
        'PLACA' : '',
        'PROFESION' : '',
        'TIPOV' : '',
        'PROPIETARIO' : '',
        'TEL_PROP' : '',
        'VRARRIENDO' : '',
        'DIRECCION' : '',
        'TELFIJO' : '',
        'CELULAR' : '',
        'TIEMPO_VIV' : '',
        'CIUD_UBI' : '',
        'EMAIL' : '',
        'DEPTO' : '',
        'ACTIVIDAD' : '',
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
        'N_EMPLEA' : '',
        'VENTASMES' : '',
        'COSTOSMES' : '',
        'GASTOS' : '',
        'DEUDAMES' : '',
        'OTROS_ING' : '',
        'ESTRATO' : '',
        'SUELDOIND' : '',
        'CIUD_NAC' : '',
        'VCON_NOM1' : '',
        'VCON_CED1' : '',
        'VCON_TEL1' : '',
        'VCON_NOM2' : '',
        'VCON_CED2' : '',
        'VCON_TEL2' : '',
        'VCON_DIR' : '',
        'MEDIO_PAGO' : '',
        'TRAT_DATOS' : ''
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
});