<?php
vc_map(array(
    "name" => 'CMS Department 2',
    "base" => "cms_department2",
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
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        )
    )
));
class WPBakeryShortCode_cms_department2 extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        global $wp_query,$post;
		$atts_extra = shortcode_atts(array(
            'source' => '',
            'not__in'=> 'false', 
        ), $atts);
		$atts = array_merge($atts_extra, $atts);
 
        $html_id = cmsHtmlID('cms-department2');
        
        wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.2.1','all');
        wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.2.1',true); 
        wp_enqueue_script('owl-carousel-department',get_template_directory_uri().'/assets/js/owl.carousel.department.js',array('jquery'),'1.0',true); 
        
        $source = $atts['source'];
        if(isset($atts['not__in']) && $atts['not__in']){
	    	list($args, $wp_query) = vc_build_loop_query($source, get_the_ID());
	    }
        else{
        	list($args, $wp_query) = vc_build_loop_query($source);
        }
        //default categories selected
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
        $atts['posts'] = $wp_query->posts;;
         
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
    }
}