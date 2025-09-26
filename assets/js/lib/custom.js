/* global jQuery */
jQuery(window).scroll(function () {
	if (jQuery(window).scrollTop() >= 100) {
		jQuery('.js_headermain').addClass('fixed-header');
	} else {
		jQuery('.js_headermain').removeClass('fixed-header');
	}
});

