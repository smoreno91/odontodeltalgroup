    jQuery(document).ready(function($){
        $('.nav-tabs li a').click(function(event) {
            window.location.hash = $(this).attr('href');
        });
        if(window.location.hash.length > 0){
            $('.nav-tabs li a[href="'+window.location.hash+'"]').tab('show');
        }
    });

          