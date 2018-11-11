jQuery(document).ready(function($) {
	"use strict";

	/* window */
	var window_width, window_height, scroll_top;

	/* admin bar */
	var adminbar = $('#wpadminbar');
	var adminbar_height = 0;
   
	/* header menu */
	var header = $('#cshero-header');
	var header_top = 0;
    
	/* scroll status */
	var scroll_status = '';
    
    $('[data-toggle="tooltip"]').tooltip();
	/**
	 * window load event.
	 * 
	 * Bind an event handler to the "load" JavaScript event.
	 * @author Fox
	 */
	$(window).on('load', function() {
	   
        if ( $('.wow').length ) {
          initWow(); 
        };
        
		/** current scroll */
		scroll_top = $(window).scrollTop();

		/** current window width */
		window_width = $(window).width();

		/** current window height */
		window_height = $(window).height();

		/* get admin bar height */
		adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;

		/* get top header menu */
		header_top = header.length > 0 ? header.offset().top - adminbar_height : 0 ;
        
        cms_page_loading();
          
		cms_lightbox_popup();
        
        /* auto resize video width */
        cms_auto_post_video_width();
        
        pieChart();
        
        $('.blog-columns').isotope({
            itemSelector: '.blog-columns > div',
        }); 
          
        setTimeout(function(){ cms_countdown(); }, 500);

        cms_custom_vc_row_stretch_content();
        
	});

	/**
	 * reload event.
	 * 
	 * Bind an event handler to the "navigate".
	 */
	window.onbeforeunload = function(){
	}
	 
	/**
	 * resize event.
	 * 
	 * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).on('resize', function(event, ui) {
		/** current window width */
		window_width = $(event.target).width();

		/** current window height */
		window_height = $(window).height();

		/** current scroll */
		scroll_top = $(window).scrollTop();
        
        /* auto resize video width */
        cms_auto_post_video_width();
        
        cms_custom_vc_row_stretch_content();
         
	});
	
	/**
	 * scroll event.
	 * 
	 * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).on('scroll', function() {
		/** current scroll */
		scroll_top = $(window).scrollTop();
        //cms_stiky_menu(); 
        pieChart(); 
        cms_back_to_top();
	});
    
    $(document).ajaxComplete(function(){  
        cms_auto_post_video_width();
    });
    
	$(".tnp-email").attr("placeholder", "EMAIL ADDRESS");
    
    //search modal
	$(".search_modal_button").on('click', function(e){  
		e.preventDefault();
		$('#search_modal').modal('show').find('input').first().focus();
        $("body.modal-open").removeAttr("style");
	});
     
    //side header
	var $sideHeader = $('.page_header_side');  
	if ($sideHeader.length) {  
		var $body = $('body');
		$('.toggle_menu_side').on('click', function(){ 
			if ($(this).hasClass('header-slide')) {
				$sideHeader.toggleClass('active-slide-side-header');
			} else {
				if($(this).parent().hasClass('header_side_right')) {
					$body.toggleClass('active-side-header slide-right');
				} else {
					$body.toggleClass('active-side-header');
				}
			}
		});
		 
		//hidding side header on click outside header
		$('body').on('click', function( e ) {
			if ( !($(e.target).closest('.page_header_side').length) && !($sideHeader.hasClass('page_header_side_sticked')) ) {
				$sideHeader.removeClass('active-slide-side-header');
				$body.removeClass('active-side-header slide-right');
			}
		});
	} //sideHeader check
    
    //video images preview - from WP
	$('.embed-placeholder').each(function(){
		$(this).on('click', function(e) {
			e.preventDefault();
			var $thisLink = $(this);
			if ($thisLink.attr('href') === '' || $thisLink.attr('href') === '#') {
				$thisLink.replaceWith($thisLink.data('iframe').replace(/&amp/g, '&').replace(/$lt;/g, '<').replace(/&gt;/g, '>').replace(/$quot;/g, '"')).trigger('click');
			} else {
				$thisLink.append('<iframe class="embed-responsive-item" src="'+ $thisLink.attr('href') + '?rel=0&autoplay=1'+ '"></iframe>');
			}
		});
	});
      
      
    var sb_text, sb_arr, sb_arr0, sb_arr1;
    $('.widget-area .wg-title,.wpb_widgetised_column .wg-title').each(function () {
        sb_text = $(this).text();
        sb_arr = sb_text.split(' ');
        if(sb_arr.length > 1){
            sb_arr0 = sb_arr.slice(0,sb_arr.length - 1);
            sb_arr1 = sb_arr.slice(sb_arr.length - 1);
            $(this).html(sb_arr0.join(' ') + '<strong>' + sb_arr1+ '</strong>');
        }
    });
     
    /**
     * Edit the count on the categories widget
     * @author Chinh Duong Manh
     * @since 1.0.0
     * @param element parent
    */

    $.fn.extend({
        cmsReplaceCount: function(is_woo){
            this.each(function(){
                if (is_woo == true) {
                    $(this).find('span.count').each(function(){
                        var count =  $(this).text();
                        var appendTo = $(this).parent().find('> a');
                        $(this).appendTo(appendTo);
                    })  
                } else {
                    $(this).find(' > ul > li').each(function() {
                        var cms_li = $(this);
                        cms_li.removeClass('recentcomments');
                        var small = $(this).html().replace('</a>&nbsp;(','&nbsp;<span class="count">(').replace(')',')</span></a>').replace('</a> (','<span class="count">&nbsp;(');
                        cms_li.html(small);
                        $(this).find(' .children li').each(function() {
                            var sm = $(this).html().replace('</a>&nbsp;(','&nbsp;<span class="count">(').replace(')',')</span></a>').replace('</a> (','<span class="count">&nbsp;(');
                            $(this).html(sm);
                            $(this).find(' .children li').each(function() {
                             var s = $(this).html().replace('</a>&nbsp;(','&nbsp;<span class="count">(').replace(')',')</span></a>').replace('</a> (','<span class="count">&nbsp;(');
                             $(this).html(s);
                            })
                        })
                    });
                }
            })
        }
    });
    // replace span.count to small 
    $('.widget_archive, .widget_categories, .product-categories').cmsReplaceCount(false);    
        
    /* Wow animation */
    function initWow(){
        var wow = new WOW( { mobile: false, } );
        wow.init();
    };
    
     /**
	 * Page loading
	 *
	 * Show or hide sticky menu.
	 * @author Fox
	 * @since 1.0.0
	 */
    function cms_page_loading(){
        $(".preloader_image").delay(200).fadeOut();
    	$(".preloader").delay(200).fadeOut("slow").delay(200, function(){
    		$(this).remove();
    	});	
    }
    
    /**
	 * Auto width video iframe
	 * 
	 * Youtube Vimeo.
	 * @author Fox
	 */
	function cms_auto_post_video_width() {  
		$('.entry-video iframe').each(function(){
			var v_width =$('.entry-video').width();
			var v_height = v_width / (16/9);
            $(this).attr('width',v_width);
			$(this).attr('height',v_height + 35);
		})
        $('.entry-video iframe').each(function(){
            $(this).attr('width','100%');
		});
        $('.format-video iframe').each(function(){
            $(this).attr('width','100%');
		});
        
	} 
	/**
	 * Stiky menu
	 *
	 * Show or hide sticky menu.
	 * @author Fox
	 * @since 1.0.0
	 */
	 //function cms_stiky_menu() {
    	if (header.length && header.hasClass('sticky-desktop') ) {
    		var headerHeight = header.outerHeight();
    		header.wrap('<div class="page_header_wrapper"></div>').parent().css({height: headerHeight}); //wrap header for smooth stick and unstick
    		if (header.hasClass('header_transparent')) {
    			$('.page_header_wrapper').addClass('header_transparent_wrapper');
    		}
    
    		//get offset
    		var headerOffset = 0;
    		//check for sticked template headers
                headerOffset = (header.offset().top - adminbar_height);
    		//for boxed layout - show or hide main menu elements if width has been changed on affix
    		$(header).on('affixed-top.bs.affix affixed.bs.affix affixed-bottom.bs.affix', function ( e ) {
    			if( header.hasClass('affix-top') ) {
    				header.parent().removeClass('affix-wrapper affix-bottom-wrapper').addClass('affix-top-wrapper');
    			} else if ( header.hasClass('affix') ) {
    				header.parent().removeClass('affix-top-wrapper affix-bottom-wrapper').addClass('affix-wrapper');
    			} else if ( header.hasClass('affix-bottom') ) {
    				header.parent().removeClass('affix-wrapper affix-top-wrapper').addClass('affix-bottom-wrapper');
    			} else {
    				header.parent().removeClass('affix-wrapper affix-top-wrapper affix-bottom-wrapper');
    			}
    		 
    		});
    
    		//if header has different height on afixed and affixed-top positions - correcting wrapper height
    		$(header).on('affixed-top.bs.affix', function () {
    		   if( !$( window ).scrollTop() ) return false;
    			header.parent().css({height: header.outerHeight()});
    		});
             
    		$(header).affix({
    			offset: {
    				top: headerOffset,
    				bottom: 0
    			}
    		});
    	}
        
	//} 
    
    //pie chart 
    function pieChart() {
		$('.chart').each(function(){
			var $currentChart = $(this);
			var imagePos = $currentChart.offset().top;
			var topOfWindow = $(window).scrollTop();
			if (imagePos < topOfWindow+900) {

				var size = $currentChart.data('size') ? $currentChart.data('size') : 270;
				var line = $currentChart.data('line') ? $currentChart.data('line') : 20;
				var bgcolor = $currentChart.data('bgcolor') ? $currentChart.data('bgcolor') : '#f5f5f5';
				var trackcolor = $currentChart.data('trackcolor') ? $currentChart.data('trackcolor') : '#c14240';
				var speed = $currentChart.data('speed') ? $currentChart.data('speed') : 3000;

				$currentChart.easyPieChart({
					barColor: trackcolor,
					trackColor: bgcolor,
					scaleColor: false,
					scaleLength: false,
					lineCap: 'butt',
					lineWidth: line,
					size: size,
					rotate: 0,
					animate: speed,
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
			}
		});
    	 
    }
	/**
	 * Mobile menu
	 * 
	 * Show or hide mobile menu.
	 * @author Fox
	 * @since 1.0.0
	 */
	
	$('body').on('click', '#cshero-menu-mobile', function(){
		var navigation = $(this).parent().find('#cshero-header-navigation');
		if(!navigation.hasClass('collapse')){
			navigation.addClass('collapse');
		} else {
			navigation.removeClass('collapse');
		}
	});

	/**
	 * Back to top
	 */
	$('body').on('click', '.ef3-back-to-top', function () {
		$('body, html').animate({scrollTop:0}, '1000');
	})
    
      /* Show or hide buttom  */
	function cms_back_to_top(){
		/* back to top */
        if (scroll_top < window_height) {
        	$('.ef3-back-to-top').addClass('off').removeClass('on');
        } else {
        	$('.ef3-back-to-top').removeClass('off').addClass('on');
        }
	}
    
     
    
	/**
	 * One page
	 *
	 * @author Fox
	 */
	if(typeof(one_page_options) != "undefined"){
		one_page_options.speed = parseInt(one_page_options.speed);
		$('#site-navigation').singlePageNav(one_page_options);
	}
    
    /**
	 * LightBox
	 * 
	 * @author Knight
	 * @since 1.0.0
	 */
	function cms_lightbox_popup() {   
		$('.magic-popup,.cms-product-gallery .zoom').magnificPopup({
			// delegate: 'a',
			type: 'image',
			mainClass: 'mfp-3d-unfold',
			removalDelay: 500,  
			callbacks: {
				beforeOpen: function() {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				}
			},
			closeOnContentClick: true,
			midClick: true  
		});
        
        
        $('.cms-video-popup').magnificPopup({
			//disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		
       
        $('.cms-map-popup').magnificPopup({
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,

			fixedContentPos: false
		});
        
		/* gallery */
		$('.cms-gallery-carousel').each(function(i, el) {
			$(el).magnificPopup({
				delegate: '.magic-popups',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-3d-unfold',
				removalDelay: 500, 
				callbacks: {
					beforeOpen: function() {
						this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					}
				},
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] 
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				}
			});
		});
        $('.cms-gallerys').magnificPopup({
			delegate: '.magic-popups',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-3d-unfold',
			removalDelay: 500,  
			callbacks: {
				beforeOpen: function() {
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				}
			},
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1]  
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			}
		});
         
	}
    /* CMS Countdown. */
	var _e_countdown = [];
	function cms_countdown() {
		"use strict";
		$('.cms-countdown').each(function () {
			var event_date = $(this).find('.cms-countdown-bar');
			var data_count = event_date.data('count');
			var server_offset = event_date.data('timezone');
		 
			/* get local time zone */
			var offset = (new Date()).getTimezoneOffset();
			offset = (- offset / 60) - server_offset;
			
			if(data_count != undefined){
				var data_label = event_date.attr('data-label');
				
				if(data_label != undefined && data_label != ''){
					data_label = data_label.split(',')
				} else {
					data_label = ['days','hours','minutes','seconds'];
				}
				
				data_count = data_count.split(',')
				
				var austDay = new Date(data_count[0],parseInt(data_count[1]) - 1,data_count[2],parseInt(data_count[3]) + offset,data_count[4],data_count[5]);
				
				_e_countdown.push(event_date.countdown({
					until: austDay,
					layout:'<div class="countdown-inner clearfix text-center"><div class="cms-count-day"><div class="countdown-item-container"><span class="countdown-amount">{dn}</span> <span class="countdown-period">'+data_label[0]+'</span></div></div><div class="cms-count-hours"><div class="countdown-item-container"><span class="countdown-amount">{hn}</span> <span class="countdown-period">'+data_label[1]+'</span></div></div><div class="cms-count-minutes"><div class="countdown-item-container"><span class="countdown-amount">{mn}</span> <span class="countdown-period">'+data_label[2]+'</span></div></div><div class="cms-count-second"><div class="countdown-item-container"><span class="countdown-amount">{sn}</span> <span class="countdown-period">'+data_label[3]+'</span></div></div></div>'
				}));
			}
		});
	}
 
   	/* Custom VC row stretch content 
     * This function just applied for header V6
     * @author Chinh Duong Manh
     * @since 1.0.0
     */
    function cms_custom_vc_row_stretch_content() {
        /* Boxed Layout */
        var language = $('html[dir="rtl"]'),
            css_attr = parseInt(language.find('.vc_row[data-vc-full-width]').css('left'));
        /* RTL Language */
        if (language) {
            language.find('.vc_row[data-vc-full-width]').css({'right': css_attr, 'left': ''});
        }
    }
    
});