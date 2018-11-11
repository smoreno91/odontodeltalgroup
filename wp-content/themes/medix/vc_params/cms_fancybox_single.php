<?php
vc_remove_param('cms_fancybox_single', 'title');
vc_remove_param('cms_fancybox_single', 'description');
vc_remove_param('cms_fancybox_single', 'content_align');
vc_remove_param('cms_fancybox_single', 'button_text');
vc_remove_param('cms_fancybox_single', 'button_link');
vc_remove_param('cms_fancybox_single', 'button_type');

vc_add_param("cms_fancybox_single", array(
    'type' => 'img',
    'heading' => esc_html__( 'Fancy Style', 'medix' ),
    'value' => array(
        'style-0' => get_template_directory_uri().'/vc_params/cms-fancy-single/default.png',
        'style-1' => get_template_directory_uri().'/vc_params/cms-fancy-single/fancy-style1.png', 
        'style-2' => get_template_directory_uri().'/vc_params/cms-fancy-single/fancy-style2.png', 
        'style-3' => get_template_directory_uri().'/vc_params/cms-fancy-single/fancy-style3.png',  
    ),
    'param_name' => 'fancy_style',
    "admin_label" => true,
    'description' => esc_html__( 'Select fancybox style', 'medix' ),
    "group" => esc_html__("Layout", 'medix'),
    'weight' => 1
));
 
vc_add_param("cms_fancybox_single", array(
    "type" => "textfield",
    "heading" => esc_html__("Extra Class",'medix'),
    "param_name" => "class",
    "value" => "",
    "description" => "",
    "group" => esc_html__("Layout", 'medix'),
    'weight' => 1
));

vc_add_param("cms_fancybox_single", array(
    "type" => "cms_template",
    "param_name" => "cms_template",
    "heading" => esc_html__("Shortcode Template", 'medix'),
    "shortcode" => "cms_fancybox_single",
    "group" => esc_html__("Layout", 'medix'),
    'weight' => 1
));
vc_add_param("cms_fancybox_single", array(
    'type' => 'dropdown',
	'heading' => esc_html__( 'Icon library', 'medix' ),
	'value' => array(
		esc_html__( 'Font Awesome', 'medix' ) => 'fontawesome',
		esc_html__( 'Open Iconic', 'medix' ) => 'openiconic',
		esc_html__( 'Typicons', 'medix' ) => 'typicons',
		esc_html__( 'Entypo', 'medix' ) => 'entypo',
		esc_html__( 'Linecons', 'medix' ) => 'linecons',
		esc_html__( 'Pixel', 'medix' ) => 'pixelicons',
		esc_html__( 'P7 Stroke', 'medix' ) => 'pe7stroke',
		esc_html__( 'RT Icon', 'medix' ) => 'rticon',
        esc_html__( 'Glyphicons Icon', 'medix' ) => 'glyphicons',
	),
	'param_name' => 'icon_type',
	'description' => esc_html__( 'Select icon library.', 'medix' ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style-0',
            'style-1',
            'style-3',
        ),
    ),
	"group" => esc_html__("Fancy Icon Settings", 'medix')
));
vc_add_param("cms_fancybox_single", array(
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
    "group" => esc_html__("Fancy Icon Settings", 'medix')
));
 
vc_add_param("cms_fancybox_single", array(
    "type" => "attach_image",
    "heading" => esc_html__("Image Item",'medix'),
    "param_name" => "image",
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style-0',
        ),
    ),
    "group" => esc_html__("Option", 'medix')
));
vc_add_param("cms_fancybox_single", array(
    "type"       => "colorpicker",
    "class"      => "",
    "heading"    => esc_html__("Background color", 'medix'),
    "param_name" => "background_color",
    "value"      => "",
    'dependency' => array(
        'element' => 'fancy_style',
        'value'   => array(
            'style-1',
            'style-2',
        ),
    ),
    "group" => esc_html__("Option", 'medix'),
    "weight" => 1
));
  
vc_add_param("cms_fancybox_single", array(
    'type' => 'checkbox',
    'heading' => esc_html__("Top overlap", 'medix'),
    'param_name' => 'top_overlap',
    'value' => array(
        'Yes' => true
    ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style-1',
            'style-2',
        ),
    ),
    'std' => false,
    "group" => esc_html__("Option", 'medix'),
    "weight" => 1
));
vc_add_param("cms_fancybox_single", array(
    "type"       => "colorpicker",
    "class"      => "",
    "heading"    => esc_html__("Top background color", 'medix'),
    "param_name" => "top_background_color",
    "value"      => "",
    "description" => esc_html__("Apply for case of top overlap",'medix'),
    'dependency' => array('element' => 'fancy_style','value'   => array('style-2')),
    "group" => esc_html__("Option", 'medix'),
    "weight" => 1
));
vc_add_param("cms_fancybox_single", array(
    "type" => "textfield",
    "heading" => esc_html__("Title thin",'medix'),
    "param_name" => "title_thin",
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style-1',
            'style-2',
            'style-3',
        ),
    ),
    "group" => esc_html__("Option", 'medix'),
    "weight" => 1
));

vc_add_param("cms_fancybox_single", array(
	"type" => "textfield",
    "heading" => esc_html__("Title Item",'medix'),
    "param_name" => "title_item",
    "value" => "",
    "admin_label" => true,
    "description" => esc_html__("Title Of Item",'medix'),
    "group" => esc_html__("Option", 'medix')
));

vc_add_param("cms_fancybox_single", array(
	"type" => "textarea",
    "heading" => esc_html__("Content Item",'medix'),
    "param_name" => "description_item",
    "group" => esc_html__("Option", 'medix')
));

vc_add_param("cms_fancybox_single", array(
	'type' => 'vc_link',
    'heading' => esc_html__( 'URL (Link)', 'medix' ),
    'param_name' => 'link',
    'description' => esc_html__( 'Add link to button.', 'medix' ),
    "group" => esc_html__("Option", 'medix'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style-0',
            'style-1',
            'style-2',
        ),
    ),
));

vc_add_param("cms_fancybox_single", array(
	'type' => 'css_editor',
    'heading' => esc_html__( 'CSS box', 'medix' ),
    'param_name' => 'css',
    'group' => esc_html__( 'Design Options', 'medix' ),
));
 