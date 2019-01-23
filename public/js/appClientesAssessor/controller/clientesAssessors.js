app.controller('customersAssessorsController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
		'state': '',
		'fechaSol':'',
		'firstDate': '',
		'lastDate': '',
		'solic':'',
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.viewAddCampaign = false;
	$scope.customer = {
		'SOLICITUD':'',
		'NOMBRES':'',
		'APELLIDOS':'',
		'FECHASOL':'',
		'CODASESOR':'',
		'CODEUDOR1':'',
		'CODEUDOR2':'',
		'ESTADO':'',

	};
	$scope.customers=[];
	$scope.idSol = '';
	$scope.confirmDialog={};
	$scope.confirmDialogUpdate={};
	$scope.socialNetworks = [
		{ label : 'FACEBOOK',value: 'FACEBOOK' },
		{ label : 'WHATSAPP',value: 'WHATSAPP' },
		{ label : 'INSTAGRAM',value: 'INSTAGRAM' },
		{ label : 'TWITTER',value: 'TWITTER' }
	];
	

	$scope.getCustomers = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/customers?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom+'&state='+$scope.q.state+'&fechaSol='+$scope.q.fechaSol+'&firstDate='+$scope.q.firstDate+'&lastDate='+$scope.q.lastDate+'&solic='+$scope.q.solic,
		}).then(function successCallback(response) {
			if(response.data[0] != false){
				$scope.q.initFrom += response.data[0].length;
				angular.forEach(response.data[0], function(value, key) {
					$scope.customers.push(value);
				});
				$scope.cargando = false;
				console.log($scope.customers);
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};

	$scope.showDetails=function(id){
		$scope.customer.SOLICITUD=id;

	};


	$scope.viewDetails=function(idSol){
		$scope.idSol=idSol;
		$scope.viewCustomer($scope.idSol);
		$('#viewModal').modal( "show");
	}

	$scope.viewCustomer = function(idSol){

		$http({
		  method: 'GET',
		  url: ' customers/'+idSol
		}).then(function successCallback(response){				
					if (response.data != false) {
						$scope.customer=response.data[0];
						$scope.customer.SOLICITUD=idSol;
					}
				},
				function errorCallback(response){
					
				});

	}


	$scope.searchCustomer = function(){
		$scope.q.initFrom = 0;
		$scope.customers = [];
		$scope.getCustomers();
		console.log($scope);
		
	};

	$scope.resetFiltros = function (){
		$scope.campaigns = [];
		$scope.q = {
			'q': '',
			'initFrom': 0,
			'state': '',
			'fechaSol':'',
			'firstDate': '',
			'lastDate': '',
		};
		$scope.filtros = false;
		$scope.getCustomers();
	};

	/*$scope.addCampaignForm = function(){
		
		$("#addCampaign").modal("show");
	
	};



	$scope.addCampaign = function(){	

	var csrftoken = document.getElementById('addForm').children[0].value;	

		$http({
		  method: 'POST',
		  url: 'community/addCampaign',
		  headers: {
		     'X-CSRF-TOKEN': csrftoken

		   },
		  data:$scope.campaign
		}).then(function successCallback(response) {	
			if(response.data != false){
				$scope.searchCampaign();
				$("#addCampaign").modal("hide");
			}
		}, function errorCallback(response) {
		   
		});
	};

	$scope.deleteCampaign= function(){
		$scope.campaign = {
			id : $scope.idCampaign
		}
		$http({
			method:'POST',
			url:'community/deleteCampaign',
			data: $scope.campaign
		}).then(function successCallback(response){
			if(response.data){
				$scope.searchCampaign();
				$('#deleteModal').modal( "hide");
			}
		}, function errorCallback(response){
			console.log(response);
		});
	}

	$scope.showDialog = function(idCampaign){
		$scope.idCampaign=idCampaign;
		$scope.confirmDialog = {
	     	title: "Eliminar campaña",
	     	message: "¿Estás seguro que deseas eliminar esta campaña?",	    	
	        label: "Eliminar",
	        action: "eliminar"	     
    	};
		$('#deleteModal').modal( "show");
		
	}

	$scope.confirmDelete = function(){
		
		$scope.deleteCampaign($scope.idCampaign);

	}

	$scope.cancelDelete=function(){
		$('#deleteModal').modal('hide');
	}

	$scope.viewDetails=function(idCampaign){
		$scope.idCampaign=idCampaign;
		$scope.viewCampaign($scope.idCampaign);
		$('#viewModal').modal( "show");
	}

	$scope.viewCampaign = function(idCampaign){

		$http({
		  method: 'GET',
		  url: 'community/viewCampaign/'+idCampaign
		}).then(function successCallback(response){				
					if (response.data != false) {
						$scope.campaign=response.data;						
					}
				},
				function errorCallback(response){
					
				});

	}

	$scope.showUpdateDialog=function(idCampaign){
		$scope.idCampaign=idCampaign;
		$scope.confirmDialogUpdate={
			title:'Actualizar campaña',
			labelName:'Nombre',
			labelDescription:'Descripción',
			labelSocialNetwork:'Red Social',
			labelBeginDate:'Fecha de inicio de campaña',
			labelEndingDate:'Fecha de fin de campaña',
			labelBudget:'Presupuesto',
			labelUsedBudget:'Presupuesto gastado'
		}
		$scope.viewCampaign($scope.idCampaign);
		$('#updateModal').modal('show');
		
	}	

	$scope.confirmUpdate=function(){
		$scope.updateCampaign($scope.idCampaign);
	}

	$scope.updateCampaign=function(){
		$http({
			method: 'POST',
		 	url: 'community/updateCampaign',
		 	data: $scope.campaign
		}).then(function successCallback(response){
			
			if(response.data != false){
				$scope.searchCampaign();
				$('#updateModal').modal('hide');
			}
		},function errorCallback(response){
			
		});
	}*/
	
	$scope.getCustomers();
});