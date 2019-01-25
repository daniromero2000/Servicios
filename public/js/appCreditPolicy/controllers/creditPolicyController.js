app.controller('creditPolicyController', function($scope, $http, $rootScope, $location, $ngBootbox){
	$ngBootbox.setLocale('es');
	$scope.credit={
		timeLimitAdmin : '',
		timeLimitPublic : ''
	};

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