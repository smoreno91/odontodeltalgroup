<?php
vc_remove_param('cms_counter_single', 'title');
vc_remove_param('cms_counter_single', 'description'); 
vc_remove_param('cms_counter_single', 'content_align'); 
 
 
$params = array( 
    array(
        'type' => 'dropdown',
        'param_name' => 'color_mode',
    	'heading' => esc_html__( 'Color mode', 'medix' ),
    	'value' => array(
            esc_html__( 'Default', 'medix' ) => '',
    		esc_html__( 'Primary', 'medix' ) => 'primary-color',
    		esc_html__( 'Secondary', 'medix' ) => 'second-color',
    	),
        "std"       => '',
        'template' => array('cms_counter_single--layout1.php'),   
    	"group" => esc_html__("Template", 'medix')
    ),
)  
 
?>