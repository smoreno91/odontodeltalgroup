(function($){
	"use strict";
    $(document).ready(function(){
        var dic=$('html').attr('dir');
    	$(".cms-carousel").each(function(){
    		var $this = $(this),slide_id = $this.attr('id'),slider_settings = cmscarousel[slide_id];
            if($this.attr('data-slidersettings')){
                slider_settings = jQuery.parseJSON($this.attr('data-slidersettings'));
            }
            else{
                slider_settings.margin = parseInt(slider_settings.margin);
                slider_settings.loop = (slider_settings.loop==="true");
                slider_settings.mouseDrag = (slider_settings.mouseDrag==="true");
                slider_settings.nav = (slider_settings.nav==="true");
                slider_settings.dots = (slider_settings.dots==="true");
                slider_settings.autoplay = (slider_settings.autoplay==="true");
                slider_settings.autoplayTimeout =  parseInt(slider_settings.autoplayTimeout);
                slider_settings.autoplayHoverPause = (slider_settings.autoplayHoverPause==="true");
                slider_settings.smartSpeed = parseInt(slider_settings.smartSpeed);
                if(dic=='rtl')
                    slider_settings.rtl = true;
                if($('.cms-dot-container'+slide_id).length){
                    slider_settings.dotsContainer = '.cms-dot-container'+slide_id;
                    slider_settings.dotsEach = true;
                }
            }
            var filters = $this.data('filters') ? $this.data('filters') : false;
            var center = slider_settings.center;
            
            if (filters) {
				$this.clone().appendTo($this.parent()).addClass( filters.substring(1) + '-carousel-original' );
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
					$this.find('.owl-item').length;
					for (var i = $this.find('.owl-item').length - 1; i >= 0; i--) {
						$this.trigger('remove.owl.carousel', [1]);
					};

					//adding new items
					var $filteredItems = jQuery($this.next().find(' > ' +filterValue).clone());
					$filteredItems.each(function() {
						$this.trigger('add.owl.carousel', jQuery(this));
						
					});
					
					$this.trigger('refresh.owl.carousel');
				});
				
			} 
            
           //$this.owlCarousel(slider_settings);
    		$this.on({
                'initialized.owl.carousel': function () {
                     $this.show();
                }
            }).owlCarousel(slider_settings);
            
            if(center) {
				$this.addClass('owl-center');
			}
    	});
        
        $(window).on('load', function() {
            overlapOwlNavWidth();
        });
        
        $(window).on('resize', function(event, ui) {
            overlapOwlNavWidth();
        });
         
        function overlapOwlNavWidth() {
        	$('.overlapped-owl-nav').each(function(){  
        		var $carousel = $(this);
        		var itemsAmount = $carousel.find('.owl-item.active').length;
        
        		if ($carousel.hasClass('owl-center')) {  
        			if (itemsAmount % 2 !== 0 && itemsAmount !== 2 && itemsAmount !== 3) {
        				var navWidth = $carousel.width() / itemsAmount;
        			} else if (itemsAmount === 2) {
        				var navWidth = ($carousel.width() - ($carousel.width() / 2) * 1.15) / 2;
        			} else if (itemsAmount === 3) {
        				var navWidth = ($carousel.width() - ($carousel.width() / 3) * 1.15) / 2;
        			} else {
        				var navWidth = $carousel.width() / itemsAmount / 2;
        			}
        		} else {
        			var navWidth = $carousel.width() / itemsAmount;
        		}
        
        		$carousel.find('.owl-nav').find('div').width(navWidth);
        	});
        }
        var owlItem = 1;
    	$('.cms-carousel-team .owl-dot').each(function(){
    		$(this).text(owlItem);
    	    owlItem++;
    	});
    });
})(jQuery)