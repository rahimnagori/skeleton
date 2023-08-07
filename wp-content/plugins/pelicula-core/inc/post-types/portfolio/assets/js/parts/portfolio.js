(function($) {
	'use strict';

	$(window).on('load', function () {
		qodefPortfolio.init();
	});

	$(window).scroll(function () {
		qodefPortfolio.stickyHolderPosition();
	});

	var qodefPortfolio = {

		params: {
			info: $('.qodef-follow-portfolio-info .qodef-portfolio-single-item .qodef-ps-info-sticky-holder')
		},

	    init: function () {
			if (qodef.windowWidth > 1024 && this.params.info.length) {
				this.params.infoHolderHeight = this.params.info.height();
				this.params.mediaHolder = $('.qodef-media');
				this.params.mediaHolderHeight = this.params.mediaHolder.height();
				this.params.mediaHolderOffset = this.params.mediaHolder.offset().top;
				this.params.mediaHolderItemSpace = parseInt(this.params.mediaHolder.find('.qodef-grid-item:last-of-type').css('marginBottom'), 10);
				this.params.header = $('#qodef-page-header');
				this.params.headerHeight = this.params.header.length ? this.params.header.height() : 0;

				qodefPortfolio.stickyHolderPosition();
			}
		},

		stickyHolderPosition: function () {
			if (qodef.windowWidth > 1024 && this.params.info.length) {
				if(this.params.mediaHolderHeight >= this.params.infoHolderHeight) {
					this.params.scrollValue = qodef.scroll;

					//Calculate header height if header appears
					if(this.params.scrollValue > 0 && this.params.header.length) {
						this.params.headerHeight = this.params.header.height();
					}

					this.params.headerMixin = this.params.headerHeight + qodefGlobal.vars.adminBarHeight;
					if(this.params.scrollValue >= this.params.mediaHolderOffset - this.params.headerMixin) {
						if(this.params.scrollValue + this.params.infoHolderHeight >= this.params.mediaHolderHeight + this.params.mediaHolderOffset - this.params.mediaHolderItemSpace - this.params.headerMixin) {
							this.params.info.stop().animate({
								marginTop: this.params.mediaHolderHeight - this.params.mediaHolderItemSpace - this.params.infoHolderHeight
							});
							//Reset header height
							this.params.headerHeight = 0;
						} else {
							this.params.info.stop().animate({
								marginTop: this.params.scrollValue - this.params.mediaHolderOffset + this.params.headerMixin
							});
						}
					} else {
						this.params.info.stop().animate({
							marginTop: 0
						});
					}
				}
			}
		}
	};
	
})(jQuery);