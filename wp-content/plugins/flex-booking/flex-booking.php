<?php
/*
Plugin Name: FsFlex Booking
Plugin URI: fsflex.com
Description: A powerful Wordpress addon plugin for Fslex Appointment plugin
Version: 1.0.0
Author: KP
Author URI: fsflex.com
Text Domain: flex-booking
*/
add_action('flex-appointment_init', function () {
    include_once('class-flex-booking.php');
});