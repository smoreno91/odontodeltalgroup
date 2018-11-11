<?php
vc_map(
	array(
		"name" => esc_html__("CMS Grid", 'medix'),
	    "base" => "cms_grid",
	    "class" => "vc-cms-grid",
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
	            "heading" => esc_html__("Layout Type",'medix'),
	            "param_name" => "layout",
	            "value" => array(
	            	"Basic" => "basic",
	            	"Masonry" => "masonry",
	            	),
	            "group" => esc_html__("Grid Settings", 'medix')
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
	            "type" => "dropdown",
	            "heading" => esc_html__("Filter on Masonry",'medix'),
	            "param_name" => "filter",
	            "value" => array(
	            	"Enable" => "true",
	            	"Disable" => "false"
	            	),
	            "dependency" => array(
	            	"element" => "layout",
	            	"value" => "masonry"
	            	),
	            "group" => esc_html__("Grid Settings", 'medix')
	        ),
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
	            "shortcode" => "cms_grid",
	            "admin_label" => true,
	            "heading" => esc_html__("Shortcode Template",'medix'),
	            "group" => esc_html__("Template", 'medix'),
	        )
	    )
	)
);
class WPBakeryShortCode_cms_grid extends CmsShortCode{
	protected function content($atts, $content = null){
		global $wp_query,$post;
		$atts_extra = shortcode_atts(array(
            'source' => '',
            'col_lg' => 4,
            'col_md' => 3,
            'col_sm' => 2,
            'col_xs' => 1,
            'layout' => 'basic',
            'filter' => 'true',
            'not__in'=> 'false', 
            'cms_template' => 'cms_grid.php',
            'class' => '',
                ), $atts);
		$atts = array_merge($atts_extra, $atts);

		//media script
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );
		 
		wp_enqueue_script('cms-grid-pagination',get_template_directory_uri().'/assets/js/cmsgrid.pagination.js',array('jquery'),'1.0.0',true);
		 
        $html_id = cmsHtmlID('cms-grid');
        $source = $atts['source'];
        if (get_query_var('paged')){ 
        	$paged = get_query_var('paged'); 
        }
	    elseif(get_query_var('page')){ 
	    	$paged = get_query_var('page'); 
	    }
	    else{ 
	    	$paged = 1; 
	    }
        if(isset($atts['not__in']) && $atts['not__in']){
	    	list($args, $wp_query) = vc_build_loop_query($source, get_the_ID());
	    }
        else{
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
           if(intval($sizes[1]) > 0) $size = $sizes['1'];
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
	    if($paged > 1){
	    	$args['paged'] = $paged;
	    	$wp_query = new WP_Query($args);
	    }
        $atts['cat'] = isset($args['cat_tmp'])?$args['cat_tmp']:'';
        $atts['limit'] = isset($args['posts_per_page'])?$args['posts_per_page']:5;
        /* get posts */
        $atts['posts'] = $wp_query;
        
        
        $col_lg = 12 / $atts['col_lg'];
        $col_md = 12 / $atts['col_md'];
        $col_sm = 12 / $atts['col_sm'];
        $col_xs = 12 / $atts['col_xs'];
        $atts['item_class'] = "cms-grid-item col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
        $atts['grid_class'] = "cms-grid";
        $class = $atts['class'];
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']). ' '. $class;
        if ($atts['layout'] == 'masonry') {
            wp_enqueue_script('cms-jquery-shuffle');
            $atts['grid_class'] .= " cms-grid-{$atts['layout']}";
        }
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>