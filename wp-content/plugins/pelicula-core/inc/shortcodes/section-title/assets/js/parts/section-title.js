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