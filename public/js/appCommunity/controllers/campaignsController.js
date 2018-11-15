app.controller('campaignsController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
		'socialNetwork': '',
		'beginDate': '',
		'endingDate': '',
		'budget': ''
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddCampaign = false;
	$scope.campaign = {};
	$scope.campaigns=[];
	$scope.idCampaign = '';
	

	$scope.getCampaigns = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/campaign?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom+'&beginDate='+$scope.q.beginDate+'&endingDate='+$scope.q.endingDate,
		}).then(function successCallback(response) {
			console.log(response.data);
			if(response.data != false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {
					$scope.campaigns.push(value);
				});
				$scope.cargando = false;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchLeads = function(){
		$scope.q.initFrom = 0;
		$scope.campaigns = [];
		$scope.getCampaigns();
	};

	$scope.resetFiltros = function (){
		$scope.q = {
			'q': '',
			'initFrom': 0,
			'city': '',
			'beginDate': '',
			'fecha_fin': '',
			'typeService': ''
		};
		$scope.filtros = false;
		$scope.getLeads();
	};

	
	$scope.getCampaigns();
})