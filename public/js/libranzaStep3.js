angular.module('appLibranzaStep3', ['moment-picker', 'ng-currency'])
	.controller("step3Ctrl", function ($scope, $http) {
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
			whatSell: '',
			dateCreationCompany: '',
			bankSavingsAccount: null,
			occupation: '',
			pagaduria: '',
			membershipNumber: ''

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
		$scope.pagadurias = {}

		$scope.getDataStep3 = function () {
			showLoader();
			$http({
				method: 'GET',
				url: '/creditoLibranza/getDataStep3/' + $scope.leadInfo.identificationNumber,
			}).then(function successCallback(response) {

				hideLoader();
				console.log(response);
				$scope.ced = $scope.leadInfo.identificationNumber;
				$scope.banks = response.data.banks;
				$scope.analyst = response.data.digitalAnalyst;
				$scope.leadInfo = response.data.dataLead[0];
				$scope.leadInfo.occupation = response.data.occupation;
				$scope.pagadurias = response.data.pagaduria;
				$scope.leadInfo.step = 3;
				$scope.leadInfo.identificationNumber = $scope.ced;
				$scope.leadInfo.salary = ($scope.leadInfo.salary != 0 && $scope.leadInfo.salary != '') ? $scope.leadInfo.salary : '';
				$scope.leadInfo.otherRevenue = ($scope.leadInfo.otherRevenue != 0 && $scope.leadInfo.otherRevenue != '') ? $scope.leadInfo.otherRevenue : '';
			}, function errorCallback(response) {
				hideLoader();
			});
		};

		$scope.saveStep3 = function () {

			var csrftoken = document.getElementById('formEmpleado').children[0].value;
			if ($scope.leadInfo.occupation == 'PENSIONADO' && $scope.leadInfo.pagaduria == 1) {

				alert('Error: Si eres pensionado debes elegir una pagaduría válida');
			} else {
				$http({
					method: 'POST',
					url: '/libranzaV2',
					data: $scope.leadInfo,
					headers: {
						'X-CSRF-TOKEN': csrftoken
					},
				}).then(function successCallback(response) {
					if (response.data[0] != false) {
						console.log(response.data);
						$('#congratulations').modal('show');
					}
				}, function errorCallback(response) {
					response.url = '/libranzaV2';
					$scope.addError(response, $scope.leadInfo.identificationNumber);
				});
			}

		};

		$scope.sendComment = function () {
			$scope.comment.identificationNumber = $scope.leadInfo.identificationNumber;
			$http({
				method: 'POST',
				url: '/libranzaV2',
				data: $scope.comment,
			}).then(function successCallback(response) {
				if (response.data != false) {
					window.location = "/creditoLibranza/step1";
				}
			}, function errorCallback(response) {
				response.url = '/libranzaV2';
				$scope.addError(response, $scope.leadInfo.identificationNumber);
			});
		};

		$scope.addError = function (response, cedula = '') {
			var arrayData = {
				url: response.url,
				mensaje: response.data.message,
				archivo: response.data.file,
				linea: response.data.line,
				cedula: cedula,
				datos: (response.datos) ? response.datos : []
			}

			var data = {
				status: response.status,
				data: angular.toJson(arrayData)
			}
			$http({
				method: 'POST',
				url: '/api/appError',
				data: data,
			}).then(function successCallback(response) {
				setTimeout(() => {
					$('#congratulations').modal('hide');
					$('#proccess').modal('hide');
					$('#confirmCodeVerification').modal('hide');
					$('#validationLead').modal('hide');
					$('#decisionCredit').modal('hide');
					$('#error').modal('show');
				}, 100);
				$scope.numError = response.data.id;
			}, function errorCallback(response) {
				console.log(response);
			});
		};

		setTimeout(function () { $scope.getDataStep3(); }, 1);
	});