$( document ).ready(function() {

	$("input").keyup(function(){

		var form = "";
		var input = this;
		var parent = input;

		while(form != 'FORM'){
			parent = parent.parentNode;	
			form = parent.nodeName;
		}
		
		var name = "";
		var idForm = parent.getAttribute('id');
		var button = $("#"+idForm+' button[type="submit"]');		
		var typeInput = this.getAttribute('type');

		if(this.getAttribute('ng-model')){
			var ngModel = this.getAttribute('ng-model');
			ngModel = ngModel.split('.');
			var countNgModel = ngModel.length;
			if(countNgModel > 1){
				name = ngModel[countNgModel - 1];
			}else{
				name = this.getAttribute('ng-model');
			}
		}else if(this.getAttribute('name')){
			name = this.getAttribute('name');
		}
		switch(typeInput) {

		    case 'number':
		    	validateNumber(this, button);
		    	if(name == 'age' || name == 'edad' || name == "anos" || name == "anios"){
		    		validateAge(this, button);
		    	}
		        break;

		    case 'text':
		        if(name == 'name' || name == "nombre" || name == "names" || name == "nombres" || name == "lastName" || name == "last_name" || name == "apellidos"){
		        	validateNameAndLastName(this, button);
		        }else if(name == "telefono" || name == "tel" || name == "telephone" || name == "celphone" || name == "celular" || name == "cel"){
		        	validateTelephoneAndCelphone(this, button);
		        }
		        break;

		    case 'email':
		    	validateEmail(this, button);
		    	break;
		}

	});


	/* Type Number */
	function validateNumber(input, button){
		var patt = new RegExp("[0-9*]");
		defineInputTest(patt, input, button);
	};

	function validateAge(input, button) {
		if(input.value >= 1 && input.value <= 127){
			addInputStyleTrue(input);
			button[0].removeAttribute('disabled');
			button.css('cursor','pointer');
		}else{
			button[0].setAttribute('disabled', 'true');
			button.css('cursor','not-allowed');
			addInputStyleFalse(input);
		}
	}


	/* Type Email */
	function validateEmail(input, button){
		var patt = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/);
		defineInputTest(patt, input, button);
	}

	
	/* Type Text */
	function validateNameAndLastName(input, button){
		var patt = new RegExp(/^(([a-zA-Z]+([\.]?)[a-zA-Z]*)\s{0,1}){1,3}$/);
		defineInputTest(patt, input, button);
	}

	function validateTelephoneAndCelphone(input, button){
		var patt = new RegExp(/^(\+57)?\s?3((\d{6})|(\d{9}))$/);
		defineInputTest(patt, input, button);
	}

	/* Funciones Privadas */
	function defineInputTest(patt, input, button){
		var value = input.value;
		var required = (input.getAttribute('required') == 'true') ? true : false ;
		if(patt.test(value)){
			button[0].removeAttribute('disabled');
			button.css('cursor','pointer');
			addInputStyleTrue(input);
		}else{
			if(required === true){
				button[0].setAttribute('disabled', 'true');
				button.css('cursor','not-allowed');
			}else{
				if(value != ""){
					button[0].setAttribute('disabled', 'true');
					button.css('cursor','not-allowed');
				}
			}
			addInputStyleFalse(input);
		}
	}
	
	function addInputStyleFalse(input){
		input.setAttribute('style', 'box-shadow: -webkit-box-shadow: 0px 0px 17px -1px rgba(201,18,18,1);-moz-box-shadow: 0px 0px 17px -1px rgba(201,18,18,1);box-shadow: 0px 0px 17px -1px rgba(201,18,18,1);');
	}

	function addInputStyleTrue(input){
		input.setAttribute('style', '-webkit-box-shadow: 1px 0px 0px -200px rgba(201,18,18,1);-moz-box-shadow: 1px 0px 0px -200px rgba(201,18,18,1);box-shadow: 1px 0px 0px -200px rgba(201,18,18,1);');
	}

});