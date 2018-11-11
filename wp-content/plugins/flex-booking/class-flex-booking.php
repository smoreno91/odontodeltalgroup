<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
$plugin_folder_name = dirname(plugin_basename(__FILE__));
if (!class_exists("FlexBooking")):

    /**
     * Initialize Class FlexAppointmentPro
     */
    final class FlexBooking extends fs_boot
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
                self::$instance = new FlexBooking();
                self::$instance->setup_globals();
                self::$instance->includes();
            }

            return self::$instance;
        }


        function setup_globals()
        {
            // Setup some base path and URL information
            $this->file = __FILE__;
            $this->basename = apply_filters('fsb_plugin_basenname', plugin_basename($this->file));
            $this->plugin_dir = apply_filters('fsb_plugin_dir_path', plugin_dir_path($this->file));
            $this->plugin_url = apply_filters('fsb_plugin_dir_url', plugin_dir_url($this->file));
        }

        function includes()
        {
            global $plugin_folder_name;
            $plugin_folder_name = dirname(plugin_basename(__FILE__));
            $this->requireFolder('includes.api');
            $this->requireFolder('includes');
        }
    }

endif;
if (!function_exists('FlexBooking')) {
    function FlexBooking()
    {
        return FlexBooking::instance();
    }
}
if (defined('FlexBooking_LATE_LOAD')) {
    add_action('plugins_loaded', 'FlexBooking', (int)FlexBooking_LATE_LOAD);
} else {
    FlexBooking();
}