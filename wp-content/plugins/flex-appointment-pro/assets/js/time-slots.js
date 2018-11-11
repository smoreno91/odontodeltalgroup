/**
 * Created by kp on 4/6/2017.
 */
jQuery(document).ready(function ($) {

    var data_ts = {};
    var day_data = [];
    var item = '';
    var nearly_click = new Date();
    var ts_init = {
        init: function () {
            this.eventDefine.getAllTimeSlots();
            this.helper.hiddenButtonSave();
        },
        defineVars: function () {
            this.eDeleteTS = $('.fa-delete');
            this.eAddTS = $('.fa-btn-add-timeslot');
            this.eAddTemp = $('#fa-add-timeslots-temp');
            this.eAddArea = $('.fa-add-area');
            this.changeAdd = $('span.fa_changeCount_add');
            this.changeMinus = $('span.fa_changeCount_minus');
            this.spacesAvailable = $('.fa-count');
        },
        eventDefine: {
            getAllTimeSlots: function () {
                $.ajax({
                    url: fa_time_slots_var.ajax_url,
                    type: 'POST',
                    beforeSend: function () {
                    },
                    data: {
                        action: 'fa_get_time_slots',
                        fa_get_all_time_slots: 'get_all_items'
                    },
                })
                    .done(function (data) {
                        data_ts = data.result;
                        item = data.item;
                        if ($('.nav-tabs li a[href="#time_slots"]').attr('aria-expanded') === 'true')
                            $('.waves-effect').css('display', 'none');
                        if ($('.nav-tabs li a[href="#shortcodes"]').attr('aria-expanded') === 'true')
                            $('.waves-effect').css('display', 'none');
                        if ($('.nav-tabs li a[href="#fa_data_options"]').attr('aria-expanded') === 'true')
                            $('.waves-effect').css('display', 'none');
                        ts_init.helper.printItem();
                        ts_init.eventDefine.addTimeSlot(data.data_time_slots);
                    })
                    .fail(function () {
                        return false;
                    })
                    .always(function () {
                        return false;
                    });
            },
            deleteTimeSlot: function () {
                ts_init.defineVars();
                var _this = ts_init;
                _this.eDeleteTS.on('click', function (e) {
                    e.preventDefault();
                    var confirm = window.confirm('Are you sure want to delete this time slot?');
                    if (confirm == true) {
                        var item_id = $(this).data('tsid');
                        $(this).parents('.fa-item-ts').remove();
                        $.ajax({
                            url: fa_time_slots_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                            },
                            data: {action: 'fa_delete_time_slots', item_id: item_id},
                        })
                            .done(function (data) {
                                return false;
                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                                return false;
                            });
                    }
                    else {
                        return;
                    }

                });
            },
            addTimeSlot: function (time_val) {
                ts_init.defineVars();
                var _this = ts_init;
                _this.eAddTS.unbind('click');
                _this.eAddTS.on('click', function () {
                    _this.eAddTS.css('display', 'inline-block');
                    $(this).css('display', 'none');
                    _this.eAddArea.html('');
                    day = $(this).parent().data('day');
                    temp_add = _this.eAddTemp.clone();
                    temp_add.css('display', 'block');
                    $(document).find('.fa-add-time-slot-' + day).html(temp_add);
                    var dt = $($.parseHTML(time_val));
                    $('.fa-add-content').html(dt);
                    $('.fa-cancel-add').on('click', function () {
                        _this.eAddTS.css('display', 'inline-block');
                        _this.eAddArea.html('');
                    });
                    var _eEndtime = $('.select_end_time');
                    var _eStarttime = $('.select_start_time');
                    _eStarttime.on('change', function () {
                        if (_eStarttime.val() == 'allday') {
                            _eEndtime.css('display', 'none');
                        }
                        else {
                            _eEndtime.css('display', 'inline-block');
                        }
                        _eEndtime.children().each(function () {
                            if ($(this).val() <= _eStarttime.val()) {
                                $(this).attr('disabled', 'disabled');
                            }
                            else {
                                $(this).removeAttr('disabled');
                            }
                        });
                    });
                    $('a.fa-add-submit_ts').on('click', function (e) {
                        e.preventDefault();
                        var start_time = _eStarttime.val();
                        var end_time = _eEndtime.val();
                        var space_counts = $('.select_space_count').val();
                        if (start_time == 'allday') {
                            start_time = '0000';
                            end_time = '2400';
                        }
                        if (start_time == '' || end_time == '' || start_time == null || end_time == null) {
                            alert('All fields are required.');
                            return false;
                        }
                        var data_add_time_slots = day + "---" + start_time + "-" + end_time + "---" + space_counts;
                        $.ajax({
                            url: fa_time_slots_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                                $('.fa-add-wait').show();
                            },
                            data: {
                                action: 'fa_add_time_slots',
                                data_time_slots: data_add_time_slots
                            },
                        })
                            .done(function (data) {
                                _this.eAddTS.css('display', 'inline-block');
                                _this.eAddArea.html('');
                                data_ts = data;
                                ts_init.helper.printItem();
                            })
                            .fail(function () {
                                return false;
                            })
                            .always(function () {
                                $('.fa-add-wait').hide();
                                return false;
                            });
                    });
                });

            },
            changeSpacesAvailable: function () {
                var _this = ts_init;
                _this.changeAdd.on('click', function (e) {
                    e.preventDefault();
                    var current_time = new Date();
                    var differ_second = (current_time - nearly_click) / 1000;
                    nearly_click = current_time;
                    if (differ_second < 0.5) {
                        return false;
                    }
                    var tsid = $(this).parent().find('.fa-count').data('tsid');
                    var space_avai = $(this).parent().find('em');
                    var counts = parseInt(space_avai.html()) + 1;
                    if (counts == 1) {
                        var sp = '<em>' + counts.toString() + '</em> Space Available';
                    } else {
                        sp = '<em>' + counts.toString() + '</em> Spaces Available';
                    }
                    space_avai.parent().html(sp);
                    $.ajax({
                        url: fa_time_slots_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                        },
                        data: {
                            action: 'fa_update_spaces_available',
                            value_spa: counts,
                            tsid: tsid
                        },
                    })
                        .done(function (data) {
                            data_ts = data;
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                            return false;
                        });
                });
                _this.changeMinus.on('click', function (e) {
                    e.preventDefault();
                    var current_time = new Date();
                    var differ_second = (current_time - nearly_click) / 1000;
                    nearly_click = current_time;
                    if (differ_second < 0.5) {
                        return false;
                    }
                    var tsid = $(this).parent().find('.fa-count').data('tsid');
                    var space_avai = $(this).parent().find('em');
                    if (parseInt(space_avai.html()) == 1) {
                        return false;
                    }
                    var counts = parseInt(space_avai.html()) - 1;
                    if (counts == 1) {
                        var sp = '<em>' + counts.toString() + '</em> Space Available';
                    } else {
                        sp = '<em>' + counts.toString() + '</em> Spaces Available';
                    }
                    space_avai.parent().html(sp);
                    $.ajax({
                        url: fa_time_slots_var.ajax_url,
                        type: 'POST',
                        beforeSend: function () {
                        },
                        data: {
                            action: 'fa_update_spaces_available',
                            value_spa: counts,
                            tsid: tsid
                        },
                    })
                        .done(function (data) {
                            data_ts = data;
                        })
                        .fail(function () {
                            return false;
                        })
                        .always(function () {
                            return false;
                        });
                });
            }
        },
        handler: {},
        helper: {
            printItem: function () {
                day_data = [];
                for (i = 0; i < data_ts.length; i++) {
                    key = data_ts[i].fa_tl_day;
                    if (day_data[key] == null)
                        day_data[key] = [data_ts[i]];
                    else
                        day_data[key].push(data_ts[i]);
                }
                for (var key in day_data) {
                    var _day = $('#fa-day-ts-' + key);
                    _day.html("");
                    for (j = 0; j < day_data[key].length; j++) {
                        content_ts = $($.parseHTML(item));
                        content_ts.find('.timeslot').data('timeslot', day_data[key][j]['fa_tl_time']);
                        array_time = ts_init.helper.changeTimeValue(day_data[key][j]['fa_tl_time']);
                        content_ts.find('span.fa-start').html(array_time[0]);
                        content_ts.find('span.fa-end').html(array_time[1]);
                        if (day_data[key][j]['fa_tl_spa_av'] == '1') {

                            space_ava = '<em>' + day_data[key][j]['fa_tl_spa_av'] + '</em> Space Available';
                        }
                        else {
                            space_ava = '<em>' + day_data[key][j]['fa_tl_spa_av'] + '</em> Spaces Available';
                        }
                        content_ts.find('span.fa-count').html(space_ava);
                        content_ts.find('span.fa-count').data('tsid', day_data[key][j]['fa_tl_id']);
                        content_ts.find('span.fa-delete').data('tsid', day_data[key][j]['fa_tl_id']);
                        _day.append(content_ts);
                    }
                }
                ts_init.eventDefine.deleteTimeSlot();
                ts_init.eventDefine.changeSpacesAvailable();
            },
            changeTimeValue: function (time_value) {
                var array_time = time_value.split('-');
                for (i = 0; i < array_time.length; i++) {
                    array_time[i] = array_time[i].substring(0, 2) + ':' + array_time[i].substring(2, 4);
                }
                return array_time;
            },
            hiddenButtonSave: function () {
                $(document).on('click', '.nav-tabs li a', function (e) {
                    e.preventDefault();
                    if ($(this).attr('href') === '#time_slots' || $(this).attr('href') === '#shortcodes' || $(this).attr('href') === '#fa_data_options') {
                        $('.waves-effect').css('display', 'none');
                        return;
                    }
                    $('.waves-effect').css('display', 'block');
                });
            }
        }
    };

    ts_init.init();
});
