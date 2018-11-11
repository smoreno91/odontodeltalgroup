(function ($) {
    $('ul.fa-mailop-tabs li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.fa-mailop-tabs li').removeClass('current');
        $('.fa-mailop-tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    });
    $('ul.fa-data-tabs li').click(function () {
        var _this = $(this);
        var tab_id = _this.attr('tab-data');
        $('ul.fa-data-tabs li').removeClass('current');
        $('.fa-data-tab-content').removeClass('current');
        _this.addClass('current');
        $("#" + tab_id).addClass('current');
    });
    load_list_zip_file();
    $(document).on('click', '.fa-btn-reset', function (e) {
        var _this = $(this);
        if (_this.attr('disabled') === 'disabled') {
            return;
        }
        var process_stt = $('.fa-process-stt');
        var process_text = $('.fa-process-text');
        process_stt.css('width', '0%');
        process_text.html("Deleting old data...");
        e.preventDefault();
        var confirm = window.confirm('Are you sure want to reset to default data?');
        if (confirm == true) {
            _this.attr('disabled', 'disabled');
            $.ajax({
                url: fa_email_var.ajax_url,
                type: 'POST',
                beforeSend: function () {
                },
                data: {action: 'fa_reset_data', process: 'delete_data'}
            })
                .done(function (data) {
                    if (data = "delete_done") {
                        process_stt.css('width', '30%');
                        process_text.html("Insert time slots data...");
                        $.ajax({
                            url: fa_email_var.ajax_url,
                            type: 'POST',
                            beforeSend: function () {
                            },
                            data: {action: 'fa_reset_data', process: 'insert_ts'}
                        })
                            .done(function (data) {
                                if (data = "insert_done") {
                                    process_stt.css('width', '65%');
                                    process_text.html("Setup options default...");
                                    $.ajax({
                                        url: fa_email_var.ajax_url,
                                        type: 'POST',
                                        beforeSend: function () {
                                        },
                                        data: {action: 'fa_reset_data', process: 'setup_options'}
                                    })
                                        .done(function (data) {
                                            if (data = "setup_done") {
                                                process_stt.css('width', '100%');
                                                process_text.html("Completed!!!");
                                            }
                                        })
                                        .fail(function () {
                                            process_text.html("Reset failed !!!");
                                        })
                                        .always(function () {
                                        });
                                }
                            })
                            .fail(function () {
                                process_text.html("Reset failed !!!");
                            })
                            .always(function () {
                            });
                    }
                })
                .fail(function () {
                    process_text.html("Reset failed !!!");
                })
                .always(function () {
                });
        }
        else {
            return;
        }
    });
    $(document).on('click', '.fa-ex-button', function (e) {
        var process_config = load_process_bar();
        e.preventDefault();
        var list_options = [];
        $('.fa-ex-check').each(function () {
            if ($(this).val() === "yes") {
                list_options.push($(this).attr('id'));
            }
        });
        if (list_options.length === 0) {
            alert('Please select data to export!')
        } else {
            //handling first export options
            var toZip = '';
            var min_percent = 0;
            var some = 100/list_options.length;
            if (list_options.length === 1) {
                toZip = 'yes';
            }
            $.ajax({
                xhr: function() {
                    var ok = setInterval(function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.onprogress = function (e) {
                            if (e.lengthComputable) {
                                console.log(e.loaded+  " / " + e.total)
                            }
                            if(e.loaded ===e.total){
                                clearInterval(ok);
                            }
                        };
                    },100);
                    // xhr.onprogress ("load", function(evt) {
                    //     console.log(evt);
                    //     if (evt.lengthComputable) {
                    //         var percentComplete = evt.loaded / evt.total;
                    //         percentComplete = parseInt(percentComplete * 100);
                    //         console.log(percentComplete);
                    //     }
                    // }, false);
                    return xhr;
                },
                url: fa_email_var.ajax_url,
                type: 'POST',
                beforeSend: function () {

                },
                data: {action: 'fa_export_data', list_options: list_options, fa_zip: toZip}
            })
                .done(function (data) {
                    // if (data.status === "success") {
                    //     process_bar_handler(process_config[0],process_config[1],process_config[2],min_percent,min_percent+some);
                    //     min_percent = min_percent+some;
                    //     if (data.zip === "done") {
                    //         load_list_zip_file();
                    //     }
                    //     if (list_options.length > 1) {
                    //         //handling second export options
                    //         var toZip = '';
                    //         if (list_options.length === 2) {
                    //             toZip = 'yes';
                    //         }
                    //         $.ajax({
                    //             url: fa_email_var.ajax_url,
                    //             type: 'POST',
                    //             beforeSend: function () {
                    //             },
                    //             data: {action: 'fa_export_data', list_options: list_options[1], fa_zip: toZip}
                    //         })
                    //             .done(function (data) {
                    //                 if (data.zip === "done") {
                    //                     load_list_zip_file();
                    //                 }
                    //                 if (data.status === "success") {
                    //                     process_bar_handler(process_config[0],process_config[1],process_config[2],min_percent,min_percent+some);
                    //                     min_percent = min_percent+some;
                    //                     console.log(min_percent);
                    //                     if (list_options.length > 2) {
                    //                         //handling third export options
                    //                         var toZip = '';
                    //                         if (list_options.length === 3) {
                    //                             toZip = 'yes';
                    //                         }
                    //                         $.ajax({
                    //                             url: fa_email_var.ajax_url,
                    //                             type: 'POST',
                    //                             beforeSend: function () {
                    //                             },
                    //                             data: {
                    //                                 action: 'fa_export_data',
                    //                                 list_options: list_options[2],
                    //                                 fa_zip: toZip
                    //                             }
                    //                         })
                    //                             .done(function (data) {
                    //                                 if (data.zip === "done") {
                    //                                     load_list_zip_file();
                    //                                 }
                    //                                 if (data.status === "success") {
                    //                                     console.log(min_percent);
                    //                                     process_bar_handler(process_config[0],process_config[1],process_config[2],min_percent,min_percent+some);
                    //                                     min_percent = min_percent+some;
                    //                                     console.log(min_percent);
                    //                                     if (list_options.length > 3) {
                    //                                         //handling fourth export options
                    //                                         var toZip = '';
                    //                                         if (list_options.length === 4) {
                    //                                             toZip = 'yes';
                    //                                         }
                    //                                         $.ajax({
                    //                                             url: fa_email_var.ajax_url,
                    //                                             type: 'POST',
                    //                                             beforeSend: function () {
                    //                                             },
                    //                                             data: {
                    //                                                 action: 'fa_export_data',
                    //                                                 list_options: list_options[3],
                    //                                                 fa_zip: toZip
                    //                                             }
                    //                                         })
                    //                                             .done(function (data) {
                    //                                                 if (data.zip === "done") {
                    //                                                     load_list_zip_file();
                    //                                                 }
                    //                                                 if (data.status === "success") {
                    //                                                     // process_bar_handler(process_config[0],process_config[1],process_config[2],min_percent,min_percent+some);
                    //                                                     console.log('lol'+min_percent);
                    //                                                 }
                    //
                    //                                             })
                    //                                             .fail(function () {
                    //                                                 return false;
                    //                                             })
                    //                                             .always(function () {
                    //                                                 return false;
                    //                                             });
                    //                                     }
                    //                                 }
                    //
                    //                             })
                    //                             .fail(function () {
                    //                                 return false;
                    //                             })
                    //                             .always(function () {
                    //                                 return false;
                    //                             });
                    //                     }
                    //                 }
                    //
                    //             })
                    //             .fail(function () {
                    //                 return false;
                    //             })
                    //             .always(function () {
                    //                 return false;
                    //             });
                    //     }
                    // }

                })
                .fail(function () {
                    return false;
                })
                .always(function () {
                    return false;
                });
        }
    });
    $(document).on('click', '.fa-btn-delete', function (e) {
        e.preventDefault();
        var id = $(this).attr('item-data');
        $.ajax({
            url: fa_email_var.ajax_url,
            type: 'POST',
            beforeSend: function () {

            },
            data: {
                action: 'fa_delete_file_data',
                value_action: id
            }
        })
            .done(function (data) {
                if (data === "done") {
                    load_list_zip_file();
                }
            })
            .fail(function () {
                return false;
            })
            .always(function () {
                return false;
            });
    });
    function load_list_zip_file() {
        $.ajax({
            url: fa_email_var.ajax_url,
            type: 'POST',
            beforeSend: function () {

            },
            data: {
                action: 'fa_load_list_zip_file',
                command: 'action'
            }
        })
            .done(function (data) {
                if (data.status === "done") {
                    $('.fs-ex-file').html(data.layout);
                }
            })
            .fail(function () {
                return false;
            })
            .always(function () {
                return false;
            });
    }

    /**
     *
     * @returns {[*,*,*]}
     */
    function load_process_bar() {
        var canvas = document.getElementById('fa-ex-process');
        var ctx = canvas.getContext('2d');
        canvas.width = 160;
        canvas.height = 120;
        var export_process = new RadialBar(ctx, {
            x: 60,
            y: 60,
            radius: 40,
            lineWidth: 10,
            lineFill: '#CCB566',
            backLineFill: '#FB6929',
            bgFill: '#F8FF8E',
            isShowInfoText: true,
            infoFamily: '20px Arial'
        });
        var config_process = [export_process,canvas,ctx];
        return config_process;
    }
    /**
     *
     * @param process_name
     * @param ctx
     * @param min
     * @param max
     */
    function process_bar_handler(process_name,canvas,ctx,min,max){
        process_name.progress = min;
        process_name.degProgress = min * process_name.PERCENT_DEG;
        console.log(process_name);
        console.log(canvas);
        console.log(ctx);
        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            process_name.add(0.3,max);
            process_name.update();
            requestAnimationFrame(loop);
            return false;
        }
        loop();
    }
})(jQuery);