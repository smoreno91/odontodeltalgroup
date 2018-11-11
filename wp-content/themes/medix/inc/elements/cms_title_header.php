<?php
vc_map(array(
    "name"        => 'Cms Title Header',
    "base"        => "cms_title_header",
    "icon"        => "cs_icon_for_vc",
    "category"    =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
        array(
            'type' => 'img',
            'heading' => esc_html__( 'Style', 'medix' ),
            'value' => array(
                'style-0' => get_template_directory_uri().'/vc_params/layouts/cms_th_default.png',
                'style-1' => get_template_directory_uri().'/vc_params/layouts/cms_th_style1.png', 
                  
            ),
            'param_name' => 'style',
            'description' => esc_html__( 'Select style', 'medix' ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Is center?", 'medix'),
            'param_name' => 'is_center',
            'value' => array(
                'Yes' => true
            ),
            'std' => false,
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title 1",'medix'),
            "param_name" => "title1",
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 1 color", 'medix'),
            "param_name" => "title1_color",
            "value"      => "",
        ), 
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title 1 font size (px)", 'medix'),
            "param_name" => "title1_fontsize",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title 1 line height", 'medix'),
            "param_name" => "title1_line_height",
            "value"      => "0.8",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title 2",'medix'),
            "param_name" => "title2",
        ),  
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 2 color", 'medix'),
            "param_name" => "title2_color",
            "value"      => "",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title 2 font size (px)", 'medix'),
            "param_name" => "title2_fontsize",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title 2 line height", 'medix'),
            "param_name" => "title2_line_height",
            "value"      => "0.9",
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group'      => esc_html__( 'Design Options', 'medix' ),
        ),
    )
));
class WPBakeryShortCode_cms_title_header extends CmsShortCode
{
    protected function content($atts, $content = null){
        $html_id = cmsHtmlID('cms-title-header');
         
        $atts['html_id'] = $html_id; 
        return parent::content($atts, $content);
    }
  
}
 

?>