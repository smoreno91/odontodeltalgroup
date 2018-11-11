<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
if(!defined("ABSPATH")){
    exit();
}
if (!class_exists("fsbHandles")){
    class fsbHandles extends fs_boot {
        public function __construct()
        {
            global $plugin_folder_name;
            parent::init($plugin_folder_name);
            add_action('wp_ajax_fsb_get_time_when_date_change', array($this, 'fsb_get_time_when_date_change'));
            add_action('wp_ajax_nopriv_fsb_get_time_when_date_change', array($this, 'fsb_get_time_when_date_change'));
        }
        function fsb_get_time_when_date_change(){
            if(!empty($_REQUEST['d']) && function_exists("faGetTimeSlotsByDate")){
                $time_slots = faGetTimeSlotsByDate($_REQUEST['d']);
                $layout = '<option class="bs-title-option" value="">'.esc_html__("Time","flex-booking").'</option>';
                foreach ($time_slots as $value=> $space){
                    if($space !== 0){
                        $layout .= '<option value="'.$value.'">'.convertTimeToDisplay($value).'</option>';
                    }
                }
                wp_send_json($layout);
                die();
            }
        }
    }
}