(function ($) {
    var week = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
    var fa_frontend = {
        init: function () {
            this.defineVars();
            this.handler.showCalendar();
            this.handler.faProfileTab();
            this.handler.faRequestLoginOrSignup();
        },
        defineVars: function () {
            this.toMonth = moment(new Date()).format("MM-YYYY");
            this.calendarFrontend = $('.fa-layout-frontend');
            this.listDay = [];
            this.otherMonth = $('.fc-day.fc-widget-content.fc-other-month');
        },
        eventDefine: {
            loadAppointments: function (month) {
                $.ajax({
                    url: fa_fr_var.ajax_url,
                    type: 'POST',
                    beforeSend: function () {
                        $('.fa-fr-wait').show();
                    },
                    data: {action: 'fa_frontend_load_spaces_available', month: month},
                })
                    .done(function (data) {
                        fa_frontend.eventDefine.faFrDayHover(data);
                        // var _today = $('.fc-day[class*="fc-today"]');
                        // if (!_today.hasClass("fa-fr-not-space") && !_today.hasClass('fa-fr-active')) {
                        //     fa_frontend.eventDefine.faFrDayClick(_today.data('date'), _today);
                        // }
                    })
                    .fail(function () {
                        return false;
                    })
                    .always(function () {
                        $('.fa-fr-wait').hide();
                        return false;
                    });
            },
            faFrDayHover: function (data) {
                var date_booked = data.appointment;
                var space_ava = data.space_ava;
                $('.fc-past').addClass('fa-fr-not-space');
                var space_ava_key = [];
                var space_ava_val = [];
                $.each(space_ava, function (key, value) {
                    space_ava_key.push(key);
                    space_ava_val.push(value);
                });
                var booked_keys = [];
                var booked_value = [];
                $.each(date_booked, function (key, value) {
                    booked_keys.push(key);
                    booked_value.push(value);
                });
                for (var i = 0; i < week.length; i++) {
                    var day_in_month = $('.fc-day.fc-widget-content.fc-' + week[i]);
                    var day_in_month_top = $('.fc-day-top.fc-' + week[i]);
                    var ind = $.inArray(week[i], space_ava_key);
                    if ($.inArray(week[i], space_ava_key) === -1) {
                        day_in_month.addClass('fa-fr-not-space');
                        day_in_month_top.addClass('fa-fr-not-space');
                    }
                    else {
                        day_in_month_top.each(function () {
                            if (!$(this).hasClass('fc-other-month') && !$(this).hasClass('fc-past') && !$(this).hasClass('fa-fr-not-space')) {
                                var data_date = moment($(this).data('date')).format('DD-MM-YYYY');
                                var number_booked = $.inArray(data_date, booked_keys);
                                $(this).find('.fa-tooltip').remove();
                                var ct = $(this).html();
                                if (number_booked === -1) {
                                    $(this).html('<div class="fa-tooltip" href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="' + space_ava_val[ind] + ' Available"></div>' + ct);
                                    $('[data-toggle="popover"]').popover();
                                }
                                else {
                                    number_booked = space_ava_val[ind] - booked_value[number_booked];
                                    $(this).html('<div class="fa-tooltip" href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="' + number_booked + ' Available"></div>' + ct);
                                    $('[data-toggle="popover"]').popover();
                                }
                            }
                        });
                    }
                    $('.fc-day.fc-widget-content.fc-other-month').html("");
                }
            },
            dayOnClick: function () {
                $('.fc-day-top').on('click', function () {
                    var ind = $(this);
                    var date = $(this).attr('data-date');
                    fa_frontend.eventDefine.faFrDayClick(date, ind);
                });
            },
            faFrDayClick: function (fa_date, ind) {
                if (ind.hasClass('fc-other-month') || ind.hasClass('fa-fr-not-space') || ind.hasClass('fc-past')) {
                    return false;
                }
                var day_number = ind.parents('.fc-row.fc-week.fc-widget-content').find('.fc-content-skeleton').find('tr td').eq(ind.index());
                $('.fsa-ct-book').remove();
                console.log(ind);
                if (ind.hasClass('fa-fr-active')) {
                    console.log('okok');
                    ind.removeClass('fa-fr-active');
                    day_number.removeClass('fa-fr-active');
                }
                else {
                    ind.parents('.fc-day-grid').find('.fa-fr-active').removeClass('fa-fr-active');
                    day_number.parents('.fc-day-grid').find('.fa-fr-active').removeClass('fa-fr-active');
                    ind.addClass('fa-fr-active');
                    day_number.addClass('fa-fr-active');
                    ind.find('.fa-tooltip').addClass('fa-show-day');
                    var date = moment(fa_date).format('DD-MM-YYYY');
                    $.ajax({
                        url: fa_fr_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                            ind.parents('.fc-week').after('<div class="fsa-ct-book"><div class="fa-fr-day-wait la-ball-clip-rotate-multiple la-dark la-3x" style="display:none;"><div></div><div></div></div></div>');
                            $('.fa-fr-day-wait').show();
                            $('.fa-fr-day-wait').popover();
                        },
                        data: {action: 'fa_frontend_get_time_slots_day', date: date},
                    })
                        .done(function (data) {
                            $('.fsa-ct-book').append(data);
                            fa_frontend.eventDefine.showRequestAppointment();
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                            $('.fa-fr-day-wait').hide();
                        });
                }
            },
            showRequestAppointment: function () {
                var _this = fa_frontend;
                var _newAppointment = $('button.fa-new-appt');
                var _request_wait = $('.fa-fr-request-app');
                _newAppointment.on('click', function (e) {
                    var obj = $(this);
                    e.preventDefault();
                    var date = $(this).data('date') + ',' + $(this).data('timeslot');
                    $.ajax({
                        url: fa_fr_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                            _request_wait.show();
                        },
                        data: {action: 'fa_frontend_load_form_request_appointment', date: date},
                    })
                        .done(function (data) {
                            _request_wait.parent().append(data);
                            $(document).on('click','.md-overlay,.md-close',function (e) {
                                e.preventDefault();
                                var modal = $(this).closest('.fa-modal');
                                modal.remove();
                            });
                            _this.eventDefine.requestAppointment(obj);
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                            _request_wait.hide();
                        });
                });

            },
            requestAppointment: function (obj) {
                var _faAppForm = $('.fa-app-form');
                var _btn_submit = $('.fa-request-app');
                var _date = $('.fa-app-date');
                var _time = $('.fa-app-time');
                var _name = $('.fa-app-name');
                var _email = $('.fa-app-email');
                var _phone = $('.fa-app-phone');
                var _submit_wait = $('.fa-fr-submit');
                var _modal_form = $('.fa-RequestForm');
                if (_modal_form.data('usertype') === 'registed') {
                    fa_frontend.handler.faRequestLoginOrSignup(obj);
                    fa_frontend.handler.faTab();
                }
                _btn_submit.on('click', function (e) {
                    e.preventDefault();
                    var _check = true;
                    var appoinment_datas = {};
                    _faAppForm.find('input:text.fa-invalid').removeClass('fa-invalid');
                    //validate date time
                    if (_date.length > 0 && _time.length > 0) {
                        if (_date.val() == '' || _time.val() == '') {
                            _check = false;
                        }
                        else {
                            appoinment_datas['date'] = _date.val();
                            appoinment_datas['time'] = _time.val();
                        }
                    }
                    //validate name
                    if (_name.val() == '') {
                        _name.addClass('fa-invalid');
                        _check = false;
                    }
                    else {
                        appoinment_datas['name'] = _name.val();
                    }
                    if (_phone.length > 0) {
                        //validate phone
                        if (_phone.val() == '') {
                            _phone.addClass('fa-invalid');
                            _check = false;
                        } else {
                            appoinment_datas['phone'] = _phone.val();
                        }
                    }
                    if (_email.length > 0) {
                        //validate mail
                        var atpos = _email.val().indexOf("@");
                        var dotpos = _email.val().lastIndexOf(".");
                        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= _email.val().length) {
                            _email.addClass('fa-invalid');
                            _check = false;
                        }
                        else {
                            appoinment_datas['email'] = _email.val();
                        }
                    }
                    if (!_check) {
                        return false;
                    } else {
                        app = {};
                        if (_modal_form.data('usertype') === 'guest') {
                            app['guest'] = appoinment_datas;
                        }
                        if (_modal_form.data('usertype') === 'logined') {
                            app['logined'] = appoinment_datas;
                        }
                        app['date'] = _date.val();
                        app['time'] = _time.val();
                        $.ajax({
                            url: fa_fr_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                _submit_wait.show();
                            },
                            data: {action: 'fa_request_appointment', app_datas: app},
                        })
                            .done(function (data) {
                                if (data.result === 'failed') {
                                    $('.fa-booked-app').append('<h4 class="fa-app-failed">' + data.noti + '</h4>');
                                    _btn_submit.attr('disabled', 'disabled');
                                }
                                else {
                                    if (data.redirect === 'no_redirect') {
                                        $('.fa-app-form').html(data.noti);
                                        $(document).on('click','.md-overlay,.md-close',function (e) {
                                            e.preventDefault();
                                            var modal = $(this).closest('.fa-modal');
                                            modal.remove();
                                        });
                                        var _date_current = moment(_date.val(), "DD-MM-YYYY").format("DD-MM-YYYY");
                                        var _month = moment(_date_current, "DD-MM-YYYY").format("MM-YYYY");
                                        $('.fsa-ct-book').remove();
                                        $(document).find('.fa-fr-active').removeClass('fa-fr-active');
                                        fa_frontend.eventDefine.loadAppointments(_month);
                                    }
                                    if (data.redirect === 'auto_redirect' || data.redirect === 'choose_redirect') {
                                        $('.fa-app-form').html(data.noti);
                                        $('#fa-redirect').submit();
                                    }
                                }

                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                                _submit_wait.hide();
                            });
                    }
                })
            }
        },
        handler: {
            showCalendar: function () {
                var obj_parent = fa_frontend;
                var dp = obj_parent.calendarFrontend.fullCalendar({
                    customButtons: {
                        prevButton: {
                            text: 'Prev',
                            click: function () {
                                obj_parent.calendarFrontend.fullCalendar('prev');
                                fa_frontend.eventDefine.dayOnClick();
                            }
                        },
                        nextButton: {
                            text: 'Next',
                            click: function () {
                                obj_parent.calendarFrontend.fullCalendar('next');
                                fa_frontend.eventDefine.dayOnClick();
                            }
                        }
                    },
                    header: {
                        left: 'prevButton',
                        center: 'title',
                        right: 'nextButton'
                    },
                    /*dayClick: function (date, jsEvent, view) {
                     /!* var ind = $(this);
                     console.log('Click day');
                     fa_frontend.eventDefine.faFrDayClick(date, ind);*!/
                     },*/
                    viewRender: function (view, element) {
                        fa_frontend.eventDefine.loadAppointments(moment(view.currentDate).format("MM-YYYY"));
                    },
                    contentHeight: 80,
                    navLinks: false,
                    allDayDefault: true
                });
                fa_frontend.eventDefine.dayOnClick();
            },
            faTab: function () {
                $('.fa-tab a').on('click', function (e) {
                    e.preventDefault();
                    $(this).parent().addClass('fa-active');
                    $(this).parent().siblings().removeClass('fa-active');
                    var href = $(this).attr('href');
                    $('.fa-forms > .fa-tab-content').hide();
                    $(href).fadeIn(500);
                });
            },
            faProfileTab: function () {
                $('ul.fa-prof-tabs li').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('ul.fa-prof-tabs li').removeClass('current');
                    $('.fa-tab-content').removeClass('current');

                    $(this).addClass('current');
                    $("#" + tab_id).addClass('current');
                });
                $(document).on('click', ".fa-prof-cancel", function (e) {
                    var _this = $(this);
                    e.preventDefault();
                    var confirm = window.confirm('Are you sure want to cancel the appointment?');
                    var appId = _this.data('id');
                    if (confirm === true) {
                        $.ajax({
                            url: fa_fr_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                            },
                            data: {action: 'fa_delete_appointment', appId: appId, actor:'user'}
                        })
                            .done(function (data) {
                                if (data === 'done') {
                                    location.reload();
                                }
                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                            });
                    }
                    else {
                        return false;
                    }
                });
            },
            faRequestLoginOrSignup: function (obj) {
                //defineVar login
                var _submit_wait = $('.fa-fr-submit');
                var _logMail = $('.fa-log-email');
                var _logPass = $('.fa-log-password');
                var _btnLogin = $('.fa-login-button');
                var _formLogin = $('#fa-login');
                var _labelInfo = $('.fa-label-info');
                var _notice = $('.fa-notice-log');
                var _requestForm = $('.fa-RequestForm');


                //check login
                _btnLogin.on('click', function (e) {
                    e.preventDefault();
                    var _check = true;
                    var loginData = {};
                    _formLogin.find('input.fa-invalid').removeClass('fa-invalid');
                    _formLogin.find('h5.fa-login-error').remove();
                    //validate email
                    if (_logMail.length > 0) {
                        //validate mail or username
                        if (_logMail.val().length < 1) {
                            _logMail.addClass('fa-invalid');
                            _check = false;
                        }
                        else {
                            loginData['email'] = _logMail.val();
                        }
                    }
                    //validate password
                    if (_logPass.length > 0) {
                        if (_logPass.val() === "" || _logPass.val().length > 20) {
                            _logPass.addClass('fa-invalid');
                            _check = false;
                        }
                        else {
                            loginData['password'] = _logPass.val();
                        }
                    }
                    if (_check) {
                        $.ajax({
                            url: fa_fr_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                _submit_wait.show();
                            },
                            data: {action: 'fa_login_and_register', loginData: loginData},
                        })
                            .done(function (data) {
                                if (data !== 'done') {
                                    _notice.html(data);
                                }
                                else {
                                    if(_notice.data('action') === 'profile'){
                                        window.location.reload();
                                    }
                                    else{
                                        _requestForm.remove();
                                        obj.trigger('click');
                                    }
                                }

                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                                _submit_wait.hide();
                            });
                    }
                });

                //defineVar Signup
                var _btnSignup = $('.fa-register-button');
                var _userName = $('.fa-userlogin');
                var _firstName = $('.fa-firstname');
                var _lastName = $('.fa-lastname');
                var _regMail = $('.fa-reg-email');
                var _regPass = $('.fa-reg-password');
                var _regForm = $('#fa-signup');
                var _noticeReg = $('.fa-notice-reg');
                //Signup new account
                _btnSignup.on('click', function (e) {
                    e.preventDefault();
                    var _checkReg = true;
                    var regData = {};
                    _regForm.find('input.fa-invalid').removeClass('fa-invalid');
                    _regForm.find('h5.fa-login-error').remove();
                    //validate user login name
                    if (_userName.length > 0) {
                        if (_userName.val() === "" || _userName.val().length > 20) {
                            _userName.addClass('fa-invalid');
                            _checkReg = false;
                        }
                        else {
                            regData['userlogin'] = _userName.val();
                        }
                    }
                    //validate first name
                    if (_firstName.length > 0) {
                        if (_firstName.val() === "" || _firstName.val().length > 20) {
                            _firstName.addClass('fa-invalid');
                            _checkReg = false;
                        }
                        else {
                            regData['firstname'] = _firstName.val();
                        }
                    }
                    //validate last name
                    if (_lastName.length > 0) {
                        if (_lastName.val() === "" || _lastName.val().length > 20) {
                            _lastName.addClass('fa-invalid');
                            _checkReg = false;
                        }
                        else {
                            regData['lastname'] = _lastName.val();
                        }
                    }
                    //validate email
                    if (_regMail.length > 0) {
                        var atpos = _regMail.val().indexOf("@");
                        var dotpos = _regMail.val().lastIndexOf(".");
                        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= _regMail.val().length) {
                            _regMail.addClass('fa-invalid');
                            _checkReg = false;
                        }
                        else {
                            regData['email'] = _regMail.val();
                        }
                    }
                    //validate password
                    if (_regPass.length > 0) {
                        if (_regPass.val() === "" || _regPass.val().length > 20) {
                            _regPass.addClass('fa-invalid');
                            _checkReg = false;
                        }
                        else {
                            regData['password'] = _regPass.val();
                        }
                    }
                    if (_checkReg) {
                        $.ajax({
                            url: fa_fr_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                _submit_wait.show();
                            },
                            data: {action: 'fa_login_and_register', regData: regData},
                        })
                            .done(function (data) {
                                if (data !== 'done') {
                                    _noticeReg.html(data);
                                }
                                else {
                                    if(_notice.data('action') === 'profile'){
                                        window.location.reload();
                                    }
                                    else{
                                        _requestForm.remove();
                                        obj.trigger('click');
                                    }
                                }

                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                                _submit_wait.hide();
                            });
                    }
                });
            }
        }
    };
    fa_frontend.init();
})(jQuery);
