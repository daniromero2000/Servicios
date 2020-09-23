
angular.module('creditLiqudatorApp', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])

    .controller('creditLiqudatorController', function ($scope, $http, $timeout) {

        $scope.lead = {};
        $scope.fees = {};
        $scope.items = {};
        $scope.discount = {};
        $scope.infoLiquidator = {};
        $scope.img = [];
        $scope.plans = [];
        $scope.lists = [];
        $scope.request = [];
        $scope.listTags = [];
        $scope.listValue = [];
        $scope.discounts = [];
        $scope.productImg = [];
        $scope.liquidator = [];
        $scope.numberOfFees = [];
        $scope.productPrices = [];
        $scope.code = '';
        $scope.zone = '';
        $scope.listSearch = '';
        $scope.tabs = 1;
        $scope.tasaea = 0;
        $scope.tabItem = 0;
        $scope.tasanom = 0;
        $scope.tasamax = 0;
        $scope.tasaint = 0;
        $scope.tasamora = 0;
        $scope.totalDiscount = 0;
        $scope.loader = false;
        $scope.viewProductImg = false;
        $scope.typeDiscount =
            [
                { 'type': 'Otros' },
            ];
        $scope.tabItems =
            [
                { 'value': 1 },
                { 'value': 2 }
            ];

        // $scope.liquidator[key][0][0] = 

        //Item del liquidador
        $scope.addItem = function () {
            var index = [[], [], [], [], [], [], [], [], []];
            $scope.liquidator.push(index);
        };

        //Listado de Planes
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

        //Traer listas
        $scope.getList = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/getLists',
            }).then(function successCallback(response) {
                $scope.lists = response.data
            }, function errorCallback(response) {
                response.url = '/api/liquidator/getLists';
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        //Listado de cuotas
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

        //factores mensuales
        $scope.getFactor = function () {
            $http({
                method: 'GET',
                url: '/api/listFactors'
            }).then(function successCallback(response) {
                if (response != false) {
                    angular.forEach(response.data, function (value) {
                        switch (value.name) {
                            case 'Tasa':
                                $scope.tasaint = value.value
                                break;
                            case 'Efectiva anual':
                                $scope.tasaea = value.value
                                break;
                            case 'Nominal vencida':
                                $scope.tasanom = value.value
                                break;
                            case 'Mensual vencida':
                                $scope.tasamora = value.value
                                break;
                            case 'Tasa maxima legal':
                                $scope.tasamax = value.value
                                break;
                            default:
                                break;
                        }
                    });
                }
            }, function errorCallback(response) {
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        //Validacion de cliente
        $scope.getValidationCustomer = function () {
            $timeout(() => {
                $scope.loader = true;
                $scope.lead.CEDULA = $("#identification").val();
                if ($scope.lead.CEDULA > 0) {
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/validationLead/' + $scope.lead.CEDULA,
                    }).then(function successCallback(response) {
                        if (response.data == -1) {
                            $scope.loader = false;
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "Estimado usuario, no es posible continuar con el proceso de crédito ya que cuenta con una tarjeta inactiva, has el proceso de pre activación para poder continuar.";
                        } else if (response.data == -3) {
                            $scope.loader = false;
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "Actualmente ya cuentas con una solicitud que está siendo procesada.";
                        } else if (response.data == -4) {
                            $scope.loader = false;
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "Estimado usuario, no es posible continuar con el proceso de crédito ya que presenta mora con Almacenes Oportunidades.";
                        } else if (response.data == -5) {
                            $scope.loader = false;
                            $('#validationCustomer').modal('show');
                            $scope.messageValidationLead = "Estimado usuario, no es posible continuar con el proceso de crédito ya que no ha culminado con el proceso de consulta. <br> Por favor termina con este proceso para continuar";
                        } else {
                            $scope.zone = response.data;
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

        //Consultar datos del cliente
        $scope.getCustomer = function () {
            $http({
                method: 'GET',
                url: '/assessor/api/getInfoLead/' + $scope.lead.CEDULA,
            }).then(function successCallback(response) {
                $scope.lead = response.data;
                $scope.createRequest();
                $scope.loader = false;
                $scope.addItem();
            }, function errorCallback(response) {
                response.url = '/assessor/api/getInfoLead/' + $scope.lead.CEDULA;
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        //Consultar Producto
        $scope.getProduct = function () {

            console.log($scope.items);
            $scope.items.CODIGO = $scope.items.CODIGO.toUpperCase();
            switch ($scope.items.COD_PROCESO) {
                case '1':
                    $scope.calcPriceProduct($scope.items);
                    break;
                case '2':
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + $scope.items.CODIGO + '/' + $scope.items.LISTA,
                    }).then(function successCallback(response) {
                        var key = $scope.items.key;

                        //precio base
                        var precio = parseInt($scope.liquidator[key][0][0].PRECIO) * parseInt($scope.liquidator[key][0][0].CANTIDAD)
                        $scope.items.ARTICULO = response.data.product[0].item;

                        //precio mas los cargos o combos
                        $scope.liquidator[key][0].forEach(j => {
                            if (j.COD_PROCESO == 2 || j.COD_PROCESO == 4) {
                                if ((j.CODIGO != 'AV10') && (j.CODIGO != 'AV12') && (j.CODIGO != 'AV15') && (j.CODIGO != 'IVAV')) {
                                    precio = precio + j.PRECIO;
                                }
                            }
                        });

                        //Calculo del AVAL
                        if ($scope.items.CODIGO == 'AV10' || $scope.items.CODIGO == 'AV12' || $scope.items.CODIGO == 'AV15') {
                            $scope.items.PRECIO = (precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100);
                            $scope.items.PRECIO_P = $scope.items.PRECIO;

                            //Calculo del Retanqueo
                        } else if ($scope.items.CODIGO == 'GPG1' || $scope.items.CODIGO == 'GPG2' || $scope.items.CODIGO == 'EPG1' || $scope.items.CODIGO == 'EPG2') {
                            $scope.items.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            $scope.items.PRECIO_P = $scope.items.PRECIO;
                        } else {

                            //Calculo del IVA AVAL
                            if ($scope.items.CODIGO == 'IVAV') {
                                var e = $scope.liquidator[key][0];
                                for (let i = 0; i < e.length; i++) {
                                    if ((e[i].COD_PROCESO == 2) && ((e[i].CODIGO == 'AV10') || (e[i].CODIGO == 'AV12') || (e[i].CODIGO == 'AV15'))) {
                                        $scope.items.PRECIO = parseInt($scope.liquidator[key][0][i].PRECIO) * (parseInt(response.data.product[0].base_cost) / 100);
                                        $scope.items.PRECIO_P = $scope.items.PRECIO;
                                    } else {
                                        $scope.items.PRECIO = 0
                                        $scope.items.PRECIO_P = 0
                                    }
                                }

                                //Cargo comun
                            } else {
                                $scope.items.PRECIO = parseInt(response.data.product[0].base_cost);
                                $scope.items.PRECIO_P = $scope.items.PRECIO;
                            }
                        }
                        // $scope.items.LISTA = response.data.price.list;
                    }, function errorCallback(response) {
                        showAlert("error", "El código ingresado no existe");
                    });
                    break;

                case '3':
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getGift/' + $scope.items.CODIGO,
                    }).then(function successCallback(response) {
                        $scope.items.ARTICULO = response.data.product[0].item;
                        $scope.items.PRECIO = 0;
                        $scope.items.PRECIO_P = 0;
                        // $scope.items.LISTA = response.data.price.list;
                    }, function errorCallback(response) {
                        showAlert("error", "El código no es un obsequio");
                    });
                    break;

                case '4':
                    $scope.calcPriceProduct($scope.items);
                    break;

                default:

                    break;
            }
        };

        //Calculo del precio del producto
        $scope.calcPriceProduct = function (item) {
            $http({
                method: 'GET',
                url: '/api/liquidator/getProduct/' + item.CODIGO + '/' + item.LISTA,
            }).then(function successCallback(response) {
                $scope.liquidator[item.key][3].apply_gift = response.data.price.apply_gift;
                item.ARTICULO = response.data.product[0].item;
                if (response.data.product[0].type_product == 1) {
                    if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya')) {
                        $scope.discount.key = item.key
                        $scope.discount.type = 'Por lista';
                        $scope.zone = response.data.zone;
                        if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Black') {
                            $scope.discount.value = Math.floor(response.data.price.percentage_oportuya_customer);
                        } else if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Gray' || $scope.lead.latest_intention.TARJETA == 'Tarjeta Blue') {
                            $scope.discount.value = Math.floor(response.data.price.percentage_oportuya_customer);
                        } else {
                            if (response.data.price.percentage_promotion_public_price != '0') {
                                $scope.discount.key = item.key
                                $scope.discount.type = 'Por lista';
                                $scope.discount.value = Math.floor(response.data.price.percentage_promotion_public_price);
                            }
                        }
                    } else {
                        if (response.data.price.percentage_promotion_public_price != '0') {
                            $scope.discount.key = item.key
                            $scope.discount.type = 'Por lista';
                            $scope.discount.value = Math.floor(response.data.price.percentage_promotion_public_price);
                        }
                    }
                    item.PRECIO = response.data.price.normal_public_price;
                    item.PRECIO_P = item.PRECIO;
                } else {
                    item.PRECIO = response.data.product[0].cash_cost;
                    item.PRECIO_P = item.PRECIO;
                }
                // item.LISTA = response.data.price.list;
                item.type_product = response.data.product[0].type_product;
            }, function errorCallback(response) {
                showAlert("error", "El código ingresado no existe");
            });
        }

        //Listado de porcentajes de descuento
        $scope.listDiscount = function () {
            for (let i = 1; i < 101; i++) {
                $scope.listValue.push({ 'value': i });
            }
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

        $scope.createItemLiquidator = function () {
            $scope.items.SOLICITUD = $scope.request.SOLICITUD;
            var key = $scope.items.key;
            $scope.liquidator[key][0].push($scope.items);
            if ($scope.discount.length != '') {
                if ($scope.discount.type) {
                    if ($scope.items.COD_PROCESO == 1 || $scope.items.COD_PROCESO == 4) {
                        $scope.liquidator[key][1] = [];
                        $scope.liquidator[key][1].push($scope.discount);
                        $scope.discount = {};
                        if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya') && $scope.lead.latest_intention.TARJETA != 'Crédito Tradicional') {
                            $scope.discount.key = key
                            $scope.discount.type = 'Cliente Oportuya';
                            if ($scope.lead.latest_intention.TARJETA == 'Tarjeta Black') {
                                if ($scope.zone == 'ALTA') {
                                    $scope.discount.value = 5;
                                    $scope.liquidator[key][1].push($scope.discount);
                                } else {
                                    $scope.discount.value = 10;
                                    $scope.liquidator[key][1].push($scope.discount);
                                    $scope.discount = {};
                                    $scope.discount.key = key
                                    $scope.discount.type = 'Tarjeta Black';
                                    $scope.discount.value = 5;
                                    $scope.liquidator[key][1].push($scope.discount);
                                }
                            } else {
                                if ($scope.zone == 'ALTA') {
                                    $scope.discount.value = 3;
                                    $scope.liquidator[key][1].push($scope.discount);
                                } else {
                                    $scope.discount.value = 10;
                                    $scope.liquidator[key][1].push($scope.discount);
                                }
                            }
                            $scope.discount = {};
                        }
                        $scope.sumDiscount(key);
                    }
                }
            }
            $("#addItem" + key).modal("hide");
            showAlert("success", "Producto ingresado correctamente");

            //Insertar IVAV automatico
            if ($scope.items.CODIGO == 'AV10' || $scope.items.CODIGO == 'AV12' || $scope.items.CODIGO == 'AV15') {
                var list = $scope.items.LISTA;
                $scope.items = {};
                $scope.items.key = key
                $scope.items.COD_PROCESO = '2';
                $scope.items.LISTA = list;
                $scope.items.CODIGO = 'IVAV';
                $scope.items.CANTIDAD = '1';
                $scope.items.SELECCION = '01';
                $scope.items.ARTICULO = "IVA AVAL 19 %";

                //Calculo del IVA AVAL
                var e = $scope.liquidator[key][0];
                for (let i = 0; i < e.length; i++) {
                    if ((e[i].COD_PROCESO == 2) && ((e[i].CODIGO == 'AV10') || (e[i].CODIGO == 'AV12') || (e[i].CODIGO == 'AV15'))) {
                        $scope.items.PRECIO = parseInt($scope.liquidator[key][0][i].PRECIO) * (parseInt(19) / 100);
                        $scope.items.PRECIO_P = $scope.items.PRECIO;
                    } else {
                        $scope.items.PRECIO = 0
                        $scope.items.PRECIO_P = 0
                    }
                }
                $scope.liquidator[key][0].push($scope.items);
            }
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
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        $scope.createLiquidator = function () {
            if ($scope.liquidator[0][5].length > 0) {
                $scope.request.push({ 'EXTENDID': $scope.request.EXTENDID })
                $http({
                    method: 'POST',
                    url: '/Administrator/creditLiquidator',
                    data: [$scope.liquidator, $scope.request, $scope.lead]
                }).then(function successCallback(response) {
                    if (response.data) {
                        $('#congratulations').modal('show');
                    }
                }, function errorCallback(response) {
                    $scope.addError(response, $scope.lead.CEDULA);
                });
            } else {
                showAlert("error", "Por favor ingrese todos los datos");
            }
        };

        $scope.addFee = function (key) {
            var factor = 1;
            var iva = 0;
            var aval = 0;
            var totalAval = 0;
            var typeProduct = $scope.liquidator[key][0][0].type_product;
            $scope.liquidator[key][7] = []

            if ((typeProduct == 2 && $scope.liquidator[key][3].PLAZO <= 12) || typeProduct != 2) {
                if (typeProduct != 3) {
                    $scope.numberOfFees.forEach(e => {
                        if (e.CUOTA == $scope.liquidator[key][3].PLAZO) {
                            factor = e.FACTOR;
                        }
                    });
                }
                var precio = parseInt($scope.liquidator[key][0][0].PRECIO) * parseInt($scope.liquidator[key][0][0].CANTIDAD);

                $scope.liquidator[key][0].forEach(j => {
                    if (j.COD_PROCESO == 2 || j.COD_PROCESO == 4) {
                        if ((j.CODIGO != 'AV10') && (j.CODIGO != 'AV12') && (j.CODIGO != 'AV15') && (j.CODIGO != 'IVAV')) {
                            precio = precio + j.PRECIO;
                        }
                    }

                    if (((j.CODIGO == 'AV10') || (j.CODIGO == 'AV12') || (j.CODIGO == 'AV15')) && (j.COD_PROCESO == 2)) {
                        aval = j.PRECIO;
                    }

                    if ((j.CODIGO == 'IVAV') && (j.COD_PROCESO == 2)) {
                        iva = j.PRECIO;
                    }
                });

                totalAval = Math.round(parseInt(aval) + parseInt(iva));

                if ($scope.liquidator[key][3].PLAZO != null) {
                    if (typeProduct != 3) {
                        $scope.liquidator[key][3].VRCUOTA = Math.round(((((precio - parseInt($scope.liquidator[key][2])) + (totalAval)) - (parseInt($scope.liquidator[key][3].CUOTAINI))) * factor))
                    } else {
                        $scope.liquidator[key][3].VRCUOTA = Math.round(((((precio - parseInt($scope.liquidator[key][2])) + (totalAval)) - (parseInt($scope.liquidator[key][3].CUOTAINI))) / parseInt($scope.liquidator[key][3].PLAZO)))
                    }

                    if ($scope.zone == 'ALTA' || typeProduct == 3 || typeProduct == 2) {
                        $scope.liquidator[key][3].timelyPayment = 0;
                    } else {
                        $scope.liquidator[key][3].timelyPayment = Math.round($scope.liquidator[key][3].VRCUOTA * 0.05);
                    }

                    $scope.liquidator[key][3].TASAEA = $scope.tasaea;
                    $scope.liquidator[key][3].TASAMORA = $scope.tasamora;
                    $scope.liquidator[key][3].TASANOM = $scope.tasanom;
                    $scope.liquidator[key][3].TASAMAX = $scope.tasamax;
                    $scope.liquidator[key][3].TASA_INT = $scope.tasaint;

                    if ($scope.liquidator[key][3].COD_PLAN != '20') {
                        if (typeProduct != 3) {
                            if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya')) {
                                $scope.liquidator[key][3].MANEJO = 9900;
                                $scope.liquidator[key][3].SEGURO = 3000;
                            } else {
                                $scope.liquidator[key][3].MANEJO = 0;
                                $scope.liquidator[key][3].SEGURO = 3000;
                            }
                        } else {
                            if (($scope.lead.latest_intention != '') && ($scope.lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya')) {
                                $scope.liquidator[key][3].MANEJO = 9900;
                                $scope.liquidator[key][3].SEGURO = 3000;
                            } else {
                                $scope.liquidator[key][3].MANEJO = 0;
                                $scope.liquidator[key][3].SEGURO = 3000;
                            }
                        }
                    } else {
                        $scope.liquidator[key][3].MANEJO = 0;
                        $scope.liquidator[key][3].SEGURO = 0;
                    }
                    $scope.liquidator[key][7].push({ 'PLAZO': $scope.liquidator[key][3].PLAZO, 'VRCUOTA': $scope.liquidator[key][3].VRCUOTA, 'MANEJO': $scope.liquidator[key][3].MANEJO, 'SEGURO': $scope.liquidator[key][3].SEGURO, 'FACTOR': factor, 'TASAEA': $scope.tasaea, 'TASAMORA': $scope.tasamora, 'TASANOM': $scope.tasanom, 'TASAMAX': $scope.tasamax, 'TASA_INT': $scope.tasaint });
                    $scope.getTerms($scope.liquidator[key][3].PLAZO, key);
                }

                $scope.liquidator[key][4] = []
                $scope.liquidator[key][4].AVAL = aval
                $scope.liquidator[key][4].IVA_AVAL = iva
                $scope.liquidator[key][4].TOTAL_AVAL = totalAval
                $scope.liquidator[key][4].push({ 'AVAL': aval, 'IVA_AVAL': iva, 'TOTAL_AVAL': totalAval });

                $scope.liquidator[key][5] = [];
                $scope.liquidator[key][5].TOTAL = Math.round((parseInt($scope.liquidator[key][3].VRCUOTA) * parseInt($scope.liquidator[key][3].PLAZO)) + parseInt
                    ($scope.liquidator[key][3].CUOTAINI))

                if ($scope.liquidator[key][3].check) {
                    var div = 1.19
                } else {
                    var div = 1
                }

                $scope.liquidator[key][5].SUBTOTAL = Math.round((parseInt($scope.liquidator[key][5].TOTAL) / div))
                $scope.liquidator[key][5].IVA = Math.round(parseInt($scope.liquidator[key][5].TOTAL - parseInt($scope.liquidator[key][5].SUBTOTAL)))
                $scope.liquidator[key][5].SALDOFIN = Math.round((parseInt($scope.liquidator[key][4].TOTAL_AVAL) + precio) - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI)));
                $scope.liquidator[key][5].push({
                    'TOTAL': $scope.liquidator[key][5].TOTAL, 'IVA': $scope.liquidator[key][5].IVA, 'SUBTOTAL': $scope.liquidator[key][5].SUBTOTAL, 'SALDOFIN': $scope.liquidator[key][5].SALDOFIN
                });
            } else {
                if ($scope.liquidator[key][3].PLAZO) {
                    showAlert("error", "El plazo ingresado no es valido para esta liquidación");
                    $scope.liquidator[key][3].PLAZO = ''
                }
            }
            $scope.loader = false;
        };

        $scope.sumDiscount = function (key) {

            var total = 0;
            var precio = 0;
            var product = 0;
            var cuotaIni = 0
            var hasRetanqueoIva = 0;
            var hasRetanqueo = 0;

            if ($scope.liquidator[key][0][0].PRECIO != 0) {
                precio = parseInt($scope.liquidator[key][0][0].PRECIO) * parseInt($scope.liquidator[key][0][0].CANTIDAD)
            }

            $scope.liquidator[key][0].forEach(j => {
                if (j.CODIGO == 'GPG1' || j.CODIGO == 'GPG2') {
                    hasRetanqueoIva = 1
                }
                if (j.CODIGO == 'EPG1' || j.CODIGO == 'EPG2') {
                    hasRetanqueo = 1
                }
                if (j.COD_PROCESO == 4) {
                    precio = precio + parseInt(parseInt(j.PRECIO) * parseInt(j.CANTIDAD));
                }
            });

            product = precio;
            $scope.liquidator[key][2] = 0
            $scope.liquidator[key][1].forEach(e => {
                total = (parseInt(e.value) / 100) * product;
                $scope.liquidator[key][2] = parseInt($scope.liquidator[key][2]) + (total)
                product = product - total;
                total = 0;
            });

            switch ($scope.liquidator[key][3].COD_PLAN) {
                case '1':
                    cuotaIni = 30000
                    break;
                case '3':
                    cuotaIni = 1
                    break;
                case '5':

                    if ($scope.liquidator[key][3].check && hasRetanqueoIva == 0) {
                        var list = $scope.liquidator[key][0][0].LISTA;
                        $scope.items = {};
                        $scope.items.key = key
                        $scope.items.COD_PROCESO = '2';
                        $scope.items.LISTA = list;
                        $scope.items.CODIGO = 'GPG2';
                        $scope.items.CANTIDAD = '1';
                        $scope.items.SELECCION = '01';
                        $scope.items.ARTICULO = "PERIODO GRACIA CAPITAL 2 MES";

                        //Calculo Retanqueo
                        $scope.items.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(4) / 100));
                        $scope.items.PRECIO_P = $scope.items.PRECIO;
                        $scope.liquidator[key][0].push($scope.items);
                        $scope.items = {};

                    } else if (($scope.liquidator[key][3].check == undefined || $scope.liquidator[key][3].check == false) && hasRetanqueo == 0) {
                        var list = $scope.liquidator[key][0][0].LISTA;
                        $scope.items = {};
                        $scope.items.key = key
                        $scope.items.COD_PROCESO = '2';
                        $scope.items.LISTA = list;
                        $scope.items.CODIGO = 'EPG2';
                        $scope.items.CANTIDAD = '1';
                        $scope.items.SELECCION = '01';
                        $scope.items.ARTICULO = "PERIODO GRACIA CAPITAL 2 MESES EXCLUIDO";

                        //Calculo Retanqueo
                        $scope.items.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(4) / 100));
                        $scope.items.PRECIO_P = $scope.items.PRECIO;
                        $scope.liquidator[key][0].push($scope.items);
                        $scope.items = {};
                    }

                    cuotaIni = 30000
                    break;
                case '6':

                    if ($scope.liquidator[key][3].check && hasRetanqueoIva == 0) {
                        var list = $scope.liquidator[key][0][0].LISTA;
                        $scope.items = {};
                        $scope.items.key = key
                        $scope.items.COD_PROCESO = '2';
                        $scope.items.LISTA = list;
                        $scope.items.CODIGO = 'GPG1';
                        $scope.items.CANTIDAD = '1';
                        $scope.items.SELECCION = '01';
                        $scope.items.ARTICULO = "PERIODO GRACIA CAPITAL 1 MES";

                        //Calculo Retanqueo
                        $scope.items.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(2) / 100));
                        $scope.items.PRECIO_P = $scope.items.PRECIO;
                        $scope.liquidator[key][0].push($scope.items);
                        $scope.items = {};

                    } else if (($scope.liquidator[key][3].check == undefined || $scope.liquidator[key][3].check == false) && hasRetanqueo == 0) {
                        var list = $scope.liquidator[key][0][0].LISTA;
                        $scope.items = {};
                        $scope.items.key = key
                        $scope.items.COD_PROCESO = '2';
                        $scope.items.LISTA = list;
                        $scope.items.CODIGO = 'EPG1';
                        $scope.items.CANTIDAD = '1';
                        $scope.items.SELECCION = '01';
                        $scope.items.ARTICULO = "PERIODO GRACIA CAPITAL 1 MESES EXCLUIDO";

                        //Calculo Retanqueo
                        $scope.items.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(2) / 100));
                        $scope.items.PRECIO_P = $scope.items.PRECIO;
                        $scope.liquidator[key][0].push($scope.items);
                        $scope.items = {};
                    }

                    cuotaIni = 30000
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
                    cuotaIni = 1
                    break;
                case '21':
                    cuotaIni = Math.round((precio - parseInt($scope.liquidator[key][2])) * 0.08)
                    break;
                default:
                    break;
            }

            $scope.liquidator[key][6] = []
            $scope.liquidator[key][3].initialFeeFeedback = false;

            if ($scope.liquidator[key][3].checkInitialFee == undefined || $scope.liquidator[key][3].checkInitialFee == false) {
                $scope.liquidator[key][3].CUOTAINI = cuotaIni;
            } else {
                if ($scope.liquidator[key][3].CUOTAINI < cuotaIni) {
                    $scope.liquidator[key][3].CUOTAINI = cuotaIni;
                    $scope.liquidator[key][3].initialFeeFeedback = cuotaIni;
                }
            }

            $scope.liquidator[key][6].push({ 'CUOTAINI': $scope.liquidator[key][3].CUOTAINI });
            $timeout(() => {
                $scope.updateChargesLiquidator(key);
            }, 500);

        };

        $scope.refreshLiquidator = function (key) {
            $scope.sumDiscount(key);
            showAlert("success", "La liquidación ha sido actualizada");
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
                            url: '/api/liquidator/getProduct/' + product.CODIGO + '/' + product.LISTA,
                        }).then(function successCallback(response) {
                            var precio = parseInt($scope.liquidator[key][0][0].PRECIO) * parseInt($scope.liquidator[key][0][0].CANTIDAD)

                            $scope.liquidator[key][0].forEach(j => {
                                if (j.COD_PROCESO == 2 || j.COD_PROCESO == 4) {
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
                            item.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100))
                            item.PRECIO_P = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            item.LISTA = product.LISTA;
                            item.SOLICITUD = $scope.request.SOLICITUD;
                            $scope.liquidator[key][0].push(item);
                        }, function errorCallback(response) {
                            response.url = '/api/liquidator/getProduct/' + product.CODIGO;
                            $scope.addError(response, product.CODIGO);
                        });
                    }
                }
            };
            $timeout(() => {
                $scope.updateIva(key);
            }, 500);
        }

        $scope.updateIva = function (key) {
            var e = $scope.liquidator[key][0];
            for (let i = 0; i < e.length; i++) {
                if (e[i].COD_PROCESO == 2 && e[i].CODIGO == 'IVAV') {
                    var product = e[i];
                    $scope.liquidator[key][0].splice(i, 1)
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + product.CODIGO + '/' + product.LISTA,
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
                        item.LISTA = product.LISTA;
                        item.SOLICITUD = $scope.request.SOLICITUD;
                        $scope.liquidator[key][0].push(item);
                    }, function errorCallback(response) {
                        response.url = '/api/liquidator/getProduct/' + product.CODIGO;
                        $scope.addError(response, product.CODIGO);
                    });
                }
            }
            $timeout(() => {
                $scope.addFee(key);
            }, 3500);
        };


        $scope.updateChargesLiquidator = function (key) {
            var e = $scope.liquidator[key][0];
            for (let i = 0; i < e.length; i++) {
                var item = {};
                if (((e[i].CODIGO == 'GPG1') || (e[i].CODIGO == 'GPG2') || e[i].CODIGO == 'EPG1' || e[i].CODIGO == 'EPG2')) {
                    if ((e[i].COD_PROCESO == 2)) {
                        var product = e[i];
                        $scope.liquidator[key][0].splice(i, 1)
                        $http({
                            method: 'GET',
                            url: '/api/liquidator/getProduct/' + product.CODIGO + '/' + product.LISTA,
                        }).then(function successCallback(response) {
                            var precio = parseInt($scope.liquidator[key][0][0].PRECIO) * parseInt($scope.liquidator[key][0][0].CANTIDAD)
                            $scope.liquidator[key][0].forEach(j => {
                                if (j.COD_PROCESO == 2 || j.COD_PROCESO == 4) {
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
                            item.PRECIO = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100))
                            item.PRECIO_P = Math.round((precio - (parseInt($scope.liquidator[key][2]) + parseInt($scope.liquidator[key][3].CUOTAINI))) * (parseInt(response.data.product[0].base_cost) / 100));
                            item.LISTA = product.LISTA;
                            item.SOLICITUD = $scope.request.SOLICITUD;
                            $scope.liquidator[key][0].push(item);
                        }, function errorCallback(response) {
                            response.url = '/api/liquidator/getProduct/' + product.CODIGO;
                            $scope.addError(response, product.CODIGO);
                        });
                    }
                }
            };
            $scope.loader = true;
            $timeout(() => {
                $scope.updateCharges(key);
            }, 500);
        }

        $scope.removeItem = function (key) {
            $scope.liquidator.splice($scope.liquidator.indexOf(key), 1);
            $scope.tabItem = key - 1
            showAlert("success", "El item se ha eliminado correctamente");
        };

        $scope.removeProduct = function (product) {
            $scope.liquidator[product.key][0].splice($scope.liquidator[product.key][0].indexOf(product), 1);
            showAlert("success", "El producto se ha eliminado correctamente");
        };

        $scope.removeDiscount = function (discount) {
            $scope.liquidator[discount.key][1].splice($scope.liquidator[discount.key][1].indexOf(discount), 1);
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
                url: '/api/appError',
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

        $scope.getDataPriceProduct = function () {
            $http({
                method: 'GET',
                url: '/api/liquidator/getProduct/' + $scope.code + '/' + $scope.listSearch
            }).then(function successCallback(response) {
                if (response.data != false) {
                    $scope.productPrices = response.data;
                    $scope.viewProductPrices = true;
                    $scope.getImgProduct();
                }
            }, function errorCallback(response) {
                showAlert("error", "El código ingresado no existe");
            });
        };

        $scope.getImgProduct = function () {
            $http({
                method: 'GET',
                url: '/api/getProducts/' + $scope.code
            }).then(function successCallback(response) {
                if (response.data != false) {
                    $scope.productImg = response.data;
                    $scope.img = response.data.images;
                    $scope.viewProductImg = true;
                }
            }, function errorCallback(response) {

            });
        };

        $scope.getTerms = function (val, key) {
            $http({
                method: 'GET',
                url: '/api/liquidator/getTerms/' + val
            }).then(function successCallback(response) {
                if (response.data != false) {
                    $scope.liquidator[key][3].FECHA = response.data[0];
                    $scope.liquidator[key][3].FECHAINI = response.data[1]
                    $scope.liquidator[key][3].FECHAFIN = response.data[2];
                }
            }, function errorCallback(response) {
                $scope.addError(response, $scope.lead.CEDULA);
            });
        };

        $scope.getPlans();
        $scope.getValidationCustomer();
        $scope.listDiscount();
        $scope.listOfFees();
        $scope.getFactor();
        $scope.getList();

        $scope.printToCart = function (printSectionId) {
            var innerContents = document.getElementById(printSectionId).innerHTML;
            var popupWinindow = window.open('', '_blank', 'width=600,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
            popupWinindow.document.open();
            popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">' + innerContents + '</html>');
            popupWinindow.document.close();
        }
    });