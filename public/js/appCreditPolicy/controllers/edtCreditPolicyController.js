app.controller('edtCreditPolicyController', function($scope, $http, $routeParams, $location){
    $scope.creditPolicy = {};

    $scope.getCreditPolicy = function(){
        $http({
            method: 'GET',
            url: '/creditPolicy/'+$routeParams.id_creditPolicy+'/edit'
          }).then(function successCallback(response) {
              $scope.creditPolicy = response.data;
          }, function errorCallback(response) {
              console.log(response);
          });
  
    };

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
    
    $scope.volver = function(){
        $location.url('/CreditPolicy');
    };

    $scope.edtCreditPolicy = function(){
        showLoader();
        $http({
            method: 'PUT',
            url: '/creditPolicy/'+$scope.creditPolicy.id,
            data: $scope.creditPolicy
          }).then(function successCallback(response) {
              hideLoader();
          }, function errorCallback(response) {
              hideLoader();
              console.log(response);
          });
    };

    $scope.getCreditPolicy();
});