<?php
/**
 * Created by PhpStorm.
 * User: kp
 * Date: 4/24/2017
 * Time: 14:52
 */
/* Flex Extensions group */
if(isset($flex_extensions)) {
    $flex_extensions[$plugin_folder_name] = plugin_dir_path(__FILE__);
} else {
    $flex_extensions = array($plugin_folder_name => plugin_dir_path(__FILE__));
}

//add_action('activated_plugin', function () use($main_plugin_basename, $textdomain) {
//    if ($plugins = get_option('active_plugins')) {
//        if ($key = array_search($main_plugin_basename, $plugins)) {
//            array_splice($plugins, $key, 1);
//            array_unshift($plugins, $main_plugin_basename);
//            update_option('active_plugins', $plugins);
//        }
//    }
//});

// boot include
if(!class_exists('fs_boot')) {
    reset($flex_extensions);
    $first_key = key($flex_extensions);
    $boot_dir = rtrim($flex_extensions[$first_key], '\\\/') . DIRECTORY_SEPARATOR . 'boot' . DIRECTORY_SEPARATOR . 'boot.php';

    include_once $boot_dir;
}