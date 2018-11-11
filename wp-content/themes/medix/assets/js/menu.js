(function ($) {
    "use strict";
    $(document).ready(function(){
        $('.nav-menu > li').each(function(){
            var $submenu = $(this).find('>ul');
            if($submenu.length == 1){
                $(this).hover(function(){  
                    if($submenu.offset().left + $submenu.width() > $(window).width()){  
                        $submenu.addClass('back');
                    }else if($submenu.offset().left < 0){
                        $submenu.addClass('back');
                    }
                }, function(){
                    $submenu.removeClass('back');
                });
            }
        });
 
        $('ul.sub-menu > li').each(function(){  
            var $submenu = $(this).find('>ul');
            if($submenu.length == 1){
                $(this).hover(function(){  
                    if($submenu.offset().left + $submenu.width() > $(window).width()){  
                        $submenu.addClass('back');
                    }else if($submenu.offset().left < 0){
                        $submenu.addClass('back');
                    }
                }, function(){
                    $submenu.removeClass('back');
                });
            }
        });
         
        /* Menu drop down*/
        $('.nav-menu li.menu-item-has-children').append('<span class="cs-menu-toggle"><i class="fa fa-angle-down"></i></span>');
        $('.cs-menu-toggle').on('click', function(){
            $(this).prev().toggleClass('submenu-open');
        });
        $('.mainmenu_side_wrapper .menu-item-has-children > a').on('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            $(this).next('ul').toggleClass('submenu-open');
        }); 
        /* Page Fixed Menu */
        $('.header-fixed-page').parents('body').addClass('remove-margin-top');
        $('#cshero-header.no-sticky').parents('body').addClass('remove-margin-top');
    });

})(jQuery);
