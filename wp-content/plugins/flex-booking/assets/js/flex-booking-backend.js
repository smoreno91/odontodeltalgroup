/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
(function ($) {
    $(document).on('click', '.fsb-img-item', function (e) {
        e.preventDefault();
        var _this = $(this);
        var _val = $(this).attr('fsb-data');
        $('.fsb-img-val').val(_val);
        $('.fsb-img-item').removeClass('fsb-img-active');
        _this.addClass('fsb-img-active');
    });
})(jQuery);
