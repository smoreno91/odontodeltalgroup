<?php

/**
 * Created by PhpStorm.
 * User: kp
 * Date: 4/11/2017
 * Time: 10:59
 */
if (!defined('ABSPATH')) {
    return;
}
if (!class_exists('faShortCode')) {
    class faShortCode extends fs_boot
    {
        function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);
            add_action('wp_enqueue_scripts', array($this, 'fa_enqueue_script'));
            add_shortcode('flex-appointment', array($this, 'fa_create_shortcode'));
            add_shortcode('fsfa-profile', array($this, 'fa_create_profile_shortcode'));
            add_action('vc_before_init', array($this, 'fa_add_shortcode_to_vc'));
        }

        function fa_enqueue_script()
        {

            wp_enqueue_script('moment.min.js', fsa()->plugin_url . '/assets/js/moment.min.js', array('jquery'), 'all', true);

            wp_enqueue_script('fullcalendar.js', fsa()->plugin_url . '/assets/js/fullcalendar.js', array('jquery'), 'all', true);

            wp_enqueue_style('fullcalendar.css', fsa()->plugin_url . 'assets/css/fullcalendar.css');

            wp_enqueue_style('dashicons');

            wp_enqueue_style('fa-frontend.css', fsa()->plugin_url . '/assets/css/fa-frontend.css');

            wp_enqueue_style('ball-clip-rotate-multiple.css', fsa()->plugin_url . '/assets/css/ball-clip-rotate-multiple.css');

            wp_enqueue_style('component.css', fsa()->plugin_url . '/assets/css/component.css');

            wp_enqueue_script('modalEffects.js', fsa()->plugin_url . '/assets/js/modalEffects.js', array('jquery'), 'all', true);

            wp_enqueue_script('ajax_fa_frontend', fsa()->plugin_url . '/assets/js/fa-frontend.js', array('jquery'), 'all', true);


        }

        function fa_create_shortcode($atts = array(), $content = null)
        {
            $ajax_data = array(
                'ajax_url' => admin_url('admin-ajax.php'),
            );
            wp_localize_script('ajax_fa_frontend', 'fa_fr_var', $ajax_data);
            return $this->get_template_file__('frontend.faLayout', '', '', 'flexAppointmentPro', 'flexAppointmentPro');
        }

        function fa_create_profile_shortcode($atts = array(), $content = null)
        {
            $history_app = array();
            $upcoming_app = array();
            $current_user = get_current_user_id();
            if ($current_user !== 0) {
                $current_date = current_time("d-m-Y");
                $current_time = intval(current_time("Hi"));
                global $table_prefix, $wpdb;
                $table_name = 'fa';
                $wp_track_table = $table_prefix . $table_name;

                //query history appointment
                $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
                $sql .= " (str_to_date(fa_date,'%d-%m-%Y') < str_to_date('" . $current_date . "','%d-%m-%Y')) ";
                $sql .= " and `fa_uid` = " . $current_user . " ";
                $sql.= " or ((str_to_date(fa_date,'%d-%m-%Y') = str_to_date('" . $current_date . "','%d-%m-%Y'))  and  RIGHT(fa_time,4)*1 <= " . $current_time . " )";
                $history_app = $wpdb->get_results($sql);

                //query upcoming appointment
                $sql_up = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
                $sql_up .= " (str_to_date(fa_date,'%d-%m-%Y') > str_to_date('" . $current_date . "','%d-%m-%Y')) ";
                $sql_up .= " and `fa_uid` = " . $current_user . " ";
                $sql_up.= " or ((str_to_date(fa_date,'%d-%m-%Y') = str_to_date('" . $current_date . "','%d-%m-%Y'))  and  RIGHT(fa_time,4)*1 > " . $current_time . " )";
                $upcoming_app = $wpdb->get_results($sql_up);
            }
            $ajax_data = array(
                'ajax_url' => admin_url('admin-ajax.php'),
            );
            wp_localize_script('ajax_fa_frontend', 'fa_fr_var', $ajax_data);
            return $this->get_template_file__('frontend.faProfileLayout',
                array('current_user' => $current_user,
                      'history_app'  => $history_app,
                      'upcoming_app' => $upcoming_app
                ),
                '',
                'flexAppointmentPro',
                'flexAppointmentPro');
        }

        function fa_add_shortcode_to_vc()
	    {
	        vc_map(array(
	            'name'   => esc_html__('Flex Appointment', 'flex-appointment'),
	            'base'   => 'flex-appointment',
	            "icon"     => "cs_icon_for_vc",
    			"category" => esc_html__('Flex Appointment Shortcodes', 'flex-appointment'),
	            'params' => array(
	            )
	        ));
	        vc_map(array(
	            'name'   => esc_attr__('Flex Appointment User Profile', 'flex-appointment'),
	            'base'   => 'fsfa-profile',
	            "icon"     => "cs_icon_for_vc",
    			"category" => esc_html__('Flex Appointment Shortcodes', 'flex-appointment'),
	            'params' => array(
	            )
	        ));

	    }


    }
}
