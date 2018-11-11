(function ($) {
    var fa_pending = {
        init: function () {
            $('#wpfooter').css('position', 'relative');
            this.defineVar();
            this.handler.loadPendingPage();
            this.eventDefine.userDetail();
            this.eventDefine.approveAppointment();
            this.eventDefine.deleteAppointment();
            this.eventDefine.selectAllAppointment();
            this.eventDefine.approveAndDeleteAllAppointment();
        },
        defineVar: function () {
            this.faUser = $(document).find('.fa-user');
            this.faPendingWait = $(document).find('.fa-user-detail');
            this.faApproveBtn = $(document).find('.fa-approve-btn');
        },
        eventDefine: {
            userDetail: function () {
                var _this = fa_pending;
                $(document).on('click', '.fa-user', function (e) {
                    e.preventDefault();
                    var _faDate = $(this).parents('.fa-pending-block').find('.fa-pending-date').html();
                    var _faTime = $(this).parents('.fa-pending-block').find('.fa-pending-time').html();
                    var uid = $(this).data('uid');
                    var gid = $(this).data('gid');
                    var objData = {'date': _faDate, 'time': _faTime, 'uid': uid, 'gid': gid};
                    $.ajax({
                        url: fa_pending_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                            _this.faPendingWait.show();
                        },
                        data: {action: 'fa_show_user_detail', objData: objData},
                    })
                        .done(function (data) {
                            $('.fa-pending-page').append(data);
                            var modal = $('.fa-user-modal');
                            var modal_overlay = document.getElementById('md-overlay');
                            window.onclick = function (event) {
                                if (event.target == modal_overlay) {
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
                            _this.faPendingWait.hide();
                        });
                });
            },
            approveAppointment: function () {
                var _this = fa_pending;
                $(document).on('click', '.fa-approve-btn', function (e) {
                    e.preventDefault();
                    var appId = $(this).data('app-id');
                    var appDate = $(this).data('app-date');
                    $.ajax({
                        url: fa_pending_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                            _this.faPendingWait.show();
                        },
                        data: {action: 'fa_approve_appointment', appId: appId, appDate: appDate},
                    })
                        .done(function (data) {
                            _this.handler.loadPendingPage();
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                        });
                });

            },
            deleteAppointment: function () {
                var _this = fa_pending;
                $(document).on('click', '.fa-delete-btn', function (e) {
                    e.preventDefault();
                    var appId = $(this).data('app-id');
                    var confirm = window.confirm('Are you sure want to delete this time slot?');
                    if (confirm == true) {
                        $.ajax({
                            url: fa_pending_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                _this.faPendingWait.show();
                            },
                            data: {action: 'fa_delete_appointment', appId: appId},
                        })
                            .done(function (data) {
                                if (data === 'done') {
                                    _this.handler.loadPendingPage();
                                }
                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                            });
                    }
                    else {
                        return;
                    }
                });
            },
            selectAllAppointment: function () {
                var _pendingPage = $('.fa-pending-page');
                $(document).on('change', '.fa-select-all', function () {
                    if ($(this).is(':checked')) {
                        _pendingPage.find('input:checkbox.fa-checkbox').each(function () {
                            $(this).prop('checked', true);
                        });
                    }
                    else {
                        _pendingPage.find('input:checkbox.fa-checkbox').each(function () {
                            $(this).prop('checked', false);
                        });
                    }
                });
            },
            approveAndDeleteAllAppointment: function () {
                var _this = fa_pending;
                var _pendingPage = $('.fa-pending-page');
                $(document).on('click', '.fa-approve-all', function (e) {
                    e.preventDefault();
                    var arrayId = [];
                    _pendingPage.find('input:checkbox.fa-checkbox').each(function () {
                        if ($(this).is(':checked')) {
                            arrayId.push($(this).val());
                        }
                    });
                    if (arrayId.length !== 0) {
                        $.ajax({
                            url: fa_pending_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                _this.faPendingWait.show();
                            },
                            data: {action: 'fa_approve_all_appointment', listID: arrayId}
                        })
                            .done(function (data) {
                                _this.handler.loadPendingPage();
                            })
                            .fail(function () {

                            })
                            .always(function () {
                            });
                    }
                });
                $(document).on('click', '.fa-delete-all', function (e) {
                    e.preventDefault();
                    var arrayId = [];
                    _pendingPage.find('input:checkbox.fa-checkbox').each(function () {
                        if ($(this).is(':checked')) {
                            arrayId.push($(this).val());
                        }
                    });
                    var confirm = window.confirm('Are you sure want to delete multi time slots?');
                    if (confirm == true) {
                        if (arrayId.length !== 0) {
                            $.ajax({
                                url: fa_pending_var.ajax_url,
                                type: 'POST',
                                beforeSend: function () {
                                    _this.faPendingWait.show();
                                },
                                data: {action: 'fa_delete_all_appointment', listID: arrayId}
                            })
                                .done(function (data) {
                                    _this.handler.loadPendingPage();
                                })
                                .fail(function () {

                                })
                                .always(function () {

                                });
                        }
                    }
                    else {
                        return;
                    }
                });

            }
        },
        handler: {
            loadPendingPage: function () {
                var _this = fa_pending;
                _this.defineVar();
                $.ajax({
                    url: fa_pending_var.ajax_url,
                    type: 'POST',
                    beforeSend: function () {
                        _this.faPendingWait.show();
                    },
                    data: {action: 'fa_load_pending_content'},
                })
                    .done(function (data) {
                        $('.fa-pending-page').html(data);
                        _this.faPendingWait.hide();
                    })
                    .fail(function () {
                        return false;
                    })
                    .always(function () {
                    });
            }

        }
    };
    fa_pending.init();
})(jQuery);