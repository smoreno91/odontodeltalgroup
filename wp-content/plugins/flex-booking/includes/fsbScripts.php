<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
if (!defined('ABSPATH')) {
    exit();
}
if (!class_exists('fsbScripts')) {
    class fsbScripts
    {
        function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'fsb_enqueue_backend'));
            add_action('wp_enqueue_scripts', array($this, 'fsb_enqueue_frontend'));
        }

        function fsb_enqueue_backend()
        {
            wp_enqueue_script("flex-booking-backend.js", FlexBooking()->plugin_url . 'assets/js/flex-booking-backend.js');
            wp_enqueue_style('fsb-backend.css', FlexBooking()->plugin_url . 'assets/css/fsb-backend.css','','all');
        }
        function fsb_enqueue_frontend(){
            wp_enqueue_script("jquery-ui-datepicker");
            wp_enqueue_style("jquery-ui.min.css",FlexBooking()->plugin_url.'assets/css/jquery-ui.min.css','','all');
            wp_enqueue_style("fsb-frontend.css",FlexBooking()->plugin_url.'assets/css/fsb-frontend.css','','all');
        }
    }
}