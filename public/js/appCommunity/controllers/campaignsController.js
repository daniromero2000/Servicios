

app.controller('campaignsController', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'initFrom': 0,
		'socialNetwork':'',
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
	$scope.confirmDialog={};
	$scope.confirmDialogUpdate={};
	$scope.socialNetworks = [
		{ label : 'FACEBOOK',value: 'FACEBOOK' },
		{ label : 'WHATSAPP',value: 'WHATSAPP' },
		{ label : 'INSTAGRAM',value: 'INSTAGRAM' },
		{ label : 'TWITTER',value: 'TWITTER' }
	];
	

	$scope.getCampaigns = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/campaign?q='+$scope.q.q+'&limitFrom='+$scope.q.initFrom+'&socialNetwork='+$scope.q.socialNetwork+'&beginDate='+$scope.q.beginDate+'&endingDate='+$scope.q.endingDate+'&budget='+$scope.q.budget,
		}).then(function successCallback(response) {
			
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

	$scope.searchCampaign = function(){
		$scope.q.initFrom = 0;
		$scope.campaigns = [];
		$scope.getCampaigns();
		
	};

	$scope.resetFiltros = function (){
		$scope.campaigns = [];
		$scope.q = {
			'q': '',
			'initFrom': 0,
			'socialNetwork': '',
			'beginDate': '',
			'endingDate': '',
			'budget': ''
		};
		$scope.filtros = false;
		$scope.getCampaigns();
	};

	$scope.addCampaignForm = function(){
		
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

	$scope.deleteCampaign= function(idCampaign){
	
		$http({
			method:'POST',
			url:'community/deleteCampaign/'+idCampaign
		}).then(function successCallback(response){
			if(response.data){
				$scope.searchCampaign();
				$('#deleteModal').modal( "hide");
			}
		}, function errorCallback(response){
			
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
	}
	
	$scope.getCampaigns();
});