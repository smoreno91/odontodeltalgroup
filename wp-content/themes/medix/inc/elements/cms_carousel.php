<?php
vc_map(
	array(
		"name" => esc_html__("CMS Carousel", 'medix'),
	    "base" => "cms_carousel",
	    "class" => "vc-cms-carousel",
	    "category" => esc_html__("CmsSuperheroes Shortcodes", 'medix'),
	    "params" => array(
	    	array(
	            "type" => "loop",
	            "heading" => esc_html__("Source",'medix'),
	            "param_name" => "source",
	            'settings' => array(
	                'size' => array('hidden' => false, 'value' => 10),
	                'order_by' => array('value' => 'date')
	            ),
	            "group" => esc_html__("Source Settings", 'medix'),
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("XSmall Devices",'medix'),
	            "param_name" => "xsmall_items",
	            "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
	            "value" => array(1,2,3,4,5,6),
	            "std" => 1,
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	    	array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Small Devices",'medix'),
	            "param_name" => "small_items",
	            "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
	            "value" => array(1,2,3,4,5,6),
	            "std" => 2,
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Medium Devices",'medix'),
	            "param_name" => "medium_items",
	            "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
	            "value" => array(1,2,3,4,5,6),
	            "std" => 3,
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Large Devices",'medix'),
	            "param_name" => "large_items",
	            "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
	            "value" => array(1,2,3,4,5,6),
	           	"std" => 4,
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => esc_html__("Margin Items",'medix'),
	            "param_name" => "margin",
	            "value" => "10",
	            "description" => esc_html__("",'medix'),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Loop Items",'medix'),
	            "param_name" => "loop",
	            "value" => array(
	            	"True" => "true",
	            	"False" => "false"
	            	),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Mouse Drag",'medix'),
	            "param_name" => "mousedrag",
	            "value" => array(
	            	"True" => "true",
	            	"False" => "false"
	            	),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Show Nav",'medix'),
	            "param_name" => "nav",
	            "value" => array(
	            	"True" => "true",
	            	"False" => "false"
	            	),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Show Dots",'medix'),
	            "param_name" => "dots",
	            "value" => array(
	            	"True" => "true",
	            	"False" => "false"
	            	),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Auto Play",'medix'),
	            "param_name" => "autoplay",
	            "value" => array(
	            	"True" => "true",
	            	"False" => "false"
	            	),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => esc_html__("Auto Play TimeOut",'medix'),
	            "param_name" => "autoplaytimeout",
	            "value" => "5000",
	            "dependency" => array(
	            	"element"=>"autoplay",
	            	"value" => "true"
	            	),
	            "description" => esc_html__("",'medix'),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => esc_html__("Smart Speed",'medix'),
	            "param_name" => "smartspeed",
	            "value" => "1000",
	            "description" => esc_html__("Speed scroll of each item",'medix'),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Pause On Hover",'medix'),
	            "param_name" => "autoplayhoverpause",
	            "dependency" => array(
	            	"element"=>"autoplay",
	            	"value" => "true"
	            	),
	            "value" => array(
	            	"True" => "true",
	            	"False" => "false"
	            	),
	            "group" => esc_html__("Carousel Settings", 'medix')
	        ),
	        /* Start Icon */
	        array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'medix' ),
				'value' => array(
					esc_html__( 'Font Awesome', 'medix' ) => 'fontawesome',
                    esc_html__( 'Glyphicons Icon', 'medix' ) => 'glyphicons',
					esc_html__( 'P7 Stroke', 'medix' ) => 'pe7stroke',
					esc_html__( 'RT Icon 2', 'medix' ) => 'rticon2',
				),
				'param_name' => 'l_icon_type',
				'description' => esc_html__( 'Select icon library.', 'js_composer' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Prev Icon', 'medix' ),
				'param_name' => 'l_icon_fontawesome',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'fontawesome',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'l_icon_type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
            array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Prev Icon', 'medix' ),
				'param_name' => 'l_icon_glyphicons',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'glyphicons',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'l_icon_type',
					'value' => 'glyphicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Prev Icon', 'medix' ),
				'param_name' => 'l_icon_pe7stroke',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'pe7stroke',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'l_icon_type',
					'value' => 'pe7stroke',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Prev Icon', 'medix' ),
				'param_name' => 'l_icon_rticon2',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'rticon2',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'l_icon_type',
					'value' => 'rticon2',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			/* End Icon */
			/* Start Icon */
	        array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'medix' ),
				'value' => array(
					esc_html__( 'Font Awesome', 'medix' ) => 'fontawesome',
                    esc_html__( 'Glyphicons Icon', 'medix' ) => 'glyphicons',
					esc_html__( 'P7 Stroke', 'medix' ) => 'pe7stroke',
					esc_html__( 'RT Icon 2', 'medix' ) => 'rticon2',
				),
				'param_name' => 'r_icon_type',
				'description' => esc_html__( 'Select icon library.', 'js_composer' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Next Icon', 'medix' ),
				'param_name' => 'r_icon_fontawesome',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'fontawesome',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'r_icon_type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
            array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Prev Icon', 'medix' ),
				'param_name' => 'r_icon_glyphicons',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'glyphicons',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'r_icon_type',
					'value' => 'glyphicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Next Icon', 'medix' ),
				'param_name' => 'r_icon_pe7stroke',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'pe7stroke',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'r_icon_type',
					'value' => 'pe7stroke',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Next Icon', 'medix' ),
				'param_name' => 'r_icon_rticon2',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'rticon2',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'r_icon_type',
					'value' => 'rticon2',
				),
				'description' => esc_html__( 'Select icon from library.', 'medix' ),
				"group" => esc_html__("Carousel Settings", 'medix')
			),
			 
			/* End Icon */
	        array(
	            "type" => "textfield",
	            "heading" => esc_html__("Extra Class",'medix'),
	            "param_name" => "class",
	            "value" => "",
	            "description" => esc_html__("",'medix'),
	            "group" => esc_html__("Template", 'medix')
	        ),
	    	array(
	            "type" => "cms_template",
	            "param_name" => "cms_template",
	            "shortcode" => "cms_carousel",
	            "admin_label" => true,
	            "heading" => esc_html__("Shortcode Template",'medix'),
	            "group" => esc_html__("Template", 'medix'),
	        )
	    )
	)
);
global $cms_carousel;
$cms_carousel = array();
class WPBakeryShortCode_cms_carousel extends CmsShortCode{
	protected function content($atts, $content = null){
		//default value
		$atts_extra = shortcode_atts(array(
			'source' => '',
			'xsmall_items' => 1,
			'small_items' => 2,
			'medium_items' => 3,
			'large_items' => 4,
			'margin' => 10,
			'loop' => 'true',
			'mousedrag' => 'true',
			'nav' => 'true',
			'dots' => 'true',
			'autoplay' => 'true',
			'autoplaytimeout' => '5000',
			'smartspeed' => '1000',
			'autoplayhoverpause' => 'true',
			'l_icon_type' => 'fontawesome',
			'l_icon_fontawesome' => '',
            'l_icon_glyphicons' => '',
			'l_icon_pe7stroke' => '',
			'l_icon_rticon2' => '',
			'r_icon_type' => 'fontawesome',
			'r_icon_fontawesome' => '',
            'r_icon_glyphicons' => '',
			'r_icon_pe7stroke' => '',
			'r_icon_rticon2' => '',
			'left_arrow' => 'fa fa-arrow-left',
			'right_arrow' => 'fa fa-arrow-right',
			'cms_template' => 'cms_carousel.php',
			'not__in'=> 'false', 
			'class' => '',
			    ), $atts);

		$atts = array_merge($atts_extra,$atts);
		global $cms_carousel;
		//icon lib
		switch ($atts['r_icon_type']) {
			case 'pe7stroke':
                wp_enqueue_style('cms-icon-pe7stroke',get_template_directory_uri().'/assets/css/pe-icon-7-stroke.css');
				break;
			case 'rticon2':
                wp_enqueue_style('cms-icon-rticon',get_template_directory_uri().'/assets/css/rt-icon.css');
				break;
			default:
				vc_icon_element_fonts_enqueue( $atts['r_icon_type'] );
				break;
		}
		switch ($atts['l_icon_type']) {
			case 'pe7stroke':
				wp_enqueue_style('cms-icon-pe7stroke',get_template_directory_uri().'/assets/css/pe-icon-7-stroke.css');
				break;
			case 'rticon2':
				wp_enqueue_style('cms-icon-rticon',get_template_directory_uri().'/assets/css/rt-icon.css');
				break;
			default:
				vc_icon_element_fonts_enqueue( $atts['l_icon_type'] );
				break;
		}
		$r_icon_name = "r_icon_" . $atts['r_icon_type'];
    	$r_iconClass = empty($atts[$r_icon_name])? $atts['right_arrow'] : $atts[$r_icon_name];
    	$l_icon_name = "l_icon_" . $atts['l_icon_type'];
    	$l_iconClass = empty($atts[$l_icon_name])? $atts['left_arrow'] : $atts[$l_icon_name];


	    wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.2.1','all');
        wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.2.1',true); 
		wp_enqueue_script('owl-carousel-cms',get_template_directory_uri().'/assets/js/owl.carousel.cms.js',array('jquery'),'1.0.0',true);
		 
		$source = $atts['source'];
        if(isset($atts['not__in']) and $atts['not__in'] == 'true'){
        	list($args, $post) = vc_build_loop_query($source, get_the_ID());
        	
        }else{
        	list($args, $post) = vc_build_loop_query($source);
        }
        $atts['posts'] = $post;
        $html_id = cmsHtmlID('cms-carousel');
        $atts['autoplaytimeout'] = isset($atts['autoplaytimeout'])?(int)$atts['autoplaytimeout']:5000;
        $atts['smartspeed'] = isset($atts['smartspeed'])?(int)$atts['smartspeed']:1000;
        $cms_carousel[$html_id] = array(
        	'margin' => $atts['margin'],
        	'loop' => $atts['loop'],
        	'mouseDrag' => $atts['mousedrag'],
        	'nav' => $atts['nav'],
        	'dots' => $atts['dots'],
        	'autoplay' => $atts['autoplay'],
        	'autoplayTimeout' => $atts['autoplaytimeout'],
        	'smartSpeed' => $atts['smartspeed'],
        	'autoplayHoverPause' => $atts['autoplayhoverpause'],
        	'navText' => array('<i class="'.$l_iconClass.'"></i>','<i class="'.$r_iconClass.'"></i>'),
        	'dotscontainer' => $html_id.' .cms-dots',
        	'responsive' => array(
        		0 => array(
        		"items" => (int)$atts['xsmall_items'],
        		),
	        	768 => array(
	        		"items" => (int)$atts['small_items'],
	        		),
	        	992 => array(
	        		"items" => (int)$atts['medium_items'],
	        		),
	        	1200 => array(
	        		"items" => (int)$atts['large_items'],
	        		)
	        	)
        );
        wp_localize_script('owl-carousel-cms', "cmscarousel", $cms_carousel);
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']). ' '. $atts['class'];
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>