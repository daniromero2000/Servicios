angular.module('appStep3', ['moment-picker'])
.controller("step3Ctrl", function($scope, $http) {
	$scope.leadInfo = {
		step: 3,
		identificationNumber: '',
		nit: '',
		indicative: '',
		companyName: '',
		companyAddres: '',
		companyTelephone: '',
		companyTelephone2: '',
		eps: '',
		companyPosition: '',
		admissionDate: '',
		antiquity: '',
		salary: '',
		typeContract: '',
		otherRevenue: '',
		camaraComercio: '',
		whatSell:'',
		dateCreationCompany: '',
		bankSavingsAccount:''
	};

	$scope.typesContracts = [
		{
			value: 'fijo',
			label: 'Fijo'
		},
		{
			value: 'indefinido',
			label: 'indefinido'
		}
	];

	$scope.typesCamaraComercio = [
		{
			value: 'Si',
			label: 'Si'
		},
		{
			value: 'No',
			label: 'No'
		}
	];

	$scope.idForm = "";
	$scope.banks = {};
	$scope.dataLead = {};

	$scope.getDataStep3 = function(){
		$http({
		  method: 'GET',
		  url: '/api/oportuya/getDataStep3/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			$scope.banks = response.data.banks;
			$scope.dataLead = response.data.dataLead;
			if($scope.dataLead.occupation == 'Empleado'){
				$scope.idForm = "formEmpleado";
			}else if($scope.dataLead.occupation == 'Independiente'){
				$scope.idForm = "formIdependiente";
			}else{
				$scope.idForm = "formPensionado";
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.saveStep3 = function(){
		var csrftoken = document.getElementById($scope.idForm).children[0].value;
		$http({
		  method: 'POST',
		  url: '/oportuyaV2',
		  data: $scope.leadInfo,
		  headers: {
		     'X-CSRF-TOKEN': csrftoken
		   },
		}).then(function successCallback(response) {
			if (response.data != false) {
				console.log(response);
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	setTimeout(function(){ $scope.getDataStep3();}, 1);
});