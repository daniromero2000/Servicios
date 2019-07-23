app.controller('creditPolicyController', function($scope, $http, $rootScope, $location, $ngBootbox){
	$ngBootbox.setLocale('es');
	$scope.tabs = 1;
	$scope.credit={
		timeLimitAdmin : '',
		timeLimitPublic : ''
	};

	$scope.optionsSms = [
		{
			label: '10',
			value: 10
		},
		{
			label: '20',
			value: 20
		},
		{
			label: '30',
			value: 30
		},
		{
			label: '40',
			value: 40
		}
	];

	$scope.optionsVigenciaRechazados = [
		{
			label: '30',
			value: 30 
		},
		{
			label: '60',
			value: 60
		},
		{
			label: '90',
			value: 90
		},
		{
			label: '120',
			value: 120
		}
	];

	$scope.getCreditPolicy = function(){
		showLoader();
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/creditPolicy'
		}).then(function successCallback(response) {
			hideLoader();
			if(response.status == 401){
				window.location = "/login";
			}
			if(response.data != false){
				$scope.credit = response.data[0];
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.edtCredit = function(){
		$ngBootbox.confirm("¿Realmente desea realizar esta modificación?")
		.then(function() {
			showLoader();
				$http({
					method: 'PUT',
					url: '/creditPolicy/'+$scope.credit.id,
					data: $scope.credit
				}).then(function successCallback(response) {
					hideLoader();
				}, function errorCallback(response) {
					hideLoader();
					console.log(response);
				});
		}, function() {
			$scope.getCreditPolicy();
		});
	};

	$scope.volver = function(){
		window.location = "/Administrator/dashboard";
	};

	$scope.getCreditPolicy();
});
app.controller('simulatePolicySingleCtrl', function($scope, $http){
	$scope.showMessageNoExistClienteFab = false;
	$scope.showMessageNoExistConsulta = false;
	$scope.lead = {
		cedula : ''
	};
	$scope.infoLead = {};
	$scope.showResp = false;
	$scope.simulate = function(){
		showLoader();
		$http({
			method : 'POST',
			url : '/api/oportuya/simulatePolicy',
			data : $scope.lead
		}).then(function successCallback(response){
			hideLoader();
			if(response.data == -1){
				$scope.showMessageNoExistClienteFab = true;
				$scope.showResp = false;
			}else if(response.data == -2){
				$scope.showMessageNoExistConsulta = true;
				$scope.showResp = false;
			}else{
				$scope.showMessageNoExistClienteFab = false;
				$scope.showMessageNoExistConsulta = false;
				$scope.showResp = true;
				$scope.infoLead = response.data[0];
			}
		}, function errorCallback(response){
			console.log(response);
		});
	};
});