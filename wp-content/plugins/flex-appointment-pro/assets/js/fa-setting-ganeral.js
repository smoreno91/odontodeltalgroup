(function ($) {
    var objChildField = $('.fa-dependency');
    var objRedirectAuto = $('input#auto_redirect');
    var objNoRedirect = $('input#no_redirect');
    var kk = $('select.show-tick');
    if (kk.val() == 'guest') {
        objChildField.removeClass('fa-hide');
        objRedirectAuto.parent().addClass('fa-hide');
    }
    else {
        objChildField.addClass('fa-hide');
        objRedirectAuto.parent().removeClass('fa-hide');
    }
    kk.on('change', function () {
        if (kk.val() == 'guest') {
            objChildField.removeClass('fa-hide');
            objRedirectAuto.parent().addClass('fa-hide');
            objNoRedirect.attr('checked',true);
        }
        else {
            objChildField.addClass('fa-hide');
            objRedirectAuto.parent().removeClass('fa-hide');
        }
    });
})(jQuery);