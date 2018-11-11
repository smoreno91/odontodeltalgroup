<?php
vc_map(array(
    "name" => 'Cms Team',
    "base" => "cms_team",
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
            "type" => "dropdown",
            "heading" => esc_html__("Layout", 'medix'),
            "param_name" => "layout",
            "value" => array(
                "Default" => "",
                "Layout 1" => "layout1",
            ),
            "std"=>"",
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns XS Devices",'medix'),
            "param_name" => "col_xs",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,6,12),
            "std" => 1,
            "group" => esc_html__("Grid Settings", 'medix')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns SM Devices",'medix'),
            "param_name" => "col_sm",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,6,12),
            "std" => 2,
            "group" => esc_html__("Grid Settings", 'medix')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns MD Devices",'medix'),
            "param_name" => "col_md",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,6,12),
            "std" => 3,
            "group" => esc_html__("Grid Settings", 'medix')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Columns LG Devices",'medix'),
            "param_name" => "col_lg",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(1,2,3,4,6,12),
            "std" => 4,
            "group" => esc_html__("Grid Settings", 'medix')
        ),
           
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        ),
    )
));
class WPBakeryShortCode_cms_team extends CmsShortCode
{
    protected function content($atts, $content = null){
        global $wp_query,$post;
		$atts_extra = shortcode_atts(array(
            'source' => '',
            'col_lg' => 4,
            'col_md' => 3,
            'col_sm' => 2,
            'col_xs' => 1,
            'layout' => '',
            'not__in'=> 'false', 
        ), $atts);
		$atts = array_merge($atts_extra, $atts);
 
        $html_id = cmsHtmlID('cms-team');
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
	     
        /* get posts */
        $atts['posts'] = $wp_query;
        
        
        $col_lg = 12 / $atts['col_lg'];
        $col_md = 12 / $atts['col_md'];
        $col_sm = 12 / $atts['col_sm'];
        $col_xs = 12 / $atts['col_xs'];
        $atts['item_class'] = "cms-team-item col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
         
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
    }
  
}
 

?>