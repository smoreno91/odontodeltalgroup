<?php
vc_map(array(
    "name" => 'CMS Button',
    "base" => "cms_button",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" => esc_html__('Show social from theme option', 'medix'),
    "params" => array(
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title",'medix'),
            "param_name" => "title",
            "value" => "",
            "admin_label" => true,
            "description" => esc_html__("Title",'medix'),
        ),
        array(
        	'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'medix' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Add link to button.', 'medix' ),
        ),
        array(
        	"type" => "dropdown",
        	"heading" => esc_html__("Type",'medix'),
        	"param_name" => "btn_type",
        	"value" => array(
                'Default' => 'btn-default',
                'Primary' => 'btn-primary',
                'Second'  => 'btn-secondary',
                'Inverse' => 'btn-inverse',
                'White'   => 'btn-white',
            ),
            "std" => 'btn-default',
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Is Dark", 'medix'),
            'param_name' => 'default_is_dark',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'btn_type',
                'value' => array(
                    'btn-default',
                ),
            ),
            'std' => false,
        ),
        array(
        	"type" => "dropdown",
        	"heading" => esc_html__("Size",'medix'),
        	"param_name" => "size",
        	"value" => array(
                'Large' => 'btn-lg',
                'Medium' => 'btn-md',
                'Small' => 'btn-sm',
            ),
            "std" => 'btn-md',
            "description" => esc_html__( 'Select button size.', 'medix' ),
        ),
        
        array(
        	"type" => "dropdown",
        	"heading" => esc_html__("Alignment",'medix'),
        	"param_name" => "align",
        	"value" => array(
                'inline' => 'inline',
                'left' => 'left',
                'right' => 'right',
                'center' => 'center',
            ),
            "std" => 'inline',
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Set full width button?", 'medix'),
            'param_name' => 'button_block',
            'value' => array(
                'Yes' => true
            ),
            'dependency' => array(
                'element' => 'align',
                'value' => array(
                    'left',
                    'right',
                    'center',
                ),
            ),
            'std' => false,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Add icon", 'medix'),
            'param_name' => 'add_icon',
            'value' => array(
                'Yes' => true
            ),
            'std' => false,
        ),
        array(
        	"type" => "dropdown",
        	"heading" => esc_html__("Icon Alignment",'medix'),
        	"param_name" => "i_align",
        	"value" => array(
                'Left' => 'left',
                'Right' => 'right',
            ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => array(
                    '1',
                ),
            ),
            "std" => 'left',
        ),
        
        array(
            'type' => 'dropdown',
        	'heading' => esc_html__( 'Icon library', 'medix' ),
        	'value' => array(
        		esc_html__( 'Font Awesome', 'medix' ) => 'fontawesome',
                esc_html__( 'Glyphicons Icon', 'medix' ) => 'glyphicons',
                esc_html__( 'RT Icon 2', 'medix' ) => 'rticon2',
                esc_html__( 'P7 Stroke', 'medix' ) => 'pe7stroke',
        	),
        	'param_name' => 'icon_type',
        	'description' => esc_html__( 'Select icon library.', 'medix' ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => array(
                    '1',
                ),
            ),
        ),
        array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon Item', 'medix' ),
			'param_name' => 'icon_fontawesome',
            'value' => '',
			'settings' => array(
				'emptyIcon' => true,  
				'type' => 'fontawesome',
				'iconsPerPage' => 200,  
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),
		 
		),
        array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon Item', 'medix' ),
			'param_name' => 'icon_glyphicons',
            'value' => '',
			'settings' => array(
				'emptyIcon' => true, 
				'type' => 'glyphicons',
				'iconsPerPage' => 200,  
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'glyphicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),
		),
        array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon Item', 'medix' ),
			'param_name' => 'icon_rticon2',
            'value' => '',
			'settings' => array(
				'emptyIcon' => true, 
				'type' => 'rticon2',
				'iconsPerPage' => 200,  
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'rticon2',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),	 
		),
        array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon Item', 'medix' ),
			'param_name' => 'icon_pe7stroke',
            'value' => '',
			'settings' => array(
				'emptyIcon' => true, 
				'type' => 'pe7stroke',
				'iconsPerPage' => 200,  
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'pe7stroke',
			),
			'description' => esc_html__( 'Select icon from library.', 'medix' ),	 
		),
         
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Class",'medix'),
            "param_name" => "el_class",
            "value" => "",
            "description" => esc_html__("Class",'medix'),
        ), 
        array(
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        )
    )
));
class WPBakeryShortCode_cms_button extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}