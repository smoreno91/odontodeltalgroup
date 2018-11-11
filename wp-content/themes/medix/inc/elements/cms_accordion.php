<?php
vc_map(array(
    "name" => 'Cms Accordion',
    "base" => "cms_accordion",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
        array(
            "type" => "cms_template",
            "param_name" => "cms_template",
            "heading" => esc_html__("Shortcode layout",'medix'),
            "shortcode" => "cms_accordion",
            "group" => esc_html__("Template", 'medix'),
        ),
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
                    "heading" =>esc_html__("Icon class",'medix'),
                    "param_name" => "icon_class",
                ),
                array(
                    "type"       => "attach_image",
                    "param_name" => "image",
                    "heading"    => esc_html__("Image",'medix'),
                ),
                array(
                    "type"        => "vc_link",
                    "heading"     => esc_html__("Image Link",'medix'),
                    "param_name"  => "link",
                    "value"       => "",
                    "description" => esc_html__("Use for case image is not null",'medix'),
                ),
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Title",'medix'),
                    "param_name" => "title",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textarea",
                    "heading" =>esc_html__("Description",'medix'),
                    "param_name" => "desc", 
                    "value" =>"",
                ),
                array(
                    "type" => "checkbox",
                    "heading" =>esc_html__("Is Open",'medix'),
                    "param_name" => "is_open", 
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

class WPBakeryShortCode_cms_accordion extends CmsShortCode
{
    protected function content($atts, $content = null){
        $atts_extra = shortcode_atts(array(
            'class' => '',
            'content'    =>  'content'
        ), $atts);
        $atts = array_merge($atts_extra, $atts);
        $html_id = cmsHtmlID('cms-accordion');
        $class = $atts['class'];
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']).' '.$class;
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
    
}

?>