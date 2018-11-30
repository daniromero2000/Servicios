$( document ).ready(function() {
	var inputs = $('input');
	for (var i = 0; i < inputs.length; i++) {
		var name = "";
		var typeInput = "";
		
		if(inputs[i].getAttribute('type') != 'hidden'){
			name = getTypeValidationInput(inputs[i]);
			switch(name) {
			    case 'number':
			    	validateNumber(inputs[i]);
			        break;

			    case 'name':
			        validateName(inputs[i]);
			        break;

		        case 'telephone':
		        	validateTelephoneAndCelphone(inputs[i]);
		        	break;

	        	case 'text':
	        		validateText(inputs[i]);
	        		break;

	        	case 'textOnly':
	        		validateTextOnly(inputs[i]);
	        		break;

			    case 'email':
			    	validateEmail(inputs[i]);
			    	break;
			}
		}
	}

	function getTypeValidationInput(input){
		var name = "";
		name = input.getAttribute('validation-pattern');
		return name;
	}

	function setAttributePatternInput(input, pattern){
		var typePattern = (input.getAttribute('ng-model') ? 'ng-pattern' : 'pattern' );
		input.setAttribute('pattern', pattern);
	}

	/*Type Text*/

	function validateName(input){
		var patt ="(([a-zA-Z]+([\\.]?)[a-zA-Z]*)\\s{0,1}){1,3}";
		setAttributePatternInput(input, patt);
	}

	function validateText(input){
		var patt ="((\\w*([\\.]?)(#?)(-?))\\s{0,1})+";
		setAttributePatternInput(input, patt);
	}

	function validateTelephoneAndCelphone(input){
		var patt = "(\\+57)?\\s?3((\\d{6})|(\\d{9}))";
		setAttributePatternInput(input, patt);
	}

	function validateTextOnly(input){
		var patt = "([a-zA-Z]+\\s?)+";
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