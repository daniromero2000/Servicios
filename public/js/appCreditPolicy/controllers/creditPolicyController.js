app.controller('creditPolicyController', function($scope, $http, $rootScope, $location, $ngBootbox){
	$ngBootbox.setLocale('es');
	$scope.q = {
		'q': '',
		'initFrom': 0,
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.creditPolicy=[];
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
		showLoader();
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/creditPolicy?q=' + $scope.q.q
		}).then(function successCallback(response) {
			hideLoader()
			if(response.status == 401){
				window.location = "/login";
			}
			if(response.data!= false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value, key) {
					$scope.creditPolicy.push(value);
				});
				$scope.cargando = false;
			}
		}, function errorCallback(response) {
			hideLoader();
		});

		
	};

	$scope.searchCreditPolicies = function(){
		$scope.q.initFrom = 0;
		$scope.creditPolicy = [];
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

	$scope.addCreditPolicy = function(){
		$ngBootbox
			.prompt('Ingrese el nombre del artÃ­culo')
			.then(function(nombre) {
				if(nombre != '') {
					$http({
						method:'POST',
						url:'/creditPolicy/',
						data:{nombre: nombre},
					}).then(function successCallback(response){
						if(response.data != false){
							$scope.edtCreditPolicy(response.data);
						}
					},function errorCallback(response){
						console.log(response);
					});
				} else {
					
				}
			})
		;
	};

	$scope.edtCreditPolicy = function(id){
		$location.url('creditPolicy/' + id);
	}

	$scope.getCreditPolicy();
})