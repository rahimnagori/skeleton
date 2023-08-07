(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_button = {};

	$(document).ready(function () {
		qodefButton.init();
	});

	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');
			qodefButton.initShopButtonsWithBgAnimation();

			if (this.buttons.length) {
				qodefButton.initButtonsWithBgAnimation();

				this.buttons.each(function () {
					var $thisButton = $(this);

					qodefButton.buttonBgAnimation($thisButton);
					qodefButton.buttonHoverColor($thisButton);
					qodefButton.buttonHoverBgColor($thisButton);
					qodefButton.buttonHoverBorderColor($thisButton);
				});
			}
		},
		buttonHoverColor: function ($button) {
			if (typeof $button.data('hover-color') !== 'undefined') {
				var hoverColor = $button.data('hover-color');
				var originalColor = $button.css('color');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'color', hoverColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'color', originalColor);
				});
			}
		},
		buttonHoverBgColor: function ($button) {
			if (typeof $button.data('hover-background-color') !== 'undefined' && !$button.hasClass('qodef-layout--with-bg-holder')) {
				var hoverBackgroundColor = $button.data('hover-background-color');
				var originalBackgroundColor = $button.css('background-color');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'background-color', hoverBackgroundColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'background-color', originalBackgroundColor);
				});
			}
		},
		buttonHoverBorderColor: function ($button) {
			if (typeof $button.data('hover-border-color') !== 'undefined') {
				var hoverBorderColor = $button.data('hover-border-color');
				var originalBorderColor = $button.css('borderTopColor');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'border-color', hoverBorderColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'border-color', originalBorderColor);
				});
			}
		},
		changeColor: function ($button, cssProperty, color) {
			$button.css(cssProperty, color);
		},
		initButtonsWithBgAnimation: function () {
			var $buttons = $('.qodef-layout--outlined, .qodef-layout--filled, .qodef-type--filled');
			$buttons.length ? $buttons.addClass('qodef-layout--with-bg-holder') : null;
		},
		initShopButtonsWithBgAnimation: function () {
			var $buttons = $('.add_to_cart_button, .single_add_to_cart_button, .button.product_type_simple, .price_slider_amount .button');
			if ($buttons.length) {
				$buttons.addClass('qodef-layout--with-bg-holder qodef-layout--shop-button');
				$buttons.append('<div class="qodef-btn-bg-holder"></div>');
			}
		},
		buttonBgAnimation: function ($button) {
			if ($button.hasClass('qodef-layout--with-bg-holder')) {
				$button.append('<div class="qodef-btn-bg-holder"></div>');
				if (typeof $button.data('hover-background-color') !== 'undefined') {
					var hoverBgColor = $button.data('hover-background-color');
					$button.find('.qodef-btn-bg-holder').css('background-color', hoverBgColor);
				}
				if ($button.hasClass('qodef-layout--filled')) {
					if (typeof $button.data('hover-background-color') !== 'undefined') {
						var filledHoverBgColor = $button.data('hover-background-color');
						$button.css('background-color', filledHoverBgColor);
					} else {
						$button.css('background-color', 'transparent');
					}
					if (typeof $button.data('background-color') !== 'undefined') {
						var BgColor = $button.data('background-color');
						$button.find('.qodef-btn-bg-holder').css('background-color', BgColor);
					}
				}
			}
		}
	};

	qodefCore.shortcodes.pelicula_core_button.qodefButton = qodefButton;


})(jQuery);
