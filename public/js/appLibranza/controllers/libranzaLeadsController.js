app.controller('libranzaLeadsController', function ($scope, $http, $rootScope) {
	$scope.q = {
		'page': 30,
		'current': 1,
		'q': '',
		'city': '',
		'fecha_ini': '',
		'fecha_fin': '',
		'typeService': 14,
		'state': '',
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddComent = false;
	$scope.lead = {};
	$scope.idLead = '';
	$scope.comment = {
		comment: '',
		idLead: 0,
		state: 0
	};
	$scope.comments = [];
	$scope.leads = [];
	$scope.cities = [];
	$scope.typeServices = [
		{
			label: 'Oportuya',
			value: 15
		},
		{
			label: 'Crédito Motos',
			value: 3
		},
		{
			label: 'Crédito Libranza',
			value: 14
		},
		{
			label: 'Seguros',
			value: 4
		},
		{
			label: 'Viajes',
			value: 13
		},
	];

	$scope.typeStates = [
		{
			label: 'En estudio',
			value: 1
		},
		{
			label: 'En espera',
			value: 2
		},
		{
			label: 'Aprobado',
			value: 3
		},
		{
			label: 'Negado',
			value: 4
		}
	];


	$scope.getCities = function () {
		$http({
			method: 'GET',
			url: '/subsidiaries/cities'
		}).then(function successCallback(response) {
			console.log(response.data);
			if (response.data != false) {
				$scope.cities = response.data;
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	console.log($scope.q.libranzaLeads)

	$scope.getLeads = function () {
		$scope.cargando = true;
		$http({
			method: 'GET',
			url: '/api/admin/getDataLibranza?q=' + $scope.q.q + '&city=' + $scope.q.city + '&fecha_ini=' + $scope.q.fecha_ini + '&fecha_fin=' + $scope.q.fecha_fin + '&typeService=' + $scope.q.typeService + '&state=' + $scope.q.state + '&libranzaLead=' + $scope.q.libranzaLeads + '&page=' + $scope.q.page + '&current=' + $scope.q.current,
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function (value, key) {
					$scope.leads.push(value);
				});
				$scope.cargando = false;

			}

		}, function errorCallback(response) {

		});
	};

	$scope.searchLeads = function () {
		$scope.q.current = 1;
		$scope.q.page = 30;
		$scope.leads = [];
		$scope.getLeads();
	};

	$scope.resetFiltros = function () {
		$scope.leads = [];
		$scope.q = {
			'page': 30,
			'current': 1,
			'q': '',
			'city': '',
			'fecha_ini': '',
			'fecha_fin': '',
			'typeService': 14,
			'state': '',
		};
		$scope.filtros = false;
		$scope.getLeads();
	};

	$scope.more = function () {
		$scope.q.current = $scope.q.current + 1;
		$scope.getLeads();
	}

	$scope.vewLead = function (lead) {
		$scope.lead = lead;
		$("#viewLead").modal("show");
	};

	$scope.viewComments = function (name, lastName, state, idLead, init = true) {
		$scope.comments = [];
		$scope.idLead = idLead;
		$http({
			method: 'GET',
			url: 'api/leads/getComentsLeads/' + idLead
		}).then(function successCallback(response) {
			if (response.data != false) {
				angular.forEach(response.data, function (value, key) {
					$scope.comments.push(value);
				});
			}
			if (init) {
				$("#viewComments").modal("show");
				$scope.nameLead = name;
				$scope.lastNameLead = lastName;
				$scope.state = state;
			}
		}, function errorCallback(response) {

		});
	};

	$scope.addComment = function () {
		$scope.comment.idLead = $scope.idLead;
		$http({
			method: 'GET',
			url: 'api/leads/addComent/' + $scope.comment.idLead + '/' + $scope.comment.comment
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.viewComments("", "", $scope.state, $scope.idLead, false);
				$scope.comment.comment = "";
				$scope.viewAddComent = false;
			}
		}, function errorCallback(response) {

		});
	};

	$scope.changeStateLead = function (name, lastName, idLead, state, title) {
		$scope.title = title;
		$scope.nameLead = name;
		$scope.lastNameLead = lastName;
		$scope.comment.idLead = idLead;
		$scope.comment.state = state;
		$("#changeStateLead").modal("show");
	};

	$scope.viewCommentChange = function () {
		$scope.viewAddComent = !$scope.viewAddComent;
	};


	$scope.changeStateLeadComment = function () {
		$http({
			method: 'GET',
			url: 'api/leads/cahngeStateLead/' + $scope.comment.idLead + '/' + $scope.comment.comment + '/' + $scope.comment.state
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.comment.comment = "";
				$scope.searchLeads();
				$("#changeStateLead").modal("hide");
			}
		}, function errorCallback(response) {

		});
	};

	$scope.getLeads();
	$scope.getCities();
})