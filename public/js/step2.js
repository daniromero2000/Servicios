angular.module('appStep2', ['moment-picker'])
.controller("step2Ctrl", function($scope, $http) {
	$scope.leadInfo = {
		step: 2,
		identificationNumber: '',
		dateDocumentExpedition: '',
		cityExpedition: '',
		housingType: '',
		housingTime: '',
		housingOwner: '',
		addres: '',
		leaseValue: '',
		housingTelephone: '',
		stratum: '',
		birthdate: '',
		gender: '',
		civilStatus: '',
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
		{ label : 'Masculino',value: 'masculino' },
		{ label : 'Femenino',value: 'femenino' }
	];

	$scope.cities = {};

	$scope.housingTypes = [
		{
			label: 'Propia',
			value: 'propia'
		},
		{
			label: 'Arriendo',
			value: 'arriendo'
		},
		{
			label: 'Familiar',
			value: 'familiar'
		}
	];

	$scope.civilTypes = [
		{
			label: 'Soltero',
			value: 'soltero'
		},
		{
			label: 'Casado',
			value: 'casado'
		},
		{
			label: 'Unión Libre',
			value: 'union libre'
		},
		{
			label: 'Viudo',
			value: 'viudo'
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