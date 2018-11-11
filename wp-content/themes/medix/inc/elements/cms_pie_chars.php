<?php
vc_map(array(
    "name"        => 'Cms Pie Chars',
    "base"        => "cms_pie_chars",
    "icon"        => "cs_icon_for_vc",
    "category"    =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title",'medix'),
            "param_name" => "title",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Percent value",'medix'),
            "param_name" => "value",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Size",'medix'),
            "param_name" => "size",
            'description' => esc_html__( 'Enter the width of chars (px)', 'medix' ),
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Line",'medix'),
            "param_name" => "line",
            'description' => esc_html__( 'Enter the thick of track line (px)', 'medix' ),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("background color", 'medix'),
            "param_name" => "bgcolor",
            "value"      => "",
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Track color", 'medix'),
            "param_name" => "trackcolor",
            "value"      => "",
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Speed",'medix'),
            "param_name" => "speed",
            "value"      => '3000',
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group'      => esc_html__( 'Design Options', 'medix' ),
        ),
    )
));
class WPBakeryShortCode_cms_pie_chars extends CmsShortCode
{
    protected function content($atts, $content = null){
        $html_id = cmsHtmlID('cms-pie-chars');
        
        wp_enqueue_script('medix-pie-chars',get_template_directory_uri().'/assets/js/pie_chars.js',array('jquery'),'1.0.0',true); 
        $atts['html_id'] = $html_id; 
        return parent::content($atts, $content);
    }
  
}
 

?>