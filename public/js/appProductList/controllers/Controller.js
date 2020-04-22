
app.controller('Controller', function ($scope, $http, $rootScope) {

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
		console.log($scope.productList)
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

	$scope.getProductList();


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

	$scope.getFactor();


});