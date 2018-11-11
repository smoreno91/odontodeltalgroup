(function ($) {
    var fsa_init = {
        init: function () {
            this.defineVars();
            this.eventDefine.loadAppointments(this.toDay);
            this.eventDefine.userDetail();
            this.eventDefine.approveAndDeleteAppointment();
        },
        defineVars: function () {
            this.toDay = moment(new Date()).format("MM-YYYY");
            this.fsaCalendar = $('.fsa-calendal');
            this.listDay = [];
            this.faAppWaiting = $('.fa-app-wait');
            this.faWait = $('.fa-wait');
        },
        eventDefine: {
            loadAppointments: function (date) {
                $.ajax({
                    url: fa_var.ajax_url,
                    type: 'POST',
                    beforeSend: function () {
                        fsa_init.faAppWaiting.show();
                    },
                    data: {action: 'load_appointments_booked', date: date},
                })
                    .done(function (data) {
                        fsa_init.handle.addCalendar();
                        fsa_init.eventDefine.faDayHover(data);

                    })
                    .fail(function () {
                        return false;
                    })
                    .always(function () {
                        fsa_init.faAppWaiting.hide();
                    });
            },
            loadDateDetail:function (fa_date,ind) {
                var date = moment(fa_date).format('DD-MM-YYYY');
                $.ajax({
                    url: fa_var.ajax_url,
                    type: 'POST',
                    beforeSend: function () {
                        ind.parents('.fc-week').after('<div class="fsa-ct-book"><div class="fa-wait la-ball-clip-rotate-multiple la-dark la-3x" style="display:none;"><div></div><div></div></div></div>');
                        $('.fa-wait').show();
                    },
                    data: {action: 'load_appointments_in_a_day', date: date},
                })
                    .done(function (data) {
                        $('.fsa-ct-book').append(data);
                    })
                    .fail(function () {
                        return false;
                    })
                    .always(function () {
                        $('.fa-wait').hide();
                    });
            }
            ,
            fsaDayClick: function (fa_date, ind) {
                var date = moment(fa_date).format('DD-MM-YYYY');
                $('.fsa-ct-book').remove();
                $('.fa-tooltip').removeClass('fa-show-day');
                if (ind.hasClass('fa-active')) {
                    ind.removeClass('fa-active');
                }
                else {
                    ind.parents('.fc-day-grid').find('.fa-active').removeClass('fa-active');
                    ind.addClass('fa-active');
                    ind.find('.fa-tooltip').addClass('fa-show-day');
                    fsa_init.eventDefine.loadDateDetail(fa_date,ind);

                }
            },
            faDayHover: function (date_list) {
                var keys = Object.keys(date_list);
                fsa_init.listDay = $('.fc-day.fc-widget-content');
                fsa_init.listDay.each(function () {
                    var data_date = moment($(this).data('date')).format('DD-MM-YYYY');
                    if ($.inArray(data_date, keys) != -1) {
                        var appointment_num;
                        for (var key in date_list) {
                            if (data_date == key) {
                                appointment_num = date_list[key];
                            }
                        }
                        var title;
                        if (appointment_num > 1) {
                            title = appointment_num + ' Appointments';
                        }
                        else {
                            title = appointment_num + ' Appointment';
                        }
                        $(this).addClass('fa-has-appointment');
                        $(this).append('<div class="fa-tooltip" href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="' + title + '"></div>')
                        $('[data-toggle="popover"]').popover();
                    }

                });

            },
            userDetail:function () {
                $(document).on('click', '.fa-app-user',function (e) {
                    e.preventDefault();
                    var _faDate = $(this).data('date');
                    var _faTime = $(this).data('time');
                    var uid = $(this).data('uid');
                    var gid = $(this).data('gid');
                    var objData = {'date':_faDate,'time':_faTime,'uid':uid,'gid':gid};
                    $.ajax({
                        url: fa_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                            $('.fa-wait').show();
                        },
                        data: {action: 'fa_show_user_detail', objData: objData},
                    })
                        .done(function (data) {
                            $('.fa-app-wait').after(data);
                            var modal = $('.fa-user-modal');
                            var modal_overlay = document.getElementById('md-overlay');
                            window.onclick = function (event) {
                                if (event.target === modal_overlay) {
                                    modal.remove();
                                }
                            };
                            $('.fa-ud-close').on('click', function (e) {
                                e.preventDefault();
                                modal.remove();
                            });
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                            $('.fa-wait').hide();
                        });
                });
            },
            approveAndDeleteAppointment:function () {
                $(document).on('click','.fa-approve-btn',function (e) {
                    e.preventDefault();
                    var appId = $(this).data('appt-id');
                    var appDate = $(this).data('appt-date');
                    $.ajax({
                        url: fa_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                            $('.fa-wait').show();
                        },
                        data: {action: 'fa_approve_appointment', appId: appId, appDate:appDate},
                    })
                        .done(function (data) {
                            $('.fsa-ct-book').html(data);
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                            $('.fa-wait').hide();
                        });
                });
                $(document).on('click','.fa-booked-delete',function (e) {
                    e.preventDefault();
                    var deleAppId = $(this).data('appt-id');
                    var deleAppDate = $(this).data('appt-date');
                    var confirm = window.confirm('Are you sure want to delete this appointment?');
                    if (confirm == true) {
                        $.ajax({
                            url: fa_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                $('.fa-wait').show();
                            },
                            data: {action: 'fa_approve_appointment', deleAppId: deleAppId, deleAppDate:deleAppDate},
                        })
                            .done(function (data) {
                                $('.fsa-ct-book').html(data);
                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                                $('.fa-wait').hide();
                            });
                    }
                    else {
                        return;
                    }
                });

            }
        },
        handle: {
            addCalendar: function () {
                var obj_parent = fsa_init;
                var dp = obj_parent.fsaCalendar.fullCalendar({
                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    height: 1000,
                    dayClick: function (date, jsEvent, view) {
                        var ind = $(this);
                        obj_parent.eventDefine.fsaDayClick(date, ind);
                    },
                    viewRender: function (view, element) {
                        fsa_init.eventDefine.loadAppointments(moment(view.currentDate).format("MM-YYYY"));
                    },
                    navLinks: false,
                    allDayDefault: true
                });
            },
        },
        helpers: function () {

        }
    };
    fsa_init.init();
})(jQuery);