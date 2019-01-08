angular.module('appAssessorStep3', ['moment-picker', 'ng-currency'])
.controller("assessorStep3Ctrl", function($scope, $http) {
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
		typeContract: null,
		otherRevenue: '',
		camaraComercio: null,
		whatSell:'',
		dateCreationCompany: '',
		bankSavingsAccount:null
	};

	$scope.comment = {
		step: 'comment',
		availability: '',
		comment: '',
		identificationNumber: ''
	};

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

	$scope.typesCamaraComercio = [
		{
			value: 'SI',
			label: 'Si'
		},
		{
			value: 'NO',
			label: 'No'
		}
	];

	$scope.idForm = "";
	$scope.banks = {};
	$scope.dataLead = {};
	$scope.analyst = {};

	$scope.getDataStep3 = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/api/oportuya/getDataStep3/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			hideLoader();
			$scope.banks = response.data.banks;
			$scope.analyst = response.data.digitalAnalyst;
			$scope.leadInfo = response.data.oportudataLead;
			$scope.leadInfo.step = 3;
			$scope.leadInfo.antiquity = ($scope.leadInfo.antiquity != 0 && $scope.leadInfo.antiquity != '') ? $scope.leadInfo.antiquity : '' ;
			$scope.leadInfo.salary = ($scope.leadInfo.salary != 0 && $scope.leadInfo.salary != '') ? $scope.leadInfo.salary : '' ;
			$scope.leadInfo.otherRevenue = ($scope.leadInfo.otherRevenue != 0 && $scope.leadInfo.otherRevenue != '') ? $scope.leadInfo.otherRevenue : '' ;
		}, function errorCallback(response) {
			hideLoader();
			console.log(response);
		});
	};

	$scope.saveStep3 = function(){
		$http({
		  method: 'POST',
		  url: '/oportuyaV2',
		  data: $scope.leadInfo,
		}).then(function successCallback(response) {
			if (response.data != false) {
				$('#congratulations').modal('show');
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	$scope.sendComment = function(){
		$scope.comment.identificationNumber = $scope.leadInfo.identificationNumber;
		$http({
		  method: 'POST',
		  url: '/oportuyaV2',
		  data: $scope.comment,
		}).then(function successCallback(response) {
			if (response.data != false) {
				window.location="/assessor/dashboard";
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	setTimeout(function(){ $scope.getDataStep3();}, 1);
});