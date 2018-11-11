<?php
vc_map(array(
    "name" => 'CMS Opening Hours',
    "base" => "cms_opening_hours",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" => esc_html__('Show contact information', 'medix'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'medix'),
            "param_name" => "style",
            "value" => array(
                'Default' => 'default',
                'White' => 'white',
            ),
            "std" => 'default',
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Monday – Friday",'medix'),
            "param_name" => "mon_fri",
            "value" => "8.00 – 17.00",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Saturday",'medix'),
            "param_name" => "set",
            "value" => "9.30 – 17.30",
        ), 
        array(
            "type" => "textfield",
            "heading" => esc_html__("Sunday",'medix'),
            "param_name" => "sun",
            "value" => "Closed",
        ), 
        array(
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        )
    )
));
class WPBakeryShortCode_cms_opening_hours extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}