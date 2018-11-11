<?php

/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 26/5/2017
 * Time: 9:37 PM
 */
if (!class_exists('faEmailCustomer')) {
    class faEmailCustomer extends fs_boot
    {

        /**
         * fsEmail constructor.
         */
        public function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);

//            add_action('phpmailer_init', array($this, 'send_smtp_email'));

            //event send email daily
            register_activation_hook(fsa()->file, array($this, 'activate_plugin'));
            add_filter('cron_schedules', array($this, 'fs_schedule_event'), 10, 1);
            register_deactivation_hook(fsa()->file, array($this, 'deactivate_plugin'));
            add_action('fs_daily_send_email', array($this, 'fs_daily_send_email'));
            //end

            add_action('fa-after-register-account', array($this, 'after_register_account'));
            add_action('fa-after-request-appointment', array($this, 'after_request_appointment'), 10, 2);
            add_action('fa-after-approved-appointment', array($this, 'after_approved_appointment'));
            add_action('fa-after-reject-appointment', array($this, 'after_reject_appointment'));
            add_action('fa-after-cancel-appointment', array($this, 'after_cancel_appointment'));
        }

        public function send_smtp_email($mailer)
        {
            $mailer->isSMTP();
            $mailer->Host = "smtp.gmail.com";
            $mailer->SMTPAuth = true;
            $mailer->Port = "587";
            $mailer->Username = "tmninh94@gmail.com";
            $mailer->Password = "txmhchkhbgvgdswg";
            $mailer->SMTPSecure = "tls";
            $mailer->From = "tmninh94@gmail.com";
            $mailer->FromName = "Appointment Admin";
        }

        public function activate_plugin()
        {
            if (!wp_next_scheduled('daily')) {
                wp_schedule_event(time('00:00:00'), 'daily', 'fs_daily_send_email');
            }
//				Custom time
//				if ( ! wp_next_scheduled( 'daily_email' ) ) {
//					wp_schedule_event( time( '00:00:00' ), 'daily_email', 'fs_daily_send_email' );
//				}
        }

        /**
         * @param $schedules
         *
         * @return mixed : Custom time
         */
        public function fs_schedule_event($schedules)
        {
            $schedules['daily_email'] = array(
                'interval' => 1,//1440 minutes = 24 hours
                'display'  => 'Send email daily',
            );

            return $schedules;
        }

        public function fs_daily_send_email()
        {

            global $table_prefix, $wpdb;
            $table_name = 'fa';
            $wp_track_table = $table_prefix . $table_name;
            $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
            $sql .= "  `fa_date`  = '" . date('d-m-Y', time()) . "' ";
            $result = $wpdb->get_results($sql);
            foreach ($result as $field) {
                if ($field->fa_uid !== 0) {
                    $user = get_user_by('id', $field->fa_uid);
                    $email = $user->user_email;
                    $name = $user->display_name;

                } else {
                    $wp_table_guest = $table_prefix . "fa_guest";
                    $sql = "SELECT * FROM  `" . $wp_table_guest . "` WHERE 'fa_guest_id' = '" . $field->fa_uid . "'";
                    $user = $wpdb->get_results($sql)[0];
                    $name = $user->fa_guest_name;
                    $email = $user->fa_guest_email;
                }
                $date = $field->fa_date;
                $time = $field->fa_time;
                $time = explode('-', $time);
                $time_start = fa_convert_time($time[0]);
                $time_stop = fa_convert_time($time[1]);
                $author = get_bloginfo('name');
                $subject = '';
                $headers = array('Content-Type: text/html; charset=UTF-8');
                $message = $this->get_template_file__('email_layouts.customer.notice_before_time', array(), null, 'flexAppointmentPro');
                $message = str_replace(array('%name%', '%time_start%', '%time_stop%', '%author%','\\'), array(
                    $name,
                    $time_start,
                    $time_stop,
                    $author,
                    ''
                ), $message);

                wp_mail($email, $subject, $message, $headers);
            }
        }

        public function after_register_account($user)
        {
            $author = get_bloginfo('name');
            $settings = get_option('fa-setting', array());
            $subject = (isset($settings['fa-cus-reg-subject']) && $settings['fa-cus-reg-subject'] != "") ? $settings['fa-cus-reg-subject'] : 'Register successfully!';
            $headers = array('Content-Type: text/html; charset=UTF-8');

            if (isset($settings['fa-cus-reg-contents']) && $settings['fa-cus-reg-contents'] != "") {
                $message = nl2br($settings['fa-cus-reg-contents']);
            } else {
                $message = $this->get_template_file__('email_layouts.customer.notice_after_reg', array(), null, 'flexAppointmentPro');
            }
            $message = str_replace(array('%name%', '%email%', '%username%', '%password%', '%author%'), array(
                $user['firstname'],
                $user['email'],
                $user['userlogin'],
                $user['password'],
                $author
            ), $message);

            wp_mail($user['email'], $subject, $message, $headers);
        }

        public function after_request_appointment($id, $args)
        {
            $author = get_bloginfo('name');
            $settings = get_option('fa-setting', array());
            $date = $args['date'];
            $time = $args['time'];
            $time = explode('-', $time);
            $time_start = fa_convert_time($time[0]);
            $time_stop = fa_convert_time($time[1]);

            $subject = (isset($settings['fa-cus-app-subject']) && $settings['fa-cus-app-subject'] != "") ? $settings['fa-cus-app-subject'] : 'You have a new appointment!';
            $headers = array('Content-Type: text/html; charset=UTF-8');

            if (isset($settings['fa-cus-app-contents']) && $settings['fa-cus-app-contents'] != "") {
                $message = nl2br($settings['fa-cus-app-contents']);
            } else {
                $message = $this->get_template_file__('email_layouts.customer.notice_after_book', array(), null, 'flexAppointmentPro');
            }
            if (is_user_logged_in()) {
                $user = get_user_by('id', $id);
                $name = $user->display_name;
                $email = $user->user_email;
            } else {

                global $table_prefix, $wpdb;
                $wp_table_guest = $table_prefix . "fa_guest";
                $sql = "SELECT * FROM  `" . $wp_table_guest . "` WHERE `fa_guest_id` = $id ";
                $user = $wpdb->get_results($sql)[0];
                $name = $user->fa_guest_name;
                $email = $user->fa_guest_email;
            }

            $message = str_replace(array(
                '%name%',
                '%date%',
                '%time_start%',
                '%time_stop%',
                '%author%',
                "\\"
            ), array(
                $name,
                $date,
                $time_start,
                $time_stop,
                $author,
                ""
            ), $message);

            wp_mail($email, $subject, $message, $headers);
        }

        public function after_approved_appointment($app_id)
        {
            global $table_prefix, $wpdb;
            $table_name = 'fa';
            $wp_track_table = $table_prefix . $table_name;

            if (is_array($app_id)) {
                $sql = "Select * from `" . $wp_track_table . "` WHERE `fa_id` IN (" . implode(',', $app_id) . ")";
            } else {
                $sql = "Select * from `" . $wp_track_table . "` WHERE `fa_id` = " . $app_id ." ";
            }
            $results = $wpdb->get_results($sql);

            foreach ($results as $result) {
                $date = $result->fa_date;
                $time = $result->fa_time;
                $time = explode('-', $time);
                $time_start = fa_convert_time($time[0]);
                $time_stop = fa_convert_time($time[1]);
                $email = "";
                $name = "";
                if ($result->fa_uid != 0) {
                    $user = get_user_by('id', $result->fa_uid);
                    $name = $user->display_name;
                    $email = $user->user_email;
                } elseif ($result->fa_gid != 0) {
                    $wp_table_guest = $table_prefix . "fa_guest";
                    $sql = "SELECT * FROM  `" . $wp_table_guest . "` WHERE `fa_guest_id` = " . $result->fa_gid . " ";
                    $user = $wpdb->get_results($sql)[0];
                    $name = $user->fa_guest_name;
                    $email = $user->fa_guest_email;
                }

                $subject = (isset($settings['fa-cus-approval-subject']) && $settings['fa-cus-approval-subject'] != "") ? $settings['fa-cus-approval-subject'] : 'Your appointment has been approved!';
                $headers = array('Content-Type: text/html; charset=UTF-8');

                if (isset($settings['fa-cus-approval-contents']) && $settings['fa-cus-approval-contents'] != "") {
                    $message = nl2br($settings['fa-cus-approval-contents']);
                } else {
                    $message = $this->get_template_file__('email_layouts.customer.notice_after_approved', array(), null, 'flexAppointmentPro');
                }
                $author = get_bloginfo('name');
                $message = str_replace(array(
                    '%name%',
                    '%date%',
                    '%time_start%',
                    '%time_stop%',
                    '%author%',
                    '\\'
                ), array(
                    $name,
                    $date,
                    $time_start,
                    $time_stop,
                    $author,
                    ''
                ), $message);
                wp_mail($email, $subject, $message, $headers);
            }
        }

        public function after_reject_appointment($results)
        {
            global $table_prefix, $wpdb;
            foreach ($results as $result) {
                $date = $result->fa_date;
                $time = $result->fa_time;
                $time = explode('-', $time);
                $time_start = fa_convert_time($time[0]);
                $time_stop = fa_convert_time($time[1]);
                $email = "";
                $name = "";

                if ($result->fa_uid != 0) {
                    $user = get_user_by('id', $result->fa_uid);
                    $name = $user->display_name;
                    $email = $user->user_email;
                } elseif ($result->fa_gid != 0) {
                    $wp_table_guest = $table_prefix . "fa_guest";
                    $sql = "SELECT * FROM  `" . $wp_table_guest . "` WHERE `fa_guest_id` = " . $result->fa_gid . " ";
                    $user = $wpdb->get_results($sql)[0];
                    $name = $user->fa_guest_name;
                    $email = $user->fa_guest_email;
                }

                $subject = (isset($settings['fa-cus-reject-subject']) && $settings['fa-cus-reject-subject'] != "") ? $settings['fa-cus-reject-subject'] : 'Your appointment has been rejected!';
                $headers = array('Content-Type: text/html; charset=UTF-8');

                if (isset($settings['fa-cus-reject-contents']) && $settings['fa-cus-reject-contents'] != "") {
                    $message = nl2br($settings['fa-cus-reject-contents']);
                } else {
                    $message = $this->get_template_file__('email_layouts.customer.notice_after_reject', array(), null, 'flexAppointmentPro');
                }
                $author = get_bloginfo('name');
                $message = str_replace(array(
                    '%name%',
                    '%date%',
                    '%time_start%',
                    '%time_stop%',
                    '%author%',
                    '\\'
                ), array(
                    $name,
                    $date,
                    $time_start,
                    $time_stop,
                    $author,
                    ''
                ), $message);
                wp_mail($email, $subject, $message, $headers);
            }
        }
        public function after_cancel_appointment($results)
        {
            global $table_prefix, $wpdb;
            foreach ($results as $result) {
                $date = $result->fa_date;
                $time = $result->fa_time;
                $time = explode('-', $time);
                $time_start = fa_convert_time($time[0]);
                $time_stop = fa_convert_time($time[1]);
                $email = "";
                $name = "";

                if ($result->fa_uid != 0) {
                    $user = get_user_by('id', $result->fa_uid);
                    $name = $user->display_name;
                    $email = $user->user_email;
                } elseif ($result->fa_gid != 0) {
                    $wp_table_guest = $table_prefix . "fa_guest";
                    $sql = "SELECT * FROM  `" . $wp_table_guest . "` WHERE 'fa_guest_id' = " . $result->fa_gid . " ";
                    $user = $wpdb->get_results($sql)[0];
                    $name = $user->fa_guest_name;
                    $email = $user->fa_guest_email;
                }

                $subject = (isset($settings['fa-cus-cancel-subject']) && $settings['fa-cus-cancel-subject'] != "") ? $settings['fa-cus-cancel-subject'] : 'Your appointment has been canceled!';
                $headers = array('Content-Type: text/html; charset=UTF-8');

                if (isset($settings['fa-cus-cancel-contents']) && $settings['fa-cus-cancel-contents'] != "") {
                    $message = nl2br($settings['fa-cus-cancel-contents']);
                } else {
                    $message = $this->get_template_file__('email_layouts.customer.notice_after_canceled', array(), null, 'flexAppointmentPro');
                }
                $author = get_bloginfo('name');
                $message = str_replace(array(
                    '%name%',
                    '%date%',
                    '%time_start%',
                    '%time_stop%',
                    '%author%',
                    '\\'
                ), array(
                    $name,
                    $date,
                    $time_start,
                    $time_stop,
                    $author,
                    ''
                ), $message);
                wp_mail($email, $subject, $message, $headers);
            }
        }

        public function deactivate_plugin()
        {
            wp_unschedule_event(wp_next_scheduled('fs_daily_send_email'), 'fs_daily_send_email');
        }

    }
}