/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
(function ($) {
    var date_picker = $("#datepicker"),
        time_input = $("#fa-app-time");
    date_picker.datepicker({
        dateFormat: "dd-mm-yy",
        minDate: new Date(),
        onSelect: function (date) {
            console.log(date);
            $.ajax({
                url: fsb_var.ajax_url,
                type: 'POST',
                sync: false,
                beforeSend: function () {
                    time_input.attr("disabled", "disabled");
                },
                data: {action: 'fsb_get_time_when_date_change', d: date}
            })
                .done(function (data) {
                    console.log(data);
                    $("#fa-app-time").html(data);
                })
                .fail(function () {
                    return false;
                })
                .always(function () {
                    time_input.removeAttr("disabled");
                });
        }
    });
    $(document).on("click", ".fa-app-form-submit", function (e) {
        e.preventDefault();
        $(".fa-invalid").removeClass("fa-invalid");
        var name = $(".fa-app-name"),
            phone = $(".fa-app-phone"),
            email = $(".fa-app-email"),
            date = $(".fa-app-date"),
            time = $(".fa-app-time"),
            message = $(".fa-app-message"),
            gender = $('input[name="fa-app-gender"]:checked'),
            _check = true,
            appoinment_datas = {};
        if (date.length > 0 && time.length > 0) {
            if (date.val() === '') {
                _check = false;
                date.addClass('fa-invalid');
            }
            else {
                appoinment_datas['date'] = date.val();
            }
            if (time.val() === '') {
                _check = false;
                time.addClass('fa-invalid');
            }
            else {
                appoinment_datas['time'] = time.val();
            }
        }
        //validate name
        if (name.val() === '') {
            name.addClass('fa-invalid');
            _check = false;
        }
        else {
            appoinment_datas['name'] = name.val();
        }
        //validate gender
        if (typeof gender.val() !== 'undefined') {
            appoinment_datas['gender'] = gender.val();
        }
        //validate message
        if (typeof message.val() !== 'undefined') {
            appoinment_datas['message'] = message.val();
        }
        if (phone.length > 0) {
            //validate phone
            if (phone.val() === '') {
                phone.addClass('fa-invalid');
                _check = false;
            } else {
                appoinment_datas['phone'] = phone.val();
            }
        }
        if (email.length > 0) {
            //validate mail
            var atpos = email.val().indexOf("@");
            var dotpos = email.val().lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.val().length) {
                email.addClass('fa-invalid');
                _check = false;
            }
            else {
                appoinment_datas['email'] = email.val();
            }
        }
        if (!_check) {
            return false;
        } else {
            var _loading = $(".fsb-wait"),
            app = {};
            app['guest'] = appoinment_datas;
            app['date'] = date.val();
            app['time'] = time.val();
            $.ajax({
                url: fsb_var.ajax_url,
                type: 'POST',
                beforeSend: function () {
                    _loading.show();
                },
                data: {action: 'fa_request_appointment', app_datas: app},
            })
                .done(function (data) {
                    _loading.hide();
                    if(data.result === "success"){
                        $(".fsb-booking-cnt").html(data.noti);
                        $(".fsb-modal").css("display","block");
                        $(document).on('click','.md-overlay,.md-close',function (e) {
                            e.preventDefault();
                            var modal = $(this).closest('.fsb-modal');
                            modal.remove();
                            location.reload();
                        });
                    }
                })
                .fail(function () {
                    return false;
                })
                .always(function () {
                    _loading.hide();
                });
        }
    });
})(jQuery);
