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