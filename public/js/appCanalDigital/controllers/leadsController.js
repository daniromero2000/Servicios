app.controller('leadsController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': ''
	};
	$scope.lead = {};
	$scope.leads = [];
	$scope.totalPages = 0;
	$scope.pages = [];
	$scope.current_page = 0;
	$scope.getLeads = function(page, init = false){
		$http({
		  method: 'GET',
		  url: '/leads?q='+$scope.q.q+'&page='+page,
		  data: $scope.libranza
		}).then(function successCallback(response) {
			$scope.totalPages = response.data.last_page;
			$scope.leads = response.data.data;
			$scope.current_page = response.data.current_page;
			console.log(response);
			if(init == true){
				$scope.calculateTotalPages();
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchLeads = function(){
		$scope.leads = [];
		$scope.totalPages = 0;
		$scope.pages = [];
		$scope.current_page = 0;
		$scope.getLeads(1, true);
	};

	$scope.setCurrentPage = function(page, sumaResta = false){
		if(sumaResta == true){
			if(page == 'suma'){
				$scope.current_page = $scope.current_page +1;
			}else{
				$scope.current_page = $scope.current_page -1;
			}
		}else{
			$scope.current_page = page;
		}
		$scope.getLeads($scope.current_page);
	};

	$scope.vewLead = function(lead){
		$scope.lead = lead;
		console.log(lead);
		$("#viewLead").modal("show");
	}

	$scope.calculateTotalPages = function(){
		for(var i=0;i<$scope.totalPages;i++) {
			$scope.pages.push(i+1);
		}
	}
	$scope.getLeads(1, true);
})