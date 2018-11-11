<?php
vc_map(array(
    "name" => 'Cms Socials',
    "base" => "cms_socials",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
         
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Options', 'medix' ),
            'param_name' => 'options',
            'description' => esc_html__( 'Enter values for plan option', 'medix' ),
            'value' => urlencode( json_encode( array(
                array(
                    'values' => esc_html__( 'Option', 'medix' ),
                ),
            ) ) ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Social Link",'medix'),
                    "param_name" => "social_link",
                ),
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Icon class (facebook,twitter,google...)",'medix'),
                    "param_name" => "icon_class",
                    "admin_label" => true,
                ),
            ),
            
        ),
         
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra Class",'medix'),
            "param_name" => "class",
            "value" => "",
            "description" =>"",
        ),
    )
));

class WPBakeryShortCode_cms_socials extends CmsShortCode
{
    protected function content($atts, $content = null){
        $atts_extra = shortcode_atts(array(
            'class' => '',
        ), $atts);
        $atts = array_merge($atts_extra, $atts);
         
        $class = $atts['class'];
          
        return parent::content($atts, $content);
    }
    
}

?>