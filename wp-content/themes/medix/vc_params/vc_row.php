<?php
 
vc_add_param('vc_row', array(
    "type" => "dropdown",
    "heading" => esc_html__("Space in px", 'medix'),
    "description" => esc_html__('Change row margin and columns padding', 'medix'),
    "param_name" => "rc_space",
    "value" => array(
        esc_html( 'None') => '',
        esc_html( 'Space 0' ) => 'space0',
        esc_html( 'Space 30px' ) => 'space30',
        esc_html( 'Space 25px' ) => 'space25',
    ),
    "group" => esc_html__("Other setting",'medix'), 
));
vc_add_param('vc_row', array(
    "type" => "dropdown",
    "heading" => esc_html__("Padding top", 'medix'),
    "description" => esc_html__('Select padding top', 'medix'),
    "param_name" => "padding_top",
    "value" => array(
        esc_html( 'None') => '',
        esc_html( 'Padding top 100px' ) => 'padding_top_100',
        esc_html( 'Padding top 110px' ) => 'padding_top_110',
        esc_html( 'Padding top 120px' ) => 'padding_top_120',
        esc_html( 'Padding top 130px' ) => 'padding_top_130',
        esc_html( 'Padding top 140px' ) => 'padding_top_140',
        esc_html( 'Padding top 150px') => 'padding_top_150', 
    ),
    "group" => esc_html__("Other setting",'medix'), 
));
vc_add_param('vc_row', array(
    "type" => "dropdown",
    "heading" => esc_html__("Padding bottom", 'medix'),
    "description" => esc_html__('Select padding bottom', 'medix'),
    "param_name" => "padding_bottom",
    "value" => array(
        esc_html( 'None') => '',
        esc_html( 'Padding bottom 100px' ) => 'padding_bottom_100',
        esc_html( 'Padding bottom 110px' ) => 'padding_bottom_110',
        esc_html( 'Padding bottom 120px' ) => 'padding_bottom_120',
        esc_html( 'Padding bottom 130px' ) => 'padding_bottom_130',
        esc_html( 'Padding bottom 140px' ) => 'padding_bottom_140',
        esc_html( 'Padding bottom 150px') => 'padding_bottom_150', 
    ),
    "group" => esc_html__("Other setting",'medix'), 
));
vc_add_param('vc_row', array(
    'type' => 'checkbox',
    'heading' => esc_html__("Gradient background", 'medix'),
    'param_name' => 'gradient_bg',
    'value' => '',
    'group' => esc_html__("Other setting",'medix'),
));
vc_add_param('vc_row', array(
    'type' => 'checkbox',
    'heading' => esc_html__("Visible overflow", 'medix'),
    'param_name' => 'visible_overflow',
    'value' => '',
    'group' => esc_html__("Other setting",'medix'),
));
vc_add_param('vc_row', array(
    'type' => 'checkbox',
    'heading' => esc_html__("Overlay opacity", 'medix'),
    'param_name' => 'overlay_opacity',
    'value' => '',
    'group' => esc_html__("Design Options",'medix'),
));
vc_add_param('vc_row', array(
    'type' => 'checkbox',
    'heading' => esc_html__("Background image fixed", 'medix'),
    'param_name' => 'bg_fixed',
    'value' => '',
    'group' => esc_html__("Design Options",'medix'),
));

 