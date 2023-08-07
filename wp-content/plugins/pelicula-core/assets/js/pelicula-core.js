(function ($) {
	"use strict";

	// This case is important when theme is not active
	if (typeof qodef !== 'object') {
		window.qodef = {};
	}

	window.qodefCore = {};
	qodefCore.shortcodes = {};

	qodefCore.body = $('body');
	qodefCore.html = $('html');
	qodefCore.windowWidth = $(window).width();
	qodefCore.windowHeight = $(window).height();
	qodefCore.scroll = 0;

	$(document).ready(function () {
		qodefCore.scroll = $(window).scrollTop();
		qodefInlinePageStyle.init();
	});

	$(window).resize(function () {
		qodefCore.windowWidth = $(window).width();
		qodefCore.windowHeight = $(window).height();
	});

	$(window).scroll(function () {
		qodefCore.scroll = $(window).scrollTop();
	});

	var qodefScroll = {
		disable: function(){
			if (window.addEventListener) {
				window.addEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function(){
			if (window.removeEventListener) {
				window.removeEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function(e){
			e = e || window.event;
			if (e.preventDefault) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function(e) {
			var keys = [37, 38, 39, 40];
			for (var i = keys.length; i--;) {
				if (e.keyCode === keys[i]) {
					qodefScroll.preventDefaultValue(e);
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ($holder) {
			if ($holder.length) {
				qodefPerfectScrollbar.qodefInitScroll($holder);
			}
		},
		qodefInitScroll: function ($holder) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar($holder[0], $defaultParams);
			$(window).resize(function () {
				$ps.update();
			});
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $('#pelicula-core-page-inline-style');

			if (this.holder.length) {
				var style = this.holder.data('style');

				if (style.length) {
					$('head').append('<style type="text/css">' + style + '</style>');
				}
			}
		}
	};

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefAgeVerificationModal.init();
	});
	
	var qodefAgeVerificationModal = {
		init: function () {
			this.holder = $('#qodef-age-verification-modal');
			
			if (this.holder.length) {
				var $preventHolder = this.holder.find('.qodef-m-content-prevent');
				
				if ($preventHolder.length) {
					var $preventYesButton = $preventHolder.find('.qodef-prevent--yes');
					
					$preventYesButton.on('click', function () {
						var cname = 'disabledAgeVerification';
						var cvalue = 'Yes';
						var exdays = 7;
						var d = new Date();
						
						d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
						var expires = "expires=" + d.toUTCString();
						document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
						
						qodefAgeVerificationModal.handleClassAndScroll('remove');
					});
				}
			}
		},
		
		handleClassAndScroll: function (option) {
			if (option === 'remove') {
				qodefCore.body.removeClass('qodef-age-verification--opened');
				qodefCore.qodefScroll.enable();
			}
			if (option === 'add') {
				qodefCore.body.addClass('qodef-age-verification--opened');
				qodefCore.qodefScroll.disable();
			}
		},
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefBackToTop.init();
    });

    var qodefBackToTop = {
        init: function () {
            this.holder = $('#qodef-back-to-top');

            if(this.holder.length) {
                // Scroll To Top
                this.holder.on('click', function (e) {
                    e.preventDefault();
                    qodefBackToTop.animateScrollToTop();
                });
    
                qodefBackToTop.showHideBackToTop();
            }
        },
        animateScrollToTop: function() {
            var startPos = qodef.scroll,
                newPos = qodef.scroll,
                step = .9,
                animationFrameId;

           var startAnimation = function() {
                if (newPos === 0) return;
                newPos < 0.0001 ? newPos = 0 : null;
                var ease = qodefBackToTop.easingFunction((startPos - newPos) / startPos);
                $('html, body').scrollTop(startPos - (startPos - newPos) * ease);
                newPos = newPos * step;
    
                animationFrameId = requestAnimationFrame(startAnimation)
            }
            startAnimation();
            $(window).one('wheel touchstart', function() {
                cancelAnimationFrame(animationFrameId);
            });
        },
        easingFunction: function(n) {
            return 0 == n ? 0 : Math.pow(1024, n - 1);
        },
        showHideBackToTop: function () {
            $(window).scroll(function () {
                var $thisItem = $(this),
                    b = $thisItem.scrollTop(),
                    c = $thisItem.height(),
                    d;

                if (b > 0) {
                    d = b + c / 2;
                } else {
                    d = 1;
                }

                if (d < 1e3) {
                    qodefBackToTop.addClass('off');
                } else {
                    qodefBackToTop.addClass('on');
                }
            });
        },
        addClass: function (a) {
            this.holder.removeClass('qodef--off qodef--on');

            if (a === 'on') {
                this.holder.addClass('qodef--on');
            } else {
                this.holder.addClass('qodef--off');
            }
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(window).on('load', function () {
		qodefUncoverFooter.init();
	});
	
	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $('#qodef-page-footer.qodef--uncover');
			
			if (this.holder.length && !qodefCore.html.hasClass('touchevents')) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight(this.holder);
				
				$(window).resize(function () {
                    qodefUncoverFooter.setHeight(qodefUncoverFooter.holder);
				});
			}
		},
        setHeight: function ($holder) {
	        $holder.css('height', 'auto');
	        
            var footerHeight = $holder.outerHeight();
            
            if (footerHeight > 0) {
                $('#qodef-page-outer').css({'margin-bottom': footerHeight, 'background-color': qodefCore.body.css('backgroundColor')});
                $holder.css('height', footerHeight);
            }
        },
		addClass: function () {
			qodefCore.body.addClass('qodef-page-footer--uncover');
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefFullscreenMenu.init();
	});
	
	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $('a.qodef-fullscreen-menu-opener'),
				$menuItems = $('#qodef-fullscreen-area nav ul li a');
			
			// Open popup menu
			$fullscreenMenuOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-fullscreen-menu--opened')) {
					qodefFullscreenMenu.openFullscreen();
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefFullscreenMenu.closeFullscreen();
						}
					});
				} else {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
			
			//open dropdowns
			$menuItems.on('tap click', function (e) {
				var $thisItem = $(this);
				if ($thisItem.parent().hasClass('menu-item-has-children')) {
					e.preventDefault();
					qodefFullscreenMenu.clickItemWithChild($thisItem);
				} else if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
		},
		openFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu-animate--out').addClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in');
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in').addClass('qodef-fullscreen-menu-animate--out');
			qodefCore.qodefScroll.enable();
			$("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
		},
		clickItemWithChild: function (thisItem) {
			var $thisItemParent = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find('.sub-menu').first();
			
			if ($thisItemSubMenu.is(':visible')) {
				$thisItemSubMenu.slideUp(300);
			} else {
				$thisItemSubMenu.slideDown(300);
				$thisItemParent.siblings().find('.sub-menu').slideUp(400);
			}
		}
	};
	
})(jQuery);
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

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMobileHeaderAppearance.init();
    });

    /*
     **	Init mobile header functionality
     */
    var qodefMobileHeaderAppearance = {
        init: function () {
            if (qodefCore.body.hasClass('qodef-mobile-header-appearance--sticky')) {

                var docYScroll1 = qodefCore.scroll,
                    displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
                    $pageOuter = $('#qodef-page-outer');

                qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                $(window).scroll(function () {
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                    docYScroll1 = qodefCore.scroll;
                });

                $(window).resize(function () {
                    $pageOuter.css('padding-top', 0);
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                });
            }
        },
        showHideMobileHeader: function(docYScroll1, displayAmount,$pageOuter){
            if(qodefCore.windowWidth <= 1024) {
                if (qodefCore.scroll > displayAmount * 2) {
                    //set header to be fixed
                    qodefCore.body.addClass('qodef-mobile-header--sticky');

                    //add transition to it
                    setTimeout(function () {
                        qodefCore.body.addClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //add padding to content so there is no 'jumping'
                    $pageOuter.css('padding-top', qodefGlobal.vars.mobileHeaderHeight);
                } else {
                    //unset fixed header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky');

                    //remove transition
                    setTimeout(function () {
                        qodefCore.body.removeClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //remove padding from content since header is not fixed anymore
                    $pageOuter.css('padding-top', 0);
                }

                if ((qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3)) {
                    //show sticky header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky-display');
                } else {
                    //hide sticky header
                    qodefCore.body.addClass('qodef-mobile-header--sticky-display');
                }
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefNavMenu.init();
	});

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li');
			
			$menuItems.each(function () {
				var $thisItem = $(this);
				
				if ($thisItem.find('.qodef-drop-down-second').length) {
					$thisItem.waitForImages(function () {
						var $dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
							$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
							dropDownHolderHeight = $dropdownMenuItem.outerHeight();
						
						if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
							$thisItem.on("touchstart mouseenter", function () {
								$dropdownHolder.css({
									'height': dropDownHolderHeight,
									'overflow': 'visible',
									'visibility': 'visible',
									'opacity': '1'
								});
							}).on("mouseleave", function () {
								$dropdownHolder.css({
									'height': '0px',
									'overflow': 'hidden',
									'visibility': 'hidden',
									'opacity': '0'
								});
							});
						} else {
							if (qodefCore.body.hasClass('qodef-drop-down-second--animate-height')) {
								var animateConfig = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropdownHolder.addClass('qodef-drop-down--start').css({
												'visibility': 'visible',
												'height': '0',
												'opacity': '1'
											});
											$dropdownHolder.stop().animate({
												'height': dropDownHolderHeight
											}, 400, 'easeInOutQuint', function () {
												$dropdownHolder.css('overflow', 'visible');
											});
										}, 0);
									},
									timeout: 100,
									out: function () {
										$dropdownHolder.stop().animate({
											'height': '0',
											'opacity': 0
										}, 100, function () {
											$dropdownHolder.css({
												'overflow': 'hidden',
												'visibility': 'hidden'
											});
										});
										
										$dropdownHolder.removeClass('qodef-drop-down--start');
									}
								};
								
								$thisItem.hoverIntent(animateConfig);
							} else {
								var config = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropdownHolder.addClass('qodef-drop-down--start').stop().css({'height': dropDownHolderHeight});
										}, 20);
									},
									timeout: 20,
									out: function () {
										$dropdownHolder.stop().css({'height': '0'}).removeClass('qodef-drop-down--start');
									}
								};
								
								$thisItem.hoverIntent(config);
							}
						}
					});
				}
			});
		},
		wideDropdownPosition: function () {
			var $menuItems = $(".qodef-header-navigation > ul > li.qodef-menu-item--wide");

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $menuItem = $(this);
					var $menuItemSubMenu = $menuItem.find('.qodef-drop-down-second');

					if ($menuItemSubMenu.length) {
						$menuItemSubMenu.css('left', 0);

						var leftPosition = $menuItemSubMenu.offset().left;

						if (qodefCore.body.hasClass('qodef--boxed')) {
							//boxed layout case
							var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
							leftPosition = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
							$menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});

						} else if (qodefCore.body.hasClass('qodef-drop-down-second--full-width')) {
							//wide dropdown full width case
							$menuItemSubMenu.css({'left': -leftPosition});
						}
						else {
							//wide dropdown in grid case
							$menuItemSubMenu.css({'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2});
						}
					}
				});
			}
		},
		dropdownPosition: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $thisItem = $(this),
						menuItemPosition = $thisItem.offset().left,
						$dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
						$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
						dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
						menuItemFromLeft = $(window).width() - menuItemPosition;

                    if (qodef.body.hasClass('qodef--boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
                        menuItemFromLeft = boxedWidth - menuItemPosition;
                    }

					var dropDownMenuFromLeft;

					if ($thisItem.find('li.menu-item-has-children').length > 0) {
						dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
					}

					$dropdownHolder.removeClass('qodef-drop-down--right');
					$dropdownMenuItem.removeClass('qodef-drop-down--right');
					if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
						$dropdownHolder.addClass('qodef-drop-down--right');
						$dropdownMenuItem.addClass('qodef-drop-down--right');
					}
				});
			}
		}
	};

})(jQuery);
(function ($) {
    "use strict";

    $(window).on('load', function () {
        qodefParallaxBackground.init();
    });

    /**
     * Init global parallax background functionality
     */
    var qodefParallaxBackground = {
        init: function (settings) {
            this.$sections = $('.qodef-parallax');

            // Allow overriding the default config
            $.extend(this.$sections, settings);

            var isSupported = !qodefCore.html.hasClass('touchevents') && !qodefCore.body.hasClass('qodef-browser--edge') && !qodefCore.body.hasClass('qodef-browser--ms-explorer');

            if (this.$sections.length && isSupported) {
                this.$sections.each(function () {
                    qodefParallaxBackground.ready($(this));
                });
            }
        },
        ready: function ($section) {
            $section.$imgHolder = $section.find('.qodef-parallax-img-holder');
            $section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
            $section.$img = $section.find('img.qodef-parallax-img');

            var h = $section.outerHeight(),
                imgWrapperH = $section.$imgWrapper.height();

            $section.movement = 300 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

            $section.buffer = window.pageYOffset;
            $section.scrollBuffer = null;

			
            //calc and init loop
            requestAnimationFrame(function () {
				$section.$imgHolder.animate({opacity: 1}, 100);
                qodefParallaxBackground.calc($section);
                qodefParallaxBackground.loop($section);
            });

            //recalc
            $(window).on('resize', function () {
                qodefParallaxBackground.calc($section);
            });
        },
        calc: function ($section) {
            var wH = $section.$imgWrapper.height(),
                wW = $section.$imgWrapper.width();

            if ($section.$img.width() < wW) {
                $section.$img.css({
                    'width': '100%',
                    'height': 'auto'
                });
            }

            if ($section.$img.height() < wH) {
                $section.$img.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width': 'unset'
                });
            }
        },
        loop: function ($section) {
            if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
                requestAnimationFrame(function () {
                    qodefParallaxBackground.loop($section);
                }); //repeat loop
                return false; //same scroll value, do nothing
            } else {
                $section.scrollBuffer = Math.round(window.pageYOffset);
            }

            var wH = window.outerHeight,
                sTop = $section.offset().top,
                sH = $section.outerHeight();

            if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
                var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4), //coeff between 0 and 1 based on scroll amount
                    yVal = (delta * $section.movement).toFixed(4);

                if ($section.buffer !== delta) {
                    $section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
                }

                $section.buffer = delta;
            }

            requestAnimationFrame(function () {
                qodefParallaxBackground.loop($section);
            }); //repeat loop
        }
    };

    qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideArea.init();
	});
	
	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $('a.qodef-side-area-opener'),
				$sideAreaClose = $('#qodef-side-area-close'),
				$sideArea = $('#qodef-side-area');
				qodefSideArea.openerHoverColor($sideAreaOpener);
			// Open Side Area
			$sideAreaOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-side-area--opened')) {
					qodefSideArea.openSideArea();
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideArea.closeSideArea();
						}
					});
				} else {
					qodefSideArea.closeSideArea();
				}
			});
			
			$sideAreaClose.on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});
			
			if ($sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($sideArea);
			}
		},
		openSideArea: function () {
			var $wrapper = $('#qodef-page-wrapper');
			var currentScroll = $(window).scrollTop();

			$('.qodef-side-area-cover').remove();
			$wrapper.prepend('<div class="qodef-side-area-cover"/>');
			qodefCore.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area--opened qodef-side-area-animate--in');

			$('.qodef-side-area-cover').on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});

			$(window).scroll(function () {
				if (Math.abs(qodefCore.scroll - currentScroll) > 400) {
					qodefSideArea.closeSideArea();
				}
			});

		},
		closeSideArea: function () {
			qodefCore.body.removeClass('qodef-side-area--opened qodef-side-area-animate--in').addClass('qodef-side-area-animate--out');
		},
		openerHoverColor: function ($opener) {
			if (typeof $opener.data('hover-color') !== 'undefined') {
				var hoverColor = $opener.data('hover-color');
				var originalColor = $opener.css('color');
				
				$opener.on('mouseenter', function () {
					$opener.css('color', hoverColor);
				}).on('mouseleave', function () {
					$opener.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

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
(function ($) {
    "use strict";

    $(window).on('load', function () {
        qodefSubscribeModal.init();
    });

    var qodefSubscribeModal = {
        init: function () {
            this.holder = $('#qodef-subscribe-popup-modal');

            if (this.holder.length) {
                var $preventHolder = this.holder.find('.qodef-sp-prevent'),
                    $modalClose = $('.qodef-sp-close'),
                    disabledPopup = 'no';

                if ($preventHolder.length) {
                    var isLocalStorage = this.holder.hasClass('qodef-sp-prevent-cookies'),
                        $preventInput = $preventHolder.find('.qodef-sp-prevent-input'),
                        preventValue = $preventInput.data('value');

                    if (isLocalStorage) {
                        disabledPopup = localStorage.getItem('disabledPopup');
                        sessionStorage.removeItem('disabledPopup');
                    } else {
                        disabledPopup = sessionStorage.getItem('disabledPopup');
                        localStorage.removeItem('disabledPopup');
                    }

                    $preventHolder.children().on('click', function (e) {
                        if (preventValue !== 'yes') {
                            preventValue = 'yes';
                            $preventInput.addClass('qodef-sp-prevent-clicked').data('value', 'yes');
                        } else {
                            preventValue = 'no';
                            $preventInput.removeClass('qodef-sp-prevent-clicked').data('value', 'no');
                        }

                        if (preventValue === 'yes') {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'yes');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'yes');
                            }
                        } else {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'no');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'no');
                            }
                        }
                    });
                }

                if (disabledPopup !== 'yes') {
                    if (qodefCore.body.hasClass('qodef-sp-opened')) {
                        qodefSubscribeModal.handleClassAndScroll('remove');
                    } else {
                        qodefSubscribeModal.handleClassAndScroll('add');
                    }

                    $modalClose.on('click', function (e) {
                        e.preventDefault();

                        qodefSubscribeModal.handleClassAndScroll('remove');
                    });

                    // Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { // KeyCode for ESC button is 27
                            qodefSubscribeModal.handleClassAndScroll('remove');
                        }
                    });
                }
            }
        },

        handleClassAndScroll: function (option) {
            if (option === 'remove') {
                qodefCore.body.removeClass('qodef-sp-opened');
                qodefCore.qodefScroll.enable();
            }
            if (option === 'add') {
                qodefCore.body.addClass('qodef-sp-opened');
                qodefCore.qodefScroll.disable();
            }
        },
    };

})(jQuery);
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
(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_accordion = {};

	$(document).ready(function () {
		qodefAccordion.init();
	});
	
	var qodefAccordion = {
		init: function () {
			this.holder = $('.qodef-accordion');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					if ($thisHolder.hasClass('qodef-behavior--accordion')) {
						qodefAccordion.initAccordion($thisHolder);
					}
					
					if ($thisHolder.hasClass('qodef-behavior--toggle')) {
						qodefAccordion.initToggle($thisHolder);
					}
					
					$thisHolder.addClass('qodef--init');
				});
			}
		},
		initAccordion: function ($accordion) {
			$accordion.accordion({
				animate: "swing",
				collapsible: true,
				active: 0,
				icons: "",
				heightStyle: "content"
			});
		},
		initToggle: function ($toggle) {
			var $toggleAccordionTitle = $toggle.find('.qodef-accordion-title'),
				$toggleAccordionContent = $toggleAccordionTitle.next();
			
			$toggle.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
			$toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
			$toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
			
			$toggleAccordionTitle.each(function () {
				var $thisTitle = $(this);
				
				$thisTitle.hover(function () {
					$thisTitle.toggleClass("ui-state-hover");
				});
				
				$thisTitle.on('click', function () {
					$thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
					$thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
				});
			});
		}
	};

	qodefCore.shortcodes.pelicula_core_accordion.qodefAccordion = qodefAccordion;

})(jQuery);
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

