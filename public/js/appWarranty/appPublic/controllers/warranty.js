	/**
     /Project: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controler to display a warranty request form public view.
    **Date: 05/03/2019
     **/
app.controller('warrantyController', function($scope, $http, $location){

	$scope.typeRequestes = [{id:'1',name:'Garantía legal'},
					{id:'2',name:'Garantía suplementaria'} ];
					

	$scope.products = [{id:'1',name:'Televisor'},
					{id:'2',name:'Blue Ray'},
					{id:'3',name:'Xbox'},
					{id:'4',name:'Sonido'},
					{id:'5',name:'Torre (sonido)'},
					{id:'6',name:'Consola Audio'},
					{id:'7',name:'Mini Componente'},
					{id:'8',name:'Celular'},
					{id:'9',name:'Tablet'},
					{id:'10',name:'Phablet'},
					{id:'11',name:'Cama'},
					{id:'12',name:'Colchón y Base cama'},
					{id:'13',name:'Sofacama'},
					{id:'14',name:'Mesa de sala'},
					{id:'15',name:'Comedor'},
					{id:'16',name:'Olla Arrocera'},
					{id:'17',name:'Licuadora'},
					{id:'18',name:'Ventilador'},
					{id:'19',name:'Linterna'},
					{id:'20',name:'Sanduchera'},
					{id:'21',name:'Plancha para Cabello'},
					{id:'22',name:'Secador de Cabello'},
					{id:'23',name:'Plancha y Secador'},
					{id:'24',name:'Computador de Escritorio'},
					{id:'25',name:'All in one'},
					{id:'26',name:'Multifuncional'},
					{id:'27',name:'Estufa'},
					{id:'28',name:'Campana de Estufa'},
					{id:'29',name:'Horno'},
					{id:'30',name:'Lavadora'},
					{id:'31',name:'Secadora'},
					{id:'32',name:'Lavadora-Secadora'},
					{id:'33',name:'Congelador'},
					{id:'34',name:'Vitrina'},
					{id:'35',name:'Aire Acondicionado'},
					{id:'36',name:'Nevera'},
					{id:'37',name:'Nevecon'},
					{id:'38',name:'Teatro en Casa'} ];

	$scope.brands = [{id:'1',name:'LG'},{id:'2',name:'Samsung'},
					{id:'3',name:'Hyundai'},{id:'4',name:'Philips'},
					{id:'5',name:'Panasonic'},{id:'6',name:'Espumas del Valle'},
					{id:'7',name:'Sony'},{id:'8',name:'Daewoo'},
					{id:'9',name:'Goldstar'},{id:'10',name:'VTA'},
					{id:'11',name:'LGB'},{id:'12',name:'Lenovo'},
					{id:'13',name:'Apple'},{id:'14',name:'Nokia'},
					{id:'15',name:'Motorola'},{id:'16',name:'Huawei'},
					{id:'17',name:'Alcatel'},{id:'18',name:'ZTE'},
					{id:'19',name:'Spring'},{id:'20',name:'Espumados del Litoral'},
					{id:'21',name:'Muebles Dahiana'},{id:'22',name:'Fantasía'},
					{id:'23',name:'Oporto'},{id:'24',name:'Home Elements'},
					{id:'25',name:'Universal'},{id:'26',name:'Landers'},
					{id:'27',name:'HP'},{id:'28',name:'Epson'},
					{id:'29',name:'Compaq'},{id:'30',name:'Toshiba'},
					{id:'31',name:'Dell'},{id:'32',name:'Acer'},
					{id:'33',name:'Asus'},{id:'34',name:'Inducol'},
					{id:'35',name:'Lanix'},{id:'36',name:'Ecofrial'},
					{id:'37',name:'Philips'},{id:'38',name:'Haceb'},
					{id:'39',name:'Mabe'},{id:'40',name:'Centrales'}];			
	$scope.WarrantyRequest = {};//Request Data
	$scope.meansSales = [{id:1,name:'PÁGINA OPORTUNIDADES'},
						{id:2,name:'MERCADO LIBRE'},
						{id:3,name:'PÁGINA ÉXITO'},
						{id:4,name:'PÁGINA  LINIO'},
						{id:5,name:'ALMACEN'}]
	//store locatios
	$scope.departamentos = [{id:1,name:'Caldas',cities:[{id:1,name:'Chinchiná',stores:['CR 8 No. 8-19']},{id:2,name:'Manizales',stores:['CR. 22 No. 23-51']},{id:3,name:'La Dorada',stores:['CR. 2 No. 14 – 35/37 ']}]},
						{id:3,name:'Meta',cities:[{id:4,name:'Villavicencio',stores:['CR 29 No. 37-16/18']},{id:5,name:'Granada',stores:['CR 13 No.22-30']},{id:6,name:'Puerto Lopez',stores:['CL 5 No. 7-17']},{id:7,name:'ACACIAS',stores:['CR 18 No. 13-35 BRR CEN ']}]},{id:4,name:'Valle del Cauca',cities:[{id:8,name:'Tuluá',stores:['CL 25 No. 22-60']}]},
						{id:5,name:'Risaralda',cities:[{id:9,name:'Pereira',stores:['CR 8 No. 20-51 ','CR 8 No. 21-18 ']},{id:10,name:'Santa Rosa',stores:['CR 14 No. 15 – 63']},{id:11,name:'La virginia',stores:['LC Comercial CR. 7 No. 8-28 ']}]},{id:6,name:'Quindío',cities:[{id:12,name:'Armenia',stores:['CR 17 No. 19-48 ','CR 18 No. 20-00 ']}]},
						{id:7,name:'Tolima',cities:[{id:13,name:'Mariquita',stores:['CR 4 No. 7-28/30 ']},{id:14,name:'Espinal',stores:['CR 4 No. 8-25 ']},{id:15,name:'Ibagué',stores:['CR. 2 No. 15-42']}]},{id:8,name:'Casanare',cities:[{id:16,name:'Aguazul',stores:['CL 10 No.15-49 ']},{id:17,name:'Yopal',stores:['CR 21 No. 8-31 ']},{id:18,name:'Villanueva',stores:['CL 11 No. 10-03 ']}]},
						{id:9,name:'Córdoba',cities:[{id:20,name:'Lorica',stores:['CL 4 A No.23-19 ']},{id:21,name:'Sahagun',stores:['CL 14 No. 8-58 ']},{id:22,name:'Planeta Rica',stores:['CL 20 No. 7-46 ']},{id:23,name:'Montelibano',stores:['CR 13 No. 14A–67 LC 1 ESQ']},{id:24,name:'Monteria',stores:['CL 30 No. 2-28']},{id:25,name:'Cereté',stores:['CR15 No. 9A-30 LC 6 AV. Santader ']}]},{id:10,name:'Sucre',cities:[{id:26,name:'Sincelejo',stores:['CR 26 No. 32-55 BRR San Juan Centro','CL 22 No.18 - 04 LCl 103 CEN ']},{id:27,name:'Corozal',stores:['CR 26 No. 32-55 BRR San Juan Centro']}]},
						{id:12,name:'Antioquia',cities:[{id:28,name:'Puerto Berrio',stores:['CR 4 ED David-Premier No. 53-27/25 CENTRO']}]},
						{id:13,name:'Boyacá',cities:[{id:29,name:'Puerto Boyacá',stores:['CR 2 con CL 13 ESQ No. 12-79 CENTRO']}]},{id:14,name:'Cesar',cities:[{id:30,name:'Aguachica',stores:['CL 5 No. 22-33']}]},
						{id:15,name:'Santander',cities:[{id:31,name:'Barrancabermeja',stores:['CL 49 No. 11ª-47 Edificio Los Balcones (Sector Comercial)']}]},{id:16,name:'Cundinamarca',cities:[{id:32,name:'Girardot',stores:['CL 16 No. 10 – 41 BRR CEN ']}]},
						{id:17,name:'Bolívar',cities:[{id:33,name:'Magangué',stores:['Sector Centro CL 11 No.3-11Calle del Colegio Piso 1 ']}]},{id:18,name:'Huila',cities:[{id:34,name:'Garzon',stores:['CR 11 No. 8-36 LC Comercial']},{id:35,name:'Pitalito',stores:['CL 7 No. 5- 41 Primer piso ']}]}];
	
	
	// watch a departamento changes in order to update a cities list
	$scope.$watch("WarrantyRequest.departamento",function(newValue,oldValue) {

		if (newValue===oldValue) {
			return;
		}
		$scope.cities=newValue.cities;
	},true);
	// watch a city changes in order to update a stores list
	$scope.$watch("WarrantyRequest.city",function(newValue,oldValue) {

		if (newValue===oldValue) {
			return;
		}
		$scope.stores=newValue.stores;
	},true);

});
	/*
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
	$scope.details = true; // show a details of a selected product
	$scope.showProducts = true; 

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

	$scope.showDetails = function(product){
		color = $scope.linesBrands[product.line].color.substr(1,);
		$location.url("details/" + product.id + "/" + product.line + "/" + color);
	};

	$scope.getLinesBrands();
	$scope.getProducts();
	*/
