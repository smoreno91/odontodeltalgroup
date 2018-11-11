<?php
if (!defined('ABSPATH')) {
    exit();
}
if (!(class_exists('faMenuPages'))):
    class faMenuPages extends fs_boot
    {
        public function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);
            add_filter('fs_filter_tabs/fa-setting', array($this, 'fa_add_tab_timeslots'));
            add_filter('fs_filter_tabs/fa-setting', array($this, 'fa_add_tab_email_options'));
            add_filter('fs_filter_tabs/fa-setting', array($this, 'fa_add_tab_shortcodes'));
            add_filter('fs_filter_tabs/fa-setting', array($this, 'fa_add_tab_im_export_data'));
            add_action('admin_menu', array($this, 'fa_page'));
            add_action('fa_list_guest_options', array($this, 'fa_list_guest_options_calback'));
            add_action('fa_list_registered_options', array($this, 'fa_list_registered_options_calback'));
            add_action('fa_time_slots', array($this, 'fa_time_slots_calback'));
            add_action('fa_shortcodes', array($this, 'fa_shortcodes_calback'));
            add_action('fa_email_options', array($this, 'fa_email_options_calback'));
            add_action('fa_data_options', array($this, 'fa_data_options_callback'));
        }

        function fa_page()
        {

            add_menu_page(

                esc_attr__('Appointments', 'flex-appointments'),
                esc_attr__('Appointments', 'flex-appointments'),
                'manage_options',
                'fa-booked-appointments',
                array($this, 'fa_create_booked_appointments_page'),
                fsa()->plugin_url . 'assets/img/logo_flexappoinement.png',
                4);
            add_submenu_page(
                'fa-booked-appointments',
                esc_attr__('Pending', 'flex-appointments'),
                esc_attr__('Pending', 'flex-appointments'),
                'manage_options',
                'fa-pending',
                array($this, 'fa_create_pending_page')
            );
            add_submenu_page(
                'fa-booked-appointments',
                esc_attr__('Settings', 'flex-appointments'),
                esc_attr__('Settings', 'flex-appointments'),
                'manage_options',
                'fa-setting',
                array($this, 'fa_create_setting_page')
            );
            global $submenu;
            $submenu['fa-booked-appointments'][1][0] .= '<span class="update-plugins count-4"><span class="update-count">' . fa_get_pending_appointments() . '</span></span>';
        }

        function fa_create_booked_appointments_page()
        {
            $this->admin_template_e('appointment-booked.faBooked');
        }

        function fa_create_pending_page()
        {
            $this->embed_flat_UI(array(
                'jquery',
                'roboto',
                'material_icon',
                'bootstrap',
                'datetimepicker',
                'bootstrap_select',
                'tags_input',
                'fields_function',
                'multi_select'
            ), true);

            $this->admin_template_e('pending.faPending');
        }

        function fa_create_setting_page()
        {
            $args = array(
                'post_type'      => 'page',
                'posts_per_page' => 1,
                'status'         => 'publish',
                's'              => '[fsfa-profile]'
            );
            $search = new WP_Query($args);
            $args = array(
                'post_type' => 'page',
                'status'    => 'publish',
            );
            $pages = new WP_Query($args);
            $list_page = "";
            if ($pages->have_posts()) {
                $list_page = $this->admin_template__("elements.faListPage", array('pages' => $pages->posts));
            }
            if ($search->have_posts()) {
                $notice = '<div class="fa_notice_pro" style="display: block"><a href="' . get_permalink($search->posts[0]->ID) . '" target="_blank">' . esc_attr__("Profile Page: ", "flex-appointments") . $search->posts[0]->post_title . '</a></div>';
            } else {
                $notice = '<div class="fa_notice_pro" style="display: block">' . esc_attr__("We were not able to auto-detect. You need to ") . '<a href="' . admin_url() . '/post-new.php?post_type=page">' . esc_attr__("Create s page") . '</a>' . esc_attr__(" with the [booked-profile] shortcode.") . '</div>';
            }
            $option = array(
                'page_slug'   => 'fa-setting',
                'title'       => esc_attr__('FlexAppointment - Setting', 'flex-appointments'),
                'description' => '',
                'tab_class'   => '',
                'query_args'  => array(
                    'page' => 'fa-setting',
                ),
                'textdomain'  => 'flex-appointments',
                'tabs'        => array(
                    'general' => array(
                        'title'   => esc_attr__('General', 'flex-appointments'),
                        'icon'    => '<i class="dashicons dashicons-admin-generic"></i>',
                        'actived' => true,
                        'note'    => '',
                        'fields'  => array(
                            array(
                                'type'    => 'select',
                                'class'   => 'fa_booking_type',
                                'name'    => 'fa_booking_type',
                                'label'   => esc_attr__('Booking Type', 'flex-appointments'),
                                'layout'  => 'horizontal',
                                'options' => array(
                                    'registered' => esc_attr__('Registered Booking', 'flex-appointments'),
                                    'guest'      => esc_attr__('Guest Booking', 'flex-appointments'),
                                )
                            ),
                            //                            array(
                            //                                'type'    => 'radio',
                            //                                'name'    => 'fa_booking_option',
                            //                                'label'   => 'Booking Options',
                            //                                'default' => 'require_name',
                            //                                'layout'  => 'horizontal',
                            //                                'options' => array('require_name'    => esc_attr__('Require "Name" only', 'flex-appointments'),
                            //                                                   'require_surname' => esc_attr__('Require "First Name" and "Last Name"', 'flex-appointments'),
                            //                                )
                            //                            ),
                            array(
                                'type'   => 'custom',
                                'action' => 'fa_list_guest_options',
                            ),
                            array(
                                'type'   => 'custom',
                                'action' => 'fa_list_registered_options'
                            ),
                            array(
                                'type'    => 'radio',
                                'name'    => 'fa_booking_redirect',
                                'label'   => esc_attr__('Appointment Booking Redirect', 'flex-appointments'),
                                'value'   => '',
                                'default' => 'no_redirect',
                                'layout'  => 'horizontal',
                                'options' => array(
                                    'no_redirect'     => esc_attr__('No Redirect — Refresh the calendar list after booking.', 'flex-appointments'),
                                    'auto_redirect'   => esc_attr__('Auto-Detect Profile Page — Auto-detect the page with the [fsfa-profile] shortcode.', 'flex-appointments') . $notice,
                                    'choose_redirect' => esc_attr__('Choose Specific Page — Choose a redirect page.', 'flex-appointments') . $list_page,
                                ),
                            ),
                            array(
                                'type'    => 'select',
                                'class'   => 'fa_timeslot_intervals',
                                'name'    => 'fa_timeslot_intervals',
                                'label'   => esc_attr__('Time Slot Intervals', 'flex-appointments'),
                                'layout'  => 'horizontal',
                                'options' => array(
                                    '120' => esc_attr__('Every 2 hours', 'flex-appointments'),
                                    '60'  => esc_attr__('Every 1 hours', 'flex-appointments'),
                                    '30'  => esc_attr__('Every 30 minutes', 'flex-appointments'),
                                    '15'  => esc_attr__('Every 15 minutes', 'flex-appointments'),
                                    '10'  => esc_attr__('Every 10 minutes', 'flex-appointments'),
                                    '5'   => esc_attr__('Every 5 minutes', 'flex-appointments'),
                                )
                            ),
//                            array(
//                                'type'    => 'select',
//                                'class'   => 'fa_appointment_buffer',
//                                'name'    => 'fa_appointment_buffer',
//                                'label'   => esc_attr__('Appointment Buffer', 'flex-appointments'),
//                                'layout'  => 'horizontal',
//                                'options' => array(
//                                    '0'     => esc_attr__('No buffer', 'flex-appointments'),
//                                    '100'   => esc_attr__('1 hours', 'flex-appointments'),
//                                    '200'   => esc_attr__('2 hours', 'flex-appointments'),
//                                    '300'   => esc_attr__('3 hours', 'flex-appointments'),
//                                    '400'   => esc_attr__('4 hours', 'flex-appointments'),
//                                    '500'   => esc_attr__('5 hours', 'flex-appointments'),
//                                    '600'   => esc_attr__('6 hours', 'flex-appointments'),
//                                    '1200'  => esc_attr__('12 hours', 'flex-appointments'),
//                                    '2400'  => esc_attr__('24 hours', 'flex-appointments'),
//                                    '4800'  => esc_attr__('2 days', 'flex-appointments'),
//                                    '7200'  => esc_attr__('3 days', 'flex-appointments'),
//                                    '9600'  => esc_attr__('4 days', 'flex-appointments'),
//                                    '12000' => esc_attr__('5 days', 'flex-appointments'),
//                                    '14400' => esc_attr__('6 days', 'flex-appointments'),
//                                    '16800' => esc_attr__('1 week', 'flex-appointments'),
//                                )
//                            ),
//                            array(
//                                'type'    => 'select',
//                                'class'   => 'fa_appointment_limit',
//                                'name'    => 'fa_appointment_limit',
//                                'label'   => esc_attr__('Appointment Limit', 'flex-appointments'),
//                                'layout'  => 'horizontal',
//                                'options' => array(
//                                    '0'  => esc_attr__('No limit', 'flex-appointments'),
//                                    '1'  => esc_attr__('1 appointment', 'flex-appointments'),
//                                    '2'  => esc_attr__('2 appointments', 'flex-appointments'),
//                                    '3'  => esc_attr__('3 appointments', 'flex-appointments'),
//                                    '4'  => esc_attr__('4 appointments', 'flex-appointments'),
//                                    '5'  => esc_attr__('5 appointments', 'flex-appointments'),
//                                    '6'  => esc_attr__('6 appointments', 'flex-appointments'),
//                                    '7'  => esc_attr__('7 appointments', 'flex-appointments'),
//                                    '8'  => esc_attr__('8 appointments', 'flex-appointments'),
//                                    '9'  => esc_attr__('9 appointments', 'flex-appointments'),
//                                    '10' => esc_attr__('10 appointments', 'flex-appointments'),
//                                    '15' => esc_attr__('15 appointments', 'flex-appointments'),
//                                    '20' => esc_attr__('20 appointments', 'flex-appointments'),
//                                    '25' => esc_attr__('25 appointments', 'flex-appointments'),
//                                    '50' => esc_attr__('50 appointments', 'flex-appointments'),
//                                )
//                            ),
                            array(
                                'type'    => 'select',
                                'class'   => 'fa_new_appointment_df',
                                'name'    => 'fa_new_appointment_df',
                                'label'   => esc_attr__('New Appointment Default', 'flex-appointments'),
                                'layout'  => 'horizontal',
                                'options' => array(
                                    'pending'  => esc_attr__('Set as pending', 'flex-appointments'),
                                    'approved' => esc_attr__('Aprove immediatery', 'flex-appointments')
                                )
                            ),
                        ),
                    ),

                ),
            );
            $this->generatePageSettings($option);
        }

        public function fa_list_guest_options_calback()
        {
            $args = array(
                'type'       => 'custom',
                'id'         => 'fa_guest_option',
                'name'       => 'fa_guest_option',
                'class'      => 'fa_guest_option',
                'label'      => esc_attr__('Guest Booking Options', 'flex-appointments'),
                'layout'     => 'horizontal',
                'dependency' => array(
                    'element' => 'fa_booking_type',
                    'value'   => 'guest',
                ),
                'options'    => array(
                    'booked_require_guest_email_address' => array(
                        'value' => '',
                        'label' => esc_attr__('Require Email Address', 'flex-appointments'),
                    ),
                    'booked_require_guest_phone_number'  => array(
                        'value' => '',
                        'label' => esc_attr__('Require Phone Number', 'flex-appointments'),
                    )
                )
            );
            $this->admin_template_e('settings.list_guest_options', $args);
        }

        public function fa_list_registered_options_calback()
        {
            $args = array(
                'type'       => 'custom',
                'id'         => 'fa_guest_option',
                'name'       => 'fa_guest_option',
                'class'      => 'fa_guest_option',
                'label'      => esc_attr__('Registered Booking Options', 'flex-appointments'),
                'layout'     => 'horizontal',
                'dependency' => array(
                    'element' => 'fa_booking_type',
                    'value'   => 'registered',
                ),
                'options'    => array(
                    'booked_require_user_phone_number' => array(
                        'value' => '',
                        'label' => esc_attr__('Require Phone Number', 'flex-appointments'),
                    )
                )
            );
            $this->admin_template_e('settings.list_user_options', $args);
        }

        /**
         * @param $tabs
         * @return mixed
         */
        public function fa_add_tab_timeslots($tabs)
        {
            $tabs['time_slots'] = array(
                'title'  => 'Time slots',
                'icon'   => '<i class="fa-icon-st-ts dashicons dashicons-clock"></i>',
                'note'   => '',
                'fields' => array(
                    array(
                        'type'   => 'custom',
                        'action' => 'fa_time_slots'
                    )
                ),
            );

            return $tabs;
        }

        /**
         * @param $tabs
         * @return mixed
         */
        public function fa_add_tab_shortcodes($tabs)
        {
            $tabs['shortcodes'] = array(
                'title'  => 'Shortcodes',
                'icon'   => '<i class="fa-icon-st-ts dashicons dashicons-editor-code"></i>',
                'note'   => '',
                'fields' => array(
                    array(
                        'type'   => 'custom',
                        'action' => 'fa_shortcodes'
                    )
                ),
            );

            return $tabs;
        }

        /**
         * @param $tabs
         * @return mixed
         */
        public function fa_add_tab_im_export_data($tabs)
        {
            $tabs['fa_data_options'] = array(
                'title'  => 'Import / Export data',
                'icon'   => '<i class="fa-icon-st-ts dashicons dashicons-media-archive"></i>',
                'note'   => '',
                'fields' => array(
                    array(
                        'type'   => 'custom',
                        'action' => 'fa_data_options'
                    )
                ),
            );

            return $tabs;
        }

        /**
         * @param $tabs
         * @return mixed
         */
        public function fa_add_tab_email_options($tabs)
        {
            $tabs['email_options'] = array(
                'title'  => 'Email Options',
                'icon'   => '<i class="fa-icon-st-ts dashicons dashicons-email-alt"></i>',
                'note'   => '',
                'fields' => array(
                    array(
                        'type'   => 'custom',
                        'action' => 'fa_email_options'
                    )
                ),
            );

            return $tabs;
        }

        /**
         * fa_time_slots_calback function
         */
        public function fa_time_slots_calback()
        {

            $args = array(
                'type'   => 'custom',
                'action' => 'fa_list_guest_option',
                'option' => array(
                    'sun' => 'Sunday',
                    'mon' => 'Monday',
                    'tue' => 'Tuesday',
                    'wed' => 'Wednesday',
                    'thu' => 'Thursday',
                    'fri' => 'Friday',
                    'sat' => 'Saturday'
                )
            );
            $this->admin_template_e('settings.faTimeSlots', $args);
        }

        /**
         * fa_shortcodes_calback function
         */
        public function fa_shortcodes_calback()
        {

            $args = array(
                'type'   => 'custom',
                'action' => 'fa_list_guest_option',
                'option' => array(
                    'sun' => 'Sunday',
                    'mon' => 'Monday',
                    'tue' => 'Tuesday',
                    'wed' => 'Wednesday',
                    'thu' => 'Thursday',
                    'fri' => 'Friday',
                    'sat' => 'Saturday'
                )
            );
            $this->admin_template_e('settings.faShortcodes', $args);
        }

        /**
         * fa_email_options_callback function
         */
        public function fa_email_options_calback()
        {
            echo $this->get_template_file__('settings.faEmailOptions', '', '', 'flexAppointmentPro');
        }

        public function fa_data_options_callback()
        {
            global $wpdb, $table_prefix;
            $table_booked = 'fa';
            $sql = "SELECT COUNT(*) FROM  `" . $table_prefix . $table_booked . "` WHERE `fa_status` = 'approved'";
            $booked_count = $wpdb->get_var($sql);

            $sql = "SELECT COUNT(*) FROM  `" . $table_prefix . $table_booked . "` WHERE `fa_status` = 'pending'";
            $pending_count = $wpdb->get_var($sql);

            $table_ts = 'fa_timeslots';
            $sql = "SELECT COUNT(*) FROM  `" . $table_prefix . $table_ts . "` ";
            $timeslots_count = $wpdb->get_var($sql);

            echo $this->get_template_file__('settings.faDataOptions', array(
                'booked_count'  => $booked_count,
                'ts_count'      => $timeslots_count,
                'pending_count' => $pending_count
            ), '', 'flexAppointmentPro');
        }
    }
endif;