/* Plugin for Cycle2; Copyright (c) 2012 M. Alsup; v20131022 */
(function(e){"use strict";e.extend(e.fn.cycle.defaults,{centerHorz:!1,centerVert:!1}),e(document).on("cycle-pre-initialize",function(i,t){function n(){clearTimeout(c),c=setTimeout(l,50)}function s(){clearTimeout(c),clearTimeout(a),e(window).off("resize orientationchange",n)}function o(){t.slides.each(r)}function l(){r.apply(t.container.find("."+t.slideActiveClass)),clearTimeout(a),a=setTimeout(o,50)}function r(){var i=e(this),n=t.container.width(),s=t.container.height(),o=i.outerWidth(),l=i.outerHeight();t.centerHorz&&n>=o&&i.css("marginLeft",(n-o)/2),t.centerVert&&s>=l&&i.css("marginTop",(s-l)/2)}if(t.centerHorz||t.centerVert){var c,a;e(window).on("resize orientationchange",n),t.container.on("cycle-destroyed",s),t.container.on("cycle-initialized cycle-slide-added cycle-slide-removed",function(){n()}),l()}})})(jQuery);