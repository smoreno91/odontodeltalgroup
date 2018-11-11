<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'name'        => esc_html__('Flex Booking', 'medix'),
        'base'        => 'flex-booking',
        'description' => esc_html__('This short code will display appoitnment.','medix'),
        "icon"        => "cs_icon_for_vc",
        "category" => esc_html__("CmsSuperheroes Shortcodes", 'medix'),
        "params"      => array(
            array(
                'type'       => 'fsb_img',
                'heading'    => esc_html__('Chosses layout', 'medix'),
                'value'      => array(
                                'layout_1' => get_template_directory_uri().'/vc_params/layouts/fsb_layout_1.png',
                                'layout_2' => get_template_directory_uri().'/vc_params/layouts/fsb_layout_2.png',
                                'layout_3' => get_template_directory_uri().'/vc_params/layouts/fsb_layout_3.png'
                            ),
                'param_name' => 'booking_layout',
                'weight'     => 1,
            )
        )
    ));
}