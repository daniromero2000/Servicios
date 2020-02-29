app.controller('libranzaLeadsController', function ($scope, $http, $rootScope) {
	$scope.q = {
		'q': '',
		'initFrom': 0,
		'city': '',
		'fecha_ini': '',
		'fecha_fin': '',
		'typeService': 'Credito libranza',
		'state': '',
		'libranzaLeads': true
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
			value: 'terjeta de crédito Oportuya'
		},
		{
			label: 'Crédito Motos',
			value: 'Motos'
		},
		{
			label: 'Crédito Libranza',
			value: 'Credito libranza'
		},
		{
			label: 'Seguros',
			value: 'Seguros'
		},
		{
			label: 'Viajes',
			value: 'Viajes'
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

	$scope.slides = [{
		img: 'creditoLibranza.jpg',
		description: 'Te damos <strong>más</strong> que <strong>Crédito,</strong>  te damos la <br><strong>Oportunidad</strong> de vivir viajando',
		textButton: 'Solicítalo ya',
		link: '#formularioSimulador'
	}, {
		img: 'creditoLibranzaSuenos.jpg',
		description: '¿Soñando con remodelar tu casa? <br> hazlo realidad con nuestro <strong>crédito de libranza</strong>',
		textButton: 'Solicítalo ya',
		link: '#formularioSimulador'
	}];


	$scope.slickConfig = {
		enabled: true,
	}
	$scope.toggleSlick = function () {
		$scope.slickConfig.enabled = !$scope.slickConfig.enabled;
	}

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

	$scope.getLeads = function () {
		$scope.cargando = true;
		$http({
			method: 'GET',
			url: '/leads?q=' + $scope.q.q + '&limitFrom=' + $scope.q.initFrom + '&city=' + $scope.q.city + '&fecha_ini=' + $scope.q.fecha_ini + '&fecha_fin=' + $scope.q.fecha_fin + '&typeService=' + $scope.q.typeService + '&state=' + $scope.q.state + '&libranzaLead=' + $scope.q.libranzaLeads,
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
		$scope.q.initFrom = 0;
		$scope.leads = [];
		$scope.getLeads();
	};

	$scope.resetFiltros = function () {
		$scope.leads = [];
		$scope.q = {
			'q': '',
			'initFrom': 0,
			'city': '',
			'fecha_ini': '',
			'fecha_fin': '',
			'typeService': 'Credito libranza',
			'state': '',
			'libranzaLeads': true
		};
		$scope.filtros = false;
		$scope.getLeads();
	};

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