angular.module('appStep3', ['moment-picker'])
.controller("step3Ctrl", function($scope, $http) {
	$scope.leadInfo = {
		nit: '',
		indicative: '',
		companyName: '',
		companyAddres: '',
		companyTelephone: '',
		companyTelephone2: '',
		eps: '',
		companyPosition: '',
		admissionDate: '',
		antiquity: '',
		salary: '',
		typeContract: '',
		otherRevenue: '',
		camaraComercio: '',
		whatSell:'',
		dateCreationCompany: '',
		bankSavingsAccount:''
	};

	$scope.typesContracts = [
		{
			value: 'fijo',
			label: 'Fijo'
		},
		{
			value: 'indefinido',
			label: 'indefinido'
		}
	];

	$scope.typesCamaraComercio = [
		{
			value: 'Si',
			label: 'Si'
		},
		{
			value: 'No',
			label: 'No'
		}
	];
});