
app.controller('productListController', function ($scope, $http, $rootScope) {
	$scope.tabs = 1;
	$scope.q = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.productList = {}; //object for index line
	$scope.productLists = []; //list of brands returned by server
	$scope.alert = "";	//text in create alert text 
	$scope.activ = true; // display delete action for each resourse if this is activ 

	$scope.qf = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.factor = {}; //object for index line
	$scope.factors = []; //list of brands returned by server
	$scope.alertFactor = "";	//text in create alert text 
	$scope.activFacttor = true; // display delete action for each resourse if this is activ 

	$scope.qlp = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.listProduct = {}; //object for index line
	$scope.listProducts = []; //list of brands returned by server
	$scope.alertListProduct = "";	//text in create alert text 
	$scope.activListProduct = true; // display delete action for each resourse if this is activ 

	$scope.qlg = {
		'q': '',
		'page': 30,
		'actual': 1,
		'delete': false
	};//object for index and filter 
	$scope.listGiveAway = {}; //object for index line
	$scope.listGiveAways = []; //list of brands returned by server
	$scope.alertListGiveAway = "";	//text in create alert text 
	$scope.activListGiveAway = true; // display delete action for each resourse if this is activ
	$scope.product = {};
	$scope.productPrices = {};
	$scope.viewProductPrices = false;

	$scope.addProductList = function () {
		$scope.productList = {};
		$("#addProductListModal").modal("show");
		$("#alertProductList").hide();
	};

	// query of faqs index and with filter 
	$scope.getProductList = function () {
		showLoader();
		//dsplay or not the delete action
		if ($scope.q.delete) {
			$scope.activ = false;
		} else {
			$scope.activ = true;
		}
		$http({
			method: 'GET',
			url: '/api/productList'
		}).then(function successCallback(response) {
			if (response != false) {
				angular.forEach(response.data, function (value) {
					$scope.productLists.push(value);
				});
				hideLoader();
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.search = function () {
		$scope.productList = {};
		$scope.alert = "";
		$scope.productLists = [];
		$scope.q.actual = 1;
		$scope.q.page = 30;
		$scope.getProductList();
	};

	$scope.moreRegister = function () {
		$scope.q.actual = $scope.q.actual + 1;
		getProductList()
	};


	$scope.createProductList = function () {
		$http({
			method: 'POST',
			url: '/api/productList',
			data: $scope.productList
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('p').innerHTML = "La lista <b>" + $scope.productList.name + "</b>  ya se encuentra registrado en la base de datos";
					$("#alertProductList").show();
				} else if (response.data == true) {
					$scope.productList = "";
					$("#addProductListModal").modal("hide");
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};


	$scope.showDialog = function (productList) {
		$("#Show").modal("show");
		$scope.productList = productList;
	};


	$scope.showUpdateDialog = function (productList) {
		$("#alertUpdate").hide();
		$("#Update").modal("show");
		$scope.productList = angular.extend({}, productList);
	};

	$scope.UpdateProductList = function () {
		$http({
			method: 'PUT',
			url: '/api/productList/' + $scope.productList.id,
			data: $scope.productList
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('update').innerHTML = "La linea  <b>" + $scope.productList.name + "</b>  ya esta registrada en la base de datos";
					$("#alertUpdate").show();
				} else if (response.data == true) {
					$scope.productList.name = "";
					$("#Update").modal("hide");
					$scope.productList = {};
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDelete = function (productList) {
		$("#Delete").modal("show");
		$scope.productList = productList;
	};

	$scope.deleteProductList = function (idProductList) {
		$http({
			method: 'DELETE',
			url: '/api/productList/' + idProductList
		}).then(function successCallback(response) {
			if (response.data != false) {
				$("#Delete").modal("hide");
				$scope.search();
			}
		}, function errorCallback(response) {

		});
	}



	//Factores


	$scope.addFactor = function () {
		$scope.factor = {};
		$("#addFactorModal").modal("show");
		$("#alertFactor").hide();
	};

	// query of faqs index and with filter 
	$scope.getFactor = function () {
		showLoader();
		//dsplay or not the delete action
		if ($scope.qf.delete) {
			$scope.activFacttor = false;
		} else {
			$scope.activFacttor = true;
		}
		$http({
			method: 'GET',
			url: '/api/factors'
		}).then(function successCallback(response) {
			if (response != false) {
				angular.forEach(response.data, function (value) {
					$scope.factors.push(value);
				});
				hideLoader();
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.createFactor = function () {
		console.log($scope.factor)
		$http({
			method: 'POST',
			url: '/api/factors',
			data: $scope.factor
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('p').innerHTML = "La lista <b>" + $scope.factor.name + "</b>  ya se encuentra registrado en la base de datos";
					$("#alertFactor").show();
				} else if (response.data == true) {
					$scope.factor = "";
					$("#addFactorModal").modal("hide");
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};


	$scope.showDialogFactor = function (factor) {
		$("#ShowFactor").modal("show");
		$scope.factor = factor;
	};


	$scope.showUpdateDialogFactor = function (factor) {
		$("#alertUpdateFactor").hide();
		$("#UpdateFactor").modal("show");
		$scope.factor = angular.extend({}, factor);
	};

	$scope.UpdateFactor = function () {
		$http({
			method: 'PUT',
			url: '/api/factors/' + $scope.factor.id,
			data: $scope.factor
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('update').innerHTML = "La linea  <b>" + $scope.factor.name + "</b>  ya esta registrada en la base de datos";
					$("#alertUpdate").show();
				} else if (response.data == true) {
					$scope.factor.name = "";
					$("#Update").modal("hide");
					$scope.factor = {};
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDeleteFactor = function (factor) {
		$("#DeleteFactor").modal("show");
		$scope.factor = factor;
	};

	$scope.deleteFactor = function (idFactor) {
		$http({
			method: 'DELETE',
			url: '/api/factors/' + idFactor
		}).then(function successCallback(response) {
			if (response.data != false) {
				$("#DeleteFactor").modal("hide");
				$scope.search();
			}
		}, function errorCallback(response) {

		});
	}


	//ListProduct


	$scope.addListProduct = function () {
		$scope.listProduct = {};
		$("#addListProductModal").modal("show");
		$("#alertListProduct").hide();
	};

	$scope.addMassiveListProduct = function () {
		$scope.listProduct = {};
		$("#addMassiveListProductModal").modal("show");
		$("#alertListProduct").hide();
	};

	// query of faqs index and with filter 
	$scope.getListProduct = function () {
		showLoader();
		//dsplay or not the delete action
		if ($scope.qf.delete) {
			$scope.activFacttor = false;
		} else {
			$scope.activFacttor = true;
		}
		$http({
			method: 'GET',
			url: '/api/listProducts'
		}).then(function successCallback(response) {
			if (response != false) {
				angular.forEach(response.data, function (value) {
					$scope.listProducts.push(value);
				});
				hideLoader();
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.createListProduct = function () {
		$http({
			method: 'POST',
			url: '/api/listProducts',
			data: $scope.listProduct
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('p').innerHTML = "La lista <b>" + $scope.listProduct.name + "</b>  ya se encuentra registrado en la base de datos";
					$("#alertListProduct").show();
				} else{
					$scope.listProduct = {};
					$scope.listProducts = [];
					$("#addListProductModal").modal("hide");
					$scope.getListProduct();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.createMassiveListProduct = function () {
		var formData = new FormData();
		$scope.product.list.upload();
		formData.append('listProduct',$scope.product.list.files[0].file);
		formData.append('type','massive');

		$http.post('/api/listProducts',formData,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).then(function successCallback(response) {
		}, function errorCallback(response) {
		});
	};


	$scope.showDialogListProduct = function (listProduct) {
		$("#ShowListProduct").modal("show");
		$scope.listProduct = listProduct;
	};


	$scope.showUpdateDialogListProduct = function (listProduct) {
		$("#alertUpdateListProduct").hide();
		$("#UpdateListProduct").modal("show");
		$scope.listProduct = angular.extend({}, listProduct);
	};

	$scope.UpdateListProduct = function () {
		$http({
			method: 'PUT',
			url: '/api/listProducts/' + $scope.listProduct.id,
			data: $scope.listProduct
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('update').innerHTML = "La linea  <b>" + $scope.listProduct.name + "</b>  ya esta registrada en la base de datos";
					$("#alertUpdate").show();
				} else if (response.data == true) {
					$scope.listProduct.name = "";
					$("#Update").modal("hide");
					$scope.listProduct = {};
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDeleteListProduct = function (listProduct) {
		$("#DeleteListProduct").modal("show");
		$scope.listProduct = listProduct;
	};

	$scope.deleteListProduct = function (idListProduct) {
		$http({
			method: 'DELETE',
			url: '/api/listProducts/' + idListProduct
		}).then(function successCallback(response) {
			if (response.data != false) {
				$("#DeleteListProduct").modal("hide");
				$scope.search();
			}
		}, function errorCallback(response) {

		});
	}



	//ListGiveAways


	$scope.addListGiveAway = function () {
		$scope.listGiveAway = {};
		$("#addListGiveAwayModal").modal("show");
		$("#alertListGiveAway").hide();
	};

	// query of faqs index and with filter 
	$scope.getListGiveAway = function () {
		showLoader();
		//dsplay or not the delete action
		if ($scope.qf.delete) {
			$scope.activFacttor = false;
		} else {
			$scope.activFacttor = true;
		}
		$http({
			method: 'GET',
			url: '/api/listGiveAways'
		}).then(function successCallback(response) {
			if (response != false) {
				angular.forEach(response.data, function (value) {
					$scope.listGiveAways.push(value);
				});
				hideLoader();
			}
		}, function errorCallback(response) {
			hideLoader();
		});
	};

	$scope.createListGiveAway = function () {
		console.log($scope.listGiveAway)
		$http({
			method: 'POST',
			url: '/api/listGiveAways',
			data: $scope.listGiveAway
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('p').innerHTML = "La lista <b>" + $scope.listGiveAway.name + "</b>  ya se encuentra registrado en la base de datos";
					$("#alertListGiveAway").show();
				} else if (response.data == true) {
					$scope.listGiveAway = "";
					$("#addListGiveAwayModal").modal("hide");
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};


	$scope.showDialogListGiveAway = function (listGiveAway) {
		$("#ShowListGiveAway").modal("show");
		$scope.listGiveAway = listGiveAway;
	};


	$scope.showUpdateDialogListGiveAway = function (listGiveAway) {
		$("#alertUpdateListGiveAway").hide();
		$("#UpdateListGiveAway").modal("show");
		$scope.listGiveAway = angular.extend({}, listGiveAway);
	};

	$scope.UpdateListGiveAway = function () {
		$http({
			method: 'PUT',
			url: '/api/listGiveAways/' + $scope.listGiveAway.id,
			data: $scope.listGiveAway
		}).then(function successCallback(response) {
			if (response.data != false) {
				if (response.data == "23000") {
					document.getElementById('update').innerHTML = "La linea  <b>" + $scope.listGiveAway.name + "</b>  ya esta registrada en la base de datos";
					$("#alertUpdate").show();
				} else if (response.data == true) {
					$scope.listGiveAway.name = "";
					$("#Update").modal("hide");
					$scope.listGiveAway = {};
					$scope.search();
				}
			}
		}, function errorCallback(response) {
		});
	};

	$scope.showDialogDeleteListGiveAway = function (listGiveAway) {
		$("#DeleteListGiveAway").modal("show");
		$scope.listGiveAway = listGiveAway;
	};

	$scope.deleteListGiveAway = function (idListGiveAway) {
		$http({
			method: 'DELETE',
			url: '/api/listGiveAways/' + idListGiveAway
		}).then(function successCallback(response) {
			if (response.data != false) {
				$("#DeleteListGiveAway").modal("hide");
				$scope.search();
			}
		}, function errorCallback(response) {

		});
	};

	$scope.selectedProduct = function(productObject){
		$scope.product = productObject.originalObject;
		$scope.getDataPriceProduct($scope.product.id);
	};

	$scope.getDataPriceProduct = function(productId){
		$http({
			method: 'GET',
			url: '/api/listProducts/getDataPriceProduct/' + productId
		}).then(function successCallback(response) {
			if (response.data != false) {
				$scope.productPrices = response.data;
				$scope.viewProductPrices = true;
			}
		}, function errorCallback(response) {

		});
	};


	$scope.getProductList();
	$scope.getFactor();
	$scope.getListProduct();
	$scope.getListGiveAway();

});