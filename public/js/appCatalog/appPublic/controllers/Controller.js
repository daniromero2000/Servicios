	/**
     /Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controler to display a products public view.
    **Date: 22/01/2011
     **/
app.controller('Controller', function($scope, $http, $rootScope){

	$scope.linesBrands = [];// list the lines and with their associated brands
	$scope.products = [];// list the products
	$scope.filter = {
		'page': 12,
		'actual': 1,
		'brand': '',
		'line': ''
	};//object for index and filter 
	$scope.Products = [];//product list to display
	$scope.title = {
		'color': "",
		'name': ""
	}//color and content to title
	$scope.color = ['#046627','#82BCF4','#ED8C00','#2C8DC9','#EC1C24','#FECD14'];//list of colors to lines icon
	$scope.enableTitle = "none";//show a title div when the user filter

	// list the lines and with their associated brands
	$scope.getLinesBrands = function(){
		showLoader();
		$http({
		  method: 'GET',
		  url: '/Catalog/linesBrands'
		}).then(function successCallback(response) {
			if(response != false){
				$scope.linesBrands = response.data;
				hideLoader();
				angular.forEach($scope.linesBrands,function(value,key){
					value.color = $scope.color.pop();
				});
			}

		}, function errorCallback(response) {
			hideLoader();
		});
	};


	//  index and filter  products
	$scope.getProducts = function(){
		$http({
		  method: 'GET',
		  url: 'Catalog/products?q='+'&page='+$scope.filter.page+'&actual='+$scope.filter.actual+'&brand='+$scope.filter.brand+'&line='+$scope.filter.line
		}).then(function successCallback(response) {
			if(response != false){
				angular.forEach(response.data, function(value) {
					$scope.products.push(value);
				});
			}	
		}, function errorCallback(response) {
		});
	};
	//prepare  the filters object to make the product request
	$scope.search = function(line,brand){
		$scope.filter.actual=1;//reset de actual page
		$scope.filter.line=line.id;
		brand.id ? $scope.filter.brand=brand.id:$scope.filter.brand="";//if only filter by line set the brand id in empty string
		$scope.products=[];//reset a products list when the user make a filter
		$scope.title.name = line.name; // set a title with a line name selected by the client
		$scope.title.color = line.color;
		$scope.enableTitle = "block";//enable de title div
		$scope.getProducts();		
	};

$scope.getLinesBrands();
$scope.getProducts();

});