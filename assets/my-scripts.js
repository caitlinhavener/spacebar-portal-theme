

jQuery(document).ready(function () {
    //mdc.ripple.MDCRipple.attachTo(document.querySelector('.mdc-text-field'));
    //mdc.ripple.MDCRipple.attachTo(document.querySelector('.foo-button'));


	const MDCTextField = mdc.textField.MDCTextField;
    //const textField = new MDCTextField(document.querySelector('.mdc-text-field'));

    const textFields = [].map.call(document.querySelectorAll('.mdc-text-field'), function(el) {
	  return new MDCTextField(el);
	});

});