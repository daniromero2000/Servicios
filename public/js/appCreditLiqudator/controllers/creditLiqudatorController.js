
angular.module('creditLiqudatorApp', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])
    .controller('creditLiqudatorController', function ($scope, $http, $timeout) {

        $scope.tabs = 1;
        $scope.lead = {};
        $scope.fees = {};
        $scope.plans = [];
        $scope.items = {};
        $scope.request = [];
        $scope.tabItem = 0;
        $scope.listTags = [];
        $scope.discount = {};
        $scope.listValue = [];
        $scope.discounts = [];
        $scope.liquidator = [];
        $scope.numberOfFees = [];
        $scope.totalDiscount = 0;
        $scope.loader = false;
        $scope.infoLiquidator = {};
        $scope.typeDiscount = [
            { 'type': 'Por tipo de cliente' },
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
            var index = [[], [], [], [], [], [], [], [], []];
            $scope.liquidator.push(index);

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
            $scope.items.PRECIO = parseInt($scope.items.PRECIO) * parseInt($scope.items.CANTIDAD);
            $scope.liquidator[$scope.items.key][0].push($scope.items);
            if ($scope.discount.length != '') {
                if ($scope.discount.type) {
                    if ($scope.items.COD_PROCESO == 1 || $scope.items.COD_PROCESO == 4) {
                        $scope.liquidator[$scope.items.key][1] = [];
                        $scope.liquidator[$scope.items.key][1].push($scope.discount);
                        $scope.discount = {};
                        if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya')) {
                            $scope.discount.key = $scope.items.key
                            $scope.discount.type = 'Tarjeta Oportuya';
                            if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Black') {
                                $scope.discount.value = 10;
                            } else {
                                $scope.discount.value = 10;
                            }
                            $scope.liquidator[$scope.items.key][1].push($scope.discount);
                            $scope.discount = {};
                        }
                        $scope.sumDiscount($scope.items.key);
                    }
                }
                // $scope.sumDiscount($scope.items.key);
            }
            $("#addItem" + $scope.items.key).modal("hide");
            showAlert("success", "Producto ingresado correctamente");
            $scope.items = {};
        };

        $scope.createDiscountLiquidator = function () {
            $scope.discount.SOLICITUD = $scope.request.SOLICITUD;
            $scope.liquidator[$scope.discount.key][1].push($scope.discount);
            showAlert("success", "Descuento ingresado correctamente");
            $("#addDiscount" + $scope.discount.key).modal("hide");
            $scope.sumDiscount($scope.discount.key);
            $scope.discount = {};
        };

        $scope.createPlan = function (key) {
            if ($scope.liquidator[key][3].COD_PLAN) {
                $scope.plans.forEach(e => {
                    if (e.CODIGO == $scope.liquidator[key][3].COD_PLAN) {
                        $scope.liquidator[key][8] = []
                        $scope.liquidator[key][3].PLANES = e.PLAN;
                        $scope.liquidator[key][8].push({ 'PLANES': $scope.liquidator[key][3].PLANES, 'COD_PLAN': $scope.liquidator[key][3].COD_PLAN })
                    }
                });
                $scope.sumDiscount(key);
            }
            else {
                showAlert("warning", "Por favor selecciona un plan");
            }
        }

        $scope.sumDiscount = function (key) {
            var total = 0;
            var product = 0;
            var precio = 0;
            if ($scope.liquidator[key][0][0].PRECIO != 0) {
                precio = parseInt($scope.liquidator[key][0][0].PRECIO)
            }
            $scope.liquidator[key][0].forEach(j => {
                if (j.COD_PROCESO == 2) {
                    if ((j.CODIGO != 'AV10') && (j.CODIGO != 'AV12') && (j.CODIGO != 'AV15') && (j.CODIGO != 'IVAV')) {
                        precio = precio + j.PRECIO;
                    }
                }
            });
            var cuotaIni = 0
            product = precio;
            $scope.liquidator[key][2] = 0
            $scope.liquidator[key][1].forEach(e => {
                total = (parseInt(e.value) / 100) * product;
                $scope.liquidator[key][2] = parseInt($scope.liquidator[key][2]) + Math.round(total)
                product = product - total;
                total = 0;
            });
            switch ($scope.liquidator[key][3].COD_PLAN) {
                case '1':
                    cuotaIni = 30000
                    break;
                case '3':
                    cuotaIni = 0
                    break;
                case '5':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.1)
                    //periodo de gracia = 2%
                    break;
                case '6':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.1)
                    //periodo de gracia = 4%
                    break;
                case '7':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.1)
                    break;
                case '15':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.1)
                    break;
                case '16':
                    cuotaIni = 10000
                    break;
                case '17':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.1)
                    break;
                case '18':
                    cuotaIni = 1000
                    break;
                case '19':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.05)
                    break;
                case '20':
                    cuotaIni = 0
                    break;
                default:
                    break;
            }
            $scope.liquidator[key][6] = []
            $scope.liquidator[key][3].CUOTAINI = cuotaIni;
            $scope.liquidator[key][6].push({ 'CUOTAINI': cuotaIni });
            $scope.updateCharges(key);
        };

        $scope.refreshLiquidator = function (key) {
            $scope.sumDiscount(key);
            showAlert("success", "La liquidación ha sido actualizada");
        };


        $scope.addFee = function (key) {
            var factor = 1;
            $scope.liquidator[key][7] = []
            $scope.numberOfFees.forEach(e => {
                if (e.CUOTA == $scope.liquidator[key][3].PLAZO) {
                    factor = e.FACTOR;
                }
            });

            var iva = 0;
            var aval = 0;
            var totalAval = 0;
            var precio = parseInt($scope.liquidator[key][0][0].PRECIO);
            var e = $scope.liquidator[key][0];
            for (let i = 0; i < e.length; i++) {
                if (((e[i].CODIGO == 'AV10') || (e[i].CODIGO == 'AV12') || (e[i].CODIGO == 'AV15')) && (e[i].COD_PROCESO == 2)) {
                    aval = e[i].PRECIO;
                }
                if ((e[i].CODIGO == 'IVAV') && (e[i].COD_PROCESO == 2)) {
                    iva = e[i].PRECIO;
                }
            }
            totalAval = Math.round(parseInt(aval) + parseInt(iva));

            $scope.liquidator[key][0].forEach(j => {
                if (j.COD_PROCESO == 2) {
                    if ((j.CODIGO != 'AV10') && (j.CODIGO != 'AV12') && (j.CODIGO != 'AV15') && (j.CODIGO != 'IVAV')) {
                        precio = precio + j.PRECIO;
                    }
                }
            });
            if ($scope.liquidator[key][3].PLAZO != null) {
                $scope.liquidator[key][3].VRCUOTA = Math.round(((((precio - parseInt($scope.liquidator[key][2])) + (totalAval)) - (parseInt($scope.liquidator[key][3].CUOTAINI))) * factor))
                $scope.liquidator[key][3].timelyPayment = Math.round($scope.liquidator[key][3].VRCUOTA * 0.05);
                $scope.liquidator[key][3].TASAEA = 26.97;
                $scope.liquidator[key][3].TASAMORA = 2.01;
                $scope.liquidator[key][3].TASANOM = 24.12;
                $scope.liquidator[key][3].TASAMAX = 27.18;
                $scope.liquidator[key][3].TASA_INT = 2.01;

                if ($scope.liquidator[key][3].COD_PLAN != '20') {
                    if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya')) {
                        $scope.liquidator[key][3].MANEJO = 9900;
                        $scope.liquidator[key][3].SEGURO = 3000;
                    } else {
                        $scope.liquidator[key][3].MANEJO = 0;
                        $scope.liquidator[key][3].SEGURO = 3000;
                    }
                } else {
                    $scope.liquidator[key][3].MANEJO = 0;
                    $scope.liquidator[key][3].SEGURO = 0;
                }

                $scope.liquidator[key][7].push({ 'PLAZO': $scope.liquidator[key][3].PLAZO, 'VRCUOTA': $scope.liquidator[key][3].VRCUOTA, 'MANEJO': $scope.liquidator[key][3].MANEJO, 'SEGURO': $scope.liquidator[key][3].SEGURO, 'FACTOR': factor, 'TASAEA': 26.97, 'TASAMORA': 2.01, 'TASANOM': 24.12, 'TASAMAX': 27.18, 'TASA_INT': 2.01 });
            }

            $scope.liquidator[key][4] = []
            $scope.liquidator[key][4].AVAL = aval
            $scope.liquidator[key][4].IVA_AVAL = iva
            $scope.liquidator[key][4].TOTAL_AVAL = totalAval
            $scope.liquidator[key][4].push({ 'AVAL': aval, 'IVA_AVAL': iva, 'TOTAL_AVAL': totalAval });

            $scope.liquidator[key][5] = [];
            $scope.liquidator[key][5].TOTAL = Math.round((parseInt($scope.liquidator[key][3].VRCUOTA) * parseInt($scope.liquidator[key][3].PLAZO)) + parseInt
                ($scope.liquidator[key][3].CUOTAINI))
            if ($scope.liquidator[key][0][0].SELECCION == 95) {
                var div = 1
            } else {
                var div = 1.19
            }
            $scope.liquidator[key][5].SUBTOTAL = Math.round((parseInt($scope.liquidator[key][5].TOTAL) / div))
            $scope.liquidator[key][5].IVA = Math.round(parseInt($scope.liquidator[key][5].TOTAL - parseInt($scope.liquidator[key][5].SUBTOTAL)))
            $scope.liquidator[key][5].SALDOFIN = Math.round((parseInt($scope.liquidator[key][4].TOTAL_AVAL) + precio) - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI)));
            $scope.liquidator[key][5].push({
                'TOTAL': $scope.liquidator[key][5].TOTAL, 'IVA': $scope.liquidator[key][5].IVA, 'SUBTOTAL': $scope.liquidator[key][5].SUBTOTAL, 'SALDOFIN': $scope.liquidator[key][5].SALDOFIN
            });
            $scope.loader = false;

        };

        $scope.getCustomer = function () {
            $http({
                method: 'GET',
                url: '/assessor/api/getInfoLead/' + $scope.lead.CEDULA,
            }).then(function successCallback(response) {
                $scope.lead = response.data;
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
            if (($scope.items.CODIGO != '') && (($scope.items.COD_PROCESO == 1) || ($scope.items.COD_PROCESO == 4))) {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.items.CODIGO,
                }).then(function successCallback(response) {
                    $scope.items.ARTICULO = response.data.product[0].item;
                    if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya')) {
                        $scope.discount.key = $scope.items.key
                        $scope.discount.type = 'Por lista';
                        if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Black') {
                            $scope.items.PRECIO = response.data.price.normal_public_price;
                            $scope.discount.value = response.data.price.percentage_black_public_price;
                        } else {
                            $scope.items.PRECIO = response.data.price.normal_public_price;
                            $scope.discount.value = response.data.price.percentage_blue_public_price;
                        }
                    } else {
                        if (response.data.price.percentage_promotion_public_price != '0') {
                            $scope.discount.key = $scope.items.key
                            $scope.discount.type = 'Por lista';
                            $scope.discount.value = response.data.price.percentage_promotion_public_price;
                        }
                        $scope.items.PRECIO = response.data.price.normal_public_price;
                    }
                    $scope.items.PRECIO_P = response.data.price.normal_public_price;
                    $scope.items.LISTA = response.data.price.list;
                }, function errorCallback(response) {
                    response.url = '/api/liquidator/getProduct/' + $scope.items.CODIGO;
                    showAlert("error", "El código ingresado no existe");
                    $scope.addError(response, $scope.items.CODIGO);
                });
            } else {
                $http({
                    method: 'GET',
                    url: '/api/liquidator/getProduct/' + $scope.items.CODIGO,
                }).then(function successCallback(response) {
                    var key = $scope.items.key;
                    $scope.items.ARTICULO = response.data.product[0].item;
                    var precio = parseInt($scope.liquidator[key][0][0].PRECIO)
                    if ($scope.items.CODIGO == 'AV10' || $scope.items.CODIGO == 'AV12' || $scope.items.CODIGO == 'AV15') {
                        $scope.liquidator[key][0].forEach(j => {
                            if (j.COD_PROCESO == 2) {
                                if ((j.CODIGO != 'AV10') && (j.CODIGO != 'AV12') && (j.CODIGO != 'AV15') && (j.CODIGO != 'IVAV')) {
                                    precio = precio + j.PRECIO;
                                }
                            }
                        });
                        if ($scope.liquidator[key][2] != '') {
                            $scope.items.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            $scope.items.PRECIO_P = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                        } else {
                            $scope.items.PRECIO = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                            $scope.items.PRECIO_P = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                        }
                    } else if ($scope.items.CODIGO == 'GPG1' || $scope.items.CODIGO == 'GPG2') {
                        $scope.items.PRECIO = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                        $scope.items.PRECIO_P = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                    } else {
                        if ($scope.items.CODIGO == 'IVAV') {
                            var e = $scope.liquidator[key][0];
                            for (let i = 0; i < e.length; i++) {
                                if ((e[i].COD_PROCESO == 2) && ((e[i].CODIGO == 'AV10') || (e[i].CODIGO == 'AV12') || (e[i].CODIGO == 'AV15'))) {
                                    $scope.items.PRECIO = Math.round(parseInt($scope.liquidator[key][0][i].PRECIO) * (parseInt(response.data.product[0].base_cost) / 100));
                                    $scope.items.PRECIO_P = Math.round(parseInt($scope.liquidator[key][0][i].PRECIO) * (parseInt(response.data.product[0].base_cost) / 100));
                                } else {
                                    $scope.items.PRECIO = 0
                                    $scope.items.PRECIO_P = 0
                                }
                            }
                        } else {
                            $scope.items.PRECIO = parseInt(response.data.product[0].base_cost);
                            $scope.items.PRECIO_P = parseInt(response.data.product[0].base_cost);
                        }
                    }

                    $scope.items.LISTA = response.data.price.list;
                }, function errorCallback(response) {
                    showAlert("error", "El código ingresado no existe");
                    response.url = '/api/liquidator/getProduct/' + $scope.items.CODIGO;
                    $scope.addError(response, $scope.items.CODIGO);
                });
            }
        };

        $scope.updateCharges = function (key) {
            var e = $scope.liquidator[key][0];
            for (let i = 0; i < e.length; i++) {
                var item = {};
                if (((e[i].CODIGO == 'AV10') || (e[i].CODIGO == 'AV12') || (e[i].CODIGO == 'AV15'))) {
                    if ((e[i].COD_PROCESO == 2)) {
                        var product = e[i];
                        $scope.liquidator[key][0].splice(i, 1)
                        $http({
                            method: 'GET',
                            url: '/api/liquidator/getProduct/' + product.CODIGO,
                        }).then(function successCallback(response) {
                            var precio = parseInt($scope.liquidator[key][0][0].PRECIO)
                            console.log(precio)
                            $scope.liquidator[key][0].forEach(j => {
                                if (j.COD_PROCESO == 2) {
                                    if ((j.CODIGO != 'AV10') && (j.CODIGO != 'AV12') && (j.CODIGO != 'AV15') && (j.CODIGO != 'IVAV')) {
                                        precio = precio + j.PRECIO;
                                    }
                                }
                            });
                            item.key = key;
                            item.CANTIDAD = product.CANTIDAD;
                            item.COD_PROCESO = product.COD_PROCESO;
                            item.SELECCION = product.SELECCION;
                            item.ARTICULO = response.data.product[0].item;
                            item.CODIGO = response.data.product[0].sku;
                            if ($scope.liquidator[key][2] != '') {
                                item.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                                item.PRECIO_P = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            } else {
                                item.PRECIO = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                                item.PRECIO_P = Math.round(precio * (parseInt(response.data.product[0].base_cost) / 100));
                            }
                            item.LISTA = response.data.price.list;
                            item.SOLICITUD = $scope.request.SOLICITUD;
                            $scope.liquidator[key][0].push(item);
                        }, function errorCallback(response) {
                            response.url = '/api/liquidator/getProduct/' + product.CODIGO;
                            $scope.addError(response, product.CODIGO);
                        });
                    }
                }
            }
            $scope.updateIva(key);
        };

        $scope.removeItem = function (key) {
            $scope.liquidator.splice($scope.liquidator.indexOf(key), 1);
            $scope.tabItem = key - 1
            showAlert("success", "El item se ha eliminado correctamente");
        };

        $scope.removeProduct = function (product) {
            key = product.key
            $scope.liquidator[key][0].splice($scope.liquidator[key][0].indexOf(product), 1);
            showAlert("success", "El producto se ha eliminado correctamente");
        };

        $scope.removeDiscount = function (discount) {
            key = discount.key
            $scope.liquidator[key][1].splice($scope.liquidator[key][1].indexOf(discount), 1);
            showAlert("success", "El descuento se ha eliminado correctamente");
        };

        $scope.updateIva = function (key) {
            var e = $scope.liquidator[key][0];
            for (let i = 0; i < e.length; i++) {
                if (e[i].COD_PROCESO == 2 && e[i].CODIGO == 'IVAV') {
                    var product = e[i];
                    $scope.liquidator[key][0].splice(i, 1)
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + product.CODIGO,
                    }).then(function successCallback(response) {
                        var item = {}
                        item.key = key;
                        item.CANTIDAD = product.CANTIDAD;
                        item.COD_PROCESO = product.COD_PROCESO;
                        item.SELECCION = product.SELECCION;
                        item.ARTICULO = response.data.product[0].item;
                        item.CODIGO = response.data.product[0].sku;
                        for (let h = 0; h < e.length; h++) {
                            if (e[h].CODIGO == 'AV10' || e[h].CODIGO == 'AV12' || e[h].CODIGO == 'AV15') {
                                if (e[h].COD_PROCESO == 2) {
                                    item.PRECIO = Math.round(parseInt($scope.liquidator[key][0][h].PRECIO) * (parseInt(response.data.product[0].base_cost) / 100));
                                    item.PRECIO_P = item.PRECIO
                                } else {
                                    item.PRECIO = 0
                                    item.PRECIO_P = 0
                                }
                            } else {
                                item.PRECIO = 0
                                item.PRECIO_P = 0
                            }
                        }

                        item.LISTA = response.data.price.list;
                        item.SOLICITUD = $scope.request.SOLICITUD;
                        $scope.liquidator[key][0].push(item);
                    }, function errorCallback(response) {
                        response.url = '/api/liquidator/getProduct/' + product.CODIGO;
                        $scope.addError(response, product.CODIGO);
                    });
                }
            }
            $scope.loader = true;
            $timeout(() => {
                $scope.addFee(key);
            }, 3500);
        };

        $scope.getValidationCustomer = function () {
            $timeout(() => {
                $scope.lead.CEDULA = $("#identification").val();
                if ($scope.lead.CEDULA > 0) {
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/validationLead/' + $scope.lead.CEDULA,
                    }).then(function successCallback(response) {
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
                        response.url = '/api/liquidator/validationLead/' + $scope.lead.CEDULA;
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
                    $scope.request.push({ 'SOLICITUD': response.data.SOLICITUD })
                }
            }, function errorCallback(response) {
            });
        };

        $scope.createLiquidator = function () {
            if ($scope.liquidator[0][5].length > 0) {
                $http({
                    method: 'POST',
                    url: '/Administrator/creditLiquidator',
                    data: [$scope.liquidator, $scope.request, $scope.lead]
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

        $scope.getPlans();
        $scope.getValidationCustomer();
        $scope.listDiscount();
        $scope.listOfFees();

    });