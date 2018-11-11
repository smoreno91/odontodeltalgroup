(function($){
	"use strict";
    $(document).ready(function(){
	 	var dic=$('html').attr('dir');
    	$('.owl-carousel-two').each(function() {
			var $carousel = jQuery(this);
			var loop = $carousel.data('loop') ? $carousel.data('loop') : false;
			var margin = ($carousel.data('margin') || $carousel.data('margin') === 0) ? $carousel.data('margin') : 0;
			var nav = $carousel.data('nav') ? $carousel.data('nav') : false;
			var dots = $carousel.data('dots') ? $carousel.data('dots') : false;
			var themeClass = $carousel.data('themeclass') ? $carousel.data('themeclass') : 'owl-theme';
			var center = $carousel.data('center') ? $carousel.data('center') : false;
			var items = $carousel.data('items') ? $carousel.data('items') : 4;
			var autoplay = $carousel.data('autoplay') ? $carousel.data('autoplay') : false;
			var responsiveXs = $carousel.data('responsive-xs') ? $carousel.data('responsive-xs') : 1;
			var responsiveSm = $carousel.data('responsive-sm') ? $carousel.data('responsive-sm') : 2;
			var responsiveMd = $carousel.data('responsive-md') ? $carousel.data('responsive-md') : 3;
			var responsiveLg = $carousel.data('responsive-lg') ? $carousel.data('responsive-lg') : 4;
			var filters = $carousel.data('filters') ? $carousel.data('filters') : false;
			var language_rtl = false;
			if(dic=='rtl')
                    language_rtl = true;
			if (filters) {
				$carousel.clone().appendTo($carousel.parent()).addClass( filters.substring(1) + '-carousel-original' );
				jQuery(filters).on('click', 'a', function( e ) {
					//processing filter link
					e.preventDefault();
					if (jQuery(this).hasClass('selected')) {
						return;
					}
					var filterValue = jQuery( this ).attr('data-filter');
					jQuery(this).siblings().removeClass('selected active');
					jQuery(this).addClass('selected active');
					
					//removing old items
					$carousel.find('.owl-item').length;
					for (var i = $carousel.find('.owl-item').length - 1; i >= 0; i--) {
						$carousel.trigger('remove.owl.carousel', [1]);
					};

					//adding new items
					var $filteredItems = jQuery($carousel.next().find(' > ' +filterValue).clone());
					$filteredItems.each(function() {
						$carousel.trigger('add.owl.carousel', jQuery(this));
						
					});
					
					$carousel.trigger('refresh.owl.carousel');
				});
				
			} //filters

			$carousel.owlCarousel({
				loop: loop,
				margin: margin,
				nav: nav,
				autoplay: autoplay,
				dots: dots,
				themeClass: themeClass,
				center: center,
				items: items,
                touchDrag: false,
                mouseDrag: false,
                rtl: language_rtl,
				responsive: {
					0:{
						items: responsiveXs
					},
					767:{
						items: responsiveSm
					},
					992:{
						items: responsiveMd
					},
					1200:{
						items: responsiveLg
					}
				},
			})
			.addClass(themeClass);
			if(center) {
				$carousel.addClass('owl-center');
			}
		}); 
        $('.testimonials-owl-dots').each(function() {
    		var $owl1 = $(this);
    		var $owl2 = $owl1.next('.testimonials-owl-content');
    
    		$owl1.on('click', '.owl-item', function(e) {
    		  var carousel = $owl1.data('owl.carousel');
    		  e.preventDefault();
    		  carousel.to(carousel.relative($(this).index()));
    		})
    		.on('change.owl.carousel', function(event) {
    			if (event.namespace && event.property.name === 'position') {
    				var target = event.relatedTarget.relative(event.property.value, true);
    				$owl2.owlCarousel('to', target, 300, true);
    			}
    		});
    	});
        
       
    });
    
})(jQuery)