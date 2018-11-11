<?php
vc_map(array(
    'name' => 'CMS Client Carousel',
    'base' => 'cms_client_carousel',
    'icon' => 'cs_icon_for_vc',
    'category' => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    'description' => esc_html__('Add clients', 'medix'),
    'params' => array(
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Add your client', 'medix' ),
            'param_name' => 'values',
            'value' => urlencode( json_encode( array(
                array(
                    'values' => esc_html__( 'Client', 'medix' ),
                ),
            ) ) ),
            'params' => array(
                array(
                    "type" => "attach_image",
                    "param_name" => "image",
                    "heading" => esc_html__("Image Item",'medix'),
                    "shortcode" => "cms_client_carousel",
                ),
                array(
                	'type' => 'vc_link',
                    'heading' => esc_html__( 'URL (Link)', 'medix' ),
                    'param_name' => 'link',
                ),
            ),
            'group' => esc_html__('Client Item','medix')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("XSmall Devices",'medix'),
            "param_name" => "xsmall_items",
            "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
            "value" => array(1,2,3),
            "std" => 1,
            "group" => esc_html__("Carousel Settings", 'medix')
        ),
    	array(
            "type" => "dropdown",
            "heading" => esc_html__("Small Devices",'medix'),
            "param_name" => "small_items",
            "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
            "value" => array(1,2,3,4,5),
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
            "value" => array(1,2,3,4,5,6,7),
           	"std" => 4,
            "group" => esc_html__("Carousel Settings", 'medix')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Margin Items",'medix'),
            "param_name" => "margin",
            "value" => "20",
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
            "type" => "cms_template",
            "param_name" => "cms_template",
            "shortcode" => "cms_client_carousel",
            "admin_label" => true,
            "heading" => esc_html__("Shortcode Template",'medix'),
            "group" => esc_html__("Template", 'medix'),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        ),
    )
));

global $cms_carousel;
$cms_carousel = array();
class WPBakeryShortCode_cms_client_carousel extends CmsShortCode
{
    protected function content($atts, $content = null){
       $atts_extra = shortcode_atts(array(
            'xsmall_items' => 1,
			'small_items' => 2,
			'medium_items' => 3,
			'large_items' => 4,
			'margin' => 20,
			'loop' => 'true',
			'nav' => 'true',
			'dots' => 'true',
			'autoplay' => 'true',
            
        ), $atts);
        $atts = array_merge($atts_extra,$atts);

        global $cms_carousel;
        
        wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.0.0b','all');
        wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.0.0b',true);
        wp_enqueue_script('owl-carousel-cms',get_template_directory_uri().'/assets/js/owl.carousel.cms.js',array('jquery'),'1.0.0',true);

            
        $html_id = cmsHtmlID('cms-client-carousel');
        $cms_carousel[$html_id] = array(
        	'margin' => $atts['margin'],
        	'loop' => $atts['loop'],
        	'mouseDrag' => 'true',
        	'nav' => $atts['nav'],
        	'dots' => $atts['dots'],
        	'autoplay' => $atts['autoplay'],
        	'autoplayTimeout' => 5000,
        	'smartSpeed' => 1000,
            //'animateOut' => 'fadeOut',
        	'autoplayHoverPause' => false,
        	'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
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
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']);
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}
?>