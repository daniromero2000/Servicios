angular.module('appStep2', ['moment-picker'])
.controller("step2Ctrl", function($scope, $http) {
	$scope.myModel = "";
	$scope.leadInfo = {
		step: 2,
		identificationNumber: '',
		dateDocumentExpedition: '',
		cityExpedition: null,
		housingType: null,
		housingTime: '',
		housingOwner: '',
		addres: '',
		leaseValue: '',
		housingTelephone: '',
		stratum: '',
		birthdate: '',
		gender: null,
		civilStatus: null,
		spouseName: '',
		spouseIdentificationNumber: '',
		spouseTelephone: '',
		spouseJobName: '',
		spouseProfession: '',
		spouseJob: '',
		spouseSalary: '',
		spouseEps: ''
	};

	$scope.genders = [
		{ label : 'Masculino',value: 'M' },
		{ label : 'Femenino',value: 'F' }
	];

	$scope.cities = {};

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

	$scope.lead = {};
	$scope.analyst = {};

	$scope.getDataStep2 = function(){
		$http({
		  method: 'GET',
		  url: '/api/oportuya/getDataStep2/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			$scope.lead = response.data.dataLead;
			$scope.analyst = response.data.digitalAnalyst;
			$scope.cities = response.data.cities;
			$scope.leadInfo = response.data.oportudataLead;
			$scope.leadInfo.step = 2;
			$scope.leadInfo.cityExpedition = ($scope.leadInfo.cityExpedition != null && $scope.leadInfo.cityExpedition != NaN && $scope.leadInfo.cityExpedition != '') ? parseInt($scope.leadInfo.cityExpedition) : null;
			$scope.leadInfo.housingType = ($scope.leadInfo.housingType != null && $scope.leadInfo.housingType != NaN && $scope.leadInfo.housingType != '') ? $scope.leadInfo.housingType : null;
			$scope.leadInfo.gender = ($scope.leadInfo.gender != null && $scope.leadInfo.gender != NaN && $scope.leadInfo.gender != '') ? $scope.leadInfo.gender : null;
			$scope.leadInfo.civilStatus = ($scope.leadInfo.civilStatus != null && $scope.leadInfo.civilStatus != NaN && $scope.leadInfo.civilStatus != '') ? $scope.leadInfo.civilStatus : null;
		}, function errorCallback(response) {
			console.log(response);
		});
	};


	$scope.changeHousingType = function(){
		if($scope.leadInfo.housingType == 'familiar' || $scope.leadInfo.housingType == 'propia'){
			$scope.leadInfo.leaseValue = "";
		}
	};

	$scope.saveStep2 = function(){
		var csrftoken = document.getElementById('step2Form').children[0].value;
		$http({
		  method: 'POST',
		  url: '/oportuyaV2',
		  data: $scope.leadInfo,
		  headers: {
		     'X-CSRF-TOKEN': csrftoken
		   },
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.encryptText();
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	$scope.encryptText = function(){
		$http({
		  method: 'GET',
		  url: '/api/encryptText/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			if (response.data != false) {
				window.location = "/step3/"+response.data;
			}
		}, function errorCallback(response) {
		    
		});
	};

	setTimeout(function(){ $scope.getDataStep2();}, 1);
});