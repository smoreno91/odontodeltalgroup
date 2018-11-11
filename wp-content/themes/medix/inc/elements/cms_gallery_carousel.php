<?php
vc_map(array(
    "name" => 'Cms Gallery Carousel',
    "base" => "cms_gallery_carousel",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
        array(
            "type" => "loop",
            "heading" => __("Source",'medix'),
            "param_name" => "source",
            'settings' => array(
                'size' => array('hidden' => false, 'value' => 10),
                'order_by' => array('value' => 'date')
            ),
            "group" => esc_html__("Source Settings", 'medix'),
        ),
         
        array(
            'type'              => 'dropdown',
            'heading'           => esc_html__('XSmall Devices','medix'),
            'param_name'        => 'xsmall_items',
            'edit_field_class'  => 'vc_col-sm-3 vc_carousel_item',
            'value'             => array(1,2,3,4,5,6),
            'std'               => 1,
            'group'             => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'              => 'dropdown',
            'heading'           => esc_html__('Small Devices','medix'),
            'param_name'        => 'small_items',
            'edit_field_class'  => 'vc_col-sm-3 vc_carousel_item',
            'value'             => array(1,2,3,4,5,6),
            'std'               => 1,
            'group'             => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'              => 'dropdown',
            'heading'           => esc_html__('Medium Devices','medix'),
            'param_name'        => 'medium_items',
            'edit_field_class'  => 'vc_col-sm-3 vc_carousel_item',
            'value'             => array(1,2,3,4,5,6,7,8),
            'std'               => 1,
            'group'             => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'              => 'dropdown',
            'heading'           => esc_html__('Large Devices','medix'),
            'param_name'        => 'large_items',
            'edit_field_class'  => 'vc_col-sm-3 vc_carousel_item',
            'value'             => array(1,2,3,4,5,6,7,8),
            'std'               => 1,
            'group'             => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Margin Items','medix'),
            'param_name'    => 'margin',
            'value'         => '30',
            'group'         => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'          => 'checkbox',
            'heading'       => esc_html__('Loop Items','medix'),
            'param_name'    => 'loop',
            'std'           => 'false',
            'group'         => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'          => 'checkbox',
            'heading'       => esc_html__('Show Next/Preview','medix'),
            'param_name'    => 'nav',
            'std'           => 'true',
            'group'         => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'          => 'checkbox',
            'heading'       => esc_html__('Show Dots','medix'),
            'param_name'    => 'dots',
            'std'           => 'false',
            'group'         => esc_html__('Carousel Settings', 'medix')
        ),
        array(
            'type'          => 'checkbox',
            'heading'       => esc_html__('Auto Play','medix'),
            'param_name'    => 'autoplay',
            'std'           => 'true',
            'group'         => esc_html__('Carousel Settings', 'medix')
        ),
        
        array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Image size', 'medix' ),
			'value' => array(
                esc_html__( 'Full', 'medix' ) => 'full',
				esc_html__( 'Thumbnail', 'medix' ) => 'thumbnail',
                esc_html__( 'Medium', 'medix' ) => 'medium',
				esc_html__( 'Large', 'medix' ) => 'large',
			),
			'param_name' => 'image_size',
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
				'description' => esc_html__( 'Select icon library.', 'medix' ),
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
				'description' => esc_html__( 'Select icon library.', 'medix' ),
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
                'type'          => 'checkbox',
                'heading'       => esc_html__('Enable filter','medix'),
                'param_name'    => 'enable_filter',
                'value' => array(
                    'Yes' => true
                ),
                'std'           => true,
                'group'         => esc_html__('Other Settings', 'medix')
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Center','medix'),
                'param_name'    => 'center',
                'group'         => esc_html__('Other Settings', 'medix')
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Overlapped nav','medix'),
                'param_name'    => 'overlapped_nav',
                'group'         => esc_html__('Other Settings', 'medix')
            ),
    )
));

global $cms_carousel;
$cms_carousel = array();
  
class WPBakeryShortCode_cms_gallery_carousel extends CmsShortCode
{
    protected function content($atts, $content = null){
        global $wp_query,$post;
		$atts_extra = shortcode_atts(array(
            'source' => '',
            'col_lg' => 4,
            'col_md' => 3,
            'col_sm' => 2,
            'col_xs' => 1,
            'not__in'=> 'false', 
            'xsmall_items'          => 1,
            'small_items'           => 1,
            'medium_items'          => 1,
            'large_items'           => 1,
            'margin'                => 30,
            'loop'                  => 'false',
            'nav'                   => 'true',
            'dots'                  => 'false',
            'autoplay'              => 'true',
            'center'                => 'false',
            'overlapped_nav'        => 'false',
            'image_size'            => 'full',
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
			'left_arrow' =>  '<span class="prev">'.esc_html__('Prev','medix').'</span>',  
			'right_arrow' => '<span class="next">'.esc_html__('Next','medix').'</span>', 
        ), $atts);
           
		$atts = array_merge($atts_extra, $atts);
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
    	$r_iconClass = empty($atts[$r_icon_name])? $atts['right_arrow'] : '<i class="'.$atts[$r_icon_name].'"></i>';
    	$l_icon_name = "l_icon_" . $atts['l_icon_type'];
    	$l_iconClass = empty($atts[$l_icon_name])? $atts['left_arrow'] : '<i class="'.$atts[$l_icon_name].'"></i>'; 
        
        wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.2.1','all');
        wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.2.1',true); 
        wp_enqueue_script('owl-carousel-cms',get_template_directory_uri().'/assets/js/owl.carousel.cms.js',array('jquery'),'1.0.0',true);
         
        $source = $atts['source'];
         
        if(isset($atts['not__in']) && $atts['not__in']){  
	    	list($args, $wp_query) = vc_build_loop_query($source, get_the_ID());
	    }else{ 
        	list($args, $wp_query) = vc_build_loop_query($source);
        }
        
        if( (strpos($atts['source'],'tax_query') == false) && (strpos($atts['source'],'post_type:gallery') == true )){
            $terms = get_terms('gallery_category');
            $tx_category = array(); 
            foreach ($terms as $txcat){
                if ($txcat->parent != 0) {
                    $tx_category[] = $txcat->term_id;
                }
            }
            
           $sources = explode('|',$atts['source']);
           $str_size = $sources[0];
           $sizes = explode(':',$sources[0]);
           if( ((int)$sizes[1]) > 0) $size = $sizes['1'];
           else $size = -1;
           
            $args = array(
                'posts_per_page' => $size,
                'post_type' => 'gallery',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'gallery_category',
                        'field' => 'id',
                        'terms' => $tx_category,
                        'operator' => 'NOT IN'
                    ),
                )
            );
            
            $wp_query = new WP_Query( $args );
             
        } 
          
        $args['cat_tmp'] = isset($args['cat'])?$args['cat']:'';
        // if select term on custom post type, move term item to cat.
        if(strstr($source, 'tax_query')){
        	$source_a = explode('|', $source);
        	foreach ($source_a as $key => $value) {
        		$tmp = explode(':', $value);
        		if($tmp[0] == 'tax_query'){
        			$args['cat_tmp'] = $tmp[1];
        		}
        	}
        }
	    $atts['cat'] = isset($args['cat_tmp'])?$args['cat_tmp']:''; 
        /* get posts */
        $atts['posts'] = $wp_query;
        
        $html_id = cmsHtmlID('cms-gallery-carousel');
        
        $atts['autoplaytimeout'] = isset($atts['autoplaytimeout'])?(int)$atts['autoplaytimeout']:5000;
        $atts['smartspeed'] = isset($atts['smartspeed'])?(int)$atts['smartspeed']:1000;
         
        $cms_carousel[$html_id] = array(
        	'margin' => $atts['margin'],
        	'loop' => $atts['loop'],
        	'mouseDrag' => 'true',
        	'nav' => $atts['nav'],
        	'dots' => $atts['dots'],
        	'autoplay' => $atts['autoplay'],
        	'autoplayTimeout' => $atts['autoplaytimeout'],
        	'smartSpeed' => $atts['smartspeed'],
        	'autoplayHoverPause' => 'true',
        	'navText' => array($l_iconClass,$r_iconClass),
        	'dotscontainer' => $html_id.' .cms-dots',
            'center'    => $atts['center'],
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
         
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
    }
     
}
 


?>