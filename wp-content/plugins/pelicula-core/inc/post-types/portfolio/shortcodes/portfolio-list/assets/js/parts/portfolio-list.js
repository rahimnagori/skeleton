(function ($) {
	
    "use strict";
	qodefCore.shortcodes.pelicula_core_portfolio_list = {};
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefMainContent = qodef.qodefMainContent;
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefMagnificPopup = qodef.qodefMagnificPopup;

	$(document).ready(function () {
		qodefPortfolioListSlider.init();
	});

	var qodefPortfolioListSlider = {
		init: function () {
			var $holder = $('.qodef-portfolio-list.qodef-slider-layout--predefined2');

			if ($holder.length) {
				$holder.each(function() {
					var $thisHolder = $(this),
						thisSwiper = $thisHolder[0].swiper;

					thisSwiper.on('touchMove', function() {
						$thisHolder.addClass('qodef-slider--dragging');
					});

					thisSwiper.on('touchEnd', function() {
						setTimeout(function() {
							$thisHolder.removeClass('qodef-slider--dragging');
						}, 100);
					});
				});
			}
		}
	}

})(jQuery);