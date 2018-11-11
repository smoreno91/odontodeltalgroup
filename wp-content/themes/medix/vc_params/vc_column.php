<?php
/**
 * Add column params
 * 
 * @author Knight
 * @since 1.0.0
 */
vc_add_param('vc_column', array(
    "type" => "dropdown",
    "heading" => esc_html__("CSS Animation", 'medix'),
    "description" => esc_html__('Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'medix'),
    "param_name" => "css_animation",
    "value" => medix_animate_lib(),
));
vc_add_param("vc_column", array(
	"type" => "textfield",
    "heading" => esc_html__("Delay",'medix'),
    "param_name" => "data_delay",
    "value" => "150",
    "description" => esc_html__("Enter the data delay as 150",'medix'),
));
vc_add_param('vc_column', array(
    "type" => "dropdown",
    "heading" => esc_html__("Select padding type", 'medix'),
    "param_name" => "padding_type",
    "value" => array(
        esc_html( 'None') => '',
        esc_html( 'Small padding' ) => 'with_small_padding',
        esc_html( 'Medium padding' ) => 'with_padding',
        esc_html( 'Big padding' ) => 'with_big_padding',
    ),
    "group" => esc_html__("Other setting",'medix'), 
));