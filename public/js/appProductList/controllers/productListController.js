
angular.module('productListApp', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])
	.controller('productListController', function ($scope, $http, $timeout) {
		$scope.tabs = 1;
		$scope.productListSubsidiaries = [];

		$scope.listTags = [];
		$scope.q = {
			'q': '',
			'page': 30,
			'actual': 1,
			'delete': false
		};
		$scope.productList = {};
		$scope.productLists = [];
		$scope.alert = "";
		$scope.activ = true;

		$scope.qf = {
			'q': '',
			'page': 30,
			'actual': 1,
			'delete': false
		};
		$scope.factor = {};
		$scope.factors = [];
		$scope.alertFactor = "";
		$scope.activeFactor = true;

		$scope.qlp = {
			'q': '',
			'page': 30,
			'actual': 1,
			'delete': false
		};
		$scope.listProduct = {};
		$scope.listProducts = [];
		$scope.alertListProduct = "";
		$scope.activListProduct = true;

		$scope.qlg = {
			'q': '',
			'page': 30,
			'actual': 1,
			'delete': false
		};
		$scope.listGiveAway = {};
		$scope.listGiveAways = [];
		$scope.alertListGiveAway = "";
		$scope.activListGiveAway = true;
		$scope.product = {};
		$scope.productPrices = {};
		$scope.viewProductPrices = false;
		$scope.disabledButtonAddSubsidiary = false;

		$scope.protections = [
			{
				'value': 1,
				'text': "Si"
			},
			{
				'value': 0,
				'text': "No"
			}
		];

		$scope.addProductList = function () {
			$scope.productList = {};
			$("#addProductListModal").modal("show");
			$("#alertProductList").hide();
		};

		$scope.loadSubsidaries = function ($query) {
			return $http.get('/api/subsidiaries');
		};

		$scope.getProductList = function () {
			showLoader();
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

		$scope.resetDataProductList = function () {
			$scope.productLists = [];
			$scope.getProductList();
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
					} else if (response.data) {
						$scope.productList = "";
						$scope.resetDataProductList();
						$("#addProductListModal").modal("hide");
						showAlert('success', 'Creado Correctamente');
					}
				}
			}, function errorCallback(response) {
			});
		};

		$scope.showUpdateDialog = function (productList) {
			$("#alertUpdate").hide();
			$("#Update").modal("show");
			$scope.productList = angular.extend({}, productList);
		};

		$scope.showDialogViewProductList = function (productList) {
			$("#viewProductList").modal('show');
			$scope.productList = productList;
			$scope.getSubsidiariesForProductList(productList.id);
		}

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
					} else if (response.data) {
						$scope.productList = "";
						$scope.resetDataProductList();
						$("#Update").modal("hide");
						showAlert('success', 'Actualizado Correctamente');
					}
				}
			}, function errorCallback(response) {
			});
		};

		$scope.addSubsidiariesToProductList = function () {
			$scope.disabledButtonAddSubsidiary = true;
			$http({
				method: 'PUT',
				url: '/api/productList/addSubsidiariesToProductList/' + $scope.productList.id,
				data: $scope.productListSubsidiaries
			}).then(function successCallback(response) {
				showAlert('success', 'Sucursales asignadas correctamente');
				$scope.disabledButtonAddSubsidiary = false;
			}, function errorCallback(response) {
			});
		};

		$scope.getSubsidiariesForProductList = function(productListId){
			$scope.productListSubsidiaries = [];
			$http({
				method: 'GET',
				url: '/api/productList/' + productListId
			}).then(function successCallback(response) {
				$scope.productListSubsidiaries = response.data;
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
					$scope.resetDataProductList();
					showAlert('success', 'Eliminado Correctamente');
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

		$scope.getFactor = function () {
			showLoader();
			if ($scope.qf.delete) {
				$scope.activeFactor = false;
			} else {
				$scope.activeFactor = true;
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

		$scope.resetDataFactor = function () {
			$scope.factors = [];
			$scope.getFactor();
		};

		$scope.createFactor = function () {
			$http({
				method: 'POST',
				url: '/api/factors',
				data: $scope.factor
			}).then(function successCallback(response) {
				if (response.data != false) {
					if (response.data == "23000") {
						document.getElementById('p').innerHTML = "La lista <b>" + $scope.factor.name + "</b>  ya se encuentra registrado en la base de datos";
						$("#alertFactor").show();
					} else if (response.data) {
						$scope.factor = "";
						$scope.resetDataFactor();
						$("#addFactorModal").modal("hide");
						showAlert('success', 'Creado Correctamente');
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
			$("#updateFactor").modal("show");
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
					} else if (response.data) {
						$scope.factor = "";
						$scope.resetDataFactor();
						$("#updateFactor").modal("hide");
						showAlert('success', 'Actualizado Correctamente');
					}
				}
			}, function errorCallback(response) {
			});
		};

		$scope.showDialogDeleteFactor = function (factor) {
			$("#deleteFactor").modal("show");
			$scope.factor = factor;
		};

		$scope.deleteFactor = function (idFactor) {
			console.log(idFactor);
			$http({
				method: 'DELETE',
				url: '/api/factors/' + idFactor
			}).then(function successCallback(response) {
				if (response.data != false) {
					$scope.resetDataFactor();
					$("#deleteFactor").modal("hide");
					showAlert('success', 'Eliminado Correctamente');
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

		$scope.getListProduct = function () {
			showLoader();
			if ($scope.qf.delete) {
				$scope.activeFactor = false;
			} else {
				$scope.activeFactor = true;
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
					showAlert('success', 'Artículo migrado exitosamente');
					if (response.data == "23000") {
						document.getElementById('p').innerHTML = "La lista <b>" + $scope.listProduct.name + "</b>  ya se encuentra registrado en la base de datos";
						$("#alertListProduct").show();
					} else {
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
			formData.append('listProduct', $scope.product.list.files[0].file);
			formData.append('type', 'massive');

			$http.post('/api/listProducts', formData, {
				transformRequest: angular.identity,
				headers: { 'Content-Type': undefined }
			}).then(function successCallback(response) {
				$("#addMassiveListProductModal").modal('hide');
				showAlert('success', 'Archivo migrado exitosamente');
				$scope.resetDataListProduct();
			}, function errorCallback(response) {
			});
		};

		$scope.resetDataListProduct = function () {
			$scope.listProducts = [];
			$scope.getListProduct();
		};


		$scope.showDialogListProduct = function (listProduct) {
			$("#ShowListProduct").modal("show");
			$scope.listProduct = listProduct;
		};


		$scope.showUpdateDialogListProduct = function (listProduct) {
			$("#alertUpdateListProduct").hide();
			$("#updateListProduct").modal("show");
			$scope.listProduct = angular.extend({}, listProduct);
		};

		$scope.updateListProduct = function () {
			$http({
				method: 'PUT',
				url: '/api/listProducts/' + $scope.listProduct.id,
				data: $scope.listProduct
			}).then(function successCallback(response) {
				if (response.data != false) {
					$("#updateListProduct").modal('hide');
					showAlert('success', 'Producto actualizado exitosamente');
					$scope.resetDataListProduct();
				}
			}, function errorCallback(response) {
			});
		};

		$scope.showDialogDeleteListProduct = function (listProduct) {
			$("#deleteListProduct").modal("show");
			$scope.listProduct = listProduct;
		};

		$scope.deleteListProduct = function (idListProduct) {
			$http({
				method: 'DELETE',
				url: '/api/listProducts/' + idListProduct
			}).then(function successCallback(response) {
				if (response.data != false) {
					$("#deleteListProduct").modal("hide");
					showAlert('success', 'Producto eliminado exitosamente');
					$scope.resetDataListProduct();
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

		$scope.getListGiveAway = function () {
			showLoader();
			if ($scope.qf.delete) {
				$scope.activeFactor = false;
			} else {
				$scope.activeFactor = true;
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
			$http({
				method: 'POST',
				url: '/api/listGiveAways',
				data: $scope.listGiveAway
			}).then(function successCallback(response) {
				if (response.data != false) {
					$scope.listGiveAway = "";
					$("#addListGiveAwayModal").modal("hide");
					showAlert('success', 'Obsequio creado exitosamente');
					$scope.resetDataListGiveAway();
				}
			}, function errorCallback(response) {
			});
		};

		$scope.resetDataListGiveAway = function () {
			$scope.listGiveAways = [];
			$scope.getListGiveAway();
		};


		$scope.showUpdateDialogListGiveAway = function (listGiveAway) {
			$("#alertUpdateListGiveAway").hide();
			$("#updateListGiveAway").modal("show");
			$scope.listGiveAway = angular.extend({}, listGiveAway);
		};

		$scope.updateListGiveAway = function () {
			$http({
				method: 'PUT',
				url: '/api/listGiveAways/' + $scope.listGiveAway.id,
				data: $scope.listGiveAway
			}).then(function successCallback(response) {
				if (response.data != false) {
					$scope.listGiveAway.name = "";
					$("#updateListGiveAway").modal("hide");
					showAlert("success", "Obsequio actualizado exitosamente");
					$scope.resetDataListGiveAway();
				}
			}, function errorCallback(response) {
			});
		};

		$scope.showDialogDeleteListGiveAway = function (listGiveAway) {
			$("#deleteListGiveAwayModal").modal("show");
			$scope.listGiveAway = listGiveAway;
		};

		$scope.deleteListGiveAway = function (idListGiveAway) {
			$http({
				method: 'DELETE',
				url: '/api/listGiveAways/' + idListGiveAway
			}).then(function successCallback(response) {
				if (response.data) {
					$("#deleteListGiveAwayModal").modal("hide");
					showAlert("success", "Obsequio eliminado exitosamente");
					$scope.resetDataListGiveAway();
				}
			}, function errorCallback(response) {

			});
		};

		$scope.selectedProduct = function (productObject) {
			$scope.product = productObject.originalObject;
			$scope.getDataPriceProduct($scope.product.id);
		};

		$scope.getDataPriceProduct = function (productId) {
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

		// $scope.getSubsidiaries();
		$scope.getProductList();
		$scope.getFactor();
		$scope.getListProduct();
		$scope.getListGiveAway();

	});