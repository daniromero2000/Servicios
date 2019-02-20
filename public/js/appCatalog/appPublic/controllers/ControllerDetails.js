	/**
     /Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controler to display a products public view.
    **Date: 04/02/2019
     **/
app.controller('ControllerDetails', function($scope, $http, $rootScope, $routeParams, $location){

	$scope.title = {
		'color':'#'+$routeParams.color,
		'name':$routeParams.line
	}

	//  index and filter  products
	$scope.getProduct = function(){
		$http({
		  method: 'GET',
		  url: 'Catalog/productDetails?id='+$routeParams.id_product
		}).then(function successCallback(response) {
			if(response != false){
				$scope.product = response.data;
				console.log($scope.product);
			}
				
		}, function errorCallback(response) {
		});
	};


    setTimeout(() => {
    	showLoader();
        $(".multiple-items").slick({
          arrows: false,
		  infinite: true,
		  slidesToShow: 4,
		  slidesToScroll: 4,
		  vertical: true,
	      verticalSwiping: true,
	      asNavFor: '.single-item',
	      centerMode: true,
	      focusOnSelect: true
        });
        $('.single-item').slick({
			arrows: false,
			asNavFor: '.multiple-items'
		});
		hideLoader();
    },2000);

    $scope.getProduct();

});