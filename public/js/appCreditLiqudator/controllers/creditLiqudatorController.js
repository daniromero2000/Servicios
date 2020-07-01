
angular.module('creditLiqudatorApp', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])
    .controller('creditLiqudatorController', function ($scope, $http, $timeout) {

        $scope.tabs = 1;
        $scope.lead = {};
        $scope.plans = [];
        $scope.tabItem = 1;
        $scope.items = [];
        $scope.listTags = [];
        $scope.request = [];
        $scope.liquidator = {};
        $scope.showLiquidator = true;
        $scope.infoLiquidator = {};



        $scope.getCustomer = function () {
            $http({
                method: 'GET',
                url: '/assessor/api/getInfoLead/' + $scope.lead.CEDULA,
            }).then(function successCallback(response) {
                $scope.lead = response.data;
                console.log($scope.lead)
                $scope.tableLiquidator = true
                $scope.createRequest();
            }, function errorCallback(response) {
                response.url = '/assessor/api/getInfoLead/' + $scope.lead.CEDULA;
                $scope.addError(response, $scope.lead.CEDULA);
            });

        };


        $scope.getPlans = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/getPlans',
            }).then(function successCallback(response) {
                $scope.plans = response.data
            }, function errorCallback(response) {
                response.url = '/api/liquidator/getPlans';
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        $scope.getProduct = function () {
            if ($scope.liquidator.CODIGO > 0) {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.liquidator.CODIGO,
                }).then(function successCallback(response) {
                    $scope.liquidator.ARTICULO = response.data.product[0].item;
                    if ($scope.lead.latest_intention != '' && $scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya') {
                        if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Black') {
                            $scope.liquidator.VALOR = response.data.price.black_public_price;
                        } else {
                            $scope.liquidator.VALOR = response.data.price.blue_public_price;
                        }
                    } else {
                        $scope.liquidator.VALOR = response.data.price.traditional_credit_price;
                    }
                    $scope.liquidator.LISTA = response.data.price.list;
                }, function errorCallback(response) {
                    response.url = '/api/liquidator/getProduct/' + $scope.liquidator.CODIGO;
                    $scope.addError(response, $scope.liquidator.CODIGO);
                });
            }
        };


        $scope.getValidationCustomer = function () {
            $timeout(() => {
                $scope.lead.CEDULA = $("#identification").val();
                if ($scope.lead.CEDULA > 0) {
                    $http({
                        method: 'GET',
                        url: '/api/oportuya/validationLead/' + $scope.lead.CEDULA,
                    }).then(function successCallback(response) {
                        hideLoader();
                        if (response.data == -2) {
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "En nuestra base de datos se registra que tienes una relación laboral con la organización, comunícate a nuestras líneas de atención, para conocer las opciones que tenemos para ti .";
                        } else if (response.data == -3) {
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "Actualmente ya cuentas con una solicitud que está siendo procesada.";
                        } else if (response.data == -4) {
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "Estimado usuario, no es posible continuar con el proceso de crédito ya que presenta mora con Almacenes Oportunidades.";
                        } else {
                            $scope.getCustomer();
                        }
                    }, function errorCallback(response) {
                        hideLoader();
                        response.url = '/api/oportuya/validationLead/' + $scope.lead.CEDULA;
                        $scope.addError(response, $scope.lead.CEDULA);
                    });
                }
            }, 500);
        }



        $scope.createItemLiquidator = function () {
            $scope.liquidator.SOLICITUD = $scope.request.SOLICITUD;
            $scope.items.push($scope.liquidator)
            console.log($scope.items);
            $scope.liquidator = {};
            $("#addItem").modal("hide");
            // $("#plan").prop("disabled", true);
            // $http({
            //     method: 'POST',
            //     url: '/Administrator/creditLiquidator',
            //     data: $scope.liquidator
            // }).then(function successCallback(response) {
            //     if (response.data != false) {
            //         if (response.data == "23000") {
            //             document.getElementById('p').innerHTML = "La lista <b>" + $scope.productList.name + "</b>  ya se encuentra registrado en la base de datos";
            //             $("#alertProductList").show();
            //         } else if (response.data) {
            //             $scope.productList = "";
            //             $scope.resetDataProductList();
            //             $("#addProductListModal").modal("hide");
            //             showAlert('success', 'Creado Correctamente');
            //         }
            //     }
            // }, function errorCallback(response) {
            // });
        };


        $scope.createRequest = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/createRequest/' + $scope.lead.CEDULA + '/' + $scope.lead.CIUD_UBI,
            }).then(function successCallback(response) {
                if (response.data) {
                    $scope.request.SOLICITUD = response.data.SOLICITUD;
                }
            }, function errorCallback(response) {
            });
        };



        $scope.resetDataProductList = function () {
            $scope.productLists = [];
            $scope.getProductList();
        };

        $scope.getPlans();
        $scope.getValidationCustomer();

        // $scope.getProductList();
        // $scope.getFactor();
        // $scope.getListProduct();
        // $scope.getListGiveAway();

    });