
angular.module('appQuotations', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])

    .controller('quotationsController', function ($scope, $http, $timeout) {

        $scope.lead = {};
        $scope.items = {};
        $scope.discount = {};
        $scope.plans = [];
        $scope.request = [];
        $scope.listTags = [];
        $scope.listValue = [];
        $scope.discounts = [];
        $scope.productImg = [];
        $scope.quotations = [];
        $scope.numberOfFees = [];
        $scope.productPrices = [];
        $scope.code = '';
        $scope.zone = '';
        $scope.tabs = 1;
        $scope.step = 1;
        $scope.tabItem = 0;
        $scope.totalDiscount = 0;
        $scope.loader = false;
        $scope.show = false;
        $scope.disabledButton = false;
        $scope.typesDocuments = [
            {
                'value': "1",
                'label': 'Cédula de ciudadanía'
            },
            {
                'value': "2",
                'label': 'NIT'
            },
            {
                'value': "3",
                'label': 'Cédula de extranjería'
            },
            {
                'value': "4",
                'label': 'Tarjeta de Identidad'
            },
            {
                'value': "5",
                'label': 'Pasaporte'
            },
            {
                'value': "6",
                'label': 'Tarjeta seguro social extranjero'
            },
            {
                'value': "7",
                'label': 'Sociedad extranjera sin NIT en Colombia'
            },
            {
                'value': "8",
                'label': 'Fidecoismo'
            },
            {
                'value': "9",
                'label': 'Registro Civil'
            },
            {
                'value': "10",
                'label': 'Carnet Diplomático'
            }
        ];
        $scope.typeDiscount =
            [
                { 'type': 'Por traslado' },
                { 'type': 'Otros' },
            ];


        $scope.getPlans = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/getPlans',
            }).then(function successCallback(response) {
                $scope.plans = response.data
            }, function errorCallback(response) {
                response.url = '/api/liquidator/getPlans';
                $scope.addError(response, $scope.lead.identificationNumber);
            });
        };


        $scope.getProduct = function () {
            if (($scope.items.sku != '') && (($scope.items.cod_proceso == 1) || ($scope.items.cod_proceso == 4))) {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.items.sku,
                }).then(function successCallback(response) {
                    $scope.items.article = response.data.product[0].item;
                    $scope.items.price = response.data.price.normal_public_price;
                    $scope.items.list = response.data.price.list;
                }, function errorCallback(response) {
                    response.url = '/api/liquidator/getProduct/' + $scope.items.sku;
                    showAlert("error", "El código ingresado no existe");
                    $scope.addError(response, $scope.items.sku);
                });
            } else {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.items.sku,
                }).then(function successCallback(response) {
                    var key = $scope.items.key;
                    $scope.items.article = response.data.product[0].item;
                    var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)
                    if ($scope.items.sku == 'AV10' || $scope.items.sku == 'AV12' || $scope.items.sku == 'AV15') {
                        $scope.quotations[key][0].forEach(j => {
                            if (j.cod_proceso == 2) {
                                if ((j.sku != 'AV10') && (j.sku != 'AV12') && (j.sku != 'AV15') && (j.sku != 'IVAV')) {
                                    precio = precio + j.price;
                                }
                            }
                        });
                        $scope.items.price = Math.round((precio - (parseInt($scope.quotations[key][2]) + parseInt($scope.quotations[key][3].initial_fee))) * (parseInt(response.data.product[0].base_cost) / 100));
                        $scope.items.price = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                    } else if ($scope.items.sku == 'GPG1' || $scope.items.sku == 'GPG2') {
                        $scope.items.price = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));

                    } else {
                        if ($scope.items.sku == 'IVAV') {
                            var e = $scope.quotations[key][0];
                            for (let i = 0; i < e.length; i++) {
                                if ((e[i].cod_proceso == 2) && ((e[i].sku == 'AV10') || (e[i].sku == 'AV12') || (e[i].sku == 'AV15'))) {
                                    $scope.items.price = Math.round(parseInt($scope.quotations[key][0][i].price) * (parseInt(response.data.product[0].base_cost) / 100));
                                } else {
                                    $scope.items.price = 0
                                }
                            }
                        } else {
                            $scope.items.price = parseInt(response.data.product[0].base_cost);
                        }
                    }

                    $scope.items.list = response.data.price.list;
                }, function errorCallback(response) {
                    showAlert("error", "El código ingresado no existe");
                    response.url = '/api/liquidator/getProduct/' + $scope.items.sku;
                    $scope.addError(response, $scope.items.sku);
                });
            }
        };

        $scope.listOfFees = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/getFactors',
            }).then(function successCallback(response) {
                $scope.numberOfFees = response.data
            }, function errorCallback(response) {
                response.url = '/api/liquidator/getFactors';
                $scope.addError(response, $scope.lead.identificationNumber);
            });
        };

        //Listado de porcentajes de descuento
        $scope.listDiscount = function () {
            for (let i = 1; i < 101; i++) {
                $scope.listValue.push({ 'value': i });
            }
        };

        $scope.addItem = function () {
            var index = [[], [], [], [], [], [], [], [], []];
            $scope.quotations.push(index);
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

        $scope.createPlan = function (key) {
            if ($scope.quotations[key][3].plan_id) {
                $scope.plans.forEach(e => {
                    if (e.CODIGO == $scope.quotations[key][3].plan_id) {
                        $scope.quotations[key][8] = []
                        $scope.quotations[key][3].plan = e.plan;
                        $scope.quotations[key][8].push({ 'plan': $scope.quotations[key][3].plan, 'plan_id': $scope.quotations[key][3].plan_id })
                    }
                });
                $scope.sumDiscount(key);
            }
            else {
                showAlert("warning", "Por favor selecciona un plan");
            }
        }

        $scope.createItemLiquidator = function () {
            $scope.quotations[$scope.items.key][0].push($scope.items);
            if ($scope.discount.length != '') {
                if ($scope.discount.type) {
                    if ($scope.items.cod_proceso == 1 || $scope.items.cod_proceso == 4) {
                        $scope.quotations[$scope.items.key][1] = [];
                        $scope.quotations[$scope.items.key][1].push($scope.discount);
                        $scope.discount = {};
                        $scope.sumDiscount($scope.items.key);
                    }
                }
            }
            $("#addItem" + $scope.items.key).modal("hide");
            showAlert("success", "Producto ingresado correctamente");
            $scope.items = {};
        };

        $scope.createDiscountLiquidator = function () {
            $scope.quotations[$scope.discount.key][1].push($scope.discount);
            showAlert("success", "Descuento ingresado correctamente");
            $("#addDiscount" + $scope.discount.key).modal("hide");
            $scope.sumDiscount($scope.discount.key);
            $scope.discount = {};
        };


        $scope.createLiquidator = function () {
            if ($scope.quotations[0][5].length > 0) {
                $http({
                    method: 'POST',
                    url: '/Administrator/assessorquotations',
                    data: [$scope.quotations, $scope.lead]
                }).then(function successCallback(response) {
                    if (response.data) {
                        $('#congratulations').modal('show');
                    }
                }, function errorCallback(response) {
                });
            } else {
                showAlert("error", "Por favor ingrese todos los datos");
            }
        };

        $scope.addFee = function (key) {
            var factor = 1;
            $scope.quotations[key][7] = []
            $scope.numberOfFees.forEach(e => {
                if (e.CUOTA == $scope.quotations[key][3].term) {
                    factor = e.FACTOR;
                }
            });

            var iva = 0;
            var aval = 0;
            var totalAval = 0;
            var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity);
            var e = $scope.quotations[key][0];
            for (let i = 0; i < e.length; i++) {
                if (((e[i].sku == 'AV10') || (e[i].sku == 'AV12') || (e[i].sku == 'AV15')) && (e[i].cod_proceso == 2)) {
                    aval = e[i].price;
                }
                if ((e[i].sku == 'IVAV') && (e[i].cod_proceso == 2)) {
                    iva = e[i].price;
                }
            }
            totalAval = Math.round(parseInt(aval) + parseInt(iva));

            $scope.quotations[key][0].forEach(j => {
                if (j.cod_proceso == 2) {
                    if ((j.sku != 'AV10') && (j.sku != 'AV12') && (j.sku != 'AV15') && (j.sku != 'IVAV')) {
                        precio = precio + j.price;
                    }
                }
            });


            if ($scope.quotations[key][3].term != null) {
                $scope.quotations[key][3].value_fee = Math.round(((((precio - parseInt($scope.quotations[key][2])) + (totalAval)) - (parseInt($scope.quotations[key][3].initial_fee))) * factor))
                $scope.quotations[key][7].push({ 'term': $scope.quotations[key][3].term, 'value_fee': $scope.quotations[key][3].value_fee });
            }

            $scope.quotations[key][4] = []
            $scope.quotations[key][4].aval = aval
            $scope.quotations[key][4].iva_aval = iva
            $scope.quotations[key][4].total_aval = totalAval
            $scope.quotations[key][4].push({ 'aval': aval, 'iva_aval': iva, 'total_aval': totalAval });

            $scope.quotations[key][5] = [];
            $scope.quotations[key][5].total = Math.round((parseInt($scope.quotations[key][3].value_fee) * parseInt($scope.quotations[key][3].term)) + parseInt
                ($scope.quotations[key][3].initial_fee))

            if ($scope.quotations[key][3].check) {
                var div = 1.19
            } else {
                var div = 1
            }

            $scope.quotations[key][5].subtotal = Math.round((parseInt($scope.quotations[key][5].total) / div))
            $scope.quotations[key][5].iva = Math.round(parseInt($scope.quotations[key][5].total - parseInt($scope.quotations[key][5].subtotal)))
            $scope.quotations[key][5].push({
                'total': $scope.quotations[key][5].total, 'iva': $scope.quotations[key][5].iva, 'subtotal': $scope.quotations[key][5].subtotal
            });
            $scope.loader = false;

        };

        $scope.sumDiscount = function (key) {
            var total = 0;
            var product = 0;
            var precio = 0;
            if ($scope.quotations[key][0][0].price != 0) {
                precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)
            }
            $scope.quotations[key][0].forEach(j => {
                if (j.cod_proceso == 2) {
                    if ((j.sku != 'AV10') && (j.sku != 'AV12') && (j.sku != 'AV15') && (j.sku != 'IVAV')) {
                        precio = precio + j.price;
                    }
                }
            });
            var cuotaIni = 0
            product = precio;
            $scope.quotations[key][2] = 0
            $scope.quotations[key][1].forEach(e => {
                total = (parseInt(e.value) / 100) * product;
                $scope.quotations[key][2] = parseInt($scope.quotations[key][2]) + Math.round(total)
                product = product - total;
                total = 0;
            });
            switch ($scope.quotations[key][3].plan_id) {
                case '1':
                    cuotaIni = 30000
                    break;
                case '3':
                    cuotaIni = 0
                    break;
                case '5':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.1)
                    //periodo de gracia = 2%
                    break;
                case '6':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.1)
                    //periodo de gracia = 4%
                    break;
                case '7':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.1)
                    break;
                case '15':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.1)
                    break;
                case '16':
                    cuotaIni = 10000
                    break;
                case '17':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.1)
                    break;
                case '18':
                    cuotaIni = 1000
                    break;
                case '19':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.05)
                    break;
                case '20':
                    cuotaIni = 0
                    break;
                default:
                    break;
            }
            $scope.quotations[key][6] = []
            $scope.quotations[key][3].initial_fee = cuotaIni;
            $scope.quotations[key][6].push({ 'initial_fee': cuotaIni });
            $scope.updateCharges(key);
        };

        $scope.refreshLiquidator = function (key) {
            $scope.sumDiscount(key);
            showAlert("success", "La liquidación ha sido actualizada");
        };

        $scope.updateCharges = function (key) {
            var e = $scope.quotations[key][0];
            for (let i = 0; i < e.length; i++) {
                var item = {};
                if (((e[i].sku == 'AV10') || (e[i].sku == 'AV12') || (e[i].sku == 'AV15'))) {
                    if ((e[i].cod_proceso == 2)) {
                        var product = e[i];
                        $scope.quotations[key][0].splice(i, 1)
                        $http({
                            method: 'GET',
                            url: '/api/liquidator/getProduct/' + product.sku,
                        }).then(function successCallback(response) {
                            var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)
                            $scope.quotations[key][0].forEach(j => {
                                if (j.cod_proceso == 2) {
                                    if ((j.sku != 'AV10') && (j.sku != 'AV12') && (j.sku != 'AV15') && (j.sku != 'IVAV')) {
                                        precio = precio + j.price;
                                    }
                                }
                            });
                            item.key = key;
                            item.quantity = product.quantity;
                            item.cod_proceso = product.cod_proceso;
                            item.article = response.data.product[0].item;
                            item.sku = response.data.product[0].sku;
                            item.price = Math.round((precio - (parseInt($scope.quotations[key][2]) + parseInt($scope.quotations[key][3].initial_fee))) * (parseInt(response.data.product[0].base_cost) / 100))
                            item.list = response.data.price.list;
                            $scope.quotations[key][0].push(item);
                        }, function errorCallback(response) {
                            response.url = '/api/liquidator/getProduct/' + product.sku;
                            $scope.addError(response, product.sku);
                        });
                    }
                }
            }
            $scope.updateIva(key);
        };

        $scope.updateIva = function (key) {
            var e = $scope.quotations[key][0];
            for (let i = 0; i < e.length; i++) {
                if (e[i].cod_proceso == 2 && e[i].sku == 'IVAV') {
                    var product = e[i];
                    $scope.quotations[key][0].splice(i, 1)
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + product.sku,
                    }).then(function successCallback(response) {
                        var item = {}
                        item.key = key;
                        item.quantity = product.quantity;
                        item.cod_proceso = product.cod_proceso;
                        item.article = response.data.product[0].item;
                        item.sku = response.data.product[0].sku;
                        for (let h = 0; h < e.length; h++) {
                            if (e[h].sku == 'AV10' || e[h].sku == 'AV12' || e[h].sku == 'AV15') {
                                if (e[h].cod_proceso == 2) {
                                    item.price = Math.round(parseInt($scope.quotations[key][0][h].price) * (parseInt(response.data.product[0].base_cost) / 100));
                                } else {
                                    item.price = 0
                                }
                            } else {
                                item.price = 0
                            }
                        }
                        item.list = response.data.price.list;
                        $scope.quotations[key][0].push(item);
                    }, function errorCallback(response) {
                        response.url = '/api/liquidator/getProduct/' + product.sku;
                        $scope.addError(response, product.sku);
                    });
                }
            }
            $scope.loader = true;
            $timeout(() => {
                $scope.addFee(key);
            }, 3500);
        };

        $scope.removeItem = function (key) {
            $scope.quotations.splice($scope.quotations.indexOf(key), 1);
            $scope.tabItem = key - 1
            showAlert("success", "El item se ha eliminado correctamente");
        };

        $scope.removeProduct = function (product) {
            $scope.quotations[product.key][0].splice($scope.quotations[product.key][0].indexOf(product), 1);
            showAlert("success", "El producto se ha eliminado correctamente");
        };

        $scope.removeDiscount = function (discount) {
            $scope.quotations[discount.key][1].splice($scope.quotations[discount.key][1].indexOf(discount), 1);
            showAlert("success", "El descuento se ha eliminado correctamente");
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
                }, 100);
                $scope.numError = response.data.id;
            }, function errorCallback(response) {
                console.log(response);
            });
        };

        $scope.getInfoLead = function () {
            if ($scope.lead.CEDULA != null) {
                $scope.loader = true;
                $http({
                    method: 'GET',
                    url: '/assessor/api/getInfoLead/' + $scope.lead.CEDULA,
                }).then(function successCallback(response) {
                    $scope.lead = response.data;
                    $scope.loader = false;
                }, function errorCallback(response) {
                    response.url = '/assessor/api/getInfoLead/' + $scope.lead.CEDULA;
                    $scope.loader = false;
                });
            }
        };

        $scope.validateStep1 = function () {
            $scope.loader = true;
            $scope.step = 2;
            $scope.addItem()
            $scope.loader = false;
        };

        $scope.getPlans();
        $scope.listDiscount();
        $scope.listOfFees();

    });