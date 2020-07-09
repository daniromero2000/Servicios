
angular.module('creditLiqudatorApp', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])
    .controller('creditLiqudatorController', function ($scope, $http, $timeout) {

        $scope.tabs = 1;
        $scope.lead = {};
        $scope.fees = {};
        $scope.plans = [];
        $scope.items = [];
        $scope.request = [];
        $scope.tabItem = 0;
        $scope.listTags = [];
        $scope.discount = [];
        $scope.listValue = [];
        $scope.discounts = [];
        $scope.liquidator = [];
        $scope.numberOfFees = [];
        $scope.totalDiscount = 0;
        $scope.infoLiquidator = {};
        $scope.typeDiscount = [
            { 'type': 'Tarjeta Oportuya' },
            { 'type': 'Por lista' },
            { 'type': 'Por traslado' },
            { 'type': 'Otros' },
        ];

        $scope.tabItems = [
            { 'value': 1 },
            { 'value': 2 }
        ];

        $scope.listDiscount = function () {
            for (let i = 1; i < 101; i++) {
                $scope.listValue.push({ 'value': i });
            }
        };

        $scope.addItem = function () {
            var index = [[], [], [], []];
            $scope.liquidator.push(index);
            console.log($scope.liquidator)
        };

        $scope.addProduct = function (key) {
            $scope.items.key = key;
            $('#addItem' + key).modal('show');
        };

        $scope.addDiscount = function (key) {
            $scope.discount.key = key;
            $('#addDiscount' + key).modal('show');
        };

        $scope.alterTab = function (value) {
            $scope.tabItem = value
        }

        $scope.createItemLiquidator = function () {
            $scope.items.SOLICITUD = $scope.request.SOLICITUD;
            $scope.liquidator[$scope.items.key][0].push($scope.items);
            console.log($scope.liquidator);
            $("#addItem" + $scope.items.key).modal("hide");
            $scope.items = {};
        };

        $scope.createDiscountLiquidator = function () {
            $scope.discount.SOLICITUD = $scope.request.SOLICITUD;
            $scope.liquidator[$scope.discount.key][1].push($scope.discount);
            console.log($scope.liquidator);
            $("#addDiscount" + $scope.discount.key).modal("hide");
            $scope.sumDiscount($scope.discount.key);
            $scope.discount = {};
        };

        $scope.sumDiscount = function (key) {
            var total = 0;
            var product = 0;
            product = parseInt($scope.liquidator[key][0][0].VALOR);
            $scope.liquidator[$scope.discount.key][2] = 0
            $scope.liquidator[key][1].forEach(e => {
                total = (parseInt(e.value) / 100) * product;
                $scope.liquidator[$scope.discount.key][2] = parseInt($scope.liquidator[$scope.discount.key][2]) + Math.round(total)
                product = product - total;
                total = 0;
            });
            $scope.liquidator[$scope.discount.key][3].CUOTAINI = Math.round((parseInt($scope.liquidator[key][0][0].VALOR) - parseInt($scope.liquidator[$scope.discount.key][2])) * 0.1)
            $scope.updateCharges($scope.discount.key);
        };

        $scope.addFee = function (key) {
            var factor = "";
            $scope.numberOfFees.forEach(e => {
                if (e.CUOTA == $scope.liquidator[key][3].NUMCUOTAS) {
                    factor = e.FACTOR;
                }
            });
            $scope.liquidator[key][3].VRCUOTA = Math.round(((parseInt($scope.liquidator[key][0][0].VALOR) - parseInt($scope.liquidator[key][2]) - (parseInt($scope.liquidator[key][3].CUOTAINI))) * factor))
            $scope.liquidator[key][3].timelyPayment = Math.round($scope.liquidator[key][3].VRCUOTA * 0.05);
            $scope.liquidator[key][3].MANEJO = 8000;
            $scope.liquidator[key][3].SEGURO = 3000;
        };

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

        $scope.listOfFees = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/getFactors',
            }).then(function successCallback(response) {
                $scope.numberOfFees = response.data
            }, function errorCallback(response) {
                response.url = '/api/liquidator/getFactors';
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        $scope.getProduct = function () {
            if ($scope.items.CODIGO != '' && $scope.items.COD_PROCESO == 1 || $scope.items.COD_PROCESO == 4) {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.items.CODIGO,
                }).then(function successCallback(response) {
                    $scope.items.ARTICULO = response.data.product[0].item;
                    if ($scope.lead.latest_intention != '' && $scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya') {
                        if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Black') {
                            $scope.items.VALOR = response.data.price.black_public_price;
                        } else {
                            $scope.items.VALOR = response.data.price.blue_public_price;
                        }
                    } else {
                        $scope.items.VALOR = response.data.price.traditional_credit_price;
                    }
                    $scope.items.PRECIO_P = response.data.price.normal_public_price;
                    $scope.items.LISTA = response.data.price.list;
                }, function errorCallback(response) {
                    response.url = '/api/liquidator/getProduct/' + $scope.items.CODIGO;
                    $scope.addError(response, $scope.items.CODIGO);
                });
            } else {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.items.CODIGO,
                }).then(function successCallback(response) {
                    var key = $scope.items.key;
                    $scope.items.ARTICULO = response.data.product[0].item;
                    if ($scope.items.CODIGO == 'AV10' || $scope.items.CODIGO == 'AV12' || $scope.items.CODIGO == 'AV15') {
                        if ($scope.liquidator[key][2] != '') {
                            $scope.items.VALOR = Math.round((parseInt($scope.liquidator[key][0][0].VALOR) - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            $scope.items.PRECIO_P = Math.round((parseInt($scope.liquidator[key][0][0].VALOR) - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                        } else {
                            $scope.items.VALOR = Math.round(parseInt($scope.liquidator[key][0][0].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                            $scope.items.PRECIO_P = Math.round(parseInt($scope.liquidator[key][0][0].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                        }
                    } else {
                        if ($scope.items.CODIGO == 'IVAV') {
                            var e = $scope.liquidator[key][0];
                            for (let i = 0; i < e.length; i++) {
                                var iva = {}
                                if (e[i].COD_PROCESO == 2 && e[i].CODIGO == 'AV10' || e[i].CODIGO == 'AV12' || e[i].CODIGO == 'AV15') {
                                    $scope.items.VALOR = Math.round(parseInt($scope.liquidator[key][0][i].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                                    $scope.items.PRECIO_P = Math.round(parseInt($scope.liquidator[key][0][i].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                                } else {
                                    // showAlert("error", "Ingresa primero el AVAL");
                                }
                            }
                        } else {
                            $scope.items.VALOR = parseInt(response.data.product[0].base_cost);
                            $scope.items.PRECIO_P = parseInt(response.data.product[0].base_cost);
                        }
                    }

                    $scope.items.LISTA = response.data.price.list;
                }, function errorCallback(response) {
                    response.url = '/api/liquidator/getProduct/' + $scope.items.CODIGO;
                    $scope.addError(response, $scope.items.CODIGO);
                });
            }
        };

        $scope.updateCharges = function (key) {
            var e = $scope.liquidator[key][0];
            for (let i = 0; i < e.length; i++) {
                var item = {};
                if (e[i].COD_PROCESO == 2 && e[i].CODIGO == 'AV10' || e[i].CODIGO == 'AV12' || e[i].CODIGO == 'AV15') {
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + e[i].CODIGO,
                    }).then(function successCallback(response) {
                        var key = e[i].key;
                        item.CANTIDAD = e[i].CANTIDAD;
                        item.COD_PROCESO = e[i].COD_PROCESO;
                        item.SELECCION = e[i].SELECCION;
                        item.key = key;
                        $scope.liquidator[key][0].splice(i, 1)
                        item.ARTICULO = response.data.product[0].item;
                        item.CODIGO = response.data.product[0].sku;
                        if ($scope.liquidator[key][2] != '') {
                            item.VALOR = Math.round((parseInt($scope.liquidator[key][0][0].VALOR) - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            item.PRECIO_P = Math.round((parseInt($scope.liquidator[key][0][0].VALOR) - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                        } else {
                            item.VALOR = Math.round(parseInt($scope.liquidator[key][0][0].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                            item.PRECIO_P = Math.round(parseInt($scope.liquidator[key][0][0].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                        }
                        item.LISTA = response.data.price.list;
                        item.SOLICITUD = $scope.request.SOLICITUD;
                        $scope.liquidator[key][0].push(item);
                    }, function errorCallback(response) {
                        response.url = '/api/liquidator/getProduct/' + e[i].CODIGO;
                        $scope.addError(response, e[i].CODIGO);
                    });
                }
                if (e[i].COD_PROCESO == 2 && e[i].CODIGO == 'IVAV') {
                    var e = $scope.liquidator[key][0];
                    for (let i = 0; i < e.length; i++) {
                        var iva = {}
                        if (e[i].COD_PROCESO == 2 && e[i].CODIGO == 'AV10' || e[i].CODIGO == 'AV12' || e[i].CODIGO == 'AV15') {
                            $scope.items.VALOR = Math.round(parseInt($scope.liquidator[key][0][i].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                            $scope.items.PRECIO_P = Math.round(parseInt($scope.liquidator[key][0][i].VALOR) * (parseInt(response.data.product[0].base_cost) / 100));
                        } else {
                            // showAlert("error", "Ingresa primero el AVAL");
                        }
                    }
                }
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

        $scope.addError = function (response, cedula = '') {
            var arrayData = {
                url: response.url,
                mensaje: response.data.message,
                archivo: response.data.file,
                linea: response.data.line,
                cedula: cedula,
                datos: (response.datos) ? response.datos : []
            }

            var data = {
                status: response.status,
                data: angular.toJson(arrayData)
            }
            $http({
                method: 'POST',
                url: '/Administrator/appError',
                data: data,
            }).then(function successCallback(response) {
                setTimeout(() => {
                    $('#congratulations').modal('hide');
                    $('#proccess').modal('hide');
                    $('#confirmCodeVerification').modal('hide');
                    $('#validationLead').modal('hide');
                    $('#decisionCredit').modal('hide');
                    $('#error').modal('show');
                }, 1800);
                $scope.numError = response.data.id;
            }, function errorCallback(response) {
                console.log(response);
            });
        };

        $scope.getPlans();
        $scope.getValidationCustomer();
        $scope.listDiscount();
        $scope.listOfFees();
        // $scope.getProductList();
        // $scope.getFactor();
        // $scope.getListProduct();
        // $scope.getListGiveAway();

    });