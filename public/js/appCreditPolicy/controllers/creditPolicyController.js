app.controller('creditPolicyController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.errorFlag=0;
	$scope.successFlag=0;
	$scope.error='';
	$scope.creditPolicyId ='';
	$scope.creditPolicies=[];
	$scope.creditPolicy={};
	$scope.comment = {
		comment: '',
		idLead: 0,
		state: 0
	};
	$scope.credit={};
	$scope.months=[];
	$scope.monthsOptions=[
		{
			value:'-1 month',
			text:'1 mes'
		},
		{
			value:'-2 month',
			text:'2 meses'
		},
		{
			value:'-3 month',
			text:'3 meses'
		},
		{
			value:'-4 month',
			text:'4 meses'
		},
		{
			value:'-5 month',
			text:'5 meses'
		},
		{
			value:'-6 month',
			text:'6 meses'
		}
	];



	$scope.getCreditPolicy = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/creditPolicy',
		}).then(function successCallback(response) {
			console.log(response);
			if(response.status == 401){
				window.location = "/login";
			}
			if(response.data!= false){
				
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {	
					
					value.timeLimitText=value.timeLimit.split('-')[1].split(' ')[0];			
					$scope.creditPolicies.push(value);
					
				});
				
				$scope.cargando = false;

			}
			
		}, function errorCallback(response) {
		    
		});

		
	};

	$scope.searchCreditPolicies = function(){
		$scope.q.initFrom = 0;
		$scope.creditPolicies = [];
		$scope.getCreditPolicy();
	};

	$scope.resetFiltros = function (){
		$scope.creditPolicies = [];
		$scope.q = {
			'q': '',
			'initFrom': 0,
		};
		$scope.filtros = false;
		$scope.getCreditPolicy();
	};

	$scope.showUpdate = function(id){
		$scope.creditPolicyId=id;
		$scope.creditPolicy=$scope.creditPolicies[0];
		$('#modalUpdate').modal('show');
	}

	$scope.updateCreditPolicy=function(){
		$http({
			method:'PUT',
			url:'/creditPolicy/'+$scope.creditPolicyId,
			data:$scope.creditPolicy,
		}).then(function successCallback(response){
			if(response.data != false){
				$scope.searchCreditPolicies();
				$('#modalUpdate').modal('hide');
			}
		},function errorCallback(response){
				console.log(response);
		});
	}

	$scope.getCreditPolicy();
})