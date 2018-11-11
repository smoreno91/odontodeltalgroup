(function($){
	"use strict";
    $(document).ready(function(){
        var dic=$('html').attr('dir');
        var language_rtl = false;
        if(dic=='rtl')
            language_rtl = true;
        $('.cms-carousel-department').each(function() {
            $(this).owlCarousel({
                autoplay:false,
                responsiveClass:true,
                loop:true,
                nav: true,
                dots: false,
                navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                margin: 30,
                rtl: language_rtl,
                responsive:{
                    0:{
                        items:1
                    },
                    768:{
                        items:2
                    },
                    992:{
                        items:2
                    },
                    1200:{
                        items:2
                    }
                }
            });
        });
    });
})(jQuery)