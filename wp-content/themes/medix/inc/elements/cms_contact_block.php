<?php
vc_map(array(
    "name" => 'CMS Contact Block',
    "base" => "cms_contact_block",
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
            'type' => 'checkbox',
            'heading' => esc_html__("Is center?", 'medix'),
            'param_name' => 'is_center',
            'value' => array(
                'Yes' => true
            ),
            'std' => false,
        ),
        array(
            'type'          => 'param_group',
            'heading'       => esc_html__( 'Add your contact info', 'medix' ),
            'param_name'    => 'values',
            'value'         => urlencode( json_encode( array(
                array(
                    'author_name' => esc_html__( 'Jacksotts street 567, San Diego, California, USA', 'medix' ),
                ),
            ) ) ),
            'params' => array(
                array(
                	"type" => "textfield",
                    "heading" => esc_html__("Title",'medix'),
                    "param_name" => "title",
                    "value" => "",
                    "admin_label" => true,
                ),
                array(
                	"type" => "textfield",
                    "heading" => esc_html__("Icon class",'medix'),
                    "param_name" => "icon_class",
                    "value" => "",
                    "description" => esc_html__("fa fa-map-marker",'medix'),
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
class WPBakeryShortCode_cms_contact_block extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}