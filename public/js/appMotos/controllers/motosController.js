app.controller('motosController', function($scope, $http){

	$scope.moto={
		id:'',
		image:'',
		brand:'',
		details:'',
		manual:'',
		name:'',
		description:'',
		price:0,
		runt:0,
		taxes:0,
		aval:0,
		initialFee:0,
		soat:0,
		creditEnrollment:0,
		brandBonus:0,
		creditPrice:0,
		buttonText:'',
		fee:0,
		type:'',
		power:'',
		torque:'',
		compression:'',
		start:'',
		engine:'',
		displacement:0,
		frontBrake:'',
		rearBrake:'',
		frontSuspension:'',
		backSuspension:'',
		tireFront:'',
		tireBack:'',
		ignition:'',
		long:0,
		height:0,
		seatHeight:0,
		width:0,
		weight:0,
		wheels:0,
		tank:0,
		axisDistance:0,
		imageDescription:'',
	};
	$scope.brand={
		id:0,
		brand:'',
	}
	$scope.brands=[];
	$scope.motos=[];
	$scope.tabs=1;
	$scope.motoImages=[];
	$scope.idMoto=0;
	$scope.tabs = 1;//init in first tab
	$scope.resource = {};//resource to edit 
	$scope.images = [];//list of images
	$scope.imgs = {};// image of flow
	$scope.auxFormData={
		'idMoto':'',
		'imgs':''
	};

	$scope.getMotos=function(){
		$scope.idMoto=0;
		$scope.motoImages=[];
		$scope.moto={};
		$scope.motos=[];
		$http({
			method:'GET',
			url:'/adminMotos'
		}).then(function successCallback(response){
				if(response.data != false){
					$scope.motos=response.data.motos;
					$scope.brands=response.data.brands;
				}
		},function errorCallback(response){
			
		});
	};


	$scope.getMotoImages=function(id){
		$http({
			method:'GET',
			url:'/adminMotos/'+id
		}).then(function(response){
			if(response.data != false){
				$scope.motoImages=response.data;
			}
		},function(response){
			
		});
	}

	$scope.viewMoto= function(moto){
		$scope.moto=moto;
		$scope.idMoto=moto.id;
		$scope.getMotoImages($scope.idMoto);
		$('#viewMoto').modal('show');
	};

	$scope.closeModal=function(){
		$scope.getMotos();
	}

	$scope.openAddModal=function(){
		$('#addMoto').modal('show');
	};

	$scope.openModalAddMoto = function(){
		$('#addMotoModal').modal('show');
	}

	$scope.addMoto = function(){
		$http({
			method:'POST',
			url:'/adminMotos',
			data:$scope.moto,
		}).then(function successCallback(response){
			if(response.data != false){
				showLoader();
				$('#addMotoModal').modal('hide');
				$scope.openAddModal();
				hideLoader();
				$scope.idMoto=response.data.idMoto;
				console.log($scope.idMoto);
			}
		},function errorCallback(response){

		});
	}

	$scope.updateMoto=function(id){
		id=$scope.moto.id;
		$http({
			method:'PUT',
			url:'/adminMotos/'+$scope.idMoto,
			data:$scope.moto,
		}).then(function successCallback(response){
			if(response.data != false){
				$scope.AddImages($scope.idMoto);
			}
			console.log('sii');
		},function(response){
			console.log(response);
		});
	}

	$scope.printFlow=function(){
		console.log($scope.imgs.flow);
	}

	$scope.AddImages = function(idMoto){
		var formData = new FormData();
		$scope.imgs.flow.upload();
		//add images to FormData
		//console.log($scope.imgs.flow);	
		//$scope.auxFormData.idMoto=idMoto
		//$scope.auxFormData.imgs=$scope.imgs.flow.files;

		//console.log($scope.auxFormData);
		
		console.log(idMoto);
		formData.append('imgs',$scope.imgs.flow.files);	
		formData.append('idMoto',idMoto);//id product to attach images 
		
		showLoader();
		$http.put('/admin/motos/addImage/'+idMoto,formData,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).then(function successCallback(response) {	
					
			if(response.data != false){
				//clear a flow  object of images uploads
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
			console.log(formData);
			hideLoader();
			//console.log(response.data);
		});
	};

	$scope.getMotos();
});