app.controller('communityController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFromCM': 0,
		'city': '',
		'fecha_ini': '',
		'fecha_fin': '',
		'typeService': '',
		'state': '',
		'channel':''
	};

	$scope.campaign = {};
	$scope.campaigns=[];
	$scope.idCampaign = '';
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddComent = false;
	$scope.lead = {};
	//$scope.name='';
	//$scope.lastName='';
	//$scope.telephone='';
	//$scope.email='';
	$scope.idLead = '';
	$scope.comment = {
		comment: '',
		idLead: 0,
		state: 0
	};
	$scope.socialNetworks = [
		{ label : 'FACEBOOK',value: 2 },
		{ label : 'WHATSAPP',value: 3 }
	];
	$scope.comments = [];
	$scope.leads = [];
	$scope.cities = [
		{ label : 'ARMENIA',value: 'ARMENIA' },
		{ label : 'MANIZALES',value: 'MANIZALES' },
		{ label : 'SINCELEJO',value: 'SINCELEJO' },
		{ label : 'YOPAL',value: 'YOPAL' },
		{ label : 'CERETÉ',value: 'CERETÉ' },
		{ label : 'TULUÁ',value: 'TULUÁ' },
		{ label : 'ACACÍAS',value: 'ACACÍAS' },
		{ label : 'ESPINAL',value: 'ESPINAL' },
		{ label : 'MARIQUITA',value: 'MARIQUITA' },
		{ label : 'CARTAGENA',value: 'CARTAGENA' },
		{ label : 'LA DORADA',value: 'LA DORADA' },
		{ label : 'IBAGUÉ',value: 'IBAGUÉ' },
		{ label : 'BOGOTÁ',value: 'BOGOTÁ' },
		{ label : 'MONTERÍA',value: 'MONTERÍA' },
		{ label : 'MAGANGUÉ',value: 'MAGANGUÉ' },
		{ label : 'PEREIRA',value: 'PEREIRA' },
		{ label : 'CALI',value: 'CALI' },
		{ label : 'MONTELIBANO',value: 'MONTELIBANO' },
		{ label : 'SAHAGÚN',value: 'SAHAGÚN' },
		{ label : 'PLANETA RICA',value: 'PLANETA RICA' },
		{ label : 'COROZAL',value: 'COROZAL' },
		{ label : 'CIÉNAGA',value: 'CIÉNAGA' },
		{ label : 'MONTELÍ',value: 'MONTELÍ' },
		{ label : 'PLATO',value: 'PLATO' },
		{ label : 'SABANALARGA',value: 'SABANALARGA' },
		{ label : 'GRANADA',value: 'GRANADA' },
		{ label : 'PUERTO BERRÍ',value: 'PUERTO BERRÍ' },
		{ label : 'VILLAVICENCIO',value: 'VILLAVICENCIO' },
		{ label : 'TAURAMENA',value: 'TAURAMENA' },
		{ label : 'PUERTO GAITÁN',value: 'PUERTO GAITÁN' },
		{ label : 'PUERTO BOYACÁ',value: 'PUERTO BOYACÁ' },
		{ label : 'PUERTO LÓPEZ',value: 'PUERTO LÓPEZ' },
		{ label : 'SEVILLA',value: 'SEVILLA' },
		{ label : 'CHINCHINÁ',value: 'CHINCHINÁ' },
		{ label : 'AGUACHICA',value: 'AGUACHICA' },
		{ label : 'BARRANCABERMEJA',value: 'BARRANCABERMEJA' },
		{ label : 'LA VIRGINIA',value: 'LA VIRGINIA' },
		{ label : 'SANTA ROSA DE CABAL',value: 'SANTA ROSA DE CABAL' },
		{ label : 'GIRARDOT',value: 'GIRARDOT' },
		{ label : 'VILLANUEVA',value: 'VILLANUEVA' },
		{ label : 'PITALITO',value: 'PITALITO' },
		{ label : 'GARZÓN',value: 'GARZÓN' },
		{ label : 'NEIVA',value: 'NEIVA' },
		{ label : 'LORICA',value: 'LORICA' },
		{ label : 'AGUAZUL', value: 'AGUAZUL' }
	];
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

	$scope.getLeads = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/communityleads?q='+$scope.q.q+'&initFromCM='+$scope.q.initFromCM,
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.q.initFromCM += response.data.length;
				angular.forEach(response.data, function(value, key) {
					if((value.channel != 1) && (value.channel != 0)){
						if(value.campaignName==null){
							value.campaignName = 'N/A';
						}
						$scope.leads.push(value);
					}

				});
				$scope.cargando = false;
			}
		}, function errorCallback(response) {
		});
	};


	$scope.getCampaigns = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/campaign?q='+$scope.q.q,
		}).then(function successCallback(response) {
			
			if(response.data != false){
				angular.forEach(response.data, function(value, key) {
					$scope.campaigns.push(value);
				});
				$scope.cargando = false;
				
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.searchLeads = function(){
		$scope.q.initFromCM = 0;
		$scope.leads = [];
		$scope.getLeads();
	};

	$scope.resetFiltros = function (){
		$scope.leads = [];
		$scope.q = {
			'q': '',
			'initFromCM': 0,
			'city': '',
			'fecha_ini': '',
			'fecha_fin': '',
			'typeService': '',
			'state': ''
		};
		$scope.filtros = false;
		$scope.getLeads();
	};

	$scope.addCommunityForm = function(){
		$scope.lead = {};
		$("#addCommunityLead").modal("show");
	};

	$scope.addCommunityLeads = function(){
		$http({
			method:'POST',
			url:'/communityLeads/addCommunityLeads',
			data:$scope.lead
		}).then(function successCallback(response){
				if(response.data != false){
					$scope.searchLeads();
					$('#addCommunityLead').modal('hide');
					$scope.lead = {};
				}
			},function errorCallback(response){
			});
		};

	$scope.viewCommunityLeads = function(idLead){

		$http({
		  method: 'GET',
		  url: '/communityLeads/viewCommunityLeads/'+idLead
		}).then(function successCallback(response){				
			if (response.data != false) {
				$scope.lead=response.data;						
			}
			
		},
		function errorCallback(response){
			
		});
	};

	$scope.showUpdateDialog=function(idLead){
		$scope.idLead=idLead;		
		$scope.viewCommunityLeads($scope.idLead);
		$('#updateCommunityModal').modal('show');
	};
	
	$scope.updateCommunityLeads = function(){
		$http({
			method: 'POST',
		 	url: '/communityLeads/updateCommunityLeads',
		 	data: $scope.lead
		}).then(function successCallback(response){
			
			if(response.data != false){
				$scope.searchLeads();
				$('#updateCommunityModal').modal('hide');
			}
			
		},function errorCallback(response){
			
		});
	}



	$scope.showDialogDelete = function(idLead){
		$scope.idLead=idLead;

		$('#deleteCommunityModal').modal( "show");
		
	}


	$scope.confirmDelete = function(){
		
		$scope.deleteCommunityLeads($scope.idLead);

	}

	$scope.cancelDelete=function(){
		$('#deleteCommunityModal').modal('hide');
	}



	$scope.deleteCommunityLeads=function(idLead){
		$http({
			method:'POST',
			url:'/communityLeads/deleteCommunityLeads/'+idLead
		}).then(function successCallback(response){	
			if(response.data != false){
				$scope.searchLeads();
				$('#deleteCommunityModal').modal('hide');
			}
		},function errorCallback(response){
				
		});
	}

	$scope.vewLead = function(lead){
		$scope.lead = lead;
		$("#viewLead").modal("show");
	};

	$scope.viewComments = function(name, lastName, state, idLead, init=true){
		$scope.comments = [];
		$scope.idLead = idLead;
		$http({
		  method: 'GET',
		  url: '/api/leads/getComentsLeads/'+idLead
		}).then(function successCallback(response) {
			if(response.data != false){
				angular.forEach(response.data, function(value, key) {
					$scope.comments.push(value);
				});
			}
			if(init){
				$("#viewComments").modal("show");
				$scope.nameLead = name;
				$scope.lastNameLead = lastName;
				$scope.state = state;
			}
			$("#viewComments").modal("show");
		}, function errorCallback(response) {
		    
		});
	};


	$scope.viewCommentChange = function(){
		$scope.viewAddComent = !$scope.viewAddComent;
	};

	

	$scope.addComment = function(){
		$scope.comment.idLead = $scope.idLead;
		$http({
		  method: 'GET',
		  url: '/api/leads/addComent/'+$scope.comment.idLead+'/'+$scope.comment.comment
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.viewComments($scope.lead.name, $scope.lead.lastName, $scope.lead.state, $scope.idLead,false);
				$scope.comment.comment = "";
				$scope.viewAddComent = false;
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.changeStateLead = function(name, lastName, idLead, state, title){
		$scope.title = title;
		$scope.nameLead = name;
		$scope.lastNameLead = lastName;
		$scope.comment.idLead = idLead;
		$scope.comment.state = state;
		$("#changeStateLead").modal("show");
	};

	$scope.viewComments = function(name, lastName, state, idLead, init=true){
		$scope.comments = [];
		$scope.idLead = idLead;
		$http({
		  method: 'GET',
		  url: '/api/leads/getComentsLeads/'+idLead
		}).then(function successCallback(response) {
			if(response.data != false){
				angular.forEach(response.data, function(value, key) {
					$scope.comments.push(value);
				});
			}
			if(init){
				$("#viewComments").modal("show");
				$scope.nameLead = name;
				$scope.lastNameLead = lastName;
				$scope.state = state;
			}
		}, function errorCallback(response) {
			
		});
	};

	$scope.changeStateLeadComment = function(){
		$http({
		  method: 'GET',
		  url: '/api/leads/cahngeStateLead/'+$scope.comment.idLead+'/'+$scope.comment.comment+'/'+$scope.comment.state
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.comment.comment = "";
				$scope.searchLeads();
				$("#changeStateLead").modal("hide");			
			}
		}, function errorCallback(response) {
		    
		});
	};

	$scope.getLeads();
	$scope.getCampaigns();
})