app.controller('directorController', function ($scope, $http) {
	$scope.q = {
		'q': '',
		'qtipoTarjeta': '',
		'qfechaInicial': '',
		'qfechaFinal': '',
		'initFrom': 0,
		'city': '',
		'fecha_ini': '',
		'fecha_fin': '',
		'qtypeStatus': '',
		'state': '',
		'channel': '',
	};

	$scope.codeAsesor = "";
	$scope.totalLeads = 0;
	$scope.cargando   = true;
	$scope.filtros    = false;
	$scope.leads      = [];

	$scope.typeStatuses = [{
			label: 'Pendiente',
			value: 'PENDIENTE'
		},
		{
			label: 'Rechazado',
			value: 'RECHAZADO'
		},
		{
			label: 'En Estudio',
			value: 'EN ESTUDIO'
		},
		{
			label: 'En espera',
			value: 'EN ESPERA'
		},
		{
			label: 'Aprobado',
			value: 'APROBADO'
		},
		{
			label: 'Negado',
			value: 'NEGADO'
		}
	];


	$scope.cardTypes = [{
			label: 'Tarjeta Black',
			value: 0
		},
		{
			label: 'Tarjeta Gray',
			value: 1
		}
	];

	$scope.getLeads = function () {
		showLoader();
		$scope.cargando = true;
		$http({
			method: 'GET',
			url: '/director?q=' + $scope.q.q +
				'&qtipoTarjeta=' + $scope.q.qtipoTarjeta +
				'&qfechaInicial=' + $scope.q.qfechaInicial +
				'&qfechaFinal=' + $scope.q.qfechaFinal +
				'&initFrom=' + $scope.q.initFrom +
				'&qtypeStatus=' + $scope.q.qtypeStatus +
				'&state=' + $scope.q.state + '&channel' +
				$scope.q.channel,

		}).then(function successCallback(response) {
			$scope.codeAsesor = response.data.codeAsesor;
			$scope.totalLeads = response.data.totalLeads;
			if (response.data.leads != false) {
				$scope.q.initFrom += response.data.leads.length;
				angular.forEach(response.data.leads, function (value, key) {
					$scope.leads.push(value);
				});
				$scope.cargando = false;
			}
			hideLoader();
		}, function errorCallback(response) {});
	};

	$scope.searchLeads = function () {
		$scope.q.initFrom = 0;
		$scope.leads      = [];
		$scope.getLeads();
	};

	$scope.resetFiltros = function () {
		$scope.leads = [];
		$scope.q = {
			'q': '',
			'qtipoTarjeta': '',
			'qfechaInicial': '',
			'qfechaFinal': '',
			'initFrom': 0,
			'city': '',
			'fecha_ini': '',
			'fecha_fin': '',
			'qtypeStatus': '',
			'state': '',
			'channel': '',
		};
		$scope.filtros = false;
		$scope.getLeads();
	};

	$scope.vewLead = function (lead) {
		$scope.lead = lead;
		$("#viewLead").modal("show");
	};

	$scope.getLeads();
})