<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
$layout = (!empty($atts['booking_layout'])) ? $atts['booking_layout'] : 'layout_1';
if ($layout === "layout_1") {
    if (function_exists('FlexBooking')) {
        echo FlexBooking()->get_template_file__('frontend.fbs-list-layout.layout-1','','','flex-booking');
    }
}
if ($layout === "layout_2") {
    if (function_exists('FlexBooking')) {
        echo FlexBooking()->get_template_file__('frontend.fbs-list-layout.layout-2','','','flex-booking');
    }
}
if ($layout === "layout_3") {
    if (function_exists('FlexBooking')) {
        echo FlexBooking()->get_template_file__('frontend.fbs-list-layout.layout-3','','','flex-booking');
    }
}
?>

