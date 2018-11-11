/**
 * Created by Admin on 7/18/2017.
 */
jQuery(function($) {
    "use strict";
    $('a[data-medix-calendar-filter*="target-"]').click(function(e){
        e.preventDefault();
        var _target = $(this).attr('data-medix-calendar-filter');
        _target = _target.substring(7);
        $(this).parents('.medix-schedule-calendar').find('a[data-medix-calendar-filter*="target-"]').removeClass('selected');
        $(this).addClass('selected');
        $(this).parents('.medix-schedule-calendar').find('td[data-medix-calendar-trigger*="clinic-"]').removeClass('medix-active');
        if(_target == '*')
            return;
        $(this).parents('.medix-schedule-calendar').find('td[data-medix-calendar-trigger="clinic-'+_target+'"]').addClass('medix-active');
    });
});