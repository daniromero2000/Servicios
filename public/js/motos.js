var app=angular.module('appMotosLiquidator', ['angularUtils.directives.dirPagination','ng-currency']);

app.controller("motosLiquidadorCtrl", function($scope, $http) {
	
$scope.timeLimits=[];
$scope.brands=[];
$scope.moto={};
$scope.motos=[];
$scope.motoBrand={};
$scope.data={
	brand:'',
	model:'',
	initialFee:400000,
	timeLimit:48,
}
$scope.payment={
	pos:0,
	interestPayment:0,
	capitalPayment:0,
	balance:0,
	fee:0
}
$scope.payments=[];
$scope.fee=0;
$scope.step=6;
$scope.stepMoto=10000;

	$scope.getDataMoto=function(id){
		$http({
			method:'GET',
			url:'/motos/simulador/getData/'+id,
		}).then(function successCallback(response){
			if(response.data != false){
				
				$scope.moto=response.data.moto;
				$scope.motoBrand=response.data.motoBrand;
				
				angular.forEach(response.data.brands, function(value, key) {
					$scope.brands.push(value);
				});
				angular.forEach(response.data.timeLimits, function(value, key) {
					$scope.timeLimits.push(value);
				});
				angular.forEach(response.data.motos, function(value, key) {
					$scope.motos.push(value);
				});
				$scope.data.brand= $scope.moto.idBrand;
				$scope.data.model= $scope.moto.id;
			}
			$('#motosLiquidadorModal').modal('show');
		},function errorCallback(response){
			
		});
	};

	$scope.viewFees=function(){

		showLoader();
			$('#motosLiquidadorModal').modal('hide');
			$scope.simulate();
			$('#motosCuotasModal').modal('show');
		hideLoader();

	}

	$scope.AssignTimeLimit=function(timeOption){
		$scope.data.timeLimit = timeOption;
	};

	$scope.cuotaCalculate=function(price,timeLimit,rate,term=0,bonus=0,initialFee,creditEnrollment,aval,soat){
		
		var monthlyRate=0;
		var capital=0;
		var base=0;
		var exponent=0;
		var cuota=0;
		var data=new Array();
			
		monthlyRate=(term==0)?parseFloat(((Math.pow((1+(rate/100)),(1/12))-1)).toFixed(4)):parseFloat(rate/100).toFixed(4);
		capital=price-bonus-initialFee+creditEnrollment+aval+soat;
		base=(1+monthlyRate);
		exponent=timeLimit;
		cuota=(capital*monthlyRate)/(1-(Math.pow(base,exponent*(-1))));
		
		data['capital']=capital;
		data['cuota']=cuota;
		data['rate']=monthlyRate;

		return data;
	};

	$scope.viewProjection=function(){
		showLoader();
			$scope.fee=2;
		hideLoader();
	};

	$scope.invalidFee=0;
	$scope.errorFee=0;



	$scope.viewCuota=function(){
		if($scope.data.initialFee<400000){
			showLoader();
				$scope.invalidFee=1;
				$scope.errorFee=1;
				setTimeout($('.formularioSimulador-containInput .errorFee').css('transform','scale(1)!important'),2000);
			hideLoader();
			console.log('error');
		}else{
			$scope.invalidFee=0;
			$scope.errorFee=0;
			$scope.simulate();
			showLoader();
			$scope.fee=1;
			hideLoader();
		}	
	};

	$scope.backToCuota=function(){
		showLoader();
			$scope.fee=1;
		hideLoader();
	};

	$scope.backToSimulate=function(){
		$scope.data={
			brand:$scope.moto.idBrand,
			model:$scope.moto.id,
			initialFee:400000,
			timeLimit:48,
		}
		$scope.payments=[];
		showLoader();
			$scope.fee=0;
		hideLoader();
	};

	$scope.initialCuota={
			pos:0,	
			interestPayment:0,
			capitalPayment:0,
			balance:0,
			fee:0
	}

	$scope.simulate=function(){

		var cuota = $scope.cuotaCalculate($scope.moto.creditPrice,
										$scope.data.timeLimit,
										28.78,
										0,
										$scope.moto.brandBonus,
										$scope.data.initialFee,
										$scope.moto.creditEnrollment,
										$scope.moto.aval,
										$scope.moto.soat);	
		var i=0;
		var capitalAmount=cuota['capital'];
		var interestPayment=0;
		var paymentCapital=0;


		$scope.payment.fee=0;

		for(i;i<=$scope.data.timeLimit;i++){
			
			$scope.payment.fee=(i==0)?0:cuota['cuota'];

			var aux={
				pos:i,	
				interestPayment:interestPayment,
				capitalPayment:paymentCapital,
				balance:capitalAmount,
				fee:$scope.payment.fee
			};
			
			interestPayment= capitalAmount*cuota['rate'];
			paymentCapital=cuota['cuota']-interestPayment;
			capitalAmount=capitalAmount-paymentCapital;
			
			if(i!=0){
				$scope.payments.push(aux);
			}else{
				$scope.initialCuota={
					pos:i,	
					interestPayment:0,
					capitalPayment:0,
					balance:capitalAmount,
					fee:$scope.payment.fee
				}
			}			
		}
	};

});