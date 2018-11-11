<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
if (!defined('ABSPATH')) {
    exit();
}
if (!class_exists('fsbShortCodes')) {
    class fsbShortCodes extends fs_boot
    {
        function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);
            add_shortcode('flex-booking', array($this, 'fsb_create_shortcode'));
            if (function_exists('vc_add_shortcode_param')) {
                vc_add_shortcode_param('fsb_img', array($this, 'fsb_img_settings_field'));
            }
            add_action('vc_before_init', array($this, 'fsb_add_shortcode_to_vc'));
        }

        function fsb_create_shortcode($atts)
        {
            wp_enqueue_script('flex-booking-frontend.js', FlexBooking()->plugin_url . 'assets/js/flex-booking-frontend.js','','all',true);
            $ajax_data = array(
                'ajax_url' => admin_url('admin-ajax.php'),
            );
            wp_localize_script('flex-booking-frontend.js', 'fsb_var', $ajax_data);
            $default = shortcode_atts(array(), $atts);
            if ($atts == null) {
                $atts = $default;
            } else {
                $atts = array_merge($default, $atts);
            }
            $layout = $this->get_template_file__('frontend.fbs-layouts', array('atts' => $atts), '', 'flex-booking');
            return $layout;
        }


        function fsb_img_settings_field($settings, $value)
        {
            $layout = $this->admin_template__('params.fsb-img', array('settings' => $settings, 'value' => $value));
            return $layout;
        }

        function fsb_add_shortcode_to_vc()
        {
            $layout = array();
            if (function_exists('FlexBooking')) {
                $layout = array(
                    'layout_1' => FlexBooking()->plugin_url . 'assets/images/fsb_layout_1.png',
                    'layout_2' => FlexBooking()->plugin_url . 'assets/images/fsb_layout_2.png',
                    'layout_3' => FlexBooking()->plugin_url . 'assets/images/fsb_layout_3.png'
                );
            }
            if (function_exists('vc_map')) {
                vc_map(array(
                    'name'        => esc_attr__('Flex Booking', 'flex-booking'),
                    'base'        => 'flex-booking',
                    'description' => 'This short code will display the average rating of a post.',
                    "icon"        => "cs_icon_for_vc",
                    "category"    => esc_html__('Flex Appointment Shortcodes', 'flex-booking'),
                    "params"      => array(
                        array(
                            'type'       => 'fsb_img',
                            'heading'    => esc_html__('Chosses layout', 'flex-booking'),
                            'value'      => $layout,
                            'param_name' => 'booking_layout',
                            'weight'     => 1,
                        )
                    )
                ));
            }
        }
    }
}