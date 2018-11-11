<?php
vc_map(array(
    "name"        => 'Cms Teaser',
    "base"        => "cms_teaser",
    "icon"        => "cs_icon_for_vc",
    "category"    =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
         
        array(
            'type' => 'img',
            'heading' => esc_html__('Layout Mode','medix'),
            'param_name' => 'layout',
            'value' =>  array(
                'layout1' => get_template_directory_uri().'/vc_params/layouts/teaser-layout1.png',
                'layout2' => get_template_directory_uri().'/vc_params/layouts/teaser-layout2.png',
                'layout3' => get_template_directory_uri().'/vc_params/layouts/teaser-layout3.png',
                'layout4' => get_template_directory_uri().'/vc_params/layouts/teaser-layout4.png',
                'layout5' => get_template_directory_uri().'/vc_params/layouts/teaser-layout5.png',
                'layout6' => get_template_directory_uri().'/vc_params/layouts/teaser-layout6.png',
                'layout7' => get_template_directory_uri().'/vc_params/layouts/teaser-layout7.png',
            ),
            'std' => 'layout1',
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
            "class"      => "",
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
            'heading' => esc_html__("With border", 'medix'),
            'param_name' => 'with_border',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout4',
                    'layout5',
                ),
            ),
            'std' => false,
        ),
        array(
            'type'    => 'dropdown',
            'heading' => esc_html__( 'Background type', 'medix' ),
            'param_name'  => 'background_type',
            'value'   => array(
                esc_html__( 'White', 'medix' )    => 'white_bg',
                esc_html__( 'Gray light', 'medix' ) => 'gray_light_bg',
                esc_html__( 'Dark', 'medix' )       => 'dark_bg',
                esc_html__( 'Primary', 'medix' )       => 'primary_bg',
                esc_html__( 'Secondary', 'medix' )       => 'second_bg',
        	),
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout4',
                    'layout5',
                    'layout6',
                    'layout7',
                ),
            ),
            'std' => 'white_bg',
        ), 
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Text right", 'medix'),
            'param_name' => 'text_right',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout5',
                ),
            ),
            'std' => false,
        ),
        array(
            'type'    => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'medix' ),
            'value'   => array(
                esc_html__( 'Font Awesome', 'medix' )    => 'fontawesome',
                esc_html__( 'Glyphicons Icon', 'medix' ) => 'glyphicons',
                esc_html__( 'RT Icon 2', 'medix' )       => 'rticon2',
                esc_html__( 'P7 Stroke', 'medix' )       => 'pe7stroke',
        	),
            'param_name'  => 'icon_type',
            'description' => esc_html__( 'Select icon library.', 'medix' ),
        ),
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon Item', 'medix' ),
            'param_name' => 'icon_fontawesome',
            'value'      => '',
            'settings'   => array(
                'emptyIcon'    => true,  
                'type'         => 'fontawesome',
                'iconsPerPage' => 200,  
			),
			'dependency' => array(
                'element' => 'icon_type',
                'value'   => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),
		 
		),
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon Item', 'medix' ),
            'param_name' => 'icon_glyphicons',
            'value'      => '',
            'settings'   => array(
                'emptyIcon'    => true, 
                'type'         => 'glyphicons',
                'iconsPerPage' => 200,  
			),
			'dependency' => array(
                'element' => 'icon_type',
                'value'   => 'glyphicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),
		),
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon Item', 'medix' ),
            'param_name' => 'icon_rticon2',
            'value'      => '',
            'settings'   => array(
                'emptyIcon'    => true, 
                'type'         => 'rticon2',
                'iconsPerPage' => 200,  
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value'   => 'rticon2',
            ),
            'description' => esc_html__( 'Select icon from library.', 'medix' ),	 
		),
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon Item', 'medix' ),
            'param_name' => 'icon_pe7stroke',
            'value'      => '',
            'settings'   => array(
                'emptyIcon'    => true, 
                'type'         => 'pe7stroke',
                'iconsPerPage' => 200,  
			),
			'dependency' => array(
                'element' => 'icon_type',
                'value'   => 'pe7stroke',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),	 
		), 
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Icon size", 'medix'),
            "param_name" => "icon_size",
            "value"      => array(
                esc_html__("Size big", 'medix' )    => "size_big",
                esc_html__("Size normal", 'medix' ) => "size_normal",
                esc_html__("Size small", 'medix' )  => "size_small",
            ),
            "std"=>"size_big",
        ),
        array(
            "type"       => "colorpicker",
            "class"      => "",
            "heading"    => esc_html__("Icon color", 'medix'),
            "param_name" => "icon_color",
            "value"      => "",
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Icon border", 'medix'),
            'param_name' => 'icon_border',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout3',
                    'layout4',
                    'layout5',
                    'layout6',
                ),
            ),
            'std' => false,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Icon round", 'medix'),
            'param_name' => 'icon_round',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout3',
                    'layout4',
                    'layout5',
                    'layout6',
                ),
            ),
            'std' => false,
        ),
        array(
            "type"       => "colorpicker",
            "class"      => "",
            "heading"    => esc_html__("Icon background", 'medix'),
            "param_name" => "icon_bg",
            "value"      => "",
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout3',
                    'layout4',
                    'layout5',
                    'layout6',
                ),
            ),
        ),
        array(
            "type"       => "textfield",
            "heading"    => esc_html__("Title",'medix'),
            "param_name" => "title",
        ), 
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Title heading",'medix'),
            "param_name" => "title_heading",
            "value"      => array(
                'h2' => 'h2',
                'h3'  => 'h3',
                'h4' => 'h4',
            ),
            "std" => 'h3',
        ), 
        
        array(
          "type"       => "textarea_html",
          "class"      => "",
          "holder"     => "div",
          "heading"    => esc_html__( "Description", "medix" ),
          "param_name" => "content",
          "value"      => '', 
        ),
        array(
            "type"        => "vc_link",
            "heading"     => esc_html__("URL (Link)",'medix'),
            "param_name"  => "link",
            "value"       => "",
            "description" =>"",
            'dependency'  => array(
                'element' => 'layout',
                'value'   => array(
                    'layout1',
                    'layout2',
                    'layout3',
                    'layout4',
                    'layout7',
                ),
            ),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Button Type",'medix'),
            "param_name" => "btn_type",
            "value"      => array(
                'Default' => 'btn-default',
                'Primary' => 'btn-primary',
                'Second'  => 'btn-secondary',
                'Inverse' => 'btn-inverse',
                'White'   => 'btn-white',
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array(
                    'layout1',
                    'layout2',
                    'layout3',
                    'layout4',
                ),
            ),
            "std" => 'btn-default',
        ), 
        array(
            "type"        => "vc_link",
            "heading"     => esc_html__("Orther custom Link",'medix'),
            "param_name"  => "orther_link",
            "value"       => "",
            "description" =>"",
            'dependency'  => array(
                'element' => 'layout',
                'value'   => array(
                    'layout7',
                ),
            ),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group'      => esc_html__( 'Design Options', 'medix' ),
        ),
    )
));
class WPBakeryShortCode_cms_teaser extends CmsShortCode
{
    protected function content($atts, $content = null){
        $html_id = cmsHtmlID('cms-teaser');
         
        $atts['html_id'] = $html_id; 
        return parent::content($atts, $content);
    }
  
}
 

?>