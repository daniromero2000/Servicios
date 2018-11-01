$( document ).ready(function() {
	var inputs = $('input');
	for (var i = 0; i < inputs.length; i++) {
		var name = "";
		var typeInput = "";
		if(inputs[i].getAttribute('type') != 'hidden'){
			name = getNameInput(inputs[i]);
			typeInput = inputs[i].getAttribute('type');
			switch(typeInput) {
			    case 'number':
			    	if(name == 'age' || name == 'edad' || name == "anos" || name == "anios"){
			    		validateAge(inputs[i]);
			    	}
			        break;

			    case 'text':
			        if(name == 'name' || name == "nombre" || name == "names" || name == "nombres" || name == "lastName" || name == "last_name" || name == "apellidos"){
			        	validateNameAndLastName(inputs[i]);
			        }else if(name == "telefono" || name == "tel" || name == "telephone" || name == "celphone" || name == "celular" || name == "cel"){
			        	validateTelephoneAndCelphone(inputs[i]);
			        }
			        break;

			    case 'email':
			    	validateEmail(inputs[i]);
			    	break;
			}
		}
	}

	function getNameInput(input){
		var name = "";
		if(input.getAttribute('ng-model')){
			var ngModel = input.getAttribute('ng-model');
			ngModel = ngModel.split('.');
			var countNgModel = ngModel.length;
			if(countNgModel > 1){
				name = ngModel[countNgModel - 1];
			}else{
				name = input.getAttribute('ng-model');
			}
		}else if(input.getAttribute('name')){
			name = input.getAttribute('name');
		}

		return name;
	}

	function setAttributePatternInput(input, pattern){
		var typePattern = (input.getAttribute('ng-model') ? 'ng-pattern' : 'pattern' );
		input.setAttribute('pattern', pattern);
	}

	/*Type Text*/

	function validateNameAndLastName(input){
		var patt ="(([a-zA-Z]+([\\.]?)[a-zA-Z]*)\\s{0,1}){1,3}";
		setAttributePatternInput(input, patt);
	}

	function validateTelephoneAndCelphone(input){
		var patt = "(\\+57)?\\s?3((\\d{6})|(\\d{9}))";
		setAttributePatternInput(input, patt);
	}

	/*Type Email*/
	function validateEmail(input){
		var patt = "\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,4})+";
		setAttributePatternInput(input, patt);
	}

	/* Type Number */
	function validateNumber(input){
		var patt = new RegExp("[0-9*]");
		setAttributePatternInput(input, patt);
	};
	/* Age */
	function validateAge(input) {
		input.setAttribute('min', '1');
		input.setAttribute('max', '127');
	}
});