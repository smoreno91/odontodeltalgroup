<?php
/**
 * Add row params
 * 
 * @author Knight
 * @since 1.0.0
 */
vc_add_param("vc_column_text",array(
	"type" => "dropdown",
	"heading" => esc_html__("List Style",'medix'),
    "admin_label" => true,
	"param_name" => "list_style",
	"value" => array(
        esc_html__('None','medix') => '',
        esc_html__('list1','medix') => 'list1',
        esc_html__('list1 no bullets','medix')  => 'list1 no-bullets',
        esc_html__('list2','medix')  => 'list2',
        esc_html__('list2 triangle bullet','medix')  => 'list2 triangle-bullet',
        esc_html__('list3 highlight','medix')  => 'list3 highlight',
    ),
    "std" => '',
    "group" => esc_html__("Other setting",'medix')
)); 
vc_add_param("vc_column_text", array(
    "type" => "textfield",
    "heading" => esc_html__("Font size",'medix'),
    "param_name" => "font_size",
    "value" => "",
    "group" => esc_html__("Other setting",'medix')
));
vc_add_param("vc_column_text", array(
    "type" => "textfield",
    "heading" => esc_html__("Line height",'medix'),
    "param_name" => "line_height",
    "value" => "",
    "group" => esc_html__("Other setting",'medix')
));
vc_add_param('vc_column_text', array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__("Color", 'medix'),
    "param_name" => "color",
    "value" => "",
	'group' => esc_html__("Other setting",'medix'),
));
