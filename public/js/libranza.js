app.controller("libranzaLiquidadorCtrl", function($scope, $http,$mdDialog,$routeParams,$location,$document) {
	
	
	//array donde se guardaran las ciudades traidas en consulta
	$scope.cities =[];
	
	//objeto donde seran capturados el monto, el plazo y la tasa
	$scope.plazoSelected={
		amount:1000000,
		timeLimit:13, 
		rate:3,
	};

	$scope.idLeadParam=$routeParams.idLeadParam;

	//initial value for datepicker
	$scope.birthday='1970/01/01';

	
	//array de tipo de productos
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


	//objeto donde se guarda los datos de la simulación
	$scope.leadResumen={
		name:'',
		lastName:'',
		amount:0,
		timeLimit:13,
		fee:0,
		idLiquidator:''
	}

	
	//objeto de datos de libranza
	$scope.libranza = {
		creditLine: '',
		idPagaduria:'',
		amount:'',
		timeLimit:'',
		pagaduria : '',
		customerType: '',
		age : 50,
		salary : '',
		lawDesc : '',
		otherDesc : '',
		segMargen : '',
		quotaBuy : 0,
		rate:'',
		fee:'',
		quaotaAvailable : '',
		typeDocument:1,
		identificationNumber:'',
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

	$scope.plazo={
		amount:0.0,
		timeLimit:''
	}

	$scope.maxAmount=80000000; //Valor inicial para el monto máximo
	$scope.minAmount=1000000;  //valor inicial para el monto mínimo
	$scope.quotaBuy=false; //Muestra el campo de compra de cartera si es true
	$scope.params=[]; //array donde se guarda el los parametros del simulador (tasa y seguros)
	$scope.timeLimits=[]; //array donde se guarda los plazos
	$scope.plazos=[]; //array donde se guarda montos y plazos según cupo disponible 
	$scope.lines=[]; //array donde se guarda las lineas de crédito
	$scope.pagaduriaLibranza=[]; //array que guarda las pagadurías 
	$scope.libranzaProfiles=[]; //array que guarda los perfiles de libranza
	
	$scope.basicFee=0;
	$scope.factor=1000000;
	$scope.interest=1.9;
	$scope.constraintQuota=false;

	$scope.toolTip = {
		showTooltip : true,
		tooltipDirection : ''
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


	/*
	Assign the queries data to defined array above
	*/
	/*
	Asigna los datos de la consulta a los arrays definidos arriba
	*/
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

	


	/*	
	Get pagadurias 
	*/
	/*
	Asigna los datos de la consulta a los arrays definidos arriba
	*/

	$scope.selectPagaduria = function (){
		$scope.pagaduriaLibranza=[];
		$http({
			method:'GET',
			url:'/api/getPagadurias/'+$scope.libranza.customerType
		}).then(function successCallback(response){
			
			angular.forEach(response.data, function(value, key) {
				$scope.pagaduriaLibranza.push(value);
			});
		},function errorCallback(response){	
		});		
	};	

	$scope.showContentCartera = false;
	$scope.showContentLibre = false;
	
	$scope.hoverInCartera = function(){
		$scope.showContentCartera = true;
	}

	$scope.hoverOutCartera = function(){
		$scope.showContentCartera = false;
	}
	
	$scope.hoverInLibre = function(){
		$scope.showContentLibre = true; 
	}

	$scope.hoverOutLibre = function(){
		$scope.showContentLibre = false;
	}

	/*
		calcular el monto máximo a prestar según edad
	*/
	$scope.calculateData = function(){
		$scope.libranza.lawDesc = Math.round($scope.libranza.salary * 0.12);
		$scope.libranza.segMargen = ($scope.libranza.salary > 828116) ? 5300 : 2000 ;
		$scope.libranza.quaotaAvailable = (($scope.libranza.salary - $scope.libranza.lawDesc)/2)-$scope.libranza.otherDesc-$scope.libranza.segMargen + parseInt($scope.libranza.quotaBuy);
		if($scope.libranza.age >= 18 && $scope.libranza.age < 80){
			$scope.libranza.maxQuota = 80000000;
		}else if($scope.libranza.age >= 80 && $scope.libranza.age < 86){
			$scope.libranza.maxQuota = 9000000;
		}else{
			$scope.libranza.maxQuota = 5000000;
		}

	};

	$scope.ableField=function(){
		if($scope.libranza.creditLine==2){
			$scope.quotaBuy=true;
			$scope.simulate();
		}else{
			$scope.quotaBuy=false;
			$scope.libranza.quotaBuy=0;
			$scope.simulate();
		}	
	}


	$scope.calculateAge = function(birthday) {	
		birthday=String(birthday);
		var birthday_date = new Date(birthday);
		var ageDifMs = Date.now() - birthday_date.getTime();
		var ageDate = new Date(ageDifMs);
		$scope.libranza.age =  Math.abs(ageDate.getUTCFullYear() - 1970);	
	}

	$scope.payFunction = function(rate,timeLimit,amount){
		var quota=0;
		var basicFeeTop=amount*(rate*Math.pow((1+rate),timeLimit));
		var basicFeeBottom= (Math.pow((1+rate),timeLimit))-1;
		quota=basicFeeTop/basicFeeBottom;
		return quota;
	}

	$scope.basicSimulation = function(loan,fee,timeLimit,amount){	
			
		var basicFeeTop=amount*(loan*Math.pow((1+loan),timeLimit)); 
		var basicFeeBottom= (Math.pow((1+loan),timeLimit))-1;
		var gap = 1;
		
		if($scope.libranza.creditLine == 2){
			gap= 2;
		}else{
			gap = 1;
		}

		var gapValue= loan*amount*gap;
		var gapQuota = $scope.payFunction(loan,timeLimit,gapValue)
		var basicFee=(basicFeeTop/basicFeeBottom) + ((fee*amount)/$scope.factor) + gapQuota;
		$scope.basicFee=(Math.floor((basicFee)/100))*100;
		$scope.libranza.fee= $scope.basicFee;
		$scope.libranza.rate=loan;
		$scope.libranza.amount=amount;
		$scope.libranza.timeLimit=timeLimit;
	};

	$scope.calculateAmounts=function(timeLimitList,rate,quaotaAvailable,gap,loanAssurance,factor,amountList){
		for(var i =0;i < timeLimitList.length; i++){
			var aux = {
				amount : 0.0,
				timeLimit : ''
			};
			var fee=Math.pow((1+rate),timeLimitList[i].timeLimit);
			
			if($scope.plazo.amount<=$scope.libranza.maxQuota){
				
				gapTop=quaotaAvailable*(fee-1);
				gapBottom=((1+(rate*gap))*(rate*fee))+((loanAssurance/factor)*(fee-1));
				result=gapTop/gapBottom;
				$scope.plazo.amount=(Math.floor((result)/1000000))*1000000;
				$scope.plazo.timeLimit=timeLimitList[i];
				aux = angular.extend({},$scope.plazo);
				amountList[i]= aux;
			}
		}
		return amountList;
	}

	$scope.calculateAmount=function(timeLimit,rate,quaotaAvailable,gap,loanAssurance,factor){

		var fee=Math.pow((1+rate),timeLimit);
		var gapBottom= 0;
		var gapTop= 0;
		var result=0;
		var amount=0;

		gapTop=quaotaAvailable*(fee-1);
		gapBottom=((1+(rate*gap))*(rate*fee))+((loanAssurance/factor)*(fee-1));
		result=gapTop/gapBottom;
		amount=(Math.floor((result)/1000000))*1000000;
		 
		return amount;

	}

	const formatter = new Intl.NumberFormat('en-US', {
		style: 'currency',
		currency: 'USD',
		minimumFractionDigits: 0
	  });

	$scope.sliderAmountChanged=0;
	$scope.sliderTimeChanged=0;
	$scope.sliderRateChanged=0;
	$scope.classForm='form-body-simulator';
	$scope.disableRange=false;

	$scope.sliderAmount = {
		value:1000000,
		minValue: 1000000,
		maxValue: $scope.maxAmount,
		options: {
		  floor: 1000000,
		  ceil: $scope.maxAmount,
		  step:1000000,
		  disabled: false,
		  translate: function(value, sliderId, label) {
			switch (label) {
			  case 'model':	
				return formatter.format(value);
			  case 'high':
				return formatter.format(value);
			  default:
				return formatter.format(value)
			}
		  },
			onChange: function(){
			  $scope.simular(0);
			  $scope.sliderAmountChanged=1;
			  $scope.inputDisable=false;
			  $scope.inputDisableButton=false;
			  
		  	},
		  	showSelectionBar: true,
    		selectionBarGradient: {
      			from: 'white',
      			to: '#FC0'
    		}
		}
	  };

	 // $scope.valueTime=13;

	  $scope.sliderTime = {
		value: 13,	
		options: {	
		  floor: 12,
		  ceil: 120,
		  step:12,
		  ticksArray: [13, 24, 36, 48, 60,72,84,96,108, 120],
		  disabled: false,
		  translate: function(value, sliderId, label) {
			switch (label) {
			  case 'model':	
				if(value==12){
					return value=13;
				}
				return value;
			case 'high':
				if(value==12){
					return value=13;
				}
				return value;
			case 'floor' :
				return floor = 13;
			  default:
					
				return value;
			}
		  },
		  onChange: function(){
			$scope.valueTime=$scope.sliderTime.value==12?13:$scope.sliderTime.value;
			$scope.simular(2);
			$scope.sliderTimeChanged=2;
			$scope.inputDisable=false;
			$scope.inputDisableButton=false;
			},
		}
	  };


	  $scope.sliderRate = {
		value: 1,
		options: {
		  showTicksValues: true,
		  stepsArray: [
			{value: 1, legend: 'Justo'},
			{value: 2, legend: 'Bueno'},
			{value: 3, legend: 'Excelente'}
		  ],
		  disabled: false,
		  onChange: function(){
			$scope.simular(1);
			$scope.sliderRateChanged=4;
			$scope.inputDisable=false;
			$scope.inputDisableButton=false;
			},
			showSelectionBar: true,
			getSelectionBarColor: function(value) {
				if (value <= 2)
					return 'orange';
				if (value <= 3)
					return '#3fcf64';
				return '#2AE02A';
			}
		}
	  };

	$scope.clickOnSlider=0;
	
	$scope.sumCLicks=function(){
		$scope.clickOnSlider++;
		$scope.classForm=$scope.clickOnSlider>=3?'form-body-simulator-able':'form-body-simulator';
		$scope.inputDisable=false;
		$scope.inputDisableButton=false;
		}


	$scope.inputDisable=true;
	$scope.inputDisableButton=true;

	$scope.showAlertError=false;

	$scope.simular = function(flag){

		
		$scope.sliderTime.value=$scope.sliderTime.value==12?13:$scope.sliderTime.value;

		var rate=0.019;
		var gap=$scope.params[0].gap;
		var loanAssurance=0;

		if ($scope.sliderRate.value == 3){
			$scope.interest= 1.9;	
			rate=$scope.interest/100; 	
		}else if($scope.sliderRate.value == 2){
			$scope.interest= 2.12;
			rate=$scope.interest/100;	
		}else{	
			rate=$scope.params[0].rate;
		}
		
		var interest = rate*100;
		$scope.interest = interest.toFixed(2);
		if($scope.libranza.age<70 && $scope.libranza.age >=18){
			loanAssurance=$scope.params[0].assurance;
		}else if($scope.libranza.age>=70 && $scope.libranza.age<90){
			loanAssurance=$scope.params[0].assurance2;
		}else{
			loanAssurance = 0;
		}


		if($scope.libranza.age == '' || $scope.libranza.creditLine == '' || $scope.libranza.customerType == '' || $scope.libranza.pagaduria == ''){
			$scope.basicSimulation(rate,loanAssurance,$scope.sliderTime.value,$scope.sliderAmount.value);
		}else{	
			if($scope.libranza.quaotaAvailable <= 148518 ){
				$scope.inputDisableButton=true;
				$scope.showAlertError=true;
				$scope.disableRange=true;
				$scope.sliderAmount.options.disabled=$scope.disableRange;
				$scope.sliderTime.options.disabled=$scope.disableRange;
				$scope.sliderRate.options.disabled=$scope.disableRange;
				$scope.basicSimulation(0,0,13,1000000);
			}else{
				if($scope.libranza.salary < 0 || $scope.libranza.salary == ''){
					$scope.inputDisableButton=true;
					$scope.showAlertError=true;
					$scope.disableRange=true;
					$scope.sliderAmount.options.disabled=$scope.disableRange;
					$scope.sliderTime.options.disabled=$scope.disableRange;
					$scope.sliderRate.options.disabled=$scope.disableRange;
					$scope.basicSimulation(0,0,13,1000000);
				}else{
					$scope.inputDisableButton=false;
					$scope.showAlertError=false;
					$scope.disableRange=false;
					$scope.sliderAmount.options.disabled=$scope.disableRange;
					$scope.sliderTime.options.disabled=$scope.disableRange;
					$scope.sliderRate.options.disabled=$scope.disableRange;

					var plazos= [];
					var lastPlazo={};	
					if(flag==1){
						$scope.plazos = $scope.calculateAmounts($scope.timeLimits,rate,$scope.libranza.quaotaAvailable,gap,loanAssurance,$scope.factor,plazos);
						lastPlazo = $scope.plazos[$scope.plazos.length-1];
						if($scope.sliderAmount.value>lastPlazo.amount){
							$scope.sliderAmount.value=lastPlazo.amount;
							$scope.sliderTime.value=lastPlazo.timeLimit.timeLimit;	
						}
						$scope.maxAmount=lastPlazo.amount;
						$scope.sliderAmount.maxValue=lastPlazo.amount;
						$scope.sliderAmount.options.ceil=lastPlazo.amount>80000000?80000000:lastPlazo.amount;
						$scope.basicSimulation(rate,loanAssurance,$scope.sliderTime.value,$scope.sliderAmount.value);

					}else if(flag==0){
						
						$scope.basicSimulation(rate,loanAssurance,$scope.sliderTime.value,$scope.sliderAmount.value);

						if($scope.basicFee > $scope.libranza.quaotaAvailable){
							var flagAmount=0;
							$scope.plazos = $scope.calculateAmounts($scope.timeLimits,rate,$scope.libranza.quaotaAvailable,gap,loanAssurance,$scope.factor,plazos);
							for(var i=0;i <$scope.plazos.length; i++){
								if(($scope.sliderAmount.value <= $scope.plazos[i].amount) && flagAmount == 0){
									$scope.sliderTime.value=$scope.plazos[i].timeLimit.timeLimit;
									flagAmount = 1;
								}
								$scope.basicSimulation(rate,loanAssurance,$scope.sliderTime.value,$scope.sliderAmount.value);
							}
						}					
						
					}else if(flag==2){

						$scope.basicSimulation(rate,loanAssurance,$scope.sliderTime.value,$scope.sliderAmount.value);

						if($scope.basicFee>$scope.libranza.quaotaAvailable){
							$scope.sliderAmount.value = $scope.calculateAmount($scope.sliderTime.value,rate,$scope.libranza.quaotaAvailable,gap,loanAssurance,$scope.factor);
							for(var j=0;j <$scope.plazos.length; j++){
								if(($scope.sliderTime.value == $scope.plazos[j].timeLimit.timeLimit)){
									$scope.sliderAmount.value=$scope.plazos[j].amount;
								}
							}
							$scope.basicSimulation(rate,loanAssurance,$scope.sliderTime.value,$scope.sliderAmount.value);
						}
					}else{

					}
					
				}
			}
		}

	};

	$scope.simulate= function(){
		$scope.calculateData();
		$scope.simular(1);
	}

	$scope.showModal=function(){
		$scope.simular(1);
		console.log($scope.sliderAmount.maxAmount);
		$('#solicitarModal').modal('show');
		
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
		$scope.plazoSelected.amount=$scope.sliderAmount.value;
		$scope.plazoSelected.timeLimit=$scope.sliderTime.value;
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
	


	var idLeadURL= $routeParams.idLeadParam;

	$scope.getLeadInfo=function(){
		$http({
			method:'GET',
			url:'api/getResumen/'+idLeadURL
		}).then(function successCallback(response){
			if(response.data != false){
				$scope.leadResumen.name=response.data.name;
				$scope.leadResumen.lastName=response.data.lastName;
				$scope.leadResumen.amount=response.data.amount;
				$scope.leadResumen.fee=response.data.fee;
				$scope.leadResumen.timeLimit=response.data.timeLimit;
				$scope.leadResumen.idLiquidator=response.data.idLiquidator;
			}
		},function errorCallback(response){
			
		});
	}

	$scope.addLead = function(){
		$('#solicitarModal').modal('hide');
		if($scope.libranza.termsAndConditions == false){
			alert("Debes aceptar términos y condiciones y política de tratamiento de datos");
		}else if($scope.libranza.city == ''){
			alert("Debes Ingresar una ciudad");
			document.getElementById("city").focus();
		}else if($scope.libranza.termsAndConditions != 1){
			getElAng.setCustomValidity("Please indicate that you accept the Terms and Conditions");
		}else{
			$http({
			  method: 'POST',
			  url: '/libranza',
			  data: $scope.libranza
			}).then(function successCallback(response) {
				$scope.idLead=response.data;
				$location.url("solicitud/"+$scope.idLead);
				
			}, function errorCallback(response) {
			});
		}
	};

	var formData = new FormData();
	var formDataDocument = new FormData();
	var idLeadURL= $routeParams.idLeadParam;

	$scope.errors = []; 
	$scope.files = [];
	$scope.errorsDocument = []; 
	$scope.filesDocument = [];

	$scope.disableFileButton=false;
	$scope.disableDocumentButton=false;
	
	$scope.successButton=false;
	$scope.hideButton=true;
	$scope.successButtonDocument=false;
	$scope.hideButtonDocument=true;
	
	$scope.uploadDocument = function (element) {
		var request = {
			method: 'POST',
			url: '/api/upload/file',
			data: formDataDocument,
			headers: {
				'Content-Type': undefined
			}
		};
	
		$http(request)
			.then(function success(e) {
				$scope.filesDocument = e.data.files;
				$scope.errorsDocument = [];
				var fileElement = angular.element(element);
				fileElement.value = '';
				$scope.successButtonDocument=true;
				$scope.disableDocumentButton=true;
				$scope.hideButtonDocument=false;
				//alert("La imagen ha sido cargada exitosamente");
				//console.log(e);
			}, function error(e) {
				$scope.errorsDocument = e.data.errors;
				console.log(e);
			});
	};


	$scope.uploadFile = function (element) {
		formData.delete('document_file');
		var request = {
			method: 'POST',
			url: '/api/upload/file',
			data: formData,
			headers: {
				'Content-Type': undefined
			}
		};
	
		$http(request)
			.then(function success(e) {
				$scope.files = e.data.files;
				$scope.errors = [];
				var fileElement = angular.element(element);
				fileElement.value = '';
				$scope.successButton=true;
				$scope.disableFileButton=true;
				$scope.hideButton=false;
				//alert("La imagen ha sido cargada exitosamente");
				//console.log(e);
			}, function error(e) {
				$scope.errors = e.data.errors;
				console.log(e);
				console.log(e.data.errors[0]);
			});
	};	

	$scope.setTheDocuments = function ($files) {
        angular.forEach($files, function (value, key) {
			formDataDocument.append('document_file', value);
		});
		formDataDocument.append('id_simulation',$scope.leadResumen.idLiquidator);
		console.log(formData.get('document_file'));
	};	

	$scope.setTheFiles = function ($files) {
        angular.forEach($files, function (value, key) {
			formData.append('image_file', value);
		});
		formData.append('id_simulation',$scope.leadResumen.idLiquidator);
		console.log(formData.get('id_simulation'));
	};	

	$scope.dialogContent=[
		{
			title:'Compra de Cartera',content:'Con el crédito de Libre inversión puedes financiar lo que quieres, viajes, electrodomésticos, motocicletas, o simplemente ir de compras, simula tu crédito de libranza,conoce el plazo y monto que más se ajuste a tus necesidades y adquiere todo lo que has soñado. <br><strong>¡Pide tu crédito ahora!</strong>'
		},
		{
			title:'Crédito de libre Inversión',content:'Si lo que necesitas es mejorar tu flujo de caja, con tu crédito de libranza podrás unificar todas tus deudas con una cuota fija mensual y amplios plazos que se ajustan a tu necesidad. <br><strong>¡Alivia tus finanzas ya!</strong>'
		}
	];

	$scope.status = '  ';
	$scope.customFullscreen = false;
	
	$scope.showAlert = function(ev,title,content) {
		// Appending dialog to document.body to cover sidenav in docs app
		// Modal dialogs should fully cover application
		// to prevent interaction outside of dialog
		$mdDialog.show(
		  $mdDialog.alert()
			.parent(angular.element(document.querySelector('#popupContainer')))
			.clickOutsideToClose(true)
			.title(title)
			.textContent(content)
			.ariaLabel('Alert Dialog Demo')
			.ok('Cerrar')
			.openFrom('#left')
			.targetEvent(ev)
		);
	  };

	

	  $scope.showAdvanced = function(ev) {
		$mdDialog.show({
		  controller: DialogController,
		  templateUrl: '/libranza-principal/templateDialog',
		  parent: angular.element(document.body),
		  targetEvent: ev,
		  clickOutsideToClose:true,
		  fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
		})
		.then(function(answer) {
		  $scope.status = 'You said the information was "' + answer + '".';
		}, function() {
		  $scope.status = 'You cancelled the dialog.';
		});
	  };

	  $scope.showAdvancedLI = function(ev,flag) {
		
		$mdDialog.show({
		  controller: DialogController,
		  templateUrl: '/libranza-principal/templateDialogLI',
		  parent: angular.element(document.body),
		  targetEvent: ev,
		  clickOutsideToClose:true,
		  fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
		})
		.then(function(answer) {
		  $scope.status = 'You said the information was "' + answer + '".';
		}, function() {
		  $scope.status = 'You cancelled the dialog.';
		});
	  };	


	  function DialogController($scope, $mdDialog) {
		$scope.hide = function() {
		  $mdDialog.hide();
		};
		
		$scope.lineTemplate=false;
		
		$scope.cancel = function() {
		  $mdDialog.cancel();
		};
	
		$scope.answer = function(answer) {
		  $mdDialog.hide(answer);
		};
	  }
 
		if(idLeadURL==undefined){
			$scope.getData();
		}else{
			$scope.getLeadInfo();
		}

});


app.directive('ngFiles', ['$parse', function ($parse) {
 
    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            onChange(scope, {$files: event.target.files});
        });
    }
    return {
        link: file_links
    }
}]);	