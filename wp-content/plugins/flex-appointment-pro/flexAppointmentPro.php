<?php
/*
Plugin Name: FsFlex Appointment Pro
Plugin URI: fsflex.com
Description: A powerful Wordpress plugin for appointment
Version: 1.0.0
Author: KP
Author URI: fsflex.com
Text Domain: flex-appointments
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// PLUGIN FOLDER
$plugin_folder_name = 'flex-appointment-pro';
// MAIN PLUGIN BASENAME
$main_plugin_basename = $plugin_folder_name . '/flexAppointmentPro.php';
// TEXT DOMAIN
$textdomain = 'flex-appointments';
// DEV MODE
$dev_mode = true;
// INSTALLER
include_once "flex-appointment-install.php";
if (!class_exists("FlexAppointmentPro")):

    /**
     * Initialize Class FlexAppointmentPro
     */
    final class FlexAppointmentPro extends fs_boot
    {

        static $instance = null;
        /**
         * @var file root
         */
        public $file = __FILE__;
        /**
         * @var basename
         */
        public $basename;
        /**
         * @var dir plugin
         */
        public $plugin_dir;
        /**
         * @var url plugin
         */
        public $plugin_url;

        public static function instance()
        {

            if (null === self::$instance) {
                self::$instance = new FlexAppointmentPro();
                self::$instance->setup_globals();
                self::$instance->includes();
            }

            return self::$instance;
        }


        function setup_globals()
        {
            // Setup some base path and URL information
            $this->file = __FILE__;
            $this->basename = apply_filters('fsa_plugin_basenname', plugin_basename($this->file));
            $this->plugin_dir = apply_filters('fsa_plugin_dir_path', plugin_dir_path($this->file));
            $this->plugin_url = apply_filters('fsa_plugin_dir_url', plugin_dir_url($this->file));
        }

        function includes()
        {
            $this->requireFolder('inc.api');
            $this->requireFolder('inc');
            register_activation_hook(__FILE__, array($this, 'activate'));

//            register_deactivation_hook(__FILE__, array($this, 'deactive'));
        }

        public function template_path()
        {
            return apply_filters('fsa_template_path', 'flexAppointmentPro/');
        }

        function deactive()
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'fa';
            $sql = "DROP TABLE IF EXISTS $table_name;";
            $wpdb->query($sql);
            delete_option("my_plugin_db_version");
            $table_name1 = $wpdb->prefix . 'fa_guest';
            $sql1 = "DROP TABLE IF EXISTS $table_name1;";
            $wpdb->query($sql1);
            delete_option("my_plugin_db_version");
        }

        public function activate()
        {
            global $table_prefix, $wpdb;
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
                $sql .= "  PRIMARY KEY (`fa_guest_id`) ";
                $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ; ";
                $wpdb->query($sql);
            }
        }
    }
endif;
if (!function_exists('fsa')) {
    function fsa()
    {
        return FlexAppointmentPro::instance();
    }
}
if (defined('FlexAppointmentPro_LATE_LOAD')) {
    add_action('plugins_loaded', 'fsa', (int)FlexAppointmentPro_LATE_LOAD);
} else {
    fsa();
}
add_action('plugins_loaded', function () {
    do_action('flex-appointment_init');
});