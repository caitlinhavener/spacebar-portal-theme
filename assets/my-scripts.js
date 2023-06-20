function startMaterialGravityFields(){
	const MDCTextField = mdc.textField.MDCTextField;
    //const textField = new MDCTextField(document.querySelector('.mdc-text-field')); //this instantiates only one input text field

    var textFields = [].map.call(document.querySelectorAll('.mdc-text-field'), function(el) { //this instatiates multiple input text fields
	  return new MDCTextField(el);
	});


    const MDCRadio = mdc.radio.MDCRadio;
    const MDCFormField = mdc.formField.MDCFormField;

	var radio = new MDCRadio(document.querySelector('.mdc-radio'));
	var formField = new MDCFormField(document.querySelector('.mdc-form-field')); //see if you can instatiates this on multple fields like I did above
	formField.input = radio; //this appears to instatitate the radio within the input (??)

	/*
		When the documentation instatiates modules like the following:
		import {MDCCatPaw} from '@material/form-field';
		import {MDCKittyPurr} from '@material/radio'; ...

		To instatiate that with the CDN, instead:
		const MDCCatPaw = mdc.catPaw.MDCCatPaw;
		const MDCKittyPurr = mdc.kittyPurr.MDCKittyPurr;

		Follow that pattern for instatiating all types of Material fields! 
	*/
}

jQuery(document).ready(function () { //make sure all of the html elements on the page have loaded
	startMaterialGravityFields();
});