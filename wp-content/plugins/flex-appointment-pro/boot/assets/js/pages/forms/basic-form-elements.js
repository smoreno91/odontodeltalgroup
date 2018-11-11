jQuery(function ($) {
    //Textare auto growth
    if($('textarea.auto-growth').length > 0){
        autosize($('textarea.auto-growth'));
    }

    //Datetimepicker plugin
    if($('.datetimepicker').length > 0){
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format: 'dddd DD MMMM YYYY - HH:mm',
            clearButton: true,
            weekStart: 1
        });
    }
    //Datetimepicker plugin
    if($('.datetimepicker2').length > 0){
        $('.datetimepicker2').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:MM',
            clearButton: true,
            weekStart: 1
        });
    }
    $('.datepicker').each(function () {
        var format = ($(this).attr('data-format') != '') ? $(this).attr('data-format') : 'YYYY-MM-DD';
       $(this).bootstrapMaterialDatePicker({
           format: format,
           clearButton: true,
           weekStart: 1,
           time: false
       });
    });

    if($('.timepicker').length > 0){
        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });
    }
    if($('.material-datimepicker').length > 0) {
        $('.material-datimepicker').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY', weekStart: 0, time: false});
    }
});