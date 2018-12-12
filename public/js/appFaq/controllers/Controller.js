	/**
     /Proyecto: SERVISIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador para la administracion de preguntas frecuentes.
    **Fecha: 12/12/2018
     **/
app.controller('Controller', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'page': 30,
		'actual':1
	};//object for index and filter 
	$scope.cargando = true;//variable for loading effect
	$scope.faq = {};//scope for storage a new faq
	$scope.faqCrud = {};//scope for storage a faq for view, update or delete forms
	$scope.faqs = [];//array of faqs retuned by server 

	// query of faqs index and with filter 
	$scope.getFaqs = function(){
		$scope.cargando = true;
		$http({
		  method: 'GET',
		  url: '/faqs?q='+$scope.q.q+'&page='+$scope.q.page+'&actual='+$scope.q.actual
		}).then(function successCallback(response) {
			if(response != false){
				$scope.q.initFrom += response.data.length;
				angular.forEach(response.data, function(value) {
					$scope.faqs.push(value);
				});
				$scope.cargando = false;
			}

				
		}, function errorCallback(response) {

		});
	};
	//reset the getFaqs variables 
	$scope.search = function(){
		$scope.q.initFrom = 0;
		$scope.faqs = [];
		$scope.getFaqs();
	};

	$scope.addFaq = function(){
		
		$("#addFaqModal").modal("show");
	
	};

	$scope.createFaq = function(){
		$http({
		  method: 'POST',
		  url: 'faqs',
		  data: $scope.faq
		}).then(function successCallback(response) {
			if(response.data != false){
				$scope.search();
				$("#addFaqModal").modal("hide");
			}
		}, function errorCallback(response) {
			
		});
	};

	$scope.showDialogDelete = function(faq){
		$("#Delete").modal("show");
		$scope.faqCrud	= faq;
	};

	$scope.showDialog = function(faq){
		$("#Show").modal("show");
		$scope.faqCrud	= faq;
	};

	$scope.showUpdateDialog = function(faq){
		$("#Update").modal("show");
		$scope.faqCrud	= faq;
	};

	$scope.deleteFaq=function(idFaq){
		$http({
		  method: 'DELETE',
		  url: 'faqs/' + idFaq
		}).then(function successCallback(response){	
			if(response.data != false){
				$("#Delete").modal("hide");
				$scope.search();
			}
		},function errorCallback(response){

		});
	}

	$scope.UpdateFaq = function(){
		$http({
		  method: 'PUT',
		  url: 'faqs/'+$scope.faqCrud.id,
		  data: $scope.faqCrud
		}).then(function successCallback(response) {
			if(response.data != false){
				$("#Update").modal("hide");
				$scope.search();
				$scope.faq = {};
			}
		}, function errorCallback(response) {

		});
	};


	$scope.getFaqs();

})