(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_cards_gallery = {};

	$(document).ready(function () {
		qodefCardsGallery.init();
	});
	
	var qodefCardsGallery = {
		init: function () {
			this.holder = $('.qodef-cards-gallery');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefCardsGallery.initCards( $thisHolder );
					qodefCardsGallery.initBundle( $thisHolder );
				});
			}
		},
		initCards: function ($holder) {
			var $cards = $holder.find('.qodef-m-card');
			$cards.each(function () {
				var $card = $(this);
				
				$card.on('click', function () {
					if (!$cards.last().is($card)) {
						$card.addClass('qodef-out qodef-animating').siblings().addClass('qodef-animating-siblings');
						$card.detach();
						$card.insertAfter($cards.last());
						
						setTimeout(function () {
							$card.removeClass('qodef-out');
						}, 200);
						
						setTimeout(function () {
							$card.removeClass('qodef-animating').siblings().removeClass('qodef-animating-siblings');
						}, 1200);
						
						$cards = $holder.find('.qodef-m-card');
						
						return false;
					}
				});
				
				
			});
		},
		initBundle: function($holder) {
			if ($holder.hasClass('qodef-animation--bundle') && !qodefCore.html.hasClass('touchevents')) {
				$holder.appear(function () {
					$holder.addClass('qodef-appeared');
					$holder.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
						$(this).addClass('qodef-animation-done');
					});
				}, {accX: 0, accY: -100});
			}
		}
	};

	qodefCore.shortcodes.pelicula_core_cards_gallery.qodefCardsGallery  = qodefCardsGallery;
	
})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_countdown = {};

	$(document).ready(function () {
		qodefCountdown.init();
	});
	
	var qodefCountdown = {
		init: function () {
			this.countdowns = $('.qodef-countdown');
			
			if (this.countdowns.length) {
				this.countdowns.each(function () {
					var $thisCountdown = $(this),
						$countdownElement = $thisCountdown.find('.qodef-m-date'),
						options = qodefCountdown.generateOptions($thisCountdown);
					
					qodefCountdown.initCountdown($countdownElement, options);
				});
			}
		},
		generateOptions: function($countdown) {
			var options = {};
			options.date = typeof $countdown.data('date') !== 'undefined' ? $countdown.data('date') : null;
			
			options.weekLabel = typeof $countdown.data('week-label') !== 'undefined' ? $countdown.data('week-label') : '';
			options.weekLabelPlural = typeof $countdown.data('week-label-plural') !== 'undefined' ? $countdown.data('week-label-plural') : '';
			
			options.dayLabel = typeof $countdown.data('day-label') !== 'undefined' ? $countdown.data('day-label') : '';
			options.dayLabelPlural = typeof $countdown.data('day-label-plural') !== 'undefined' ? $countdown.data('day-label-plural') : '';
			
			options.hourLabel = typeof $countdown.data('hour-label') !== 'undefined' ? $countdown.data('hour-label') : '';
			options.hourLabelPlural = typeof $countdown.data('hour-label-plural') !== 'undefined' ? $countdown.data('hour-label-plural') : '';
			
			options.minuteLabel = typeof $countdown.data('minute-label') !== 'undefined' ? $countdown.data('minute-label') : '';
			options.minuteLabelPlural = typeof $countdown.data('minute-label-plural') !== 'undefined' ? $countdown.data('minute-label-plural') : '';
			
			options.secondLabel = typeof $countdown.data('second-label') !== 'undefined' ? $countdown.data('second-label') : '';
			options.secondLabelPlural = typeof $countdown.data('second-label-plural') !== 'undefined' ? $countdown.data('second-label-plural') : '';
			
			return options;
		},
		initCountdown: function ($countdownElement, options) {
			var $weekHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%w</span><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span></span>';
			var $dayHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%d</span><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span></span>';
			var $hourHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%H</span><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span></span>';
			var $minuteHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%M</span><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span></span>';
			var $secondHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%S</span><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span></span>';
			
			$countdownElement.countdown(options.date, function(event) {
				$(this).html(event.strftime($weekHTML + $dayHTML + $hourHTML + $minuteHTML + $secondHTML));
			});
		}
	};

	qodefCore.shortcodes.pelicula_core_countdown.qodefCountdown  = qodefCountdown;


})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_counter = {};

	$(document).ready(function () {
		qodefCounter.init();
	});
	
	var qodefCounter = {
		init: function () {
			this.counters = $('.qodef-counter');
			
			if (this.counters.length) {
				this.counters.each(function () {
					var $thisCounter = $(this),
						$counterElement = $thisCounter.find('.qodef-m-digit'),
						options = qodefCounter.generateOptions($thisCounter);
					
					qodefCounter.counterScript($counterElement, options);
				});
			}
		},
		generateOptions: function($counter) {
			var options = {};
			options.start = typeof $counter.data('start-digit') !== 'undefined' && $counter.data('start-digit') !== '' ? $counter.data('start-digit') : 0;
			options.end = typeof $counter.data('end-digit') !== 'undefined' && $counter.data('end-digit') !== '' ? $counter.data('end-digit') : null;
			options.step = typeof $counter.data('step-digit') !== 'undefined' && $counter.data('step-digit') !== '' ? $counter.data('step-digit') : 1;
			options.delay = typeof $counter.data('step-delay') !== 'undefined' && $counter.data('step-delay') !== '' ? parseInt( $counter.data('step-delay'), 10 ) : 100;
			options.txt = typeof $counter.data('digit-label') !== 'undefined' && $counter.data('digit-label') !== '' ? $counter.data('digit-label') : '';
			
			return options;
		},
		counterScript: function ($counterElement, options) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 50,
				txt: ""
			};
			
			var settings = $.extend(defaults, options || {});
			var nb_start = settings.start;
			var nb_end = settings.end;
			
			$counterElement.text(nb_start + settings.txt);
			
			var counter = function() {
				// Definition of conditions of arrest
				if (nb_end !== null && nb_start >= nb_end) {
					return;
				}
				// incrementation
				nb_start = nb_start + settings.step;
				
				if( nb_start >= nb_end ) {
					nb_start = nb_end;
				}
				// display
				$counterElement.text(nb_start + settings.txt);
			};
			
			// Timer
			// Launches every "settings.delay"
			$counterElement.appear(function() {
				setInterval(counter, settings.delay);
			}, { accX: 0, accY: 0 });
		}
	};

	qodefCore.shortcodes.pelicula_core_counter.qodefCounter  = qodefCounter;

})(jQuery);
(function ($) {
	'use strict';

	qodefCore.shortcodes.pelicula_core_frame_slider = {};

	$(document).ready(function () {
		qodefFrameSlider.init();
	});
	
	var qodefFrameSlider = {
		init: function () {
			this.holder = $('.qodef-frame-slider-holder');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					qodefFrameSlider.createSlider($thisHolder);
				});
			}
		},
		
		createSlider: function ($holder) {
			var $swiperHolder = $holder.find('.qodef-m-swiper'),
				$sliderHolder = $holder.find('.qodef-m-items'),
				$pagination = $holder.find('.swiper-pagination');
			
			var $swiper = new Swiper($swiperHolder, {
				slidesPerView: 'auto',
				centeredSlides: true,
				spaceBetween: 0,
				autoplay: true,
				loop: true,
				speed: 800,
				pagination: {
					el: $pagination,
					type: 'bullets',
					clickable: true
				},
				on: {
					init: function () {
						setTimeout(function () {
                            $sliderHolder.addClass('qodef-swiper--initialized');
                        }, 1500);
					}
				}
			});
		}
	};

	qodefCore.shortcodes.pelicula_core_frame_slider.qodefFrameSlider  = qodefFrameSlider;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_google_map = {};

	$(document).ready(function () {
		qodefGoogleMap.init();
	});
	
	var qodefGoogleMap = {
		init: function () {
			this.holder = $('.qodef-google-map');
			
			if (this.holder.length) {
				this.holder.each(function () {
					if (typeof window.qodefGoogleMap !== 'undefined') {
						window.qodefGoogleMap.initMap($(this).find('.qodef-m-map'));
					}
				});
			}
		}
	};

	qodefCore.shortcodes.pelicula_core_google_map.qodefGoogleMap  = qodefGoogleMap;

})(jQuery);
(function ($) {
	'use strict';

	qodefCore.shortcodes.pelicula_core_horizontal_timeline = {};

	$(document).ready(function () {
		qodefTimeline.init();
	});

	var qodefTimeline = {
		eventsMinDistance: 60,

		init: function () {
			this.holder = $('.qodef-horizontal-timeline');

			if (this.holder.length) {
				this.holder.each(function () {

					var timeline = $(this),
						timelineComponents = {};

					qodefTimeline.eventsMinDistance = timeline.data('distance');

					//cache timeline components
					timelineComponents.timelineNavWrapper = timeline.find('.qodef-m-ht-nav-wrapper');
					timelineComponents.timelineNavWrapperWidth = timelineComponents.timelineNavWrapper.width();
					timelineComponents.timelineNavInner = timelineComponents.timelineNavWrapper.find('.qodef-m-ht-nav-inner');
					timelineComponents.fillingLine = timelineComponents.timelineNavInner.find('.qodef-m-ht-nav-filling-line');
					timelineComponents.timelineEvents = timelineComponents.timelineNavInner.find('a');
					timelineComponents.timelineDates = qodefTimeline.parseDate(timelineComponents.timelineEvents);
					timelineComponents.eventsMinLapse = qodefTimeline.minLapse(timelineComponents.timelineDates);
					timelineComponents.timelineNavigation = timeline.find('.qodef-m-ht-nav-navigation');
					timelineComponents.timelineEventContent = timeline.find('.qodef-m-ht-content');

					//select initial event
					timelineComponents.timelineEvents.first().addClass('qodef-selected');
					timelineComponents.timelineEventContent.find('li').first().addClass('qodef-selected');

					//assign a left postion to the single events along the timeline
					qodefTimeline.setDatePosition(timelineComponents, qodefTimeline.eventsMinDistance);

					//assign a width to the timeline
					var timelineTotWidth = qodefTimeline.setTimelineWidth(timelineComponents, qodefTimeline.eventsMinDistance);

					//the timeline has been initialize - show it
					timeline.addClass('qodef-loaded');

					//detect click on the next arrow
					timelineComponents.timelineNavigation.on('click', '.qodef-next', function (e) {
						e.preventDefault();
						qodefTimeline.updateSlide(timelineComponents, timelineTotWidth, 'next');
					});

					//detect click on the prev arrow
					timelineComponents.timelineNavigation.on('click', '.qodef-prev', function (e) {
						e.preventDefault();
						qodefTimeline.updateSlide(timelineComponents, timelineTotWidth, 'prev');
					});

					//detect click on the a single event - show new event content
					timelineComponents.timelineNavInner.on('click', 'a', function (e) {
						e.preventDefault();
						if (autoplayEnabled) {
							clearTimeout(autoplayTimeout);
							resetAutoplay();
						}

						var thisItem = $(this);

						timelineComponents.timelineEvents.removeClass('qodef-selected');
						thisItem.addClass('qodef-selected');

						qodefTimeline.updateOlderEvents(thisItem);
						qodefTimeline.updateFilling(thisItem, timelineComponents.fillingLine, timelineTotWidth);
						qodefTimeline.updateVisibleContent(thisItem, timelineComponents.timelineEventContent);
					});

					var mq = qodefTimeline.checkMQ();

					// Autoplay functionality
					var autoplayEnabled = timeline.hasClass('qodef-autoplay--enabled');

					if (autoplayEnabled) {
						// Autoplay variables
						var autoplaySpeed = 4000,
							autoplayInterval,
							autoplayTimeout,
							autoplayTimeoutVal = 4000, // time in ms before autoplay resets again after user interruption
							lastNavItem = timeline.find('.qodef-m-ht-nav-inner ol li:last-child a');

						// Autoplay logic
						var autoplayStart = function() {
							autoplayInterval = setInterval(function() {
								if (lastNavItem.hasClass('qodef-selected')) {
									stopAutoplay();
								} else {
									qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'next');
								}
							}, autoplaySpeed);
						}

						// Start autoplay on appear
						timeline.appear(function() {
							setTimeout(function() {
								qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'next');
								autoplayStart();
							}, 1000);
						}, { accX: 0, accY: 0 });

						// Reset autoplay function
						var resetAutoplay = function() {
							clearInterval(autoplayInterval);
							autoplayTimeout = setTimeout(function() {
								autoplayStart();
							}, autoplayTimeoutVal);
						}

						var stopAutoplay = function() {
							clearInterval(autoplayInterval);
						}
					}

					// Desktop drag events
					var dragEvent = {
						down: 'mousedown',
						up: 'mouseup',
						target: 'target',
					}

					var isTouchDevice = qodef.html.hasClass('touchevents');

					// Touch drag events
					if (isTouchDevice) {
						dragEvent = {
							down: 'touchstart',
							up: 'touchend',
							target: 'srcElement',
						}
					}

					// Check if user is scrolling on touch devices
					var touchScrolling = function(oldEvent, newEvent) {
						if (isTouchDevice) {
							var oldY = oldEvent.originalEvent.changedTouches[0].clientY,
								newY = newEvent.originalEvent.changedTouches[0].clientY;
							
							if (Math.abs(newY - oldY) > 100) { // 100 is drag sensitivity
								return true;
							};
						}
						return false;
					}
					
					var getXPos = function(e) {
						return isTouchDevice ? e.originalEvent.changedTouches[0].clientX : e.clientX;
					}

					// Check if user is tapping on link on touch devices
					var tapOnLink = function(e) {
						return (isTouchDevice && $(e[dragEvent.target]).is('a')) ? true : false;
					}
					
					// Drag logic for top timeline
					var mouseTopDown = false;
					timeline.find('.qodef-m-ht-nav').on(dragEvent.down, function(e) {
						if (!mouseTopDown && !tapOnLink(e)) {
							var xPos = getXPos(e);
							!isTouchDevice ? e.preventDefault() : null;
							mouseTopDown = true;
	
							timeline.find('.qodef-m-ht-nav').one(dragEvent.up, function(e) {
								var xPosNew = getXPos(e);
								!isTouchDevice ? e.preventDefault() : null;
								if (Math.abs(xPos - xPosNew) > 10) { // drag sensitivity
									if (xPos > xPosNew) {
										qodefTimeline.updateSlide(timelineComponents, timelineTotWidth, 'next');
									} else {
										qodefTimeline.updateSlide(timelineComponents, timelineTotWidth, 'prev');
									}
								}
								mouseTopDown = false;
							});
						}
					});
					
					// Drag logic for content items
					var mouseDown = false;
					timeline.find('.qodef-m-ht-content').on(dragEvent.down, function(e) {
						if (!mouseDown && !$(e[dragEvent.target]).is('a, span')) {
							var oldEvent = e,
								xPos = getXPos(e);
							mouseDown = true;
							if (autoplayEnabled) {
								clearTimeout(autoplayTimeout);
								resetAutoplay();
							}
	
							timeline.find('.qodef-m-ht-content').one(dragEvent.up, function(e) {
								var xPosNew = getXPos(e);
								if (Math.abs(xPos - xPosNew) > 10 && !touchScrolling(oldEvent, e)) {
									if (xPos > xPosNew) {
										qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'next');
									} else {
										qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'prev');
									}
								}
								mouseDown = false;
							});
						}
					});

					//on swipe, show next/prev event content
					// timelineComponents.timelineEventContent.on('swipeleft', function(){
					// 	( mq === 'mobile' ) && qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'next');
					// });
					// timelineComponents.timelineEventContent.on('swiperight', function(){
					// 	( mq === 'mobile' ) && qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'prev');
					// });

					//keyboard navigation
					$(document).keyup(function (event) {
						if (event.which === '37' && qodefTimeline.elementInViewport(timeline.get(0))) {
							qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'prev');
						} else if (event.which === '39' && qodefTimeline.elementInViewport(timeline.get(0))) {
							qodefTimeline.showNewContent(timelineComponents, timelineTotWidth, 'next');
						}
					});
				});
	        }
		},

		updateSlide: function (timelineComponents, timelineTotWidth, string) {
			//retrieve translateX value of timelineComponents.timelineNavInner
			var translateValue = qodefTimeline.getTranslateValue(timelineComponents.timelineNavInner),
				wrapperWidth = Number(timelineComponents.timelineNavWrapper.css('width').replace('px', ''));
			//translate the timeline to the left('next')/right('prev')
			if(string === 'next') {
				qodefTimeline.translateTimeline(timelineComponents, translateValue - wrapperWidth + qodefTimeline.eventsMinDistance, wrapperWidth - timelineTotWidth);
			} else {
				qodefTimeline.translateTimeline(timelineComponents, translateValue + wrapperWidth - qodefTimeline.eventsMinDistance);
			}
		},

		showNewContent: function (timelineComponents, timelineTotWidth, string) {
			//go from one event to the next/previous one
			var visibleContent = timelineComponents.timelineEventContent.find('.qodef-selected'),
				newContent = (string === 'next') ? visibleContent.next() : visibleContent.prev();

			if (newContent.length > 0) { //if there's a next/prev event - show it
				var selectedDate = timelineComponents.timelineNavInner.find('.qodef-selected'),
					newEvent = (string === 'next') ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');

				qodefTimeline.updateFilling(newEvent, timelineComponents.fillingLine, timelineTotWidth);
				qodefTimeline.updateVisibleContent(newEvent, timelineComponents.timelineEventContent);

				newEvent.addClass('qodef-selected');
				selectedDate.removeClass('qodef-selected');

				qodefTimeline.updateOlderEvents(newEvent);
				qodefTimeline.updateTimelinePosition(string, newEvent, timelineComponents);
			}
		},

		updateTimelinePosition: function (string, event, timelineComponents) {
			//translate timeline to the left/right according to the position of the qodef-selected event
			var eventStyle = window.getComputedStyle(event.get(0), null),
				eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
				timelineWidth = Number(timelineComponents.timelineNavWrapper.css('width').replace('px', '')),
				timelineTotWidth = Number(timelineComponents.timelineNavInner.css('width').replace('px', '')),
				timelineTranslate = qodefTimeline.getTranslateValue(timelineComponents.timelineNavInner);

			if ((string === 'next' && eventLeft > timelineWidth - timelineTranslate) || (string === 'prev' && eventLeft < -timelineTranslate)) {
				qodefTimeline.translateTimeline(timelineComponents, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
			}
		},

		translateTimeline: function (timelineComponents, value, totWidth) {
			var timelineNavInner = timelineComponents.timelineNavInner.get(0);

			value = (value > 0) ? 0 : value; //only negative translate value
			value = (typeof totWidth !== 'undefined' && value < totWidth) ? totWidth : value; //do not translate more than timeline width

			qodefTimeline.setTransformValue(timelineNavInner, 'translateX', value + 'px');

			//update navigation arrows visibility
			(value === 0) ? timelineComponents.timelineNavigation.find('.qodef-prev').addClass('qodef-inactive') : timelineComponents.timelineNavigation.find('.qodef-prev').removeClass('qodef-inactive');
			(value === totWidth) ? timelineComponents.timelineNavigation.find('.qodef-next').addClass('qodef-inactive') : timelineComponents.timelineNavigation.find('.qodef-next').removeClass('qodef-inactive');
		},

		updateFilling: function (selectedEvent, filling, totWidth) {
			//change .qodef-m-ht-nav-filling-line length according to the qodef-selected event
			var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
				eventLeft = eventStyle.getPropertyValue("left"),
				eventWidth = eventStyle.getPropertyValue("width");

			eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;

			var scaleValue = eventLeft / totWidth;

			qodefTimeline.setTransformValue(filling.get(0), 'scaleX', scaleValue);
		},

		setDatePosition: function (timelineComponents, min) {
			for (var i = 0; i < timelineComponents.timelineDates.length; i++) {
				var distance = qodefTimeline.daydiff(timelineComponents.timelineDates[0], timelineComponents.timelineDates[i]),
					distanceNorm = Math.round(distance / timelineComponents.eventsMinLapse) + 2;

				timelineComponents.timelineEvents.eq(i).css('left', distanceNorm * min + 'px');
			}
		},

		setTimelineWidth: function (timelineComponents, width) {
			var timeSpan = qodefTimeline.daydiff(timelineComponents.timelineDates[0], timelineComponents.timelineDates[timelineComponents.timelineDates.length - 1]),
				timeSpanNorm = Math.round(timeSpan / timelineComponents.eventsMinLapse) + 4,
				totalWidth = timeSpanNorm * width;

			if (totalWidth < timelineComponents.timelineNavWrapperWidth) {
				totalWidth = timelineComponents.timelineNavWrapperWidth;
			}

			timelineComponents.timelineNavInner.css('width', totalWidth + 'px');

			qodefTimeline.updateFilling(timelineComponents.timelineNavInner.find('a.qodef-selected'), timelineComponents.fillingLine, totalWidth);
			qodefTimeline.updateTimelinePosition('next', timelineComponents.timelineNavInner.find('a.qodef-selected'), timelineComponents);

			return totalWidth;
		},

		updateVisibleContent: function (event, timelineEventContent) {
			var eventDate = event.data('date'),
				visibleContent = timelineEventContent.find('.qodef-selected'),
				selectedContent = timelineEventContent.find('[data-date="' + eventDate + '"]'),
				selectedContentHeight = selectedContent.height(),
				classEnetering = 'qodef-selected qodef-enter-left',
				classLeaving = 'qodef-leave-right';

			if (selectedContent.index() > visibleContent.index()) {
				classEnetering = 'qodef-selected qodef-enter-right';
				classLeaving = 'qodef-leave-left';
			}

			selectedContent.attr('class', classEnetering);

			visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
				visibleContent.removeClass('qodef-leave-right qodef-leave-left');
				selectedContent.removeClass('qodef-enter-left qodef-enter-right');
			});

			timelineEventContent.css('height', selectedContentHeight + 'px');
		},

		updateOlderEvents: function (event) {
			event.parent('li').prevAll('li').children('a').addClass('qodef-older-event').end().end().nextAll('li').children('a').removeClass('qodef-older-event');
		},

		getTranslateValue: function (timeline) {
			var timelineStyle = window.getComputedStyle(timeline.get(0), null),
				timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") || timelineStyle.getPropertyValue("-moz-transform") || timelineStyle.getPropertyValue("-ms-transform") || timelineStyle.getPropertyValue("-o-transform") || timelineStyle.getPropertyValue("transform"),
				translateValue = 0;

			if (timelineTranslate.indexOf('(') >= 0) {
				timelineTranslate = timelineTranslate.split('(')[1];
				timelineTranslate = timelineTranslate.split(')')[0];
				timelineTranslate = timelineTranslate.split(',');

				translateValue = timelineTranslate[4];
			}

			return Number(translateValue);
		},

		setTransformValue: function (element, property, value) {
			element.style["-webkit-transform"] = property + "(" + value + ")";
			element.style["-moz-transform"] = property + "(" + value + ")";
			element.style["-ms-transform"] = property + "(" + value + ")";
			element.style["-o-transform"] = property + "(" + value + ")";
			element.style["transform"] = property + "(" + value + ")";
		},

		//based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
		parseDate: function (events) {
			var dateArrays = [];

			events.each(function () {
				var singleDate = $(this),
					dateCompStr = new String(singleDate.data('date')),
					dayComp = ['2000', '0', '0'],
					timeComp = ['0', '0'];

				if ( dateCompStr.length === 4 ) { //only year
					dayComp = [dateCompStr, '0', '0'];
				} else {
					var dateComp = dateCompStr.split('T');

					dayComp = dateComp[0].split('/'); //only DD/MM/YEAR

					if (dateComp.length > 1) { //both DD/MM/YEAR and time are provided
						dayComp = dateComp[0].split('/');
						timeComp = dateComp[1].split(':');
					} else if (dateComp[0].indexOf(':') >= 0) { //only time is provide
						timeComp = dateComp[0].split(':');
					}
				}

				var newDate = new Date(dayComp[2], dayComp[1] - 1, dayComp[0], timeComp[0], timeComp[1]);

				dateArrays.push(newDate);
			});

			return dateArrays;
		},

		daydiff: function (first, second) {
			return Math.round((second - first));
		},

		minLapse: function (dates) {
			//determine the minimum distance among events
			var dateDistances = [];

			for (var i = 1; i < dates.length; i++) {
				var distance = qodefTimeline.daydiff(dates[i - 1], dates[i]);
				dateDistances.push(distance);
			}

			return Math.min.apply(null, dateDistances);
		},

		/*
		 How to tell if a DOM element is visible in the current viewport?
		 http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
		 */
		elementInViewport: function (el) {
			var top = el.offsetTop;
			var left = el.offsetLeft;
			var width = el.offsetWidth;
			var height = el.offsetHeight;

			while (el.offsetParent) {
				el = el.offsetParent;
				top += el.offsetTop;
				left += el.offsetLeft;
			}

			return (
				top < (window.pageYOffset + window.innerHeight) &&
				left < (window.pageXOffset + window.innerWidth) &&
				(top + height) > window.pageYOffset &&
				(left + width) > window.pageXOffset
			);
		},

		checkMQ: function () {
			//check if mobile or desktop device
			return window.getComputedStyle(document.querySelector('.qodef-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
		}
	};

	qodefCore.shortcodes.pelicula_core_horizontal_timeline.qodefTimeline = qodefTimeline;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.pelicula_core_icon = {};

    $(document).ready(function () {
        qodefIcon.init();
    });

    var qodefIcon = {
        init: function () {
            this.icons = $('.qodef-icon-holder');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIcon = $(this);

                    qodefIcon.iconHoverColor($thisIcon);
                    qodefIcon.iconHoverBgColor($thisIcon);
                    qodefIcon.iconHoverBorderColor($thisIcon);
                });
            }
        },
        iconHoverColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-color') !== 'undefined') {
                var spanHolder = $iconHolder.find('span');
                var originalColor = spanHolder.css('color');
                var hoverColor = $iconHolder.data('hover-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(spanHolder, 'color', hoverColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(spanHolder, 'color', originalColor);
                });
            }
        },
        iconHoverBgColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = $iconHolder.data('hover-background-color');
                var originalBackgroundColor = $iconHolder.css('background-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', hoverBackgroundColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', originalBackgroundColor);
                });
            }
        },
        iconHoverBorderColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-border-color') !== 'undefined') {
                var hoverBorderColor = $iconHolder.data('hover-border-color');
                var originalBorderColor = $iconHolder.css('borderTopColor');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', hoverBorderColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', originalBorderColor);
                });
            }
        },
        changeColor: function (iconElement, cssProperty, color) {
            iconElement.css(cssProperty, color);
        }
    };

	qodefCore.shortcodes.pelicula_core_icon.qodefIcon = qodefIcon;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.pelicula_core_image_gallery = {};
	qodefCore.shortcodes.pelicula_core_image_gallery.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.pelicula_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.pelicula_core_image_with_text = {};
    qodefCore.shortcodes.pelicula_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;

})(jQuery);
(function($) {
    'use strict';

	qodefCore.shortcodes.pelicula_core_interactive_link_carousel = {};

	$(document).ready(function () {
		qodefInteractiveLinkCarousel.init();
    });

	var qodefInteractiveLinkCarousel = {
		init: function () {
			var $holder = $('.qodef-interactive-link-carousel');

			if ($holder.length) {
				$holder.each(function() {
				    var $thisHolder = $(this);

                    // Init Swipers
                    qodefInteractiveLinkCarousel.initSwipers($thisHolder);
				});
			}
        },
        initSwipers: function($thisHolder) {
            var $swiperContainers = $thisHolder.find('.swiper-container'),
                swiperContainersLength = $swiperContainers.length - 1,
                slideSpeed = 600;

            $swiperContainers.each(function(i){
                var $thisSwiperContainer = $(this),
                    swiperIndex = i;

                // Set direction
                if ((i+1) % 2 == 0) {
                    $thisSwiperContainer.attr("dir","rtl");
                } else{
                    $thisSwiperContainer.attr("dir","ltr");
                }

                var swiperSlider = new Swiper($thisSwiperContainer, {
                    loop: true,
                    slidesPerView: 'auto',
                    speed: slideSpeed,
                    on: {
                        init: function() {
                            if (swiperIndex === swiperContainersLength) {
                                // Init other functions after last swiper init
                                setTimeout(function() {
                                    swiperContainersLength > 0 ? qodefInteractiveLinkCarousel.connectTwoSwipers($swiperContainers) : null;
                                    qodefInteractiveLinkCarousel.wheelTrigger($thisHolder, $thisHolder.find('.swiper-container').first(), slideSpeed);
                                    qodefInteractiveLinkCarousel.initHoverAnimations($thisHolder);
                                    $thisHolder.addClass('qodef-initialized');
                                }, 100);
                            }
                        },
                    },
                });
            });
        },
        initHoverAnimations: function($thisHolder) {
            var $slideItems = $thisHolder.find('.qodef-m-item'),
                xPos, 
                yPos;

            $(window).on('mousemove', function(e) {
                xPos = e.clientX;
                yPos = e.clientY;
            });

            // Change hovered item after scroll
            $thisHolder.on('qodefSliderScrolled', function(e) {
                setTimeout(function() {
                    qodefInteractiveLinkCarousel.changeHoveredItemAfterScroll($thisHolder, $slideItems, xPos, yPos);
                }, 10);
            });

            // Mouse enter and leave item
            $slideItems.each(function() {
                var $thisItem = $(this);
                $thisItem.on('mouseenter', function() {
                    qodefInteractiveLinkCarousel.hoverItem($thisHolder, $thisItem, 'in');
                }).on('mouseleave', function() {
                    qodefInteractiveLinkCarousel.hoverItem($thisHolder, $thisItem, 'out');
                });
            });


            // Touch device events
            if (qodef.html.hasClass('touchevents')) {
                $slideItems.on('touchstart', function() {
                    var $thisItem = $(this);

                    if (!$thisItem.hasClass('qodef--hovered')) {
                        $slideItems.each(function() {
                            qodefInteractiveLinkCarousel.hoverItem($thisHolder, $(this), 'out');
                        });
                        qodefInteractiveLinkCarousel.hoverItem($thisHolder, $thisItem, 'in');
                    }
                });
            }
        },
        changeHoveredItemAfterScroll: function($thisHolder, $slideItems, x, y) {
            var $pointElement = qodefInteractiveLinkCarousel.getJqueryElementFromPoint(x, y),
                $hoveredItem = $pointElement.closest('.qodef-m-item');

            if ($hoveredItem.length && !$hoveredItem.hasClass('qodef--hovered')) {
                $slideItems.each(function() {
                    qodefInteractiveLinkCarousel.hoverItem($thisHolder, $(this), 'out');
                });
                qodefInteractiveLinkCarousel.hoverItem($thisHolder, $hoveredItem, 'in');
            }
        },
        hoverItem: function($thisHolder, $thisItem, action) {
            var itemDataId = $thisItem.find('.qodef-m-item-content').data('index'),
                $thisItemSource = $thisHolder.find('.qodef-e-source[data-index='+ itemDataId +']');
            
            if (action === 'in') {
                $thisItem.addClass('qodef--hovered');
                $thisItemSource.addClass('qodef-active');
                $thisItemSource.find('.mejs-container video').length && qodefInteractiveLinkCarousel.controlVideo($thisItemSource.find('.mejs-container video'), 'play');
            } else {
                $thisItem.removeClass('qodef--hovered');
                $thisItemSource.removeClass('qodef-active');
                $thisItemSource.find('.mejs-container video').length && qodefInteractiveLinkCarousel.controlVideo($thisItemSource.find('.mejs-container video'), 'pause');
            }
        },
        getJqueryElementFromPoint: function(x, y) {
            return $(document.elementFromPoint(x, y));
        },
        connectTwoSwipers: function($swiperContainers) {
            $swiperContainers.each(function(i) {
                var thisSwiperInstance = $(this)[0].swiper,
                    indexOfOtherSwiper = i == 0 ? 1 : 0;

                thisSwiperInstance.controller.control = $swiperContainers.eq(indexOfOtherSwiper)[0].swiper,
                thisSwiperInstance.update();
            });
        },
        wheelTrigger: function($thisHolder, $firstSwiper, slideSpeed) {
            var scrollStart = false;

            $thisHolder.on('wheel', function(event) {
                event.preventDefault();
                if (!scrollStart) {
                    scrollStart = true;

                    if(event.originalEvent.deltaY < 0) {
                        $firstSwiper[0].swiper.slideNext(slideSpeed, true);
                    } else {
                        $firstSwiper[0].swiper.slidePrev(slideSpeed, true);
                    }

                    setTimeout(function() {
                        scrollStart = false;
                        $thisHolder.triggerHandler('qodefSliderScrolled');
                    }, slideSpeed + 10);
                }
                
            });
        },
        controlVideo: function($videoElement, action) {
            var $thisMediaElement = $videoElement[0].player.media;

            if (action === 'play') {
                $thisMediaElement.play();
            } else {
                $thisMediaElement.pause();
            }
        }
	};

	qodefCore.shortcodes.pelicula_core_interactive_link_carousel.qodefInteractiveLinkCarousel = qodefInteractiveLinkCarousel;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.pelicula_core_interactive_link_showcase = {};

})(jQuery);
(function ($) {
    "use strict";
	
	qodefCore.shortcodes.pelicula_core_item_showcase = {};
	
	$(document).ready(function () {
		qodefItemShowcaseList.init();
	});
	
	var qodefItemShowcaseList = {
		init: function () {
			this.holder = $('.qodef-item-showcase');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					$thisHolder.appear(function(){
						$thisHolder.addClass('qodef--init');
					}, {accX: 0, accY: -100});
				});
			}
		}
	};
	qodefCore.shortcodes.pelicula_core_item_showcase.qodefItemShowcaseList = qodefItemShowcaseList;

})(jQuery);
(function ($) {
	'use strict';

	qodefCore.shortcodes.pelicula_core_progress_bar = {};

	$(document).ready(function () {
		qodefProgressBar.init();
	});

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $('.qodef-progress-bar');

			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this),
						layout = $thisHolder.data('layout'),
						data = qodefProgressBar.generateBarData($thisHolder, layout),
						container = '#qodef-m-canvas-' + $thisHolder.data('rand-number'),
						number = $thisHolder.data('number') / 100;
					
					if(!$(container).hasClass('qodef-m-initialized')) {
						$(container).addClass('qodef-m-initialized');
						switch (layout) {
							case 'circle':
								qodefProgressBar.initCircleBar(container, data, number);
								break;
							case 'semi-circle':
								qodefProgressBar.initSemiCircleBar(container, data, number);
								break;
							case 'line':
								number = $thisHolder.data('number');
								container = $thisHolder.find('.qodef-m-canvas');
								data = qodefProgressBar.generateLineData($thisHolder, layout, number);
								qodefProgressBar.initLineBar(container, data);
								break;
							case 'custom':
								container = "#" + $thisHolder.data('custom-shape-id');
								qodefProgressBar.initCustomBar(container, data, number);
								break;
						}
					}
				});
			}
		},
		generateBarData: function (thisBar, layout) {
			var activeWidth = thisBar.data('active-line-width');
			var activeColor = thisBar.data('active-line-color');
			var inactiveWidth = thisBar.data('inactive-line-width');
			var inactiveColor = thisBar.data('inactive-line-color');
			var easing = 'linear';
			var duration = typeof thisBar.data('duration') !== 'undefined' && thisBar.data('duration') !== '' ? parseInt(thisBar.data('duration'), 10) : 1600;
			var textColor = thisBar.data('text-color');

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function (state, bar) {
					if (layout !== 'custom') {
						bar.setText(Math.round(bar.value() * 100) + '%');
					}
				}
			};
		},
		generateLineData: function (thisBar, layout, number) {
			var height = thisBar.data('active-line-width');
			var activeColor = thisBar.data('active-line-color');
			var inactiveHeight = thisBar.data('inactive-line-width');
			var inactiveColor = thisBar.data('inactive-line-color');
			var duration = typeof thisBar.data('duration') !== 'undefined' && thisBar.data('duration') !== '' ? parseInt(thisBar.data('duration'), 10) : 1600;
			var textColor = thisBar.data('text-color');

			return {
				percentage: number,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: true,
				textColor: textColor
			};
		},
		initCircleBar: function (container, data, number) {
			var bar = new ProgressBar.Circle(container, data);

			$(container).appear(function () {
				bar.animate(number);
			});
		},
		initSemiCircleBar: function (container, data, number) {
			var bar = new ProgressBar.SemiCircle(container, data);

			$(container).appear(function () {
				bar.animate(number);
			});
		},
		initCustomBar: function (container, data, number) {
			var bar = new ProgressBar.Path(container, data);
			bar.set(0);

			$(container).appear(function () {
				bar.animate(number);
			});
		},
		initLineBar: function (container, data) {
			$(container).appear(function () {
				container.LineProgressbar(data);
			});
		}
	};

	qodefCore.shortcodes.pelicula_core_progress_bar.qodefProgressBar = qodefProgressBar;

})(jQuery);
(function ($) {
	
    "use strict";

	$(document).ready(function () {
		qodefSectionTitle.init();
	});

	var qodefSectionTitle = {
		init: function () {
			var $sectionTitle = $('.qodef-section-title');
			
			if ($sectionTitle.length) {

                $sectionTitle.each(function() {
                    qodefSectionTitle.appearAnimation($(this));
                });
			}
		},
		appearAnimation: function($holder) {
			if ($holder.length) {
                var $title = $holder.find('.qodef-m-title'),
                    $titleHighlight = $holder.find('.qodef-custom-styles'),
                    $tagline = $holder.find('.qodef-m-tagline'),
                    $button = $title.closest('.elementor-widget-pelicula_core_section_title').parent().find('.elementor-widget-pelicula_core_button'),
                    titleTextWords = $title.text().split(' '),
                    titleAppearOffset = 300,
                    holderData = JSON.parse($holder.attr('data-holder-options')),
                    lineBreaks;

                if ($title.offset().top < qodef.windowHeight * 2) {
                    titleAppearOffset = 100;
                }

                if (holderData !== " ") {
                    lineBreaks = holderData['line-breaks'];
                    lineBreaks ? lineBreaks = lineBreaks.split(',') : null;
                }

                if ($title.length) {
                    $button.addClass('qodef-section-title-adjacent-button');
                    $title.empty();
                    titleTextWords.forEach(function(item, i) {
                        var randomDuration = qodefSectionTitle.getRandomIntegerInRange(1000, 2000),
                            randomSign = i % 2 === 0 ? "" : "-",
                            highlightWord = false,
                            isLineBreak = false;

                        item = item.trim();

                        if (lineBreaks) {
                            lineBreaks.forEach(function(thisItem) {
                                if (i + 1 == thisItem) {
                                    isLineBreak = true;
                                }
                            });
                        }
                        
                        // Check if Highlight word contains commas or dots at the end
                        if ($titleHighlight.length) {
                            $titleHighlight.each(function() {
                                var titleHighlightText = $(this).text();
                                if (item.indexOf(titleHighlightText) > -1) {
                                    item = item.split(/(,|\.)/g);
                                    highlightWord = true;
                                }
                            });
                        }

                        if (highlightWord) {
                            var highlightStr = '';
                            item.forEach(function(element, index) {
                                if (element !== "") {
                                    if (index === 0) {
                                        highlightStr += '<span class="qodef-custom-styles--line-through">'+ element +'</span>';
                                    } else {
                                        highlightStr += '<span>'+ element +'</span>';
                                    }
                                }
                            });
                            $title.append('<span style="transition-duration: '+ randomDuration +'ms; transform: translateY('+ randomSign +'10px);" class="qodef-m-title-word qodef-custom-styles">'+ highlightStr +' </span>' + (isLineBreak ? '<br>' : ''));
                        } else {
                            $title.append('<span style="transition-duration: '+ randomDuration +'ms; transform: translateY('+ randomSign +'10px);" class="qodef-m-title-word">' + item + ' </span>' + (isLineBreak ? '<br>' : ''));
                        }
                    });

                    $title.appear(function() {
                        $title.addClass('qodef--appear');
                        $tagline.addClass('qodef--appear');
                        $title.find('.qodef-m-title-word').addClass('qodef--appear');
                    }, { accX: 0, accY: titleAppearOffset });

                    if ($button.length) {
                        $button.appear(function() {
                            $button.addClass('qodef--appear');
                        }, { accX: 0, accY: 0 });
                    }
                }
			}
        },
        getRandomIntegerInRange: function(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min)) + min;
        }
	}

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_tabs = {};

	$(document).ready(function () {
		qodefTabs.init();
	});
	
	var qodefTabs = {
		init: function () {
			this.holder = $('.qodef-tabs');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTabs.initTabs($(this));
				});
			}
		},
		initTabs: function ($tabs) {
			$tabs.children('.qodef-tabs-content').each(function (index) {
				index = index + 1;
				
				var $that = $(this),
					link = $that.attr('id'),
					$navItem = $that.parent().find('.qodef-tabs-navigation li:nth-child(' + index + ') a'),
					navLink = $navItem.attr('href');
				
				link = '#' + link;
				
				if (link.indexOf(navLink) > -1) {
					$navItem.attr('href', link);
				}
			});
			
			$tabs.addClass('qodef--init').tabs();
		}
	};

	qodefCore.shortcodes.pelicula_core_tabs.qodefTabs = qodefTabs;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.pelicula_core_text_marquee = {};

	$(document).ready(function () {
		qodefTextMarquee.init();
	});
	
	var qodefTextMarquee = {
		init: function () {
			this.holder = $('.qodef-text-marquee');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTextMarquee.initMarquee($(this));
					qodefTextMarquee.initResponsive($(this).find('.qodef-m-content'));
				});
			}
		},
		initResponsive: function (thisMarquee) {
			var fontSize,
				lineHeight,
				coef1 = 1,
				coef2 = 1;
			
			if (qodefCore.windowWidth < 1480) {
				coef1 = 0.8;
			}
			
			if (qodefCore.windowWidth < 1200) {
				coef1 = 0.7;
			}
			
			if (qodefCore.windowWidth < 768) {
				coef1 = 0.55;
				coef2 = 0.65;
			}
			
			if (qodefCore.windowWidth < 600) {
				coef1 = 0.45;
				coef2 = 0.55;
			}
			
			if (qodefCore.windowWidth < 480) {
				coef1 = 0.4;
				coef2 = 0.5;
			}
			
			fontSize = parseInt(thisMarquee.css('font-size'));
			
			if (fontSize > 200) {
				fontSize = Math.round(fontSize * coef1);
			} else if (fontSize > 60) {
				fontSize = Math.round(fontSize * coef2);
			}
			
			thisMarquee.css('font-size', fontSize + 'px');
			
			lineHeight = parseInt(thisMarquee.css('line-height'));
			
			if (lineHeight > 70 && qodefCore.windowWidth < 1440) {
				lineHeight = '1.2em';
			} else if (lineHeight > 35 && qodefCore.windowWidth < 768) {
				lineHeight = '1.2em';
			} else {
				lineHeight += 'px';
			}
			
			thisMarquee.css('line-height', lineHeight);
		},
		initMarquee: function (thisMarquee) {
			var elements = thisMarquee.find('.qodef-m-text'),
				delta = 0.05;
			
			elements.each(function (i) {
				$(this).data('x', 0);
			});
			
			requestAnimationFrame(function () {
				qodefTextMarquee.loop(thisMarquee, elements, delta);
			});
		},
		inRange: function (thisMarquee) {
			if (qodefCore.scroll + qodefCore.windowHeight >= thisMarquee.offset().top && qodefCore.scroll < thisMarquee.offset().top + thisMarquee.height()) {
				return true;
			}
			
			return false;
		},
		loop: function (thisMarquee, elements, delta) {
			if (!qodefTextMarquee.inRange(thisMarquee)) {
				requestAnimationFrame(function () {
					qodefTextMarquee.loop(thisMarquee, elements, delta);
				});
				return false;
			} else {
				elements.each(function (i) {
					var el = $(this);
					el.css('transform', 'translate3d(' + el.data('x') + '%, 0, 0)');
					el.data('x', (el.data('x') - delta).toFixed(2));
					el.offset().left < -el.width() - 25 && el.data('x', 100 * Math.abs(i - 1));
				});
				requestAnimationFrame(function () {
					qodefTextMarquee.loop(thisMarquee, elements, delta);
				});
			}
		}
	};

	qodefCore.shortcodes.pelicula_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.pelicula_vertical_split_slider = {};

    $(document).ready(function () {
        qodefVerticalSplitSlider.init();
    });

    var qodefVerticalSplitSlider = {
        init: function () {
            var $holder = $('.qodef-vertical-split-slider'),
                breakpoint = qodefVerticalSplitSlider.getBreakpoint($holder),
                initialHeaderStyle = '';

            if (qodefCore.body.hasClass('qodef-header--light')) {
                initialHeaderStyle = 'light';
            } else if (qodefCore.body.hasClass('qodef-header--dark')) {
                initialHeaderStyle = 'dark';
            }

            if ($holder.length) {
                $holder.multiscroll({
                    navigation: true,
                    navigationPosition: 'right',
                    afterRender: function () {
                        qodefCore.body.addClass('qodef-vertical-split-slider--initialized');
                        qodefVerticalSplitSlider.bodyClassHandler($('.ms-left .ms-section:first-child').data('header-skin'), initialHeaderStyle);
                    },
                    onLeave: function (index, nextIndex) {
                        qodefVerticalSplitSlider.bodyClassHandler($($('.ms-left .ms-section')[nextIndex - 1]).data('header-skin'), initialHeaderStyle);
                    }
                });

                $holder.height(qodefCore.windowHeight);
                qodefVerticalSplitSlider.buildAndDestroy(breakpoint);

                $(window).resize(function () {
                    qodefVerticalSplitSlider.buildAndDestroy(breakpoint);
                });
            }
        },
        getBreakpoint: function ($holder) {
            if ($holder.hasClass('qodef-disable-below--768')) {
                return 768;
            } else {
                return 1024;
            }
        },
        buildAndDestroy: function (breakpoint) {
            if (qodefCore.windowWidth <= breakpoint) {
                $.fn.multiscroll.destroy();
                $('html, body').css('overflow', 'initial');
                qodefCore.body.removeClass('qodef-vertical-split-slider--initialized');
            } else {
                $.fn.multiscroll.build();
                qodefCore.body.addClass('qodef-vertical-split-slider--initialized');
            }
        },
        bodyClassHandler: function (slideHeaderStyle, initialHeaderStyle) {
            if (slideHeaderStyle !== undefined && slideHeaderStyle !== '') {
                qodefCore.body.removeClass('qodef-header--light qodef-header--dark').addClass('qodef-header--' + slideHeaderStyle);
            } else if (initialHeaderStyle !== '') {
                qodefCore.body.removeClass('qodef-header--light qodef-header--dark').addClass('qodef-header--' + slideHeaderStyle);
            } else {
                qodefCore.body.removeClass('qodef-header--light qodef-header--dark');
            }
        }
    };

	qodefCore.shortcodes.pelicula_vertical_split_slider.qodefVerticalSplitSlider = qodefVerticalSplitSlider;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.pelicula_core_video_button = {};
    qodefCore.shortcodes.pelicula_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})(jQuery);
