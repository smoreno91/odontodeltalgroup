<?php
/**
 * Add vc custom heading params
 * 
 * @author Knight
 * @since 1.0.0
 */
    vc_add_param("vc_custom_heading", array(
        "type" => "checkbox",
        "heading" => esc_html__("Uppercase text transform",'medix'),
        "param_name" => "uppercase",
        "value" => array(
            'Yes' => true
        ),
        "std"   => false,
        'group' => esc_html__("Other setting",'medix'),
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "checkbox",
        "heading" => esc_html__("Font-weight: thin",'medix'),
        "param_name" => "thin",
        "value" => array(
            'Yes' => true
        ),
        "std"   => false,
        'group' => esc_html__("Other setting",'medix'),
    ));
    
   