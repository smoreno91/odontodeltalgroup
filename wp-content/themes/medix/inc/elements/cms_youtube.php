<?php
vc_map(array(
    "name" => 'CMS Youtube',
    "base" => "cms_youtube",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "params" => array(
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__( 'Youtube url', 'medix' ),
            'param_name'    => 'url',
            'value'         => 'https://www.youtube.com/embed/o-So-vE8OcM',
        ),
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title",'medix'),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__( 'Sub Title', 'medix' ),
            'param_name'    => 'sub_title',
            'admin_label'   => true,
            'value'         => ""
        ),
        array(
            "type"        => "vc_link",
            "heading"     => esc_html__("URL (Link)",'medix'),
            "param_name"  => "link",
            "value"       => "",
        ),
        array(
            "type"        => "dropdown",
            'type' => 'dropdown',
            'param_name' => 'background_icon',
        	'heading' => esc_html__( 'Background icon', 'medix' ),
        	'value' => array(
                esc_html__( 'Secondary', 'medix' ) => 'second-color',
        		esc_html__( 'Primary', 'medix' ) => 'primary-color',
        	),
            "std"       => 'second-color',
        ),  
        array(
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        )
           
    )
));
class WPBakeryShortCode_cms_youtube extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}