/**
 * Created by administrator on 12/1/13.
 */
(function($,sr){

    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        var timeout;

        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            };

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    }
    // smartresize
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

(function ( $ ) {
    $(function(){
        //    VARS
        var def, text, ref, num, id, header;
        def = $(".side-matter-ref");
        text = $(".side-matter-text");
        ref = text.find("dt");
        header = $("header");

        //    ACTIVATE REFS on DEF HOVER
        def.hover(function() {
                id = $(this).attr('id');
                num = id.split('-');
                num = num[1];

                $('#note-'+num).find('dt').addClass('hover');
            },
            function() {
                $('#note-'+num).find('dt').removeClass('hover');
            });

        def.click(function(e) {
            e.preventDefault();
            id = $(this).attr('id');
            num = id.split('-');
            num = num[1];

            $('.side-matter-note dt.clicked').removeClass('clicked');
            $('#note-'+num).find('dt').addClass('clicked');
        });

        ref.click(function(e) {
            if ($(this).hasClass('clicked'))
            {
                $(this).removeClass('clicked');
            }
            else
            {
                $(this).addClass('clicked');
            }
        });
//    HEADER ANIMATION
        var $header, $window, $doc, $nav, $navwrap, $navul, $logo, $logomini, 
            $dscrollTop, $homeSlides, $offset, $winWidth, $extra, $pagerLeft, $pagerRight, 
            $pointer, $homeH, $wpadminbar;

        $header = $('header'),
        $window = $(window),
        $doc = $(document),
        $nav = $('#nav'),
        $navwrap = $('#nav-wrap'),
        $navul = $('nav ul'),
        $logo = $('.logo'),
        $logomini = $('.logo-mini'),
        $pagerLeft = $('.pager-left'),
        $pagerRight = $('.pager-right'),
        $pointer = $('.nolink::after'),
        $wpadminbar = $('#wpadminbar');

        var $head_full_height, $trigger, $trigger2, $head_anim_speed;
        $head_full_height = $header.height();
        $trigger = $nav.offset().top + 1;
        if($wpadminbar.length && $window.width() > 781 ) $trigger -= $wpadminbar.height();
        $trigger2 = $trigger + 15;
        $head_anim_speed = 300;

        var $selector = $('.subnav');

        //    SERVICES SUBNAV ANIMATION
        $('.nolink a').click(function(e){
            e.preventDefault();
            
            var cPadTop = parseInt($('#content').css('paddingTop'));
            
            if ( $selector.hasClass('show') ) {
                set_subnav_heights('hide');
                $('.nolink').removeClass('show');
                
                cPadTop = cPadTop - $selector.data('oHeight');
            } else {
                var $win_height, $sn_height;
                $win_height = $window.height(),
                
                set_subnav_heights($sn_height);

                $sn_height = $selector.data('nHeight');
                $sn_offset = $head_full_height;
                
                if( $nav.hasClass('condensed') ){
                    $sn_offset = $head_full_height - $trigger2;
                }

             /*   console.log( '$win_height:' + $win_height 
                            + ' $sn_height:' + $sn_height 
                            + ' $head_full_height:' + $head_full_height 
                            + ' $trigger2:' + $trigger2 
                            + ' $sn_offset:' + $sn_offset );
            */

                if( $win_height < $sn_offset + $sn_height && $window.width() >= 500 ){
            
                    $selector
                        .animate({height: $win_height - $sn_offset },400)
                        .addClass('show'); 

                } else {

                    set_subnav_heights('show');

                }
                
                $('.nolink').addClass('show');
                
                cPadTop = cPadTop + $selector.data('nHeight');
               // console.log($selector.data('nHeight'));
           }
            $('#content').animate({paddingTop: cPadTop},400);

        });
        
        // subnav functions
        function set_subnav_heights(anim) {
            if(anim == 'show'){

                $selector
                .addClass('show')
                .animate({height: $selector.data('nHeight')},400);

            } else if(anim == 'hide'){

                $selector
                    .data('oHeight',$selector.height())
                    .css('height', 0)
                    .data('nHeight',$selector.height())
                    .height($selector.data('oHeight'))
                    .animate({height: $selector.data('nHeight')},400)
                    .removeClass('show');

            } else {

                $selector
                    .data('oHeight',anim)
                    .css('height','auto')
                    .data('nHeight',$selector.height())
                    .height($selector.data('oHeight'));

            }
        }




        // ANIMATE HEADER

        function headanim_stage1 ( scrolltoppos ) {

            if( $header.data('stage') == 0 && scrolltoppos > $trigger ){
                $header.data('stage', 1);
                $logomini.fadeIn( $head_anim_speed );
                $nav.addClass('condensed');
            }

            if( scrolltoppos > $trigger){
                $logomini.show();
                 $nav.addClass('condensed');
           }
            if( scrolltoppos > $trigger2 ){
                $header.data('stage', 2);

                $header.css({'position' : 'fixed', marginTop : '-' + $trigger2 + 'px' });
                $('#content').css({ paddingTop : $head_full_height + 'px' });
                
                $nav.stop().animate({paddingBottom: '0'}, $head_anim_speed );
            }

        }

        $header.data('stage', 0);

        if ($window.width() > 849) {
            $header.data('size', 2);
        }

        if( $header.length ){
            //$header.after('<div id="readout"></div>');
            $window.scroll(function(){
                if($window.width() > 500){
                    var $headheight;
                    $dscrollTop = $doc.scrollTop();
                    
                    if( $dscrollTop < $trigger && $header.data('stage') ){
                        
                        $header.data('stage', 0);
                        $header.css({'position' : 'relative', marginTop : '0' });
                        $('#content').css({paddingTop : '0'});
                        $logomini.hide();
                        $nav.removeClass('condensed').stop().animate({paddingBottom: '1rem'}, $head_anim_speed);

                    } else if( $header.data('stage') < 2 ){
                        headanim_stage1( $dscrollTop );
                    }                    
                }

            });
            $window.resize(function(){
                if($window.width() > 500){

                    $head_full_height = $header.height();
                    $trigger = $navwrap.position().top + $nav.position().top + 1;
                    $trigger2 = $trigger + 15;
                    $header.data('stage', 0);
                    
                    $dscrollTop = $doc.scrollTop();
                    headanim_stage1( $dscrollTop );
                }

           });
        }

//  HOME SLIDER POSITIONING

        // calculate window width
        $homeSlides = $('.home-slides');
        var $slides = $('.home-slides .cycle-slide a');

        $doc.on('cycle-post-initialize', '.home-slides', function(e, o){
            //console.log(o);
            $winWidth = $window.width();
            $homeH = $homeSlides.css('height');
            var $bp_med2 = 890,
                $bp_med = 780,
                $bp_small2 = 650,
                $bp_small = 500,
                $slide_width;

            // for full breakpoint
            if ($winWidth >= $bp_med2 ) {
                $slide_width = 850;
            }
            // for med breakpoint
            if ($winWidth >= $bp_med && $winWidth < $bp_med2 ) {
                $slide_width = 700;
            }
            if ($winWidth >= $bp_small2 && $winWidth < $bp_med ) {
                $slide_width = 600;
            }
            if ($winWidth >= $bp_small && $winWidth < $bp_small2 ) {
                $slide_width = 500;
            }
            if ($winWidth < $bp_small ) {
                $slide_width = 300;
            }

            // subtract slide from window
            $extra = $winWidth - $slide_width;
            // divide that by 2
            $offset = $extra / 2;
            // apply that to carousel-offset for home-slides
            o.carouselOffset = $offset;
            //            o.fx = 'carousel';
            //            o.slides = '> div';
            $pagerLeft.css({
                'left': $offset
            }).fadeIn();
            $pagerRight.css({
                'left': $slide_width + $offset - 150
            }).fadeIn();

            // for sm breakpoint
            
             //disable clickthru on inactive slides
        $('.cycle-slide a').click(function(e) {
           if($(this).parent().hasClass('cycle-slide-active')) {
               // allow click
//               alert('allow');
              
           } else {
//               alert('prevent');
               e.preventDefault();
           }
        });
        });

        $homeSlides.cycle({
            slides: '> div',
            fx: 'carousel',
            carouselVisible: 1.5,
            speed: 1100,
            carouselFluid: true
        });

        $homeSlides.on('cycle-next', function(e, o) {
            //console.log(o.currSlide);
        });

        $(window).load(function() {
            $homeSlides.fadeIn('slow');
        });

        $pagerLeft.click(function() {
            $homeSlides.cycle('prev');
        });

        $pagerRight.click(function() {
            $homeSlides.cycle('next');
        });
        

        // resize, uses smartresize
        $window.smartresize(function() {
            $winWidth = $window.width();
            $extra = $winWidth - 850;
            $offset = $extra / 2;

            $homeSlides.cycle('destroy');
            $homeSlides.cycle({
                slides: '> div',
                fx: 'carousel',
                carouselVisible: 1.5,
                speed: 700,
                carouselFluid: true,
                carouselOffset: $offset
            });

            $homeSlides.fadeIn('slow');

        });

        // toggle shortcode
        $(".toggle_container").hide();
        $("h4.trigger").click(function(){
            $(this).toggleClass("active").next().slideToggle("normal", function() {
                if( $(this).is(":hidden") ){
                    var $thisref = $(this).find('.side-matter-ref'),
                        count = $thisref.length;
                    if( count ) {
                        $thisref.each( function () {
                            var id = $(this).attr('id').replace("ref-","");
                            var note = '#note-' + id; // Sidenote
                            $(note).hide();
                            if (--count == 0) rccsPlaceNotes();
                        });
                    }
                } else {
                    rccsPlaceNotes();                    
                }
            });
            return false; //Prevent the browser jump to the link anchor
        });

 // Definition With Toggle and positioning fix
        function rccsPlaceNotes() {
            var offsetcumulate = 0;
            $('a.side-matter-ref').each( function(){
                if($(this).is(":visible") ){
                    var id = $(this).attr('id').replace("ref-","");
                    var ref = '#ref-' + id; // Reference anchor
                    var note = '#note-' + id; // Sidenote
                    $(note).show();
                    var refPosition = $(ref).offset().top;
                    var notePosition = $(note).offset().top; // Position of sidenote
                    var noteMargin = parseInt($(note).css('margin-top')); // this was the one detail that fixed everyhting after 4 hours!!!
                    var noteOffset = refPosition - notePosition + noteMargin; // Get current offset between reference and note, minus noteAdjust
                    var finalOffset = ( noteOffset < 0 || notePosition < 0 ) ? 0 : noteOffset; // If offset is negative, set to 0 (prevents layout problems)
                    offsetcumulate += finalOffset
                    $(note).css('marginTop', finalOffset); // Position note
                    //console.log(refPosition + "|" + notePosition + "||" + noteOffset + "|" + finalOffset + "|" + offsetcumulate);
                }
            });
        }       

        rccsPlaceNotes();
 
        if($('.side-matter-note').length) {
            $('.side-matter-note').each( function () {
                var id = $(this).attr('id').replace("note-","");
                if( $('#ref-'+id).closest('.toggle_container').is(":hidden") ) {
                    $(this).hide();
                    //console.log($(this).html());
                }
            });
        }




        // WHO WE ARE toggle

        if($('.who-we-are').length) {
        function isOdd(a, b) {
            if (a % b === 0) return false;
            else return true;
        }
        var wrapper = $('.who-we-are'),
            boxes = wrapper.children(),
            boxSize = boxes.first().outerWidth(true),
            w = wrapper.outerWidth(true),
            breakat = Math.floor(w / boxSize),
            aboutWrap = '<li class="about-wrapper"></li>';


        boxes.removeClass('edge')
            .filter(':nth-of-type(' + breakat + 'n)')
            .addClass('edge')
            .after(aboutWrap);

        if (isOdd(boxes.length, breakat)) {
            boxes.last().addClass('edge').after(aboutWrap);
        }

        var $head_height = 60;
        $(window).smartresize(function () {
            var w = wrapper.outerWidth(true),
                rebreakat = Math.floor(w / boxSize),
                aboutWrappers = $('.about-wrapper');

            aboutWrappers.each(function() {
                $(this).remove();
            });

                boxes.removeClass('edge')
                    .filter(':nth-of-type(' + rebreakat + 'n)')
                    .addClass('edge')
                    .after(aboutWrap);
                if (isOdd(boxes.length, rebreakat)) {
                    boxes.last().addClass('edge').after(aboutWrap);
                }
        });

        // stop animated scroll if user scrolls
        $('body,html').bind('scroll mousedown wheel DOMMouseScroll mousewheel keyup', function(e){
            if ( e.which > 0 || e.type == "mousedown" || e.type == "mousewheel"){
                $("html,body").stop();
            }
        })

        $('.staff-img').click(function () {
            var $this = $(this),
                clone = $this.children('.about-staff').clone(),
                aboutActive = $('.about-wrapper.active');

            // if this image's about is open, close it
            if ($this.hasClass('open')) {
                aboutActive.slideToggle()
                    .removeClass('active')
                    .children().slideToggle("fast", function(){
                        $(this).remove();
                        $('html, body').animate({
                            scrollTop: $this.offset().top - $head_height
                        }, 500);
                    });
                $this.removeClass('open').siblings().removeClass('fade');

                // if another image's about is open, switch them
            } else if ($this.siblings().hasClass('open')) {

                // if this is an edge but it's not open
                if ($this.hasClass('edge')) {

                    // if it's the same edge, swap the html
                    if ($this.next().hasClass('active')) {
                        $('.open').removeClass('open');
                        clone.addClass('clone');

                        $this.addClass('open');
                        aboutActive.children().animate({
                            opacity: 0
                        })
                            .after(clone).next().fadeIn("fast", function () {
                                $('.clone').removeClass('clone');
                                aboutActive.children().first().remove();
                                $('html, body').animate({
                                    scrollTop: $this.offset().top - $head_height
                                }, 500);
                            });
                    }
                    // if not, then close the active, empty it, and open the right one
                    else {
                        aboutActive.slideToggle()
                            .removeClass('active')
                            .children().remove();
                        $('.open').removeClass('open');
                        clone.show();
                        $this.addClass('open').next('.about-wrapper').addClass('active').append(clone).slideToggle(700, function() {
                            $('html, body').animate({
                                scrollTop: $this.offset().top - $head_height
                            }, 500);
                        });
                    }
                }

                // if it's the same edge, swap the about-staff
                else if ($this.nextAll('.edge').first().next().hasClass('active')) {
                    $('.open').removeClass('open');
                    clone.addClass('clone');

                    $this.addClass('open');
                    aboutActive.children().animate({
                        opacity: 0
                    })
                        .after(clone).next().fadeIn("fast", function () {
                            $('.clone').removeClass('clone');
                            aboutActive.children().first().remove();
                            $('html, body').animate({
                                scrollTop: $this.offset().top - $head_height
                            }, 500);
                        });
                }

                // if different, toggle and remove the open one, add and toggle new
                else {
                    $('.open').removeClass('open');
                    aboutActive.slideToggle().removeClass('active')
                        .children().slideToggle("fast", function() {
                            $(this).remove();
                        });
                    if ($this.hasClass('edge')) {
                        clone.show();
                        $this.next('.about-wrapper').addClass('active').append(clone).slideToggle(700, function() {
                            $('html, body').animate({
                                scrollTop: $this.offset().top - $head_height
                            }, 500);
                        });
                    } else {
                        clone.show();
                        $this.nextAll('.edge').first().next('.about-wrapper').addClass('active').append(clone).slideToggle(700, function() {
                            $('html, body').animate({
                                scrollTop: $this.offset().top - $head_height
                            }, 500);
                        });
                    }
                    $this.addClass('open').siblings('.staff-img').addClass('fade');
                }
                // unfade this img, fade all others
                $this.removeClass('fade').siblings('.staff-img').addClass('fade');

                // if no about is open, find the closest edge, append the about and open the wrapper
            } else {

                // if this img is the edge
                if ($this.hasClass('edge')) {
                    clone.show();
                    $this.next('.about-wrapper').addClass('active').append(clone).slideToggle(700, function() {
                        $('html, body').animate({
                            scrollTop: $this.offset().top - $head_height
                        }, 500);
                    });
                } else {
                    clone.show();
                    $this.nextAll('.edge').first().next('.about-wrapper').addClass('active').append(clone).slideToggle(700, function() {
                        $('html, body').animate({
                            scrollTop: $this.offset().top - $head_height
                        }, 500);
                    });
                }
                $this.addClass('open').siblings('.staff-img').addClass('fade');
            }
        });
        }
    });
})( jQuery );