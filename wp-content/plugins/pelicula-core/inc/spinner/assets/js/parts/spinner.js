(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSpinner.init();
	});

	$(window).on('elementor/frontend/init', function() {
		var isEditMode = Boolean(elementorFrontend.isEditMode());
        if (isEditMode) {
			qodefSpinner.init(isEditMode);
		}
    });
	
	var qodefSpinner = {
		init: function (isEditMode) {
			this.holder = $('#qodef-page-spinner');
			
			if (this.holder.length) {
				qodefSpinner.animateSpinner(this.holder, isEditMode);
			}
		},
		animateSpinner: function ($holder, isEditMode) {
			$(window).on('load', function () {
				qodefSpinner.fadeOutLoader($holder);
			});

			if (isEditMode) {
				qodefSpinner.fadeOutLoader($holder);
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			// Pelicula Spinner
			$holder.hasClass('qodef-layout--pelicula') ? delay = 2300 : null;
			var landingRev = $('#qodef-landing-rev').find('rs-module');
			if (landingRev.length) {
				setTimeout(function() {
					landingRev.revstart();
				}, 2300);
			}

			$holder.delay(delay).fadeOut(speed, easing);

			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	}
	
})(jQuery);