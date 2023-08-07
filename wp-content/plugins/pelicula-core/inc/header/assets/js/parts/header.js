(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHeaderScrollAppearance.init();
		qodefAnimateLogoLineThrough.init();
	});
	
	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodefCore.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();
			
			if (appearanceType !== '' && appearanceType !== 'none') {
                qodefCore[appearanceType + "HeaderAppearance"]();
			}
		}
	};

	var qodefAnimateLogoLineThrough = {
		init: function () {
			var $holder = $('.qodef-textual-logo.qodef--line-through');
			
			if ($holder.length) {
				$holder.addClass('qodef--animate-line-through');
			}
		}
	};
	
})(jQuery);
