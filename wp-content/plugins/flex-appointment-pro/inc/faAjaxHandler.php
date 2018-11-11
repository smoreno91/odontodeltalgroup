<?php
if (!defined('ABSPATH')) {
    exit();
}
if (!class_exists('faAjaxHandler')) {
    class faAjaxHandler extends fs_boot
    {
        public function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);
            add_action('wp_ajax_load_appointments_in_a_day', array($this, 'load_appointments_in_a_day'));
            add_action('wp_ajax_load_appointments_booked', array($this, 'load_appointments_booked'));
            add_action('wp_ajax_fa_get_time_slots', array($this, 'fa_get_time_slots'));
            add_action('wp_ajax_fa_delete_time_slots', array($this, 'fa_delete_time_slots'));
            add_action('wp_ajax_fa_add_time_slots', array($this, 'fa_add_time_slots'));
            add_action('wp_ajax_fa_update_spaces_available', array($this, 'fa_update_spaces_available'));
            add_action('wp_ajax_fa_frontend_load_spaces_available', array($this, 'fa_frontend_load_spaces_available'));
            add_action('wp_ajax_nopriv_fa_frontend_load_spaces_available', array($this, 'fa_frontend_load_spaces_available'));
            add_action('wp_ajax_fa_frontend_get_time_slots_day', array($this, 'fa_frontend_get_time_slots_day'));
            add_action('wp_ajax_nopriv_fa_frontend_get_time_slots_day', array($this, 'fa_frontend_get_time_slots_day'));
            add_action('wp_ajax_fa_frontend_load_form_request_appointment', array($this, 'fa_frontend_load_form_request_appointment'));
            add_action('wp_ajax_nopriv_fa_frontend_load_form_request_appointment', array($this, 'fa_frontend_load_form_request_appointment'));
            add_action('wp_ajax_fa_request_appointment', array($this, 'fa_request_appointment'));
            add_action('wp_ajax_nopriv_fa_request_appointment', array($this, 'fa_request_appointment'));
            add_action('wp_ajax_fa_login_and_register', array($this, 'fa_login_and_register'));
            add_action('wp_ajax_nopriv_fa_login_and_register', array($this, 'fa_login_and_register'));
            add_action('wp_ajax_fa_show_user_detail', array($this, 'fa_show_user_detail'));
            add_action('wp_ajax_fa_approve_appointment', array($this, 'fa_approve_appointment'));
            add_action('wp_ajax_fa_load_pending_content', array($this, 'fa_load_pending_content'));
            add_action('wp_ajax_fa_delete_appointment', array($this, 'fa_delete_appointment'));
            add_action('wp_ajax_fa_approve_all_appointment', array($this, 'fa_approve_all_appointment'));
            add_action('wp_ajax_fa_delete_all_appointment', array($this, 'fa_delete_all_appointment'));
            add_action('wp_ajax_fa_reset_data', array($this, 'fa_reset_data'));
            add_action('wp_ajax_fa_export_data', array($this, 'fa_export_data'));
            add_action('wp_ajax_fa_load_list_zip_file', array($this, 'fa_load_list_zip_file'));
            add_action('wp_ajax_fa_delete_file_data', array($this, 'fa_delete_file_data'));
            add_action('init', array($this, 'fa_download_file_data'));
        }

        function load_appointments_in_a_day()
        {
            if (isset($_POST['date'])):
                $date = date_create($_POST['date']);
                $ar['date'] = date_format($date, "F d, Y");
                $list_ts = fa_get_time_slots_filter_day($_POST['date']);
                $ar['list_ts'] = $list_ts;
                $layout = $this->admin_template__('appointment-booked.faDayLayout', $ar);
                wp_send_json($layout);
                die();
            endif;
        }

        function load_appointments_booked()
        {
            if (isset($_POST['date'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
                $sql .= "  `fa_date`  LIKE '%" . $_POST['date'] . "' ";
                $result = $wpdb->get_results($sql);
                $appointment = array();
                foreach ($result as $key => $date_data) {
                    if (!empty($appointment[$date_data->fa_date])) {
                        $appointment[$date_data->fa_date] = $appointment[$date_data->fa_date] + 1;
                    } else {
                        $appointment[$date_data->fa_date] = 1;
                    }

                }
                wp_send_json($appointment);
                die();
            }
        }

        function fa_get_time_slots()
        {
            if (isset($_POST['fa_get_all_time_slots'])) {
                $options = get_option('fa-setting');
                $time_intervals = (!empty($options['fa_timeslot_intervals'])) ? $options['fa_timeslot_intervals'] : '120';
                $data = array();
                ob_start();
                $this->admin_template_e('settings.faItemTS');
                $temp = ob_get_clean();
                global $table_prefix, $wpdb;
                $table_name = 'fa_timeslots';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "SELECT * FROM  `" . $wp_track_table . "` order by ";
                $sql .= "  fa_tl_day,fa_tl_time ";
                $result = $wpdb->get_results($sql);
                $data['data_time_slots'] = $this->admin_template__('elements.add_ts_form', array('time_intervals' => $time_intervals));
                $data['item'] = $temp;
                $data['result'] = $result;
                wp_send_json($data);
                die();
            }
        }

        function fa_delete_time_slots()
        {
            if (isset($_POST['item_id'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa_timeslots';
                $wp_track_table = $table_prefix . $table_name;
                $wpdb->delete($wp_track_table, array('fa_tl_id' => $_POST['item_id']));
                wp_send_json('donedone');
                die();
            }
        }

        function fa_add_time_slots()
        {
            if (isset($_POST['data_time_slots'])) {
                $data_time = explode('---', $_POST['data_time_slots']);
                $time_ts = explode('-', $data_time[1]);
                global $table_prefix, $wpdb;
                $table_name = 'fa_timeslots';
                $wp_track_table = $table_prefix . $table_name;
                //check new timeslots outside exists timeslots?
                $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE left(`fa_tl_time`,4)*1 >= " . $time_ts[0];
                $sql .= " AND right(fa_tl_time,4)*1 <= " . $time_ts[1];
                $sql .= " AND `fa_tl_day` = '" . $data_time[0] . "'";
                $result = $wpdb->get_results($sql);
                if (!empty($result)) {
                    $spaces = intval($data_time[2]);
                    $id_list = array();
                    foreach ($result as $old_ts) {
                        $spaces += intval($old_ts->fa_tl_spa_av);
                        $id_list[] = intval($old_ts->fa_tl_id);
                    }
                    $sql = "DELETE FROM `" . $wp_track_table . "` WHERE";
                    $sql .= "`fa_tl_id` IN (" . implode(',', $id_list) . ")";
                    $wpdb->query($sql);
                    $wpdb->insert(
                        $wp_track_table,
                        array(
                            'fa_tl_id'     => 'NULL',
                            'fa_tl_day'    => $data_time[0],
                            'fa_tl_time'   => $data_time[1],
                            'fa_tl_spa_av' => $spaces,
                        ),
                        array(
                            '%d',
                            '%s',
                            '%s',
                            '%d',
                        )
                    );
                    $sql = "SELECT * FROM  `" . $wp_track_table . "` order by ";
                    $sql .= "  fa_tl_day,fa_tl_time ";
                    $result = $wpdb->get_results($sql);
                    wp_send_json($result);
                    die();
                }
                //check new timeslots inside exists timeslots?
                $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE left(`fa_tl_time`,4)*1 <= " . $time_ts[0];
                $sql .= " AND right(fa_tl_time,4)*1 >= " . $time_ts[1];
                $sql .= " AND `fa_tl_day` = '" . $data_time[0] . "'";
                $sql .= " ORDER BY `fa_tl_spa_av` ASC";
                $sql .= " LIMIT 1";
                $result = $wpdb->get_results($sql);
                if (!empty($result)) {
                    $spaces = intval($data_time[2]) + $result[0]->fa_tl_spa_av;
                    $sql = "UPDATE `" . $wp_track_table . "` SET `fa_tl_spa_av` = " . $spaces;
                    $sql .= " WHERE `fa_tl_id` = " . $result[0]->fa_tl_id;
                    $wpdb->query($sql);
                    $sql = "SELECT * FROM  `" . $wp_track_table . "` order by ";
                    $sql .= "  fa_tl_day,fa_tl_time ";
                    $result = $wpdb->get_results($sql);
                    wp_send_json($result);
                    die();
                }
                //other case
                $wpdb->insert(
                    $wp_track_table,
                    array(
                        'fa_tl_id'     => 'NULL',
                        'fa_tl_day'    => $data_time[0],
                        'fa_tl_time'   => $data_time[1],
                        'fa_tl_spa_av' => $data_time[2],
                    ),
                    array(
                        '%d',
                        '%s',
                        '%s',
                        '%d',
                    )
                );
                $sql = "SELECT * FROM  `" . $wp_track_table . "` order by ";
                $sql .= "  fa_tl_day,fa_tl_time ";
                $result = $wpdb->get_results($sql);
                wp_send_json($result);
                die();

            }
        }

        function fa_update_spaces_available()
        {
            if (isset($_POST['value_spa']) && isset($_POST['tsid'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa_timeslots';
                $wp_track_table = $table_prefix . $table_name;
                $wpdb->update(
                    $wp_track_table,
                    array(
                        'fa_tl_spa_av' => $_POST['value_spa'],
                    ),
                    array('fa_tl_id' => $_POST['tsid']),
                    array(
                        '%d'
                    ),
                    array(
                        '%d'
                    )
                );
                $sql = "SELECT * FROM  `" . $wp_track_table . "` order by ";
                $sql .= "  fa_tl_day,fa_tl_time ";
                $result = $wpdb->get_results($sql);
                wp_send_json($result);
                die();
            }
        }

        function fa_frontend_load_spaces_available()
        {
            if (isset($_POST['month'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
                $sql .= "  `fa_date`  LIKE '%" . $_POST['month'] . "' ";
                $result_booked = $wpdb->get_results($sql);
                $appointment = array();
                foreach ($result_booked as $key => $date_data) {
                    if (isset($appointment[$date_data->fa_date])) {
                        $appointment[$date_data->fa_date][] = $date_data->fa_time;
                    } else {
                        $appointment[$date_data->fa_date] = array($date_data->fa_time);
                    }

                }
                $space_booked = array();
                foreach ($appointment as $date_booked => $time_booked_list) {
                    $ts_by_day = fa_get_time_slots_filter_day($date_booked);
                    $counts = 0;
                    foreach ($ts_by_day as $ts_time_inday) {
                        $add = @array_count_values($time_booked_list)[$ts_time_inday->fa_tl_time];
                        $counts += is_numeric($add) ? intval($add) : 0;
                    }
                    $space_booked[$date_booked] = $counts;
                }
                $table = 'fa_timeslots';
                $wp_track = $table_prefix . $table;
                $sql = "SELECT * FROM  `" . $wp_track . "` order by ";
                $sql .= "  fa_tl_day";
                $result_ts = $wpdb->get_results($sql);
                foreach ($result_ts as $key => $day_data) {
                    if (isset($space_ava[$day_data->fa_tl_day])) {
                        $space_ava[$day_data->fa_tl_day] = $space_ava[$day_data->fa_tl_day] + (int)$day_data->fa_tl_spa_av;
                    } else {
                        $space_ava[$day_data->fa_tl_day] = 0;
                        $space_ava[$day_data->fa_tl_day] = $space_ava[$day_data->fa_tl_day] + (int)$day_data->fa_tl_spa_av;
                    }
                }
                $data['appointment'] = $space_booked;
                $data['space_ava'] = $space_ava;
                $data['d'] = $appointment;
                wp_send_json($data);
                die();
            }
        }

        function fa_frontend_get_time_slots_day()
        {
            if (isset($_POST['date'])) {
                $date_format = $_POST['date'];
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
                $sql .= "  `fa_date`  = '" . $date_format . "' ";
                $result_booked = $wpdb->get_results($sql);
                $booked_list_time = array();
                foreach ($result_booked as $key => $date_data) {
                    $booked_list_time[] = $date_data->fa_time;
                }
                $result_ts = fa_get_time_slots_filter_day($date_format);
                $time_slots = array();
                foreach ($result_ts as $time_slot) {
                    $time_slots[$time_slot->fa_tl_time] = $time_slot->fa_tl_spa_av;
                }
                foreach ($time_slots as $time => $space) {
                    $c = array_count_values($booked_list_time)[$time];
                    $time_slots[$time] = $time_slots[$time] - $c;
                }
                ob_start();
                $date = date_create($date_format);
                $date = date_format($date, "F d, Y");
                echo $this->get_template_file__('frontend.faBookedList', array(
                    'time_slots'  => $time_slots,
                    'date'        => $date,
                    'format_date' => $date_format
                ), '', 'flexAppointment'
                );
                $data = ob_get_clean();
                wp_send_json($data);
                die();
            }
        }

        function fa_frontend_load_form_request_appointment()
        {
            if (isset($_POST['date'])) {
                $date_time = explode(',', $_POST['date']);
                $options = get_option('fa-setting');
                $args = array(
                    'post_type'      => 'page',
                    'posts_per_page' => 1,
                    'status'         => 'publish',
                    's'              => '[fsfa-profile]'
                );
                $search = new WP_Query($args);
                if ($search->have_posts()) {
                    $link = get_permalink($search->posts[0]->ID);
                } else {
                    $link = home_url();
                }
                if (isset($options['fa_booking_redirect']) && $options['fa_booking_redirect'] == "choose_redirect" && isset($options['page_id_redirect'])) {
                    $link = get_permalink($options['page_id_redirect']);
                }
                ob_start();
                echo $this->get_template_file__('frontend.faRequestForm',
                    array('date_time' => $date_time, 'options' => $options, 'link' => $link),
                    '',
                    'flexAppointment');
                $layout = ob_get_clean();
                wp_send_json($layout);
                die();
            }
        }

        function fa_request_appointment()
        {
            if (isset($_POST['app_datas'])) {
                //check space available
                global $table_prefix, $wpdb;
                $table_booked = 'fa';
                $wp_table_app = $table_prefix . $table_booked;
                $sql = "SELECT COUNT(*) FROM  `" . $wp_table_app . "` WHERE `fa_date` = '" . $_POST['app_datas']['date'] . "' AND `fa_time` = '" . $_POST['app_datas']['time'] . "'";
                $count = $wpdb->get_var($sql);

                $date = date_create($_POST['app_datas']['date']);
                $day = date_format($date, "D");
                $day = strtolower($day);
                $table_time = 'fa_timeslots';
                $sql = "SELECT `fa_tl_spa_av` FROM  `" . $table_prefix . $table_time . "` WHERE `fa_tl_day` = '" . $day . "' AND `fa_tl_time` = '" . $_POST['app_datas']['time'] . "' LIMIT 1";
                $rs = $wpdb->get_results($sql);
                $spaces = $rs[0]->fa_tl_spa_av;
                $available = (intval($spaces) - intval($count));
                if ($available < 1) {
                    $request['result'] = 'failed';
                    $request['noti'] = esc_attr__('Booking failed!!!', 'flex-appointments');
                    wp_send_json($request);
                    die();
                }
                if ($available >= 1) {
                    $options = get_option('fa-setting');
                    $appointment_stt = (!empty($options['fa_new_appointment_df'])) ? $options['fa_new_appointment_df'] : 'pending';
                    $redirect = (!empty($options['fa_booking_redirect'])) ? $options['fa_booking_redirect'] : 'no_redirect';
                    $obj_guest = (isset($_POST['app_datas']['guest']) ? $_POST['app_datas']['guest'] : array());
                    $obj_logined = (isset($_POST['app_datas']['logined']) ? $_POST['app_datas']['logined'] : array());

                    //booking for guest
                    if (!empty($obj_guest)) {
                        $date = (!empty($obj_guest['date'])) ? $obj_guest['date'] : '';
                        $time = (!empty($obj_guest['time'])) ? $obj_guest['time'] : '';
                        $name = (!empty($obj_guest['name'])) ? $obj_guest['name'] : '';
                        $email = (!empty($obj_guest['email'])) ? $obj_guest['email'] : '';
                        $phone = (!empty($obj_guest['phone'])) ? $obj_guest['phone'] : '';
                        $gender = (!empty($obj_guest['gender'])) ? $obj_guest['gender'] : 'not_know';
                        $message = (!empty($obj_guest['message'])) ? $obj_guest['message'] : '';
                        $table_name = 'fa_guest';
                        $wp_table_guest = $table_prefix . $table_name;
                        $result = $wpdb->insert(
                            $wp_table_guest,
                            array(
                                'fa_guest_id'    => 'NULL',
                                'fa_guest_name'  => $name,
                                'fa_guest_email' => $email,
                                'fa_guest_phone' => $phone,
                                'fa_guest_gender' => $gender,
                            ),
                            array(
                                '%d',
                                '%s',
                                '%s',
                                '%s',
                                '%s',
                            )
                        );
                        if (!$result) {
                            $request['result'] = 'failed';
                            $request['noti'] = esc_attr__('Booking failed!!!', 'flex-appointments');
                            wp_send_json($request);
                            die();
                        }
                        //get new guest id
                        $sql = "SELECT `fa_guest_id` FROM  `" . $wp_table_guest . "` order by `fa_guest_id` DESC LIMIT 1";
                        $guest_id = $wpdb->get_results($sql)[0]->fa_guest_id;

                        //insert appointment
                        $table_app = 'fa';
                        $wp_table_app = $table_prefix . $table_app;
                        $wpdb->insert(
                            $wp_table_app,
                            array(
                                'fa_id'     => 'NULL',
                                'fa_date'   => $date,
                                'fa_time'   => $time,
                                'fa_uid'    => 0,
                                'fa_gid'    => $guest_id,
                                'fa_status' => $appointment_stt,
                                'fa_message' => $message
                            )
                        );
                        $request['redirect'] = $redirect;
                        $request['guet_id'] = $guest_id;
                        $request['result'] = 'success';
                        $request['noti'] = '<p class="fa-book-success">' . esc_attr__('Booking success!!!', 'flex-appointments') . '</p>
                                            <div class="fa-button-request">
                                                <button class="md-close fa-ok">OK</button>
                                            </div>';
                        do_action('fa-after-request-appointment', $guest_id, array('date' => $date, 'time' => $time, 'status' => $appointment_stt));
                        wp_send_json($request);
                        die();
                    }
                    //booking for user logined
                    $current_user = wp_get_current_user();
                    if ($current_user->ID !== 0 && $current_user->user_level == 10) {
                        $fa_status = 'approved';
                    } else {
                        $fa_status = $appointment_stt;
                    }
                    if (!empty($obj_logined)) {
                        $date = (!empty($obj_logined['date'])) ? $obj_logined['date'] : '';
                        $time = (!empty($obj_logined['time'])) ? $obj_logined['time'] : '';
                        global $table_prefix, $wpdb;
                        //insert appointment
                        $table_app = 'fa';
                        $wp_table_app = $table_prefix . $table_app;
                        $wpdb->insert(
                            $wp_table_app,
                            array(
                                'fa_id'     => 'NULL',
                                'fa_date'   => $date,
                                'fa_time'   => $time,
                                'fa_uid'    => $current_user->ID,
                                'fa_gid'    => 0,
                                'fa_status' => $fa_status,
                            )
                        );
                        $request['redirect'] = $redirect;
                        $request['result'] = 'success';
                        $request['noti'] = '<p class="fa-book-success">' . esc_attr__('Booking success!!!', 'flex-appointments') . '</p>
                                            <div class="fa-button-request">
                                                <button class="md-close fa-ok">OK</button>
                                            </div>';
                        do_action('fa-after-request-appointment', $current_user->ID, array('date' => $date, 'time' => $time, 'status' => $fa_status));
                        wp_send_json($request);
                        die();
                    }
                }
            }
        }

        function fa_login_and_register()
        {
            if (!empty($_POST['loginData'])) {
                $email = $_POST['loginData']['email'];
                $request = 'not';
                if (username_exists(trim($email)) == false) {
                    $users = get_user_by('email', $email);
                    if (!$users) {
                        $request = '<h5 class="fa-login-error">Username or Email address does not exist.</h5>';
                    } else {
                        $creds = array(
                            'user_login'    => $users->user_login,
                            'user_password' => $_POST['loginData']['password'],
                            'remember'      => true
                        );
                        $user = wp_signon($creds, false);
                        if (is_wp_error($user)) {
                            $request = '<h5 class="fa-login-error">Incorrect password.</h5>';
                        } else {
                            $request = 'done';
                        }
                    }
                } else {
                    $creds = array(
                        'user_login'    => $email,
                        'user_password' => $_POST['loginData']['password'],
                        'remember'      => true
                    );
                    $user = wp_signon($creds, false);
                    if (is_wp_error($user)) {
                        $request = '<h5 class="fa-login-error">Incorrect password.</h5>';
                    } else {
                        $request = 'done';
                    }
                }
                wp_send_json($request);
                die();
            }
            if (!empty($_POST['regData'])) {
                $username = $_POST['regData']['userlogin'];
                $firstName = $_POST['regData']['firstname'];
                $lastName = $_POST['regData']['lastname'];
                $user_exists = username_exists($username);
                $email = $_POST['regData']['email'];
                $user_by_mail = get_user_by('email', $email);
                if (!empty($user_exists)) {
                    $request = '<h5 class="fa-login-error">User name already exists.</h5>';
                } elseif ($user_by_mail) {
                    $request = '<h5 class="fa-login-error">Email already exists.</h5>';
                } else {
                    $new_uid = wp_create_user($username, $_POST['regData']['password'], $email);
                    if (is_wp_error($new_uid)) {
                        $request = '<h5 class="fa-login-error">Incorrect password.</h5>';
                    } else {
                        $update_firstname = update_user_meta($new_uid, 'first_name', $firstName);
                        $update_lastname = update_user_meta($new_uid, 'last_name', $lastName);
                        if (!$update_firstname || !$update_lastname) {
                            $request = '<h5 class="fa-login-error">An error occurred.</h5>';
                        } else {
                            $creds = array(
                                'user_login'    => $username,
                                'user_password' => $_POST['regData']['password'],
                                'remember'      => true
                            );
                            do_action('fa-after-register-account', $_POST['regData']);
                            wp_signon($creds, false);
                            $request = 'done';
                        }

                    }
                }
                wp_send_json($request);
                die();
            }
        }

        function fa_load_pending_content()
        {
            global $table_prefix, $wpdb;
            $table_app = 'fa';
            $wp_track_table_app = $table_prefix . $table_app;
            $sql = "SELECT * FROM  `" . $wp_track_table_app . "` WHERE ";
            $sql .= "  `fa_status`  = 'pending' order by `fa_id` DESC";
            $result = $wpdb->get_results($sql);
            ob_start();
            $this->admin_template_e('pending.faPendingContent', array('pendings' => $result));
            $data = ob_get_clean();
            wp_send_json($data);
            die();
        }

        function fa_show_user_detail()
        {
            if (!empty($_POST['objData'])) {
                $detail['info'] = $_POST['objData'];
                if ($_POST['objData']['uid'] != 0) {
                    $detail['user']['name'] = get_user_by('ID', $_POST['objData']['uid'])->display_name;
                    $detail['user']['email'] = get_user_by('ID', $_POST['objData']['uid'])->user_email;
                    $detail['user']['type'] = 'Customer';
                } else {
                    $guest_user = getGuestUserById($_POST['objData']['gid']);
                    $detail['user']['name'] = $guest_user[0]->fa_guest_name;
                    $detail['user']['email'] = $guest_user[0]->fa_guest_email;
                    $detail['user']['phone'] = $guest_user[0]->fa_guest_phone;
                    $detail['user']['gender'] = $guest_user[0]->fa_guest_gender;
                    $detail['user']['type'] = 'Guest user';
                }
                ob_start();
                $this->admin_template_e('pending.faUserDetail', $detail);
                $data = ob_get_clean();
                wp_send_json($data);
                die();
            }
        }

        function fa_approve_appointment()
        {
            if (isset($_POST['appId']) && isset($_POST['appDate'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $result = $wpdb->update(
                    $wp_track_table,
                    array(
                        'fa_status' => 'approved',
                    ),
                    array('fa_id' => $_POST['appId']),
                    array('%s'),
                    array('%d')
                );
                if ($result != false) {
                    $date = date_create($_POST['appDate']);
                    $ar['date'] = date_format($date, "F d, Y");
                    $list_ts = fa_get_time_slots_filter_day($_POST['appDate']);
                    $ar['list_ts'] = $list_ts;
                    $layout = $this->admin_template__('appointment-booked.faDayLayout', $ar);
                    do_action('fa-after-approved-appointment', $_POST['appId']);
                    wp_send_json($layout);
                    die();
                }
            }
            //delete appointment in booked appointment page
            if (isset($_POST['deleAppId']) && isset($_POST['deleAppDate'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "Select * from `" . $wp_track_table . "` WHERE `fa_id` = " . $_POST['deleAppId'] . " ";
                $app_info = $wpdb->get_results($sql, 'OBJECT_K');
                $result = $wpdb->delete($wp_track_table, array('fa_id' => $_POST['deleAppId']));
                if ($result != false) {
                    $date = date_create($_POST['deleAppDate']);
                    $ar['date'] = date_format($date, "F d, Y");
                    $list_ts = fa_get_time_slots_filter_day($_POST['deleAppDate']);
                    $ar['list_ts'] = $list_ts;
                    $layout = $this->admin_template__('appointment-booked.faDayLayout', $ar);
                    do_action('fa-after-reject-appointment', $app_info);
                    wp_send_json($layout);
                    die();
                }
            }
        }

        function fa_delete_appointment()
        {
            if (isset($_POST['appId'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "Select * from `" . $wp_track_table . "` WHERE `fa_id` = " . $_POST['appId'] . " ";
                $app_info = $wpdb->get_results($sql, 'OBJECT_K');
                $wpdb->delete($wp_track_table, array('fa_id' => $_POST['appId']));
                if (isset($_POST['actor']) && $_POST['actor'] == "user") {
                    do_action('fa-after-cancel-appointment', $app_info);

                } else {
                    do_action('fa-after-reject-appointment', $app_info);
                }
                wp_send_json('done');
                die();
            }
        }

        function fa_approve_all_appointment()
        {
            if (!empty($_POST['listID'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "UPDATE `" . $wp_track_table . "` SET `fa_status` = 'approved' WHERE    ";
                $sql .= "`fa_id` IN (" . implode(',', $_POST['listID']) . ")";
                $result = $wpdb->query($sql);
                if ($result == count($_POST['listID'])) {
                    do_action('fa-after-approved-appointment', $_POST['listID']);
                    wp_send_json(count($_POST['listID']));
                    die();
                }
            }
        }

        function fa_delete_all_appointment()
        {
            if (!empty($_POST['listID'])) {
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;
                $sql = "Select * from `" . $wp_track_table . "` WHERE `fa_id` IN (" . implode(',', $_POST['listID']) . ")";
                $app_info = $wpdb->get_results($sql);
                $sql = "DELETE FROM `" . $wp_track_table . "` WHERE";
                $sql .= "`fa_id` IN (" . implode(',', $_POST['listID']) . ")";
                $result = $wpdb->query($sql);
                if ($result == count($_POST['listID'])) {
                    do_action('fa-after-reject-appointment', $app_info);
                    wp_send_json($result);
                    die();
                }
            }
        }

        function fa_reset_data()
        {
            if (!empty($_POST['process'])) {
                $process = $_POST['process'];
                global $wpdb;
                //delete old data
                if ($process == "delete_data") {

                    $table_name = $wpdb->prefix . 'fa_timeslots';
                    $sql = "DELETE FROM `" . $table_name . "` WHERE 1";
                    $wpdb->query($sql);
                    $table_name1 = $wpdb->prefix . 'fa';
                    $sql = "DELETE FROM `" . $table_name1 . "` WHERE 1";
                    $wpdb->query($sql);
                    $table_name2 = $wpdb->prefix . 'fa_guest';
                    $sql = "DELETE FROM `" . $table_name2 . "` WHERE 1";
                    $wpdb->query($sql);

                    $table_name = $wpdb->prefix . 'fa';
                    $sql = "DROP TABLE IF EXISTS $table_name;";
                    $wpdb->query($sql);
                    delete_option("my_plugin_db_version");
                    $table_name1 = $wpdb->prefix . 'fa_guest';
                    $sql1 = "DROP TABLE IF EXISTS $table_name1;";
                    $wpdb->query($sql1);
                    delete_option("my_plugin_db_version");
                    $table_name2 = $wpdb->prefix . 'fa_timeslots';
                    $sql1 = "DROP TABLE IF EXISTS $table_name1;";
                    $wpdb->query($sql1);
                    delete_option("my_plugin_db_version");

                    global $table_prefix;
                    $table_name = 'fa';
                    $wp_track_table = $table_prefix . $table_name;
                    if ($wpdb->get_var("show tables like '$wp_track_table'") != $wp_track_table) {
                        $sql = "CREATE TABLE `" . $wp_track_table . "` ( ";
                        $sql .= "  `fa_id`  int(11)   NOT NULL auto_increment, ";
                        $sql .= "  `fa_date`  varchar(128)   NOT NULL, ";
                        $sql .= "  `fa_time`  varchar(128)   NOT NULL, ";
                        $sql .= "  `fa_uid`  bigint(20)   NOT NULL, ";
                        $sql .= "  `fa_gid`  bigint(20)   , ";
                        $sql .= "  `fa_status`  varchar(128)   NOT NULL, ";
                        $sql .= "  `fa_message`  longtext , ";
                        $sql .= "  PRIMARY KEY (`fa_id`) ";
                        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ; ";
                        $wpdb->query($sql);
                    }
                    $table_time = 'fa_timeslots';
                    $wp_track_time = $table_prefix . $table_time;
                    if ($wpdb->get_var("show tables like '$wp_track_time'") != $wp_track_time) {
                        $sql = "CREATE TABLE `" . $wp_track_time . "` ( ";
                        $sql .= "  `fa_tl_id`  int(11)   NOT NULL auto_increment, ";
                        $sql .= "  `fa_tl_day`  varchar(128)   NOT NULL, ";
                        $sql .= "  `fa_tl_time`  varchar(128)   NOT NULL, ";
                        $sql .= "  `fa_tl_spa_av`  int(11)   NOT NULL, ";
                        $sql .= "  PRIMARY KEY (`fa_tl_id`) ";
                        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ; ";
                        $wpdb->query($sql);
                    }
                    $table_guest = 'fa_guest';
                    $wp_track_guest = $table_prefix . $table_guest;
                    if ($wpdb->get_var("show tables like '$wp_track_guest'") != $wp_track_guest) {
                        $sql = "CREATE TABLE `" . $wp_track_guest . "` ( ";
                        $sql .= "  `fa_guest_id`  int(11)   NOT NULL auto_increment, ";
                        $sql .= "  `fa_guest_name`  varchar(128)   NOT NULL, ";
                        $sql .= "  `fa_guest_email`  varchar(128) , ";
                        $sql .= "  `fa_guest_phone`  varchar(128) , ";
                        $sql .= "  `fa_guest_gender`  varchar(10) , ";
                        $sql .= "  PRIMARY KEY (`fa_guest_id`) ";
                        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ; ";
                        $wpdb->query($sql);
                    }


                    wp_send_json('delete_done');
                }
                //insert timeslots data
                if ($process == "insert_ts") {
                    $table_name = $wpdb->prefix . 'fa_timeslots';
                    $query = "INSERT INTO `" . $table_name . "` (";
                    $query .= "`fa_tl_id`, `fa_tl_day`, `fa_tl_time`, `fa_tl_spa_av`) VALUES ";
                    $days = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
                    $count = 0;
                    foreach ($days as $day) {
                        for ($i = 0; $i < 1440; $i += 120) {
                            $add = ($count === 0) ? '' : ',';
                            $count++;
                            $time = convertTimeValue($i)['val'] . "-" . convertTimeValue($i + 120)['val'];
                            $query .= $add . "(NULL,'$day','$time',5)";
                        }
                    }
                    $wpdb->query($query);
                    wp_send_json('insert_done');
                }
                //setup options default
                if ($process == "setup_options") {
                    $options_default = array(
                        'fa_booking_type'                             => 'guest',
                        'booked_require_guest_email_address'          => 'yes',
                        'booked_require_guest_email_address_checkbox' => 'yes',
                        'booked_require_guest_phone_number'           => 'yes',
                        'booked_require_guest_phone_number_checkbox'  => 'yes',
                        'fa_booking_redirect'                         => 'no_redirect',
                        'fa_timeslot_intervals'                       => '120',
                        'fa_new_appointment_df'                       => 'pending',
                    );
                    update_option('fa-setting', $options_default);
                    wp_send_json('setup_done');
                }
            }
        }

        function fa_export_data()
        {
            if (isset($_REQUEST['list_options'])) {
                $export_type = $_REQUEST['list_options'];
                $export_result = fa_export_data_to_file($export_type);
                if ($export_result) {
                    $response = array(
                        'status' => 'success'
                    );
                    $zip_result = fs_export_zip_folder('QuanCho');
                    $response['zip'] = ($zip_result) ? 'done' : 'failed';
                    wp_send_json($response);
                    die();
                } else {
                    $response = array(
                        'status' => 'failed'
                    );
                    wp_send_json($response);
                    die();
                }
            }
        }

    function fa_load_list_zip_file()
    {
        if (isset($_REQUEST['command'])) {
            $options = get_option('fa-data-backup', array());
            $layout = $this->get_template_file__('settings.faListBackupData', array('list_zip' => $options), '', 'flexAppointment');
            $response['status'] = 'done';
            $response['layout'] = $layout;
            wp_send_json($response);
            die();
        }
    }

    function fa_delete_file_data()
    {
        if (isset($_REQUEST['value_action'])) {
            $file_path = base64_decode($_REQUEST['value_action']);
            $options = get_option('fa-data-backup', array());
            if (in_array($file_path, $options)) {
                $id_remove = array_search($file_path, $options);
                unset($options[$id_remove]);
            }
            update_option('fa-data-backup', $options);
            wp_send_json('done');
            die();
        }
    }

    function fa_download_file_data()
    {
        if (isset($_REQUEST['file'])) {
            $file_path = base64_decode($_REQUEST['file']);
            echo $file_path;
            fa_download_zip_file($file_path);
        }
    }
}
}