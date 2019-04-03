app.controller("libranzaLiquidadorCtrl", function($scope, $http) {
	
	$scope.cities =[];
	$scope.plazoSelected={
		amount:'',
		timeLimit:''
	};

	$scope.typeProducts = [
		{
			label: 'Crédito para electrodomésticos', value: 'Crédito para electrodomésticos'
		},
		{
			label: 'Crédito para motos', value:'Crédito para motos'
		},
		{
			label: 'Credito para viajes', value: 'Credito para viajes'
		},
		{
			label: 'Compra de cartera', value: 'Compra de cartera'
		},
		{
			label: 'Libre inversión', value:'Libre inversión'
		}
	];
	$scope.tipoCliente = [
		{
			label : 'Pensionado',
			value : 'Pensionado'
		},
		{
			label : 'Docente',
			value : 'Docente'
		},
		{
			label : 'Militares Activos',
			value : 'Militares Activos'
		}
	];

	

	$scope.libranza = {
		creditLine: '',
		pagaduria : '',
		customerType: '',
		age : '',
		salary : '',
		lawDesc : '',
		otherDesc : '',
		segMargen : '',
		quotaBuy : '',
		quaotaAvailable : '',
		maxQuota : '',
		name : '',
		lastName : '',
		email: '',
		telephone: '',
		city: '',
		typeService: 'Credito libranza',
		typeProduct: '',
		termsAndConditions: 0,
		channel: 1,

	};

	$scope.validateInt = function(){
		if($scope.libranza.salary < 0){
			$scope.libranza.salary = 0;
		}

		if($scope.libranza.otherDesc < 0){
			$scope.libranza.otherDesc = 0;
		}

		if($scope.libranza.age < 0){
			$scope.libranza.age = 0;
		}

		if($scope.libranza.quotaBuy < 0){
			$scope.libranza.quotaBuy = 0;
		}
	};

	$scope.plazo={
		amount:0.0,
		timeLimit:''
	}
	$scope.quotaBuy=false;
	$scope.params=[]
	$scope.timeLimits=[];
	$scope.plazos=[];
	$scope.lines=[];
	$scope.pagaduriaLibranza=[];
	$scope.libranzaProfiles=[];

	$scope.getData=function(){
		$http({
			method:'GET',
			url:'/api/getDataLibranza'
		}).then(function successCallback(response){
			if(response.data != false){
				
				angular.forEach(response.data.lines, function(value, key) {
					$scope.lines.push(value);
				});

				angular.forEach(response.data.profiles, function(value, key) {
					$scope.libranzaProfiles.push(value);
				});

				angular.forEach(response.data.timeLimits, function(value, key) {
					$scope.timeLimits.push(value);
				});

				angular.forEach(response.data.params, function(value, key) {
					$scope.params.push(value);
				});

				angular.forEach(response.data.cities, function(value, key) {
					$scope.cities.push(value);
				});
			}
		},function errorCallback(response){
			
		});
	}

	$scope.assignPagaduria = function(){

	};


	$scope.selectPagaduria = function (){

		$http({
			method:'GET',
			url:'/api/getPagadurias/'+$scope.libranza.customerType
		}).then(function successCallback(response){
			console.log(typeof $scope.libranza.customerType);
			angular.forEach(response.data, function(value, key) {
				$scope.pagaduriaLibranza.push(value);
			});
		},function errorCallback(response){	
			
		});
		
	};

	$scope.calculateData = function(){
		$scope.libranza.lawDesc = $scope.libranza.salary * 0.12;
		$scope.libranza.segMargen = ($scope.libranza.salary > 828116) ? 5300 : 2000 ;
		$scope.libranza.quaotaAvailable = (($scope.libranza.salary - $scope.libranza.lawDesc)/2)-$scope.libranza.otherDesc-$scope.libranza.segMargen+$scope.libranza.quotaBuy;
		if($scope.libranza.age >= 18 && $scope.libranza.age < 80){
			$scope.libranza.maxQuota = 60000000;
		}else if($scope.libranza.age >= 80 && $scope.libranza.age < 86){
			$scope.libranza.maxQuota = 9000000;
		}else{
			$scope.libranza.maxQuota = 5000000;
		}
	};

	$scope.ableField=function(){
		if($scope.libranza.creditLine==2){
			$scope.quotaBuy=true;
		}else{
			$scope.quotaBuy=false;
		}		
	}


	$scope.simular = function(){
		if($scope.libranza.age == '' || $scope.libranza.creditLine == '' || $scope.libranza.customerType == '' || $scope.libranza.pagaduria == ''){
			return -1;
		}else{
			if($scope.libranza.quaotaAvailable <= 148518 ){
				return 0;
			}else{
				if($scope.libranza.salary < 0 || $scope.libranza.salary == ''){
					return -2;
				}else{
					$scope.updateLiquidator();
					var rate=$scope.params[0].rate;
					var gap=$scope.params[0].gap;
					var loanAssurance=($scope.params[0].assurance)/1000000;
					var gapTop=0.0;
					var gapBottom=0.0;
					var result=0;	
					for(var i =0;i < $scope.timeLimits.length; i++){
						var aux = {
							amount : 0.0,
							timeLimit : ''
						};
						var fee=Math.pow((1+rate),$scope.timeLimits[i].timeLimit);
						
						if($scope.plazo.amount<=$scope.libranza.maxQuota){
							
							gapTop=$scope.libranza.quaotaAvailable*(fee-1);
							gapBottom=((1+(rate*gap))*(rate*fee))+(loanAssurance*(fee-1));
							result=gapTop/gapBottom;
							$scope.plazo.amount=(Math.floor((result)/100000))*100000;
							$scope.plazo.timeLimit=$scope.timeLimits[i];
							aux = angular.extend({},$scope.plazo);
							$scope.plazos[i]= aux;
													
						}
					}	
								
				}
			}
		}
	};

	$scope.showModal=function(){
		var sim= $scope.simular();

		if(sim== -1){
			alert('Debes de llenar todos los datos');
		}else if(sim== 0){
			$('#solicitarModal').modal('hide');
			$('#negacionModal').modal('show');
		}else if(sim== -2){
			alert("Para poder simular el Salario Básico no puede ser menor a 0");
		}else{
			
			$('#solicitarModal').modal('hide');
			$('#simularModal').modal('show');
		}
		
	}
	
	$scope.idLead='';

	$scope.updateLiquidator=function(){
		$http({
			method:'PUT',
			url:'/api/updateLiquidator/'+$scope.idLead,
			data:$scope.libranza
		}).then(function successCallback(response){
			if(response.data != false){
			}
		},function errorCallback(response){
		});
	}


	$scope.solicitar = function(){
		
		$http({
			method:'PUT',
			url:'api/addAmount/'+$scope.idLead,
			data:$scope.plazoSelected
		}).then(function successCallback(response){
			if(response.data != false){
			}
		},function errorCallback(response){
		});
		window.location = "/LIB_gracias_FRM";		
	};
	
	$scope.setPlazo=function(amount,timeLimit){
		$scope.plazoSelected.amount=amount;
		$scope.plazoSelected.timeLimit=timeLimit;		
	}

	$scope.updateCSS=function(plazoSelected){
		if($scope.plazoSelected.amount == plazoSelected.amount){
			return 'background-color: #348dc7;color: #FFF;font-weight: 700;';
		}else{
			return '';
		}
		
	}

	$scope.addLead = function(){
		if($scope.libranza.termsAndConditions == false){
			alert("Debes aceptar términos y condiciones y política de tratamiento de datos");
		}else if($scope.libranza.city == ''){
			alert("Debes Ingresar una ciudad");
			document.getElementById("city").focus();
		}else{
			$http({
			  method: 'POST',
			  url: '/libranza',
			  data: $scope.libranza
			}).then(function successCallback(response) {
				$scope.idLead=response.data;
				$('#solicitarModal').modal('show');
			}, function errorCallback(response) {
			    
			});
		}
	};
	
	$scope.getData();

});