
angular.module('appQuotations', ['angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput'])

    .controller('quotationsController', function ($scope, $http, $timeout) {

        $scope.lead = {};
        $scope.items = {};
        $scope.discountTradicional = {};
        $scope.discountOportuyaCard = {};
        $scope.discountOportuyaCardBlack = {};
        $scope.discountCash = {};
        $scope.plans = [];
        $scope.lists = [];
        $scope.request = [];
        $scope.listTags = [];
        $scope.listValue = [];
        $scope.discountTradicionals = [];
        $scope.productImg = [];
        $scope.quotations = [];
        $scope.numberOfFees = [];
        $scope.productPrices = [];
        $scope.code = '';
        $scope.zone = '';
        $scope.leadId = '';
        $scope.tabs = 1;
        $scope.step = 1;
        $scope.tabItem = 0;
        $scope.totalDiscount = 0;
        $scope.loader = false;
        $scope.show = false;
        $scope.disabledButton = false;
        $scope.showButtonLead = false;
        $scope.buttonDisabled = true;
        $scope.typesDocuments = [
            {
                'value': "",
                'label': 'Selecciona'
            },
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
                { 'type': 'Por Lista' },
                { 'type': 'Por Tipo de cliente' },
                { 'type': 'Por traslado' },
                { 'type': 'Otros' }
            ];

        $scope.addItem = function () {
            var index = [[], [], [], [], [], [], [], [], [], [], [], []];
            $scope.quotations.push(index);
            $scope.tabItem = $scope.quotations.length - 1;
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
                $scope.addError(response, $scope.lead.identificationNumber);
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
                $scope.addError(response, $scope.lead.identificationNumber);
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
                $scope.addError(response, $scope.lead.identificationNumber);
            });
        };

        //Consultar Producto
        $scope.getProduct = function () {
            $scope.items.sku = $scope.items.sku.toUpperCase();
            switch ($scope.items.cod_proceso) {
                case '1':
                    $scope.calcPriceProduct($scope.items);
                    break;
                case '2':
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + $scope.items.sku + '/' + $scope.items.list,
                    }).then(function successCallback(response) {
                        var key = $scope.items.key;

                        //precio base
                        var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)
                        $scope.items.article = response.data.product[0].item;

                        //precio mas los cargos o combos
                        $scope.quotations[key][0].forEach(j => {
                            if (j.cod_proceso == 2 || j.cod_proceso == 4) {
                                if ((j.sku != 'AV10') && (j.sku != 'AV12') && (j.sku != 'AV15') && (j.sku != 'IVAV')) {
                                    precio = precio + j.price;
                                }
                            }
                        });

                        //Calculo del AVAL
                        if ($scope.items.sku == 'AV10' || $scope.items.sku == 'AV12' || $scope.items.sku == 'AV15') {
                            $scope.items.price = Math.round((precio - (parseInt($scope.quotations[key][2]) + parseInt($scope.quotations[key][3].initial_fee))) * (parseInt(response.data.product[0].base_cost) / 100));

                            //Calculo del Retanqueo
                        } else if ($scope.items.sku == 'GPG1' || $scope.items.sku == 'GPG2') {
                            $scope.items.price = Math.round((precio - (parseInt($scope.quotations[key][2]) + parseInt($scope.quotations[key][3].initial_fee))) * (parseInt(response.data.product[0].base_cost) / 100));
                        } else {

                            //Calculo del IVA AVAL
                            if ($scope.items.sku == 'IVAV') {
                                var e = $scope.quotations[key][0];
                                for (let i = 0; i < e.length; i++) {
                                    if ((e[i].cod_proceso == 2) && ((e[i].sku == 'AV10') || (e[i].sku == 'AV12') || (e[i].sku == 'AV15'))) {
                                        $scope.items.price = Math.round(parseInt($scope.quotations[key][0][i].price) * (parseInt(response.data.product[0].base_cost) / 100));
                                    } else {
                                        $scope.items.price = 0
                                    }
                                }
                                //Cargo comun
                            } else {
                                $scope.items.price = parseInt(response.data.product[0].base_cost);
                            }
                        }
                        $scope.buttonDisabled = false;

                    }, function errorCallback(response) {
                        showAlert("error", "El código ingresado no existe");
                    });
                    break;

                case '3':
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getGift/' + $scope.items.sku,
                    }).then(function successCallback(response) {
                        $scope.items.article = response.data.product[0].item;
                        $scope.items.price = 0;
                        $scope.buttonDisabled = false;

                    }, function errorCallback(response) {
                        showAlert("error", "El código no es un obsequio");
                    });
                    break;


                case '4':
                    $scope.calcPriceProduct($scope.items);
                    break;
                default:
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + $scope.items.sku + '/' + $scope.items.list,
                    }).then(function successCallback(response) {
                        $scope.items.article = response.data.product[0].item;
                        $scope.items.price = 0;
                        $scope.buttonDisabled = false;
                    }, function errorCallback(response) {
                        showAlert("error", "El código ingresado no existe");
                    });
                    break;
            }
        };

        //Calculo del precio del producto
        $scope.calcPriceProduct = function (item) {
            $http({
                method: 'GET',
                url: '/api/liquidator/getProduct/' + item.sku + '/' + $scope.items.list,
            }).then(function successCallback(response) {
                item.article = response.data.product[0].item;
                if (response.data.product[0].type_product == '1') {

                    if (response.data.price.percentage_promotion_public_price) {
                        console.log(response.data.price.percentage_promotion_public_price);
                        $scope.discountTradicional.key = item.key
                        $scope.discountTradicional.type = 'Por lista';
                        $scope.discountTradicional.value = Math.floor(response.data.price.percentage_promotion_public_price);
                    }

                    if (response.data.price.percentage_oportuya_customer) {
                        $scope.discountOportuyaCard.key = item.key
                        $scope.discountOportuyaCard.type = 'Por lista';
                        $scope.discountOportuyaCard.value = Math.floor(response.data.price.percentage_oportuya_customer);

                        $scope.discountOportuyaCardBlack.key = item.key
                        $scope.discountOportuyaCardBlack.type = 'Por lista';
                        $scope.discountOportuyaCardBlack.value = Math.floor(response.data.price.percentage_oportuya_customer);
                    }
                    $scope.zone = response.data.zone;
                    item.price = response.data.price.normal_public_price;
                    item.price_cash = response.data.product[0].cash_cost;
                } else if (response.data.product[0].type_product == 5) {
                    //Incrementar el 10% 
                    item.price = response.data.product[0].cash_cost / 0.90;
                } else {
                    item.price = response.data.product[0].cash_cost;
                }
                item.type_product = response.data.product[0].type_product;
                $scope.buttonDisabled = false;
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
            $scope.buttonDisabled = true;
        };

        $scope.addDiscountTradicional = function (key) {
            $scope.discountTradicional.key = key;
            $('#addDiscountTradicional' + key).modal('show');
        };

        $scope.addDiscountOportuyaCard = function (key) {
            $scope.discountOportuyaCard.key = key;
            $('#addDiscountOportuyaCard' + key).modal('show');
        };

        $scope.addDiscountOportuyaCardBlack = function (key) {
            $scope.discountOportuyaCardBlack.key = key;
            $('#addDiscountOportuyaCardBlack' + key).modal('show');
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

        $scope.createItemQuotations = function () {
            var key = $scope.items.key;
            var list = $scope.items.list;
            $scope.quotations[key][0].push($scope.items);
            if ($scope.items.cod_proceso == 1 || $scope.items.cod_proceso == 4) {

                if ($scope.items.type_product == '1') {
                    if (!angular.equals($scope.discountTradicional, {})) {
                        $scope.quotations[key][9] = [];
                        $scope.quotations[key][9].push($scope.discountTradicional);
                    }

                    if (!angular.equals($scope.discountOportuyaCard, {})) {
                        $scope.quotations[key][10] = [];
                        $scope.quotations[key][10].push($scope.discountOportuyaCard);
                    }

                    if (!angular.equals($scope.discountOportuyaCardBlack, {})) {
                        $scope.quotations[key][11] = [];
                        $scope.quotations[key][11].push($scope.discountOportuyaCardBlack);
                    }

                    $scope.discountTradicional = {};
                    $scope.discountOportuyaCard = {};
                    $scope.discountOportuyaCardBlack = {};

                    $scope.discountOportuyaCard.key = key
                    $scope.discountOportuyaCard.type = 'Cliente Oportuya';

                    $scope.discountOportuyaCardBlack.key = key
                    $scope.discountOportuyaCardBlack.type = 'Cliente Oportuya';

                    if ($scope.zone == 'ALTA') {
                        $scope.discountOportuyaCardBlack.value = 5;
                        $scope.quotations[key][11].push($scope.discountOportuyaCardBlack);

                    } else {
                        $scope.discountOportuyaCardBlack.value = 10;
                        $scope.quotations[key][11].push($scope.discountOportuyaCardBlack);

                        $scope.discountOportuyaCardBlack = {};
                        $scope.discountOportuyaCardBlack.key = key
                        $scope.discountOportuyaCardBlack.type = 'Tarjeta Black';
                        $scope.discountOportuyaCardBlack.value = 5;
                        $scope.quotations[key][11].push($scope.discountOportuyaCardBlack);
                    }

                    if ($scope.zone == 'ALTA') {
                        $scope.discountOportuyaCard.value = 3;
                        $scope.quotations[key][10].push($scope.discountOportuyaCard);
                    } else {
                        $scope.discountOportuyaCard.value = 10;
                        $scope.quotations[key][10].push($scope.discountOportuyaCard);
                    }

                    $scope.discountOportuyaCard = {};
                    $scope.discountOportuyaCardBlack = {};
                }
            }

            $("#addItem" + key).modal("hide");
            showAlert("success", "Producto ingresado correctamente");

            // Calculo de Motos
            //Calculo AVAL10
            if ($scope.items.type_product == 5) {
                var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity);
                $scope.addChange(key, list, precio, '2', 'AV10', '1', "AVAL CREDIT 10 %", 10, 0);
            }

            //Insertar IVAV automatico
            if ($scope.items.sku == 'AV10' || $scope.items.sku == 'AV12' || $scope.items.sku == 'AV15') {
                var e = $scope.quotations[key][0];
                $scope.items = {};
                $scope.items.key = key
                $scope.items.sku = 'IVAV';
                $scope.items.quantity = '1';
                $scope.items.article = "IVA AVAL 19 %";
                if ($("#typeQuotations").val() == '3') {
                    $scope.items.list = $scope.fixedList;
                    $scope.items.cod_proceso = '5';
                    var type = 5
                } else {
                    $scope.items.list = list;
                    $scope.items.cod_proceso = '2';
                    var type = 2
                }

                for (let i = 0; i < e.length; i++) {
                    if ((e[i].cod_proceso == type) && ((e[i].sku == 'AV10') || (e[i].sku == 'AV12') || (e[i].sku == 'AV15'))) {
                        $scope.items.price = parseInt($scope.quotations[key][0][i].price) * (parseInt(19) / 100);
                    } else {
                        $scope.items.price = 0
                    }
                }

                //Calculo del IVA AVAL
                $scope.quotations[key][0].push($scope.items);
            }
            $scope.sumDiscount($scope.items.key);
            $scope.items = {};
        };


        $scope.createDiscountTradicionalQuotation = function () {
            $scope.quotations[$scope.discountTradicional.key][9].push($scope.discountTradicional);
            showAlert("success", "Descuento ingresado correctamente");
            $("#addDiscountTradicional" + $scope.discountTradicional.key).modal("hide");
            $scope.sumDiscount($scope.discountTradicional.key);
            $scope.discountTradicional = {};
        };

        $scope.createDiscountOportuyaCardQuotation = function () {
            $scope.quotations[$scope.discountOportuyaCard.key][10].push($scope.discountOportuyaCard);
            showAlert("success", "Descuento ingresado correctamente");
            $("#addDiscountOportuyaCard" + $scope.discountOportuyaCard.key).modal("hide");
            $scope.sumDiscount($scope.discountOportuyaCard.key);
            $scope.discountOportuyaCard = {};
        };


        $scope.createDiscountOportuyaCardBlackQuotation = function () {
            $scope.quotations[$scope.discountOportuyaCardBlack.key][11].push($scope.discountOportuyaCardBlack);
            showAlert("success", "Descuento ingresado correctamente");
            $("#addDiscountOportuyaCardBlack" + $scope.discountOportuyaCardBlack.key).modal("hide");
            $scope.sumDiscount($scope.discountOportuyaCardBlack.key);
            $scope.discountOportuyaCardBlack = {};
        };

        $scope.createQuotations = function () {
            var save = '';
            $scope.quotations.forEach(element => {
                save = element[5].total > 0;
            });
            if (save) {
                if ($scope.quotations[0][5].length > 0) {
                    $http({
                        method: 'POST',
                        url: '/Administrator/assessorquotations',
                        data: [$scope.quotations, $scope.lead, $scope.leadId]
                    }).then(function successCallback(response) {
                        if (response.data) {
                            $('#congratulations').modal('show');
                        }
                    }, function errorCallback(response) {
                    });
                } else {
                    showAlert("error", "Por favor ingrese todos los datos");
                }
            } else {
                showAlert("error", "Por favor termine de diligenciar la información");
            }
        };

        $scope.addFee = function (key) {
            var factor = 1;
            var iva = 0;
            var aval = 0;
            var totalAval = 0;
            var typeProduct = $scope.quotations[key][0][0].type_product;
            $scope.quotations[key][7] = []

            if ((typeProduct == 2 && $scope.quotations[key][3].term <= 12) || typeProduct != 2) {

                if ($scope.quotations[key][3].typeQuotation != 1) {
                    var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity);
                } else {
                    var precio = parseInt($scope.quotations[key][0][0].price_cash) * parseInt($scope.quotations[key][0][0].quantity);
                }

                if (typeProduct != 3) {
                    $scope.numberOfFees.forEach(e => {
                        if ($scope.quotations[key][3].typeQuotation != 1) {
                            if (e.CUOTA == $scope.quotations[key][3].term) {
                                factor = e.FACTOR;
                            }
                        }
                    });
                }

                $scope.quotations[key][0].forEach(j => {
                    if (j.cod_proceso == 2 || j.cod_proceso == 4) {
                        if ((j.sku != 'AV10') && (j.sku != 'AV12') && (j.sku != 'AV15') && (j.sku != 'IVAV')) {
                            precio = precio + j.price;
                        }
                    }

                    if (((j.sku == 'AV10') || (j.sku == 'AV12') || (j.sku == 'AV15')) && (j.cod_proceso == 2)) {
                        aval = j.price;
                    }

                    if ((j.sku == 'IVAV') && (j.cod_proceso == 2)) {
                        iva = j.price;
                    }
                });

                $scope.quotations[key][5] = [];

                totalAval = Math.round(parseInt(aval) + parseInt(iva));
                if ($scope.quotations[key][3].term != null) {
                    if (typeProduct != 3) {
                        $scope.quotations[key][3].value_fee = Math.round(((((precio - parseInt($scope.quotations[key][2])) + (totalAval)) - (parseInt($scope.quotations[key][3].initial_fee))) * factor))
                    } else {
                        $scope.quotations[key][3].value_fee = Math.round(((((precio - parseInt($scope.quotations[key][2])) + (totalAval)) - (parseInt($scope.quotations[key][3].initial_fee))) / parseInt($scope.quotations[key][3].term)))
                    }
                    $scope.quotations[key][7].push({ 'term': $scope.quotations[key][3].term, 'value_fee': $scope.quotations[key][3].value_fee });
                }
                
                if ($scope.quotations[key][3].typeQuotation != 1) {
                    $scope.quotations[key][5].total = Math.round((parseInt($scope.quotations[key][3].value_fee) * parseInt($scope.quotations[key][3].term)) + parseInt($scope.quotations[key][3].initial_fee))
                } else {
                    $scope.quotations[key][5].total = precio
                }

                $scope.quotations[key][4] = []
                $scope.quotations[key][4].aval = aval
                $scope.quotations[key][4].iva_aval = iva
                $scope.quotations[key][4].total_aval = totalAval
                $scope.quotations[key][4].push({ 'aval': aval, 'iva_aval': iva, 'total_aval': totalAval });

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


            } else {
                if ($scope.quotations[key][3].term) {
                    showAlert("error", "El plazo ingresado no es valido para esta cotización");
                    $scope.quotations[key][3].term = ''
                }
            }
            $scope.loader = false;
        };

        $scope.alterTypeQuatation = function (key, id) {
            $scope.quotations[key][3].typeQuotation = id;

            if (id == 1) {
                var type = 'Contado'
            } else if (id == 9) {
                var type = 'Tradicional'
            } else if (id == 10) {
                var type = 'Tarjeta Blue o Gray'
            } else {
                var type = 'Tarjeta Black'
            }

            $scope.refreshQuotations(key);
            var dataOpo = {
                'modulo': 'Cotizador',
                'proceso': 'Simulacion de credito tipo ' + type,
                'accion': 'Simulacion',
                'identificacion': type,
            };
            $http({
                method: 'POST',
                url: '/api/oportudataLog',
                data: dataOpo,
            }).then(function successCallback(response) {

            }, function errorCallback(response) {
                console.log(response);
            });
        }

        $scope.sumDiscount = function (key) {

            let total = 0;
            let precio = 0;
            let product = 0;
            let cuotaIni = 0
            let hasRetanqueoIva1 = 0;
            let hasRetanqueoIva2 = 0;
            let hasRetanqueo1 = 0;
            let hasRetanqueo2 = 0;
            let list = $scope.quotations[key][0][0].list;

            $scope.quotations[key][2] = 0;
            $scope.quotations[key][1] = [];
            $scope.quotations[key][1] = $scope.quotations[key][$scope.quotations[key][3].typeQuotation];

            if ($scope.quotations[key][0][0].price != 0) {
                precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)
            }

            $scope.quotations[key][0].forEach(j => {
                if (j.sku == 'GPG1') {
                    hasRetanqueoIva1 = 1
                } else if (j.sku == 'GPG2') {
                    hasRetanqueoIva2 = 1
                } else if (j.sku == 'EPG1') {
                    hasRetanqueo1 = 1
                } else if (j.sku == 'EPG2') {
                    hasRetanqueo2 = 2
                }

                if (j.cod_proceso == 4) {
                    precio = precio + parseInt(parseInt(j.price) * parseInt(j.quantity));
                }
            });

            product = precio;
            if ($scope.quotations[key][3].typeQuotation) {
                $scope.quotations[key][$scope.quotations[key][3].typeQuotation].forEach(e => {
                    total = (parseInt(e.value) / 100) * product;
                    $scope.quotations[key][2] = parseInt($scope.quotations[key][2]) + (total)
                    product = product - total;
                    total = 0;
                });
            }

            switch ($scope.quotations[key][3].plan_id) {
                case '1':
                    cuotaIni = 30000
                    break;
                case '3':
                    cuotaIni = 1
                    break;
                case '5':

                    if ($scope.quotations[key][3].check && hasRetanqueoIva2 == 0) {
                        $scope.addChange(key, list, precio, '2', 'GPG2', '1', "PERIODO GRACIA CAPITAL 2 MES", 4);

                    } else if (($scope.quotations[key][3].check == undefined || $scope.quotations[key][3].check == false) && hasRetanqueo2 == 0) {
                        $scope.addChange(key, list, precio, '2', 'EPG2', '1', "PERIODO GRACIA CAPITAL 2 MESES EXCLUIDO", 4);
                    }

                    cuotaIni = 30000
                    break;
                case '6':

                    if ($scope.quotations[key][3].check && hasRetanqueoIva1 == 0) {
                        $scope.addChange(key, list, precio, '2', 'GPG1', '1', "PERIODO GRACIA CAPITAL 1 MES", 2);
                    } else if (($scope.quotations[key][3].check == undefined || $scope.quotations[key][3].check == false) && hasRetanqueo1 == 0) {
                        $scope.addChange(key, list, precio, '2', 'EPG1', '1', "PERIODO GRACIA CAPITAL 1 MESES EXCLUIDO", 2);
                    }

                    cuotaIni = 30000
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
                    cuotaIni = 1
                    break;
                case '21':
                    cuotaIni = Math.round((precio - parseInt($scope.quotations[key][2])) * 0.08)
                    break;
                default:
                    break;
            }

            $scope.quotations[key][6] = []
            $scope.quotations[key][3].initialFeeFeedback = false;

            if ($scope.quotations[key][3].typeQuotation == 1) {
                cuotaIni = 0;
            }

            if ($scope.quotations[key][3].checkInitialFee == undefined || $scope.quotations[key][3].checkInitialFee == false) {
                $scope.quotations[key][3].initial_fee = cuotaIni;
            } else {
                if ($scope.quotations[key][3].initial_fee < cuotaIni) {
                    $scope.quotations[key][3].initial_fee = cuotaIni;
                    $scope.quotations[key][3].initialFeeFeedback = cuotaIni;
                }
            }

            $scope.quotations[key][6].push({ 'initial_fee': $scope.quotations[key][3].initial_fee });
            $timeout(() => {
                $scope.updateChargesQuotations(key);
            }, 500);

        };

        $scope.refreshQuotations = function (key) {
            $scope.sumDiscount(key);
            showAlert("success", "La cotización ha sido actualizada");
        };

        $scope.addChange = function (key, list, precio, code, sku, quanty, item, percentaje, reset = 1) {
            $scope.items = {};
            $scope.items.key = key;
            $scope.items.cod_proceso = code;
            $scope.items.list = list;
            $scope.items.sku = sku;
            $scope.items.quantity = quanty;
            $scope.items.article = item;

            //Calculo Retanqueo
            $scope.items.price = Math.round((precio - (parseInt($scope.quotations[key][2]) + parseInt($scope.quotations[key][3].initial_fee))) * (parseInt(percentaje) / 100));
            $scope.items.price_P = $scope.items.price;
            $scope.quotations[key][0].push($scope.items);
            if (reset == 1) {
                $scope.items = {};
            }
        }


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
                            url: '/api/liquidator/getProduct/' + product.sku + '/' + product.list,
                        }).then(function successCallback(response) {
                            var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)

                            $scope.quotations[key][0].forEach(j => {
                                if (j.cod_proceso == 2 || j.cod_proceso == 4) {
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

                        });
                    }
                }
            };
            $scope.updateIva(key);
        }

        $scope.updateIva = function (key) {
            var e = $scope.quotations[key][0];
            for (let i = 0; i < e.length; i++) {
                if (e[i].cod_proceso == 2 && e[i].sku == 'IVAV') {
                    var product = e[i];
                    $scope.quotations[key][0].splice(i, 1)
                    $http({
                        method: 'GET',
                        url: '/api/liquidator/getProduct/' + product.sku + '/' + product.list,
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

                    });
                }
            }
            $scope.loader = true;
            $timeout(() => {
                $scope.addFee(key);
            }, 3500);
        };

        $scope.updateChargesQuotations = function (key) {
            var e = $scope.quotations[key][0];
            for (let i = 0; i < e.length; i++) {
                var item = {};
                if (((e[i].sku == 'GPG1') || (e[i].sku == 'GPG2'))) {
                    if ((e[i].cod_proceso == 2)) {
                        var product = e[i];
                        $scope.quotations[key][0].splice(i, 1)
                        $http({
                            method: 'GET',
                            url: '/api/liquidator/getProduct/' + product.sku + '/' + product.list,
                        }).then(function successCallback(response) {
                            var precio = parseInt($scope.quotations[key][0][0].price) * parseInt($scope.quotations[key][0][0].quantity)
                            $scope.quotations[key][0].forEach(j => {
                                if (j.cod_proceso == 2 || j.cod_proceso == 4) {
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

                        });
                    }
                }
            };
            $scope.updateCharges(key);
        }

        $scope.removeItem = function (key) {
            $scope.quotations.splice(key, 1);
            if (key > 0) {
                $scope.tabItem = key - 1
            }
            showAlert("success", "El item se ha eliminado correctamente");
        };

        $scope.removeProduct = function (product) {
            $scope.quotations[product.key][0].splice($scope.quotations[product.key][0].indexOf(product), 1);
            showAlert("success", "El producto se ha eliminado correctamente");
        };

        $scope.removeDiscountTradicional = function (discount) {
            $scope.quotations[discount.key][9].splice($scope.quotations[discount.key][9].indexOf(discount), 1);
            showAlert("success", "El descuento se ha eliminado correctamente");
        };

        $scope.removeDiscountOportuyaCard = function (discount) {
            $scope.quotations[discount.key][10].splice($scope.quotations[discount.key][10].indexOf(discount), 1);
            showAlert("success", "El descuento se ha eliminado correctamente");
        };

        $scope.removeDiscountOportuyaCardBlack = function (discount) {
            $scope.quotations[discount.key][11].splice($scope.quotations[discount.key][11].indexOf(discount), 1);
            showAlert("success", "El descuento se ha eliminado correctamente");
        };

        $scope.addError = function (response, cedula = '') {
            if (response.statusText != 'Unauthorized') {
                var arrayData = {
                    url: response.url,
                    mensaje: response.data.message,
                    archivo: response.data.file,
                    linea: response.data.line,
                    cedula: cedula,
                    datos: (response.datos) ? response.datos : [],
                    navegador: navigator.userAgent
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
            } else {
                location.reload();
            }
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

        $scope.validateStep2 = function () {
            $scope.loader = true;
            $scope.createQuotations()
            $scope.loader = false;
        };

        $scope.nextStep = function () {
            $scope.loader = true;
            var save = '';
            $scope.quotations.forEach(element => {
                save = element[5].total > 0;
            });
            if (save) {
                $scope.step = 2;
            } else {
                showAlert("error", "Por favor termine de diligenciar la información");
            }
            $scope.loader = false;
        };

        $scope.prevStep = function () {
            $scope.loader = true;
            $scope.step = 1;
            $scope.loader = false;
        };

        $scope.checkLead = function () {
            $scope.loader = true;
            if ($('#lead').val() != '') {
                $scope.leadId = $('#lead').val();
                $scope.step = 1;
                $scope.showButtonLead = true;
            }
            $scope.loader = false;
        };

        $scope.checkLead();
        $scope.getPlans();
        $scope.listDiscount();
        $scope.listOfFees();
        $scope.getList();
        $scope.addItem()

    });