(function ($) {
	
	"use strict";
	qodefCore.shortcodes.pelicula_core_blog_list = {};
	qodefCore.shortcodes.pelicula_core_blog_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.pelicula_core_blog_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.pelicula_core_blog_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.pelicula_core_blog_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.pelicula_core_blog_list.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.pelicula_core_blog_list.qodefMainContent = qodef.qodefMainContent;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefVerticalNavMenu.init();
	});
	
	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		initNavigation: function ($verticalMenuObject) {
			var $verticalNavObject = $verticalMenuObject.find('.qodef-header-vertical-navigation');
			
			if ($verticalNavObject.hasClass('qodef-vertical-drop-down--below')) {
				qodefVerticalNavMenu.dropdownClickToggle($verticalNavObject);
			} else if ($verticalNavObject.hasClass('qodef-vertical-drop-down--side')) {
				qodefVerticalNavMenu.dropdownFloat($verticalNavObject);
			}
		},
		dropdownClickToggle: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
				var menuItem = this;
				var $dropdownOpener = $(this).find('> a');
				var slideUpSpeed = 'fast';
				var slideDownSpeed = 'slow';
				
				$dropdownOpener.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();
					
					if ($elementToExpand.is(':visible')) {
						$(menuItem).removeClass('qodef-menu-item--open');
						$elementToExpand.slideUp(slideUpSpeed);
					} else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
						$(this).parent().parent().children().removeClass('qodef-menu-item--open');
						$(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					} else {
						
						if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
							$menuItems.removeClass('qodef-menu-item--open');
							$menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
							$(this).parent().parent().children().removeClass('qodef-menu-item--open');
							$(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					}
				});
			});
		},
		dropdownFloat: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
				var menuItem = this;
				
				if (Modernizr.touch) {
					var $dropdownOpener = $(this).find('> a');
					
					$dropdownOpener.on('click tap', function (e) {
						e.preventDefault();
						e.stopPropagation();
						
						if ($elementToExpand.hasClass('qodef-float--open')) {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						} else {
							if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
								$menuItems.removeClass('qodef-menu-item--open');
								$allDropdowns.removeClass('qodef-float--open');
							}
							
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						}
					});
				} else {
					//must use hoverIntent because basic hover effect doesn't catch dropdown
					//it doesn't start from menu item's edge
					$(this).hoverIntent({
						over: function () {
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						},
						out: function () {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						},
						timeout: 300
					});
				}
			});
		},
		verticalAreaScrollable: function ($verticalMenuObject) {
			return $verticalMenuObject.hasClass('qodef-with-scroll');
		},
		initVerticalAreaScroll: function ($verticalMenuObject) {
			if (qodefVerticalNavMenu.verticalAreaScrollable($verticalMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($verticalMenuObject);
			}
		},
		init: function () {
			var $verticalMenuObject = $('.qodef-header--vertical #qodef-page-header');
			
			if ($verticalMenuObject.length) {
				qodefVerticalNavMenu.initNavigation($verticalMenuObject);
				qodefVerticalNavMenu.initVerticalAreaScroll($verticalMenuObject);
			}
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefVerticalSlidingNavMenu.init();
    });

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalSlidingNavMenu = {
        initNavigation: function ($verticalSlidingMenuObject) {
            var $verticalSlidingNavObject = $verticalSlidingMenuObject.find('.qodef-header-vertical-sliding-navigation');

            if ($verticalSlidingNavObject.hasClass('qodef-vertical-sliding-drop-down--below')) {
                qodefVerticalSlidingNavMenu.dropdownClickToggle($verticalSlidingNavObject);
            } else if ($verticalSlidingNavObject.hasClass('qodef-vertical-sliding-drop-down--side')) {
                qodefVerticalSlidingNavMenu.dropdownFloat($verticalSlidingNavObject);
            }
        },
        dropdownClickToggle: function ($verticalSlidingNavObject) {
            var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');

            $menuItems.each(function () {
                var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
                var menuItem = this;
                var $dropdownOpener = $(this).find('> a');
                var slideUpSpeed = 'fast';
                var slideDownSpeed = 'slow';

                $dropdownOpener.on('click tap', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if ($elementToExpand.is(':visible')) {
                        $(menuItem).removeClass('qodef-menu-item--open');
                        $elementToExpand.slideUp(slideUpSpeed);
                    } else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
                        $(this).parent().parent().children().removeClass('qodef-menu-item--open');
                        $(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);

                        $(menuItem).addClass('qodef-menu-item--open');
                        $elementToExpand.slideDown(slideDownSpeed);
                    } else {

                        if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
                            $menuItems.removeClass('qodef-menu-item--open');
                            $menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
                        }

                        if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
                            $(this).parent().parent().children().removeClass('qodef-menu-item--open');
                            $(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
                        }

                        $(menuItem).addClass('qodef-menu-item--open');
                        $elementToExpand.slideDown(slideDownSpeed);
                    }
                });
            });
        },
        dropdownFloat: function ($verticalSlidingNavObject) {
            var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');
            var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');

            $menuItems.each(function () {
                var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
                var menuItem = this;

                if (Modernizr.touch) {
                    var $dropdownOpener = $(this).find('> a');

                    $dropdownOpener.on('click tap', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if ($elementToExpand.hasClass('qodef-float--open')) {
                            $elementToExpand.removeClass('qodef-float--open');
                            $(menuItem).removeClass('qodef-menu-item--open');
                        } else {
                            if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
                                $menuItems.removeClass('qodef-menu-item--open');
                                $allDropdowns.removeClass('qodef-float--open');
                            }

                            $elementToExpand.addClass('qodef-float--open');
                            $(menuItem).addClass('qodef-menu-item--open');
                        }
                    });
                } else {
                    //must use hoverIntent because basic hover effect doesn't catch dropdown
                    //it doesn't start from menu item's edge
                    $(this).hoverIntent({
                        over: function () {
                            $elementToExpand.addClass('qodef-float--open');
                            $(menuItem).addClass('qodef-menu-item--open');
                        },
                        out: function () {
                            $elementToExpand.removeClass('qodef-float--open');
                            $(menuItem).removeClass('qodef-menu-item--open');
                        },
                        timeout: 300
                    });
                }
            });
        },
        verticalSlidingAreaScrollable: function ($verticalSlidingMenuObject) {
            return $verticalSlidingMenuObject.hasClass('qodef-with-scroll');
        },
        initVerticalSlidingAreaScroll: function ($verticalSlidingMenuObject) {
            if (qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable($verticalSlidingMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
                qodefCore.qodefPerfectScrollbar.init($verticalSlidingMenuObject);
            }
        },
        verticalSlidingAreaShowHide: function ($verticalSlidingMenuObject) {
            var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find('.qodef-vertical-sliding-menu-opener');

            $verticalSlidingMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!$verticalSlidingMenuObject.hasClass('qodef-vertical-sliding-menu--opened')) {
                    $verticalSlidingMenuObject.addClass('qodef-vertical-sliding-menu--opened');
                } else {
                    $verticalSlidingMenuObject.removeClass('qodef-vertical-sliding-menu--opened');
                }
            });
        },
        init: function () {
            var $verticalSlidingMenuObject = $('.qodef-header--vertical-sliding #qodef-page-header');

            if ($verticalSlidingMenuObject.length) {
                qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide($verticalSlidingMenuObject);
                qodefVerticalSlidingNavMenu.initNavigation($verticalSlidingMenuObject);
                qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll($verticalSlidingMenuObject);
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var fixedHeaderAppearance = {
		showHideHeader: function ($pageOuter, $header) {
			if (qodefCore.windowWidth > 1024) {
				if (qodefCore.scroll <= 0) {
					qodefCore.body.removeClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', '0');
					$header.css('margin-top', '0');
				} else {
					qodefCore.body.addClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight) + 'px');
					$header.css('margin-top', parseInt(qodefGlobal.vars.topAreaHeight) + 'px');
				}
			}
		},
		init: function () {
            
            if (!qodefCore.body.hasClass('qodef-header--vertical')) {
                var $pageOuter = $('#qodef-page-outer'),
                    $header = $('#qodef-page-header');
                
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                
                $(window).scroll(function () {
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
                
                $(window).resize(function () {
                    $pageOuter.css('padding-top', '0');
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
            }
		}
	};
	
	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;
	
})(jQuery);
(function ($) {
	"use strict";
	
	var stickyHeaderAppearance = {
		displayAmount: function () {
			if (qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0) {
				return parseInt(qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10);
			} else {
				return parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10);
			}
		},
		showHideHeader: function (displayAmount) {
			
			if (qodefCore.scroll < displayAmount) {
				qodefCore.body.removeClass('qodef-header--sticky-display');
			} else {
				qodefCore.body.addClass('qodef-header--sticky-display');
			}
		},
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();
			
			stickyHeaderAppearance.showHideHeader(displayAmount);
			$(window).scroll(function () {
				stickyHeaderAppearance.showHideHeader(displayAmount);
			});
		}
	};
	
	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;
	
})(jQuery);
(function($) {
    "use strict";

    $(document).ready(function(){
        qodefSearchFullscreen.init();
    });

	var qodefSearchFullscreen = {
	    init: function(){
            var $searchOpener = $('a.qodef-search-opener'),
                $searchHolder = $('.qodef-fullscreen-search-holder'),
                $searchClose = $searchHolder.find('.qodef-m-close');

            if ($searchOpener.length && $searchHolder.length) {
                $searchOpener.on('click', function (e) {
                    e.preventDefault();
                    if(qodefCore.body.hasClass('qodef-fullscreen-search--opened')){
                        qodefSearchFullscreen.closeFullscreen($searchHolder);
                    }else{
                        qodefSearchFullscreen.openFullscreen($searchHolder);
                    }
                });
                $searchClose.on('click', function (e) {
                    e.preventDefault();
                    qodefSearchFullscreen.closeFullscreen($searchHolder);
                });

                //Close on escape
                $(document).keyup(function (e) {
                    if (e.keyCode === 27 && qodefCore.body.hasClass('qodef-fullscreen-search--opened')) { //KeyCode for ESC button is 27
                        qodefSearchFullscreen.closeFullscreen($searchHolder);
                    }
                });
            }
        },
        openFullscreen: function($searchHolder){
            qodefCore.body.removeClass('qodef-fullscreen-search--fadeout');
            qodefCore.body.addClass('qodef-fullscreen-search--opened qodef-fullscreen-search--fadein');

            setTimeout(function () {
                $searchHolder.find('.qodef-m-form-field').focus();
            }, 900);

            qodefCore.qodefScroll.disable();
        },
        closeFullscreen: function($searchHolder){
            qodefCore.body.removeClass('qodef-fullscreen-search--opened qodef-fullscreen-search--fadein');
            qodefCore.body.addClass('qodef-fullscreen-search--fadeout');

            setTimeout(function () {
                $searchHolder.find('.qodef-m-form-field').val('');
                $searchHolder.find('.qodef-m-form-field').blur();
                qodefCore.body.removeClass('qodef-fullscreen-search--fadeout');
            }, 300);

            qodefCore.qodefScroll.enable();
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
        qodefSearch.init();
	});
	
	var qodefSearch = {
		init: function () {
            this.search = $('a.qodef-search-opener');

            if (this.search.length) {
                this.search.each(function () {
                    var $thisSearch = $(this);

                    qodefSearch.searchHoverColor($thisSearch);
                });
            }
        },
		searchHoverColor: function ($searchHolder) {
			if (typeof $searchHolder.data('hover-color') !== 'undefined') {
				var hoverColor = $searchHolder.data('hover-color'),
				    originalColor = $searchHolder.css('color');
				
				$searchHolder.on('mouseenter', function () {
					$searchHolder.css('color', hoverColor);
				}).on('mouseleave', function () {
					$searchHolder.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefProgressBarSpinner.init();
	});
	
	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $('#qodef-page-spinner.qodef-layout--progress-bar');
			
			if (this.holder.length) {
				qodefProgressBarSpinner.animateSpinner(this.holder);
			}
		},
		animateSpinner: function ($holder) {
			
			var $numberHolder = $holder.find('.qodef-m-spinner-number-label'),
				$spinnerLine = $holder.find('.qodef-m-spinner-line-front'),
				numberIntervalFastest,
				windowLoaded = false;
			
			$spinnerLine.animate({'width': '100%'}, 10000, 'linear');
			
			var numberInterval = setInterval(function () {
				qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
			
				if (windowLoaded) {
					clearInterval(numberInterval);
				}
			}, 100);
			
			$(window).on('load', function () {
				windowLoaded = true;
				
				numberIntervalFastest = setInterval(function () {
					if (qodefProgressBarSpinner.percentNumber >= 100) {
						clearInterval(numberIntervalFastest);
						$spinnerLine.stop().animate({'width': '100%'}, 500);
						
						setTimeout(function () {
							$holder.addClass('qodef--finished');
							
							setTimeout(function () {
								qodefProgressBarSpinner.fadeOutLoader($holder);
							}, 1000);
						}, 600);
					} else {
						qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
					}
				}, 6);
			});
		},
		animatePercent: function ($numberHolder, percentNumber) {
			if (percentNumber < 100) {
				percentNumber += 5;
				$numberHolder.text(percentNumber);
				
				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';
			
			$holder.delay(delay).fadeOut(speed, easing);
			
			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    qodefCore.shortcodes.pelicula_core_clients_list = {};
    qodefCore.shortcodes.pelicula_core_clients_list.qodefSwiper = qodef.qodefSwiper;
})(jQuery);
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
(function ($) {
	
    "use strict";
	qodefCore.shortcodes.pelicula_core_team_list = {};
	qodefCore.shortcodes.pelicula_core_team_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.pelicula_core_team_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.pelicula_core_team_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.pelicula_core_team_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.pelicula_core_team_list.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.pelicula_core_team_list.qodefMainContent = qodef.qodefMainContent;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.pelicula_core_testimonials_list = {};
	qodefCore.shortcodes.pelicula_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.pelicula_core_product_categories_list = {};
	qodefCore.shortcodes.pelicula_core_product_categories_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.pelicula_core_product_categories_list.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.pelicula_core_product_categories_list.qodefMainContent = qodef.qodefMainContent;

})(jQuery);
(function ($) {
	
    "use strict";
	qodefCore.shortcodes.pelicula_core_product_list = {};
	qodefCore.shortcodes.pelicula_core_product_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.pelicula_core_product_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.pelicula_core_product_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.pelicula_core_product_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.pelicula_core_product_list.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.pelicula_core_product_list.qodefMainContent = qodef.qodefMainContent;

})(jQuery);
(function($) {
    "use strict";

    /*
     **	Re-init scripts on gallery loaded
     */
	$(document).on('yith_wccl_product_gallery_loaded', function () {
		
		if (typeof qodefCore.qodefWooMagnificPopup === "function") {
			qodefCore.qodefWooMagnificPopup.init();
		}
	});

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideAreaCart.init();
	});
	
	var qodefSideAreaCart = {
		init: function () {
			var $holder = $('.qodef-woo-side-area-cart');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);
					
					if (qodefCore.windowWidth > 680) {
						qodefSideAreaCart.trigger($thisHolder);
						
						qodefCore.body.on('added_to_cart', function () {
							qodefSideAreaCart.trigger($thisHolder);
						});
					}
				});
			}
		},
		trigger: function ($holder) {
			var $opener = $holder.find('.qodef-m-opener'),
				$close = $holder.find('.qodef-m-close'),
				$items = $holder.find('.qodef-m-items');
			
			// Open Side Area
			$opener.on('click', function (e) {
				e.preventDefault();
				
				if (!$holder.hasClass('qodef--opened')) {
					qodefSideAreaCart.openSideArea($holder);
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideAreaCart.closeSideArea($holder);
						}
					});
				} else {
					qodefSideAreaCart.closeSideArea($holder);
				}
			});
			
			$close.on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
			
			if ($items.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($items);
			}
		},
		openSideArea: function ($holder) {
			qodefCore.qodefScroll.disable();
			
			$holder.addClass('qodef--opened');
			$('#qodef-page-wrapper').prepend('<div class="qodef-woo-side-area-cart-cover"/>');
			
			$('.qodef-woo-side-area-cart-cover').on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
		},
		closeSideArea: function ($holder) {
			if ($holder.hasClass('qodef--opened')) {
				qodefCore.qodefScroll.enable();
				
				$holder.removeClass('qodef--opened');
				$('.qodef-woo-side-area-cart-cover').remove();
			}
		}
	};
	
})(jQuery);

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefInteractiveLinkShowcaseList.init();
    });

    var qodefInteractiveLinkShowcaseList = {
        init: function () {
            this.holder = $('.qodef-interactive-link-showcase.qodef-layout--list');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        $images = $thisHolder.find('.qodef-m-images > .qodef-m-image'),
                        $links = $thisHolder.find('.qodef-m-items .qodef-m-item');
    
                    $images.eq(0).addClass('qodef--active');
                    $links.eq(0).addClass('qodef--active');
    
                    $links.on('touchstart mouseenter', function (e) {
                        var $thisLink = $(this);
        
                        if (!qodefCore.html.hasClass('touchevents') || (!$thisLink.hasClass('qodef--active') && qodefCore.windowWidth > 680)) {
                            e.preventDefault();
                            $images.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                            $links.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                        }
                    }).on('touchend mouseleave', function () {
                        var $thisLink = $(this);
        
                        if (!qodefCore.html.hasClass('touchevents') || (!$thisLink.hasClass('qodef--active') && qodefCore.windowWidth > 680)) {
                            $links.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                            $images.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                        }
                    });
    
                    $thisHolder.addClass('qodef--init');
                });
            }
        }
    };

	qodefCore.shortcodes.pelicula_core_interactive_link_showcase.qodefInteractiveLinkShowcaseList = qodefInteractiveLinkShowcaseList;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefInteractiveLinkShowcaseSlider.init();
    });

    var qodefInteractiveLinkShowcaseSlider = {
        init: function () {
            this.holder = $('.qodef-interactive-link-showcase.qodef-layout--slider');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        $images = $thisHolder.find('.qodef-m-image');
    
                    var $swiperSlider = new Swiper($thisHolder.find('.swiper-container'), {
                        loop: true,
                        slidesPerView: 'auto',
                        centeredSlides: true,
                        speed: 1400,
                        mousewheel: true,
                        init: false
                    });
    
                    $thisHolder.waitForImages(function () {
                        $swiperSlider.init();
                    });
    
                    $swiperSlider.on('init', function () {
                        $images.eq(0).addClass('qodef--active');
                        $thisHolder.find('.swiper-slide-active').addClass('qodef--active');
        
                        $swiperSlider.on('slideChangeTransitionStart', function () {
                            var $swiperSlides = $thisHolder.find('.swiper-slide'),
                                $activeSlideItem = $thisHolder.find('.swiper-slide-active');
            
                            $images.removeClass('qodef--active').eq($activeSlideItem.data('swiper-slide-index')).addClass('qodef--active');
                            $swiperSlides.removeClass('qodef--active');
            
                            $activeSlideItem.addClass('qodef--active');
                        });
        
                        $thisHolder.find('.swiper-slide').on('click', function (e) {
                            var $thisSwiperLink = $(this),
                                $activeSlideItem = $thisHolder.find('.swiper-slide-active');
            
                            if (!$thisSwiperLink.hasClass('swiper-slide-active')) {
                                e.preventDefault();
                                e.stopImmediatePropagation();
                
                                if (e.pageX < $activeSlideItem.offset().left) {
                                    $swiperSlider.slidePrev();
                                    return false;
                                }
                
                                if (e.pageX > $activeSlideItem.offset().left + $activeSlideItem.outerWidth()) {
                                    $swiperSlider.slideNext();
                                    return false;
                                }
                            }
                        });
        
                        $thisHolder.addClass('qodef--init');
                    });
                });
            }
        }
    };

	qodefCore.shortcodes.pelicula_core_interactive_link_showcase.qodefInteractiveLinkShowcaseSlider = qodefInteractiveLinkShowcaseSlider;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		// qodefTilt.init();
	});
	
	$(document).on('pelicula_trigger_get_new_posts', function () {
		// qodefTilt.init();
	});

	var qodefTilt = {
		init: function () {
			var $gallery = $('.qodef-hover-animation--tilt');
			
			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);
					
					$this.find('article .qodef-e-media-image').each(function () {
						var $tiltHolder = $(this).find('.js-tilt-glare');

						if ( $tiltHolder.length === 0 ) {

							$(this).tilt({
								maxTilt: 25,
								perspective: 1600,
								scale: 1,
								easing: "cubic-bezier(.03,.98,.52,.99)",
								transition: true,
								speed: 300,
								glare: true,
								maxGlare: 0.2,
							});
						}
					});
				});
			}
		}
	};
	
	// qodefCore.shortcodes.pelicula_core_portfolio_list.qodefTilt = qodefTilt;
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefInfoFollow.init();
	});
	
	$(document).on('pelicula_trigger_get_new_posts', function () {
		qodefInfoFollow.init();
	});
	
	var qodefInfoFollow = {
		init: function () {
			var $gallery = $('.qodef-hover-animation--follow');
			
			if ($gallery.length) {
				qodefCore.body.append('<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><span class="qodef-follow-info-category"></span><br/><span class="qodef-follow-info-title"></span></div></div>');
				
				var $followInfoHolder = $('.qodef-follow-info-holder'),
					$followInfoCategory = $followInfoHolder.find('.qodef-follow-info-category'),
					$followInfoTitle = $followInfoHolder.find('.qodef-follow-info-title');
				
				$gallery.each(function () {
					$gallery.find('.qodef-e-inner').each(function () {
						var $thisItem = $(this);
						
						//info element position
						$thisItem.on('mousemove', function (e) {
                            if(e.clientX + 20 + $followInfoHolder.width() > qodefCore.windowWidth){
                                $followInfoHolder.addClass('qodef-right');
                            }else{
                                $followInfoHolder.removeClass('qodef-right');
                            }

							$followInfoHolder.css({
								top: e.clientY + 20,
								left: e.clientX + 20
							});
						});
						
						//show/hide info element
						$thisItem.on('mouseenter', function () {
							var $thisItemTitle = $(this).find('.qodef-e-title'),
								$thisItemCategory = $(this).find('.qodef-e-info-category');
							
							if ($thisItemTitle.length) {
								$followInfoTitle.html($thisItemTitle.clone());
							}
							
							if ($thisItemCategory.length) {
								$followInfoCategory.html($thisItemCategory.html());
							}
							
							if (!$followInfoHolder.hasClass('qodef-is-active')) {
								$followInfoHolder.addClass('qodef-is-active');
							}
						}).on('mouseleave', function () {
							if ($followInfoHolder.hasClass('qodef-is-active')) {
								$followInfoHolder.removeClass('qodef-is-active');
							}
						});
					});
				});
			}
		}
	};
	
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHoverDir.init();
	});
	
	$(document).on('pelicula_trigger_get_new_posts', function () {
		qodefHoverDir.init();
	});
	
	var qodefHoverDir = {
		init: function () {
			var $gallery = $('.qodef-hover-animation--direction-aware');
			
			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);
					$this.find('article').each(function () {
						$(this).hoverdir({
							hoverElem: 'div.qodef-e-content',
							speed: 330,
							hoverDelay: 35,
							easing: 'ease'
						});
					});
				});
			}
		}
	};
	
	qodefCore.shortcodes.pelicula_core_portfolio_list.qodefHoverDir = qodefHoverDir;
	
})(jQuery);