angular.module('appLibranzaStep2', ['moment-picker', 'ng-currency'])
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
		spouseEps: '',
		nationality:'',
		occupation:''
	};

	$scope.countries={};


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
		showLoader();
		$http({
		  method: 'GET',
		  url: '/creditoLibranza/getDataStep2/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			hideLoader();
			$scope.ced=$scope.leadInfo.identificationNumber;
			$scope.countries = response.data.countries;
			$scope.analyst = response.data.digitalAnalyst;
			$scope.cities = response.data.cities;
			$scope.leadInfo = response.data.dataLead[0];
			$scope.leadInfo.identificationNumber = $scope.ced;
			$scope.leadInfo.step = 2;
			$scope.leadInfo.occupation=response.data.occupation;
			console.log(response);
		}, function errorCallback(response) {
			console.log(response);
			hideLoader();
		});
	};


	$scope.changeHousingType = function(){
		if($scope.leadInfo.housingType == 'FAMILIAR' || $scope.leadInfo.housingType == 'PROPIA'){
			$scope.leadInfo.leaseValue = "";
		}

		if($scope.leadInfo.housingType == 'FAMILIAR' || $scope.leadInfo.housingType == 'ARRIENDO'){
			var myEl = angular.element( document.querySelector( '#housingOwner' ) );
			myEl.attr('required',"true");
		}

		if($scope.leadInfo.housingType == 'PROPIA'){
			var myEl = angular.element( document.querySelector( '#housingOwner' ) );
			myEl.removeAttr('required');
		}
	};

	$scope.saveStep2 = function(){
		var csrftoken = document.getElementById('step2Form').children[0].value;
		$http({
		  method: 'POST',
		  url: '/libranzaV2',
		  data: $scope.leadInfo,
		  headers: {
		     'X-CSRF-TOKEN': csrftoken
		   },
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.encryptText();
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.encryptText = function(){
		$http({
		  method: 'GET',
		  url: '/creditoLibranza/encryptText/'+$scope.leadInfo.identificationNumber,
		}).then(function successCallback(response) {
			if (response.data != false) {
				window.location = "/creditoLibranza/step3/"+response.data;
			}
		}, function errorCallback(response) {
		    
		});
	};

	setTimeout(function(){ $scope.getDataStep2();}, 1);
});