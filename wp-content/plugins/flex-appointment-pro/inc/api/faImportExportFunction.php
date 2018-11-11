<?php
/**
 * User: KP
 * Date: 6/12/2017
 * Time: 14:03
 */
if (!defined("ABSPATH")) exit();

if (!function_exists('fa_export_data_to_file')) {
    /**
     * @param array $data_options
     * @return bool
     */
    function fa_export_data_to_file($data_options = array('fa-ex-booked', 'fa-ex-guest', 'fa-ex-ts', 'fa-ex-options'))
    {
        if (!is_array($data_options)) {
            return false;
        }
        $folder = trailingslashit(ABSPATH . 'wp-content/uploads/flex-appointment');
        if (!is_dir($folder)) {
            wp_mkdir_p($folder);
        }
        $ex_result = true;
        foreach ($data_options as $type) {
            global $wpdb;
            if ($type === "fa-ex-booked") {
                $table_name = $wpdb->prefix . 'fa';
                $sql = "SELECT * FROM `" . $table_name . "` ";
                $data = $wpdb->get_results($sql);
                //file handling
                $fa_booked = @fopen($folder . 'fa_booked.json', "w");
                if (!$fa_booked) {
                    $ex_result = false;
                } else {
                    fwrite($fa_booked, json_encode($data));
                    fclose($fa_booked);
                }
            }
            if ($type === "fa-ex-guest") {
                $table_name = $wpdb->prefix . 'fa_guest';
                $sql = "SELECT * FROM `" . $table_name . "` ";
                $data = $wpdb->get_results($sql);
                //file handling
                $fa_guest = @fopen($folder . 'fa_guest.json', "w");
                if (!$fa_guest) {
                    $ex_result = false;
                } else {
                    fwrite($fa_guest, json_encode($data));
                    fclose($fa_guest);
                }
            }
            if ($type === "fa-ex-ts") {
                $table_name = $wpdb->prefix . 'fa_timeslots';
                $sql = "SELECT * FROM `" . $table_name . "` ";
                $data = $wpdb->get_results($sql);
                //file handling
                $fa_ts = @fopen($folder . 'fa_timeslots.json', "w");
                if (!$fa_ts) {
                    $ex_result = false;
                } else {
                    fwrite($fa_ts, json_encode($data));
                    fclose($fa_ts);
                }
            }
            if ($type === "fa-ex-options") {
                $data = get_option('fa-setting', array());
                //file handling
                $fa_options = @fopen($folder . 'fa_options.json', "w");
                if (!$fa_options) {
                    $ex_result = false;
                } else {
                    fwrite($fa_options, json_encode($data));
                    fclose($fa_options);
                }
            }
        }
        return $ex_result;
    }
}

if (!function_exists('fs_export_zip_folder')) {
    /**
     * @param string $zip_name
     * @param string $folder
     * @param bool $once_file
     * @return bool
     */
    function fs_export_zip_folder($zip_name = 'flexDataBackup', $folder="", $once_file = true)
    {
        $folder = !empty($folder) ? $folder : ABSPATH . 'wp-content/uploads/flex-appointment';
        $_cache = trailingslashit(ABSPATH . 'wp-content/uploads/flex-appointment');
        $files = array('fa_booked.json', 'fa_guest.json', 'fa_timeslots.json', 'fa_options.json');
        $folder = trailingslashit($folder);
        if (!is_dir($folder)) {
            wp_mkdir_p($folder);
        }
        if ($once_file === false) {
            $prefix = date('ymdhis');
            $zip_name = $prefix . '_' . $zip_name;
        }
        if (strpos($zip_name, '.zip') === false) {
            $zip_name = $zip_name . '.zip';
        }
        if (!class_exists('ZipArchive')) {
            return false;
        }
        $zip_result = true;
        $zip = new ZipArchive;
        $zip->open($folder . $zip_name, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE);
        foreach ($files as $filename) {
            if (is_file($_cache . $filename)) {
                $result = $zip->addFile($_cache . $filename, $filename);
                if ($result !== true) {
                    $zip_result = false;
                }
            }
        }
        $zip->close();
        //delete file data
        foreach ($files as $filename) {
            if (file_exists($_cache . $filename)) {
                unlink($_cache . $filename);
            }
        }
        $options = get_option('fa-data-backup', array());
        $options[] = $folder . $zip_name;
        $options = array_unique($options);
        update_option('fa-data-backup', $options);
        return $zip_result;
    }
}
if (!function_exists('fa_download_zip_file')) {
    /**
     * @param string $path
     * @return bool
     */
    function fa_download_zip_file($path = '')
    {
        if (!is_file($path)) {
            return false;
        }
        //then send the headers to force download the zip file
        $fileName = basename($path);
        if (!empty($fileName) && file_exists($path)) {
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            // Read the file
            readfile($path);
            exit;
        } else {
            return false;
        }
    }
}
