<?php

/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 26/5/2017
 * Time: 9:37 PM
 */
if (!class_exists('faEmailAdmin')) {
    class faEmailAdmin extends fs_boot
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

            $email = (!empty(get_option('fa-setting')['fa-admin-setmail-address'])) ? get_option('fa-setting')['fa-admin-setmail-address'] : get_bloginfo('admin_email');

            global $table_prefix, $wpdb;
            $table_name = 'fa';
            $wp_track_table = $table_prefix . $table_name;
            $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
            $sql .= "  `fa_date`  = '" . date('d-m-Y', time()) . "' ";
            $results = $wpdb->get_results($sql);
            $number = $wpdb->num_rows;
            $table = $this->get_template_file__('email_layouts.admin.notice_before_time_table', array('appointments' => $results), null, 'flexAppointmentPro');
            $author = get_bloginfo('name');
            $subject = (get_option('fa-setting')['fa-ad-reminder-subject']) ? get_option('fa-setting')['fa-ad-reminder-subject'] : esc_html__('Reminder: You have appointments coming up soon!', 'flex-appointments');
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $message = (get_option('fa-setting')['fa-ad-reminder-contents']) ? get_option('fa-setting')['fa-ad-reminder-contents'] : fsa()->get_template_file__("email_layouts.admin.notice_before_time");
            $message = str_replace(array('%number_appointments%', '%table_appointments%'), array(
                $number,
                $table,
                $author
            ), $message);
            wp_mail($email, $subject, $message, $headers);
        }

        public function deactivate_plugin()
        {
            wp_unschedule_event(wp_next_scheduled('fs_daily_send_email'), 'fs_daily_send_email');
        }

    }
}