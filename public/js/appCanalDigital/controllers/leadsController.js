app.controller('leadsController', function ($scope, $http, $rootScope, $ngBootbox) {
	$ngBootbox.setLocale('es');
	$scope.q = {
		'q': '',
		'qtipoTarjetaAprobados': '',
		'qcityAprobados': '',
		'qfechaInicialAprobados': '',
		'qfechaFinalAprobados': '',
		'qCM': '',
		'qRL': '',
		'qGen': '',
		'qTR': '',
		'qfechaInicialTR': '',
		'qfechaFinalTR': '',
		'qAL': '',
		'initFrom': 0,
		'initFromCM': 0,
		'initFromRL': 0,
		'initFromGen': 0,
		'initFromTR': 0,
		'initFromAL': 0,
		'city': '',
		'fecha_ini': '',
		'fecha_fin': '',
		'typeService': '',
		'state': '',
		'channel': '',


	};
	$scope.codeAsesor = "";
	$scope.tabs = 1;
	$scope.totalLeads = 0;
	$scope.totalLeadsRejected = 0;
	$scope.totalLeadsCM = 0;
	$scope.totalLeadsGen = 0;
	$scope.totalLeadsTR = 0;
	$scope.cargando = true;
	$scope.cargandoCM = true;
	$scope.cargandoRL = true;
	$scope.cargandoGen = true;
	$scope.cargandoTR = true;
	$scope.cargandoAL = true;
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
	$scope.leadsCM = [];
	$scope.leadsGen = [];
	$scope.leadsRejected = [];
	$scope.leadsTR = [];
	$scope.leadsAL = [];
	$scope.cities = [{
			label: 'ARMENIA',
			value: 'ARMENIA'
		},
		{
			label: 'MANIZALES',
			value: 'MANIZALES'
		},
		{
			label: 'SINCELEJO',
			value: 'SINCELEJO'
		},
		{
			label: 'YOPAL',
			value: 'YOPAL'
		},
		{
			label: 'CERETÉ',
			value: 'CERETÉ'
		},
		{
			label: 'TULUÁ',
			value: 'TULUÁ'
		},
		{
			label: 'ACACÍAS',
			value: 'ACACÍAS'
		},
		{
			label: 'ESPINAL',
			value: 'ESPINAL'
		},
		{
			label: 'MARIQUITA',
			value: 'MARIQUITA'
		},
		{
			label: 'CARTAGENA',
			value: 'CARTAGENA'
		},
		{
			label: 'LA DORADA',
			value: 'LA DORADA'
		},
		{
			label: 'IBAGUÉ',
			value: 'IBAGUÉ'
		},
		{
			label: 'BOGOTÁ',
			value: 'BOGOTÁ'
		},
		{
			label: 'MONTERÍA',
			value: 'MONTERÍA'
		},
		{
			label: 'MAGANGUÉ',
			value: 'MAGANGUÉ'
		},
		{
			label: 'PEREIRA',
			value: 'PEREIRA'
		},
		{
			label: 'CALI',
			value: 'CALI'
		},
		{
			label: 'MONTELIBANO',
			value: 'MONTELIBANO'
		},
		{
			label: 'SAHAGÚN',
			value: 'SAHAGÚN'
		},
		{
			label: 'PLANETA RICA',
			value: 'PLANETA RICA'
		},
		{
			label: 'COROZAL',
			value: 'COROZAL'
		},
		{
			label: 'CIÉNAGA',
			value: 'CIÉNAGA'
		},
		{
			label: 'MONTELÍ',
			value: 'MONTELÍ'
		},
		{
			label: 'PLATO',
			value: 'PLATO'
		},
		{
			label: 'SABANALARGA',
			value: 'SABANALARGA'
		},
		{
			label: 'GRANADA',
			value: 'GRANADA'
		},
		{
			label: 'PUERTO BERRÍ',
			value: 'PUERTO BERRÍ'
		},
		{
			label: 'VILLAVICENCIO',
			value: 'VILLAVICENCIO'
		},
		{
			label: 'TAURAMENA',
			value: 'TAURAMENA'
		},
		{
			label: 'PUERTO GAITÁN',
			value: 'PUERTO GAITÁN'
		},
		{
			label: 'PUERTO BOYACÁ',
			value: 'PUERTO BOYACÁ'
		},
		{
			label: 'PUERTO LÓPEZ',
			value: 'PUERTO LÓPEZ'
		},
		{
			label: 'SEVILLA',
			value: 'SEVILLA'
		},
		{
			label: 'CHINCHINÁ',
			value: 'CHINCHINÁ'
		},
		{
			label: 'AGUACHICA',
			value: 'AGUACHICA'
		},
		{
			label: 'BARRANCABERMEJA',
			value: 'BARRANCABERMEJA'
		},
		{
			label: 'LA VIRGINIA',
			value: 'LA VIRGINIA'
		},
		{
			label: 'SANTA ROSA DE CABAL',
			value: 'SANTA ROSA DE CABAL'
		},
		{
			label: 'GIRARDOT',
			value: 'GIRARDOT'
		},
		{
			label: 'VILLANUEVA',
			value: 'VILLANUEVA'
		},
		{
			label: 'PITALITO',
			value: 'PITALITO'
		},
		{
			label: 'GARZÓN',
			value: 'GARZÓN'
		},
		{
			label: 'NEIVA',
			value: 'NEIVA'
		},
		{
			label: 'LORICA',
			value: 'LORICA'
		},
		{
			label: 'AGUAZUL',
			value: 'AGUAZUL'
		}
	];
	$scope.typeServices = [{
			label: 'Oportuya',
			value: 'Oportuya'
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

	$scope.typeStates = [{
			label: 'Pendiente',
			value: 0
		},
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
		$scope.cargandoCM = true;
		$scope.cargandoRL = true;
		$scope.cargandoGen = true;
		$scope.cargandoTR = true;
		$scope.cargandoAL = true;
		$http({
			method: 'GET',
			url: '/leads?q=' + $scope.q.q + '&qtipoTarjetaAprobados=' + $scope.q.qtipoTarjetaAprobados + '&qcityAprobados=' + $scope.q.qcityAprobados + '&qfechaInicialAprobados=' + $scope.q.qfechaInicialAprobados + '&qfechaFinalAprobados=' + $scope.q.qfechaFinalAprobados + $scope.q.qcityAprobados + '&qfechaInicialTR=' + $scope.q.qfechaInicialTR + '&qfechaFinalTR=' + $scope.q.qfechaFinalTR + '&qCM=' + $scope.q.qCM + '&qRL=' + $scope.q.qRL + '&qGen=' + $scope.q.qGen + '&qTR=' + $scope.q.qTR + '&qAL=' + $scope.q.qAL + '&initFrom=' + $scope.q.initFrom + '&initFromCM=' + $scope.q.initFromCM + '&initFromRL=' + $scope.q.initFromRL + '&initFromGen=' + $scope.q.initFromGen + '&initFromTR=' + $scope.q.initFromTR + '&initFromAL=' + $scope.q.initFromAL + '&city=' + $scope.q.city + '&fecha_ini=' + $scope.q.fecha_ini + '&fecha_fin=' + $scope.q.fecha_fin + '&typeService=' + $scope.q.typeService + '&state=' + $scope.q.state + '&channel' + $scope.q.channel,
		}).then(function successCallback(response) {
			console.log(response.data);
			$scope.codeAsesor = response.data.codeAsesor;
			$scope.totalLeads = response.data.totalLeads;
			$scope.totalLeadsRejected = response.data.totalLeadsRejected;
			$scope.totalLeadsCM = response.data.totalLeadsCM;
			$scope.totalLeadsGen = response.data.totalLeadsGen;
			$scope.totalLeadsTR = response.data.totalLeadsTR;
			$scope.totalLeadsAL = response.data.totalLeadsAL;

			if (response.data.leadsDigital != false) {
				$scope.q.initFrom += response.data.leadsDigital.length;
				angular.forEach(response.data.leadsDigital, function (value, key) {
					$scope.leads.push(value);
				});
				$scope.cargando = false;
			}


	if (response.data.leadsDigitalAnt != false) {
		$scope.q.initFrom += response.data.leadsDigitalAnt.length;
		angular.forEach(response.data.leadsDigitalAnt, function (value, key) {
			$scope.leads.push(value);
		});
		$scope.cargando = false;
	}


			if (response.data.leadsTR != false) {
				$scope.q.initFromTR += response.data.leadsTR.length;
				angular.forEach(response.data.leadsTR, function (value, key) {
					$scope.leadsTR.push(value);
				});
				$scope.cargandoTR = false;
			}

				if (response.data.leadsTRAnt != false) {
					$scope.q.initFromTR += response.data.leadsTRAnt.length;
					angular.forEach(response.data.leadsTRAnt, function (value, key) {
						$scope.leadsTR.push(value);
					});
					$scope.cargandoTR = false;
				}


			if (response.data.leadsGen != false) {
				$scope.q.initFromGen += response.data.leadsGen.length;
				angular.forEach(response.data.leadsGen, function (value, key) {
					$scope.leadsGen.push(value);
				});
				$scope.cargandoGen = false;
			}

			if (response.data.leadsCM != false) {
				$scope.q.initFromCM += response.data.leadsCM.length;
				angular.forEach(response.data.leadsCM, function (value, key) {
					$scope.leadsCM.push(value);
				});
				$scope.cargandoCM = false;
			}

			if (response.data.leadsAL != false) {
				$scope.q.initFromAL += response.data.leadsAL.length;
				angular.forEach(response.data.leadsAL, function (value, key) {
					$scope.leadsAL.push(value);
				});
				$scope.cargandoAL = false;
			}

			hideLoader();
		}, function errorCallback(response) {

			console.log(response);
		});
	};

	$scope.searchLeads = function () {
		$scope.q.initFrom = 0;
		$scope.q.initFromCM = 0;
		$scope.q.initFromGen = 0;
		$scope.q.initFromTR = 0;
		$scope.leads = [];
		$scope.leadsCM = [];
		$scope.leadsTR = [];
		$scope.leadsGen = [];
		$scope.leadsRejected = [];
		$scope.getLeads();
	};

	$scope.resetFiltros = function () {
		$scope.leads = [];
		$scope.q = {
			'q': '',
			'qtipoTarjetaAprobados': '',
			'qcityAprobados': '',
			'qfechaInicialAprobados': '',
			'qfechaFinalAprobados': '',
			'qCM': '',
			'qRL': '',
			'qGen': '',
			'qTR': '',
			'qfechaInicialTR': '',
			'qfechaFinalTR': '',
			'qAL': '',
			'initFrom': 0,
			'initFromCM': 0,
			'initFromRL': 0,
			'initFromGen': 0,
			'initFromTR': 0,
			'initFromAL': 0,
			'city': '',
			'fecha_ini': '',
			'fecha_fin': '',
			'typeService': '',
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

	$scope.assignAssesorDigitalToLead = function (solicitud) {
		$ngBootbox.confirm('Desea hacer la gestión de este lead ?')
			.then(function () {
				showLoader();
				$http({
					method: 'GET',
					url: '/api/canalDigital/assignAssesorDigitalToLead/' + solicitud,
				}).then(function successCallback(response) {
					$scope.searchLeads();
					hideLoader();
				}, function errorCallback(response) {});
			});
	};

	$scope.checkLeadProcess = function (idLead) {
		$ngBootbox.confirm('Desea marcar a este lead como procesado ?')
			.then(function () {
				showLoader();
				$http({
					method: 'GET',
					url: '/api/canalDigital/checkLeadProcess/' + idLead,
				}).then(function successCallback(response) {
					$scope.searchLeads();
					hideLoader();
				}, function errorCallback(response) {
					console.log(response);
				});
			});
	}

	$scope.viewComments = function (name, lastName, state, idLead, init = true) {
		$scope.comments = [];
		$scope.idLead = idLead;
		$http({
			method: 'GET',
			url: '/api/leads/getComentsLeads/' + idLead
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
	// get a comments for a community manager lead and show a modal
	$scope.viewCommentsCM = function (name, lastName, state, idLead, init = true) {
		$scope.comments = [];
		$scope.idLead = idLead;
		$http({
			method: 'GET',
			url: '/api/leads/getComentsLeads/' + idLead
		}).then(function successCallback(response) {
			if (response.data != false) {
				angular.forEach(response.data, function (value, key) {
					$scope.comments.push(value);
				});
			}

			if (init) {
				$("#viewCommentsCM").modal("show");
				$scope.nameLead = name;
				$scope.lastNameLead = lastName;
				$scope.state = state;
			}
		}, function errorCallback(response) {

		});
	};


	$scope.viewCommentChange = function () {
		$scope.viewAddComent = !$scope.viewAddComent;
	};

	$scope.addComment = function () {
		$scope.comment.idLead = $scope.idLead;
		$http({
			method: 'GET',
			url: '/api/leads/addComent/' + $scope.comment.idLead + '/' + $scope.comment.comment
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.viewComments($scope.lead.name, $scope.lead.lastName, $scope.state, $scope.idLead, false);
				$scope.comment.comment = "";
				$scope.viewAddComent = false;
			}
		}, function errorCallback(response) {

		});
	};

	//store a community manager lead comment and reload a comments

	$scope.addCommentCM = function () {
		$scope.comment.idLead = $scope.idLead;
		$http({
			method: 'GET',
			url: '/api/leads/addComent/' + $scope.comment.idLead + '/' + $scope.comment.comment
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.viewComments($scope.lead.NOMBRES, $scope.lead.APELLIDOS, $scope.state, $scope.idLead, false);
				$scope.comment.comment = "";
				$scope.viewAddComent = false;
			}
		}, function errorCallback(response) {

		});
	};

	$scope.getLeads();
})