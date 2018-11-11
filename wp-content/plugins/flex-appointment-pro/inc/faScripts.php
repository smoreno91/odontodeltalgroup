<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!class_exists('faScripts')) {
    class faScripts extends fs_boot
    {
        function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);
            add_action('admin_enqueue_scripts', array($this, 'fsa_enqueue'));
            add_filter('tiny_mce_before_init', array($this, 'fa_tinymce_fix'));
//            add_action( 'wp_footer', 'my_deregister_scripts' );
        }

        function fa_tinymce_fix($settings)
        {
//            $settings['forced_root_block'] = false;
            // html elements being stripped
//            $settings['extended_valid_elements'] = 'div[*], article[*],br';
//            $settings['valid_elements'] = 'div[*], article[*],br';

            // don't remove line breaks
//            $settings['remove_linebreaks'] = false;
            // Convert newline characters to BR tags
//            $settings['convert_newlines_to_brs'] = true;
            // Do not remove redundant BR tags
//            $settings['remove_redundant_brs'] = false;

            // convert newline characters to BR
//            $settings['force_br_newlines '] = true;
//            $settings['apply_source_formatting'] = false;

            // don't remove redundant BR
//            $settings['remove_trailing_brs'] = false;
            $settings['force_p_newlines'] = true;
//            $settings['forced_root_block'] = '';

            // pass back to wordpress
            return $settings;
        }

        function fsa_enqueue()
        {
            $screen = get_current_screen();
            if ($screen->base === 'toplevel_page_fa-booked-appointments') {

                wp_enqueue_script('bootstrap.min.js', fsa()->plugin_url . 'boot/assets/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), 'all', true);

                wp_enqueue_script('moment.js', fsa()->plugin_url . 'assets/js/moment.min.js', array('jquery'), 'all', true);

                wp_enqueue_script('fullcalendar.js', fsa()->plugin_url . 'assets/js/fullcalendar.js', array('jquery'), 'all', true);

                wp_enqueue_style('fullcalendar.css', fsa()->plugin_url . 'assets/css/fullcalendar.css');

                wp_enqueue_style('bootstrap.min.css', fsa()->plugin_url . 'boot/assets/plugins/bootstrap/css/bootstrap.min.css');

                wp_enqueue_style('component.css', fsa()->plugin_url . '/assets/css/component.css');

                wp_enqueue_script('modalEffects.js', fsa()->plugin_url . '/assets/js/modalEffects.js', array('jquery'), 'all', true);

                wp_enqueue_style('fa.css', fsa()->plugin_url . 'assets/css/fa.css');

                wp_enqueue_style('ball-clip-rotate-multiple.css', fsa()->plugin_url . 'assets/css/ball-clip-rotate-multiple.css');

                wp_enqueue_script('ajax_fa', fsa()->plugin_url . 'assets/js/fa.js', array('jquery'), 'all', true);

                $ajax_data = array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                );

                wp_localize_script('ajax_fa', 'fa_var', $ajax_data);
            }

            if ($screen->base === 'appointments_page_fa-setting') {
                wp_enqueue_style('ball-clip-rotate.css', fsa()->plugin_url . 'assets/css/ball-clip-rotate-multiple.css');

                wp_enqueue_style('fsa.css', fsa()->plugin_url . 'assets/css/fa.css');

                wp_enqueue_script('fa-setting-ganeral.js', fsa()->plugin_url . 'assets/js/fa-setting-ganeral.js', '', 'all', true);

                wp_enqueue_script('fa-circle.js', fsa()->plugin_url . 'assets/js/fa-circle.js', array('jquery'), 'all', true);

                wp_enqueue_script('ajax_time_slots', fsa()->plugin_url . 'assets/js/time-slots.js', '', 'all', true);

                wp_enqueue_script('fa_email_options', fsa()->plugin_url . 'assets/js/fa-email-options.js', '', 'all', true);
                $ajax_data = array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                );
                wp_localize_script('ajax_time_slots', 'fa_time_slots_var', $ajax_data);

                wp_localize_script('fa_email_options', 'fa_email_var', $ajax_data);
            }
            if ($screen->base === 'appointments_page_fa-pending') {

                wp_enqueue_script('bootstrap.min.js', fsa()->plugin_url . '/assets/js/bootstrap.min.js', array('jquery'), 'all', true);

                wp_enqueue_style('ball-clip-rotate-multiple.css', fsa()->plugin_url . '/assets/css/ball-clip-rotate-multiple.css');

                wp_enqueue_style('component.css', fsa()->plugin_url . '/assets/css/component.css');

                wp_enqueue_script('modalEffects.js', fsa()->plugin_url . '/assets/js/modalEffects.js', array('jquery'), 'all', true);

                wp_enqueue_style('dashicons');

                wp_enqueue_style('fa.css', fsa()->plugin_url . 'assets/css/fa.css');

                wp_enqueue_script('ajax_pending', fsa()->plugin_url . 'assets/js/fa-pending.js', array('jquery'), 'all', true);
                $ajax_data = array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                );
                wp_localize_script('ajax_pending', 'fa_pending_var', $ajax_data);
            }
        }
    }
}