angular.module('appAdvanceStep2', ['moment-picker', 'ng-currency'])
	.controller("advanceStep2Ctrl", function ($scope, $http) {
		$scope.myModel = "";
		$scope.leadInfo = {
			step: 2,
			identificationNumber: '',
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
			{ label: 'Masculino', value: 'M' },
			{ label: 'Femenino', value: 'F' }
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

		$scope.getDataStep2 = function () {
			showLoader();
			$http({
				method: 'GET',
				url: '/api/oportuya/getDataStep2/' + $scope.leadInfo.identificationNumber,
			}).then(function successCallback(response) {
				hideLoader();
				$scope.analyst = response.data.digitalAnalyst;
				$scope.cities = response.data.cities;
				$scope.leadInfo = response.data.oportudataLead;
				$scope.leadInfo.step = 2;
				$scope.leadInfo.cityExpedition = ($scope.leadInfo.cityExpedition != null && $scope.leadInfo.cityExpedition != NaN && $scope.leadInfo.cityExpedition != '') ? $scope.leadInfo.cityExpedition : '';
				$scope.leadInfo.stratum = ($scope.leadInfo.stratum != null && $scope.leadInfo.stratum != NaN && $scope.leadInfo.stratum != '') ? $scope.leadInfo.stratum : '';
				$scope.leadInfo.housingTime = ($scope.leadInfo.housingTime != null && $scope.leadInfo.housingTime != NaN && $scope.leadInfo.housingTime != '') ? $scope.leadInfo.housingTime : '';
			}, function errorCallback(response) {
				hideLoader();
				response.url = '/api/oportuya/getDataStep2/' + $scope.leadInfo.identificationNumber;
				$scope.addError(response, $scope.leadInfo.identificationNumber);
				console.log(response);
			});
		};


		$scope.changeHousingType = function () {
			if ($scope.leadInfo.housingType == 'FAMILIAR' || $scope.leadInfo.housingType == 'PROPIA') {
				$scope.leadInfo.leaseValue = "";
			}

			if ($scope.leadInfo.housingType == 'FAMILIAR' || $scope.leadInfo.housingType == 'ARRIENDO') {
				var myEl = angular.element(document.querySelector('#housingOwner'));
				myEl.attr('required', "true");
			}

			if ($scope.leadInfo.housingType == 'PROPIA') {
				var myEl = angular.element(document.querySelector('#housingOwner'));
				myEl.removeAttr('required');
			}
		};

		$scope.saveStep2 = function () {
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
				response.url = '/oportuyaV2' + $scope.leadInfo.identificationNumber;
				$scope.addError(response, $scope.leadInfo.identificationNumber);
				console.log(response);
			});
		};

		$scope.encryptText = function () {
			$http({
				method: 'GET',
				url: '/api/encryptText/' + $scope.leadInfo.identificationNumber,
			}).then(function successCallback(response) {
				if (response.data != false) {
					window.location = "/avance/step3/" + response.data;
				}
			}, function errorCallback(response) {
				response.url = '/api/encryptText/' + $scope.leadInfo.identificationNumber;
				$scope.addError(response, $scope.leadInfo.identificationNumber);
			});
		};

		setTimeout(function () { $scope.getDataStep2(); }, 1);
	});