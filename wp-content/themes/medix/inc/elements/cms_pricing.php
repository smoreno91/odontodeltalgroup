<?php
vc_map(array(
    "name" => 'Pricing Table',
    "base" => "cms_pricing",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Layout", 'medix'),
            "param_name" => "layout",
            "value"      => array(
                esc_html__("Background Color", 'medix')     => "layout1",
                esc_html__("Style 1", 'medix')              => "layout2",
                esc_html__("Style 2", 'medix')              => "layout3",
                 
            ),
            "std"=>"layout1",
        ), 
        array(
            "type"       => "attach_image",
            "param_name" => "image",
            "heading"    => esc_html__("Background image",'medix'),
            'dependency' => array(
                'element' => 'layout',
                'value'   => array(
                    'layout1',
                ),
            ),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Background overlay color", 'medix'),
            "param_name" => "background_overlay",
            "value"      => "",
            'dependency' => array(
                'element' => 'layout',
                'value'   => array(
                    'layout1',
                ),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Is center?", 'medix'),
            'param_name' => 'is_center',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'layout',
                'value'   => array(
                    'layout3',
                ),
            ),
            'std' => false,
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Title",'medix'),
            "param_name" => "title",
            'dependency' => array(
                'element' => 'layout',
                'value'   => array(
                    'layout1',
                    'layout2',
                ),
            ),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title color", 'medix'),
            "param_name" => "title_color",
            "value"      => "",
            'dependency' => array(
                'element' => 'layout',
                'value'   => array(
                    'layout1',
                ),
            ),
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Sub title",'medix'),
            "param_name" => "sub_title",
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Unit",'medix'),
            "param_name" => "unit",
            "value"=>"$",
            "std"=>"$",
        ), 
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Price",'medix'),
            "param_name" => "price",
            'description' => esc_html( '39.99'),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Price color", 'medix'),
            "param_name" => "price_color",
            "value"      => "",
            'dependency' => array(
                'element' => 'layout',
                'value'   => array(
                    'layout3',
                ),
            ),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Features', 'medix' ),
            'param_name' => 'features',
            'description' => esc_html__( 'Enter values for feature', 'medix' ),
            'value' => urlencode( json_encode( array(
                array(
                    'values' => esc_html__( 'Feature', 'medix' ),
                ),
            ) ) ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Feature name",'medix'),
                    "param_name" => "feature_name",
                    'admin_label' => true,
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__("Removed", 'medix'),
                    'param_name' => 'removed',
                    'value' => array(
                        'Yes' => true
                    ),
                    'std' => false,
                ), 
            ),
        ), 
        array(
            "type"        => "vc_link",
            "heading"     => esc_html__("URL (Link)",'medix'),
            "param_name"  => "link",
            "value"       => "",
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Type",'medix'),
            "param_name" => "btn_type",
            "value"      => array(
                'Default' => 'btn-default',
                'Primary' => 'btn-primary',
                'Second'  => 'btn-secondary',
                'Inverse' => 'btn-inverse',
                'White'   => 'btn-white',
            ),
            "std" => 'btn-default',
        ), 
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group'      => esc_html__( 'Design Options', 'medix' ),
        ), 
    )
));

class WPBakeryShortCode_cms_pricing extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
    
}

?>