app.controller('Controller', function($scope, $http, $rootScope){
	$scope.q = {
		'q': '',
		'page': 30,
		'actual':1
	};
	$scope.cargando = true;
	$scope.filtros = false;
	$scope.faq = {};
	$scope.idFaq = '';
	$scope.faqCrud = {};
	$scope.faqs = [];

	
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
		  	console.log(false);
		  	console.log(response);
		});
	};

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
		  url: 'faqs/',
		  data: $scope.faq
		}).then(function successCallback(response) {
			if(response.data != false){
				$("#addFaqModal").modal("hide");
				$scope.search();
				$scope.faq = {};
				console.log($scope.faq);
			}
		}, function errorCallback(response) {
		    console.log(response);
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
				$scope.search(response);
				console.log(response);
			}
		},function errorCallback(response){
				console.log(response);
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
				console.log(response);
			}
		}, function errorCallback(response) {
		    console.log(response);
		});
	};


	$scope.getFaqs();

})