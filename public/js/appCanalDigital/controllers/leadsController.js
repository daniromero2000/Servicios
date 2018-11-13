app.controller('leadsController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0
	};
	$scope.cargando = true;
	$scope.lead = {};
	$scope.leads = [];
	$scope.getLeads = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/leads?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom,
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {
					$scope.leads.push(value);
				});
				$scope.cargando = false;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchLeads = function(){
		$scope.q.initFrom = 0;
		$scope.leads = [];
		$scope.getLeads();
	};

	$scope.vewLead = function(lead){
		$scope.lead = lead;
		console.log(lead);
		$("#viewLead").modal("show");
	}

	$scope.getLeads();
})