<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
if (!defined("ABSPATH")) {
    exit();
}
if (!function_exists("faGetTimeSlotsByDate")) {
    function faGetTimeSlotsByDate($date_format = "")
    {
        global $table_prefix, $wpdb;
        $table_name = 'fa';
        $wp_track_table = $table_prefix . $table_name;
        $sql = "SELECT * FROM  `" . $wp_track_table . "` WHERE ";
        $sql .= "  `fa_date`  = '" . $date_format . "' ";
        $result_booked = $wpdb->get_results($sql);
        $booked_list_time = array();
        foreach ($result_booked as $key => $date_data) {
            $booked_list_time[] = $date_data->fa_time;
        }
        $result_ts = fa_get_time_slots_filter_day($date_format);
        $time_slots = array();
        foreach ($result_ts as $time_slot) {
            $time_slots[$time_slot->fa_tl_time] = $time_slot->fa_tl_spa_av;
        }
        foreach ($time_slots as $time => $space) {
            $c = array_count_values($booked_list_time)[$time];
            $time_slots[$time] = $time_slots[$time] - $c;
        }
        return $time_slots;
    }
}