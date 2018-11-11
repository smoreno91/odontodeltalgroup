<?php
vc_map(array(
    "name" => 'CMS Department',
    "base" => "cms_department",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "params" => array(
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title",'medix'),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            'type'          => 'param_group',
            'heading'       => esc_html__( 'Add department items', 'medix' ),
            'param_name'    => 'values',
            'value'         => urlencode( json_encode( array(
                array(
                    'author_name' => esc_html__( 'Medical Center', 'medix' ),
                ),
            ) ) ),
            'params' => array(
                 array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Tab Title', 'medix' ),
                    'param_name'    => 'tab_title',
                    'admin_label'   => true,
                    'value'         => esc_html__('Medical Center','medix')
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Title 1', 'medix' ),
                    'param_name'    => 'title1',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Title 2', 'medix' ),
                    'param_name'    => 'title2',
                ),
                array(
                    'type'          => 'textarea',
                    'heading'       => esc_html__( 'Content text', 'medix' ),
                    'description'   => esc_html__('Press double ENTER to get line-break','medix'),
                    'param_name'    => 'text',
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__( 'Image', 'medix' ),
                    'param_name'    => 'image',
                    'value'         => ''
                ),
                array(
                    "type"        => "vc_link",
                    "heading"     => esc_html__("URL (Link)",'medix'),
                    "param_name"  => "link",
                    "value"       => "",
                ),
                
            ),
            
        ),
         
        array(
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        )
    )
));
class WPBakeryShortCode_cms_department extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}