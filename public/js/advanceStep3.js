angular.module('appAdvacneStep3', ['moment-picker', 'ng-currency'])
.controller("advanceStep3Ctrl", function($scope, $http) {
	$scope.quota = 0;
	$scope.numSolic = 0;
	$scope.textPreaprobado = 0;
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
		bankSavingsAccount:null,
		NOM_REFPER: '',
		TEL_REFPER: '',
		NOM_REFFAM: '',
		TEL_REFFAM: ''
	};

	$scope.timesContact = [
		{
			label: '6 A.M',
			value: '6 A.M'
		},
		{
			label: '7 A.M',
			value: '7 A.M'
		},
		{
			label: '8 A.M',
			value: '8 A.M'
		},
		{
			label: '9 A.M',
			value: '9 A.M'
		},
		{
			label: '10 A.M',
			value: '10 A.M'
		},
		{
			label: '11 A.M',
			value: '11 A.M'
		},
		{
			label: '12 M',
			value: '12 M'
		},
		{
			label: '1 P.M',
			value: '1 P.M'
		},
		{
			label: '2 P.M',
			value: '2 P.M'
		},
		{
			label: '3 P.M',
			value: '3 P.M'
		},
		{
			label: '4 P.M',
			value: '4 P.M'
		},
		{
			label: '5 P.M',
			value: '5 P.M'
		},
		{
			label: '6 P.M',
			value: '6 P.M'
		}
	];

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
			if(response.data == -1){
				window.location = "/OPNTR_gracias_denied";
			}

			if(response.data == -2){
				window.location = "/OPN_gracias_denied";
			}

			if(response.data == -3){
				window.location = "/UsuarioPendiente";
			}

			if (response.data.data == true) {
				$scope.quota = response.data.quota;
				$scope.numSolic = response.data.numSolic;
				$scope.textPreaprobado = response.data.textPreaprobado;
				$('#congratulations').modal('show');
			}
			
			if(response.data.data == false){
				window.location = "/OPN_gracias_denied";
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
				window.location="/OP_gracias_FRM";
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	setTimeout(function(){ $scope.getDataStep3();}, 1);
});