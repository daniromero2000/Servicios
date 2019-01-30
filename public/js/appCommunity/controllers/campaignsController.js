

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
	$scope.idImage = '';
	$scope.confirmDialog={};
	$scope.confirmDialogUpdate={};
	$scope.socialNetworks = [
		{ label : 'FACEBOOK',value: 'FACEBOOK' },
		{ label : 'WHATSAPP',value: 'WHATSAPP' },
		{ label : 'INSTAGRAM',value: 'INSTAGRAM' },
		{ label : 'TWITTER',value: 'TWITTER' }
	];
	$scope.tabs = 1;//init in first tab
	$scope.resource = {};//resource to edit 
	$scope.images = [];//list of images
	$scope.imgs = {};// image of flow

	

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
				$scope.idCampaign=response.data;
				$scope.showUpdateDialog(response.data);
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
				//$('#updateModal').modal('hide');
			}
		},function errorCallback(response){
			
		});
	}

	$scope.saveChanges = function(idCampaign){
		idCampaign=$scope.idCampaign;
		$scope.updateCampaign();
		$scope.AddImages(idCampaign);
		$('#updateModal').modal('hide');
	}

	$scope.AddImages = function(idCampaign){
		idCampaign=$scope.idCampaign;
		var formData = new FormData();
		$scope.imgs.flow.upload();
		//add images to FormData
		i=0;
		angular.forEach($scope.imgs.flow.files, function(value) {
		  formData.append('imgs' + i++,value.file);
		});
		
		formData.append('nImages', i);//num images to upload
		formData.append('idCampaign',idCampaign);//id product to attach images 
		console.log(idCampaign);
		showLoader();
		$http.post('/community/addImage',formData,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).then(function successCallback(response) {	
					
			if(response.data != false){
				//clear a flow  objet of images uploads
				while($scope.imgs.flow.files.length>0){
					$scope.imgs.flow.cancel();
				}
				console.log('si');
				console.log(response.data);
				console.log($scope);
				//to  updete the uploaded images
			//	$scope.getResource();
				hideLoader();
			}
		}, function errorCallback(response) {
			console.log('no');
			console.log(response);
			hideLoader();
			//console.log(response.data);
		});
	};

	
	$scope.getCampaigns();
});