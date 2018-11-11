<?php
vc_map(array(
    "name" => 'Message Box',
    "base" => "cms_message_box",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Layout", 'medix'),
            "param_name" => "message_type",
            "value"      => array(
                esc_html__("Success", 'medix')      => "alert-success",
                esc_html__("Info", 'medix')         => "alert-info",
                esc_html__("Warning", 'medix')      => "alert-warning",
                esc_html__("Danger", 'medix')       => "alert-danger",
                 
            ),
            "std"=>"alert-success",
        ), 
         
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Title",'medix'),
            "param_name" => "title",
            "admin_label" => true,
            "value"   => "Well done!",
        ),
        array(
          "type"       => "textarea",
          "heading"    => esc_html__( "Message", "medix" ),
          "param_name" => "message",
          "value"      => 'You successfully read this important alert message.', 
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group'      => esc_html__( 'Design Options', 'medix' ),
        ), 
    )
));

class WPBakeryShortCode_cms_message_box extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
    
}

?>