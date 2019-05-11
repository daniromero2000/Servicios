	/**
     /Project: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controler to display a warranty request form public view.
    **Date: 05/03/2019
     **/
app.controller('warrantyController', function($scope, $http, $location){
	$scope.step = 1;//shows the format according to the step in which you are
	$scope.other = 0;//display or not a name and last name and alert for itentification number 
	$scope.selectedProduct = {};//store a selected product in the step 2


	// change a row style of the selected product
	$scope.style = function(product){
		if (product.CODIGO == $scope.selectedProduct.CODIGO){
			// if de current product is a  selected product change a style 
			return 'background-color: #DE005D; color:white';
		}else{
			//  don't change
			return '';
		}
	
	}
	
	$scope.typeRequestes = [{id:'1',name:'Garantía legal'},
					{id:'2',name:'Garantía suplementaria'} ];
	//Request Data
	$scope.WarrantyRequest = {
		cellPhones:[{number:null}],//phones list
	};
	
	$scope.meansSales = [{id:1,name:'PÁGINA OPORTUNIDADES'},
						{id:2,name:'MERCADO LIBRE'},
						{id:3,name:'PÁGINA ÉXITO'},
						{id:4,name:'PÁGINA  LINIO'},
						{id:5,name:'ALMACEN'}]

	// check that a email and email confirmation are equal
	$scope.$watchGroup(["WarrantyRequest.confirmEmail","WarrantyRequest.email"],function(newValues,oldValues) {
		if (newValues === oldValues) {
			return;
		  }
		  if (newValues[0] == newValues[1]) {
			$scope.validEmail=false;
		  }else{
			$scope.validEmail=true;
		  }
		
	},true);

	$scope.relations = [{id:1,name:'Padre/Madre'},{id:2,name:'Hijo (a)'},
						{id:3,name:'Abuelo (a)'},{id:4,name:'Esposo (a)'},
						{id:5,name:'Abuelo (a)'},{id:6,name:'Nieto (a)'},
						{id:7,name:'Amigo (a)'},{id:8,name:'Vecino (a)'},
						{id:9,name:'Tío (a)'},{id:10,name:'Otro'}];

	// save a information product and redirect to step 3
	$scope.sendStep2 = function() {
		$scope.WarrantyRequest.idProduct = $scope.selectedProduct.CODIGO; 
		$scope.WarrantyRequest.dateShop = $scope.selectedProduct.FEC_AUR;  
		$scope.WarrantyRequest.shop = $scope.selectedProduct.SUCURSAL;
		$scope.WarrantyRequest.invoiceNumber = $scope.selectedProduct.FACTURA;
		$scope.step=3;
	}
	$scope.sendStep21 = function() {
		$scope.step=3;
	}

	// open a confirm cel number modal 
	$scope.sendRequest = function() {
		if ($scope.validEmail){ // only star if email an confirm email match
			return;
		}
		$('#confirmNumCel').modal('show');
		
	}
 // get the list of the bought products by the client in the last four years
	$scope.getProducts = function() {
		showLoader();
		$http({
			method: 'POST',
			url: '/digitalWarranty/products',
			data: $scope.WarrantyRequest
			}).then(function successCallback(response) {
				// if identification number don't correspond to any register client
				if(response.data == 'no records'){
					$scope.step = 21;
					hideLoader();
				}else if(response.data.length == 1){
					// if identification number correspond to a register client, but this don't register a credit
					$scope.step = 21;
					$scope.WarrantyRequest.names = response.data[0].NOMBRES;
					$scope.WarrantyRequest.lastNames = response.data[0].APELLIDOS;
					$scope.other=1;
					hideLoader();
				}else{
					// if identification number correspond to a register client and register a credit
					$scope.step = 2;
					$scope.WarrantyRequest.names = response.data[0].NOMBRES;
					$scope.WarrantyRequest.lastNames = response.data[0].APELLIDOS;
					$scope.products = response.data[1];
					hideLoader();
				}
			}, function errorCallback(response) {
				console.log(response.data);
				hideLoader();
			});
	}
	// send a confirmation sms and show a input token modal
	$scope.sendSms = function() {
		$('#confirmNumCel').modal('hide');
		$http({
			method: 'GET',
			url: '/digitalWarranty/getCodeVerification/'+$scope.WarrantyRequest.identificationNumber+'/'+$scope.WarrantyRequest.cellPhones[0].number
		  }).then(function successCallback(response) {
			if(response != false){
			}
		  }, function errorCallback(response) {
			console.log(response.data);
		  });
		  $('#confirmCodeVerification').modal('show');
	}
	// confirm a verification  token and show a thank you modal 
	$scope.verificationCode = function() {
		showLoader();
		$http({
			method: 'GET',
			url: '/digitalWarranty/verificationCode/'+$scope.code+'/'+$scope.WarrantyRequest.identificationNumber,
		}).then(function successCallback(response) {
			if(response.data == true){
				$('#confirmCodeVerification').modal('hide');
				$('#ModalThaks').modal('show');
				console.log($scope.WarrantyRequest)
				$http({
					method: 'POST',
					url: '/digitalWarranty/request',
					data: $scope.WarrantyRequest
				  }).then(function successCallback(response) {
					  if(response.data != false){
							$scope.WarrantyRequest.number = response.data;
							hideLoader();
						}
				  }, function errorCallback(response) {
						console.log(response.data);
						hideLoader();
				  });
			}else if(response.data == -1){
				// En caso de que el codigo sea erroneo
				$scope.showAlertCode = true;
			}else if(response.data == -2){
				// en caso de que el codigo ya expiro
				$scope.showWarningCode = true;
			}
			hideLoader();
		}, function errorCallback(response) {
			hideLoader();
		});
	}
	// load a required information to create a request
	$scope.create = function() {
		$http({
			method: 'GET',
			url: '/digitalWarranty/request/create'
		  }).then(function successCallback(response) {
			if(response != false){
				$scope.stores = response.data[0];
				$scope.groups = response.data[1];
				$scope.idTypes = response.data[2];
			}
  
		  }, function errorCallback(response) {
				console.log(response.data);
		  });
	}
	$scope.create();

});

