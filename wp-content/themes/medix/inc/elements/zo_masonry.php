<?php
vc_map(
	array(
		"name" => esc_html__("ZO Masonry", 'medix'),
	    "base" => "zo_masonry",
	    "class" => "vc-zo-masonry",
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
                    "Disable" => 0,
	            	"Enable" => 1
	            ),
	            "group" => esc_html__("Grid Settings", 'medix')
	        ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Grid item margin",'medix'),
                "param_name" => "margin",
                "value" => 0,
                "group" => esc_html__("Grid Settings", 'medix')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Aspect ratio",'medix'),
                "description" => esc_html__("The ratio of width to height",'medix'),
                "param_name" => "ratio",
                "value" => 0.5,
                "group" => esc_html__("Grid Settings", 'medix')
            ),
	        array(
	            "type" => "textfield",
	            "heading" => esc_html__("Extra Class",'medix'),
	            "param_name" => "class",
	            "value" => "",
	            "group" => esc_html__("Template", 'medix')
	        ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__("Show more", 'medix'),
                'param_name' => 'show_patination',
                'value' => array(
                    'Yes' => true
                ),
                'std' => false,
                "group" => esc_html__("Template", 'medix'),
            ), 
             array(
                'type' => 'checkbox',
                'heading' => esc_html__("Filter align center", 'medix'),
                'param_name' => 'filter_align_center',
                'value' => array(
                    'Yes' => true
                ),
                'std' => true,
                "group" => esc_html__("Template", 'medix'),
            ), 
	    	array(
	            "type" => "cms_template",
	            "param_name" => "cms_template",
	            "shortcode" => "zo_masonry",
	            "admin_label" => true,
	            "heading" => esc_html__("Shortcode Template",'medix'),
	            "group" => esc_html__("Template", 'medix'),
	        )
	    )
	)
);
//Masonry settings global
$zo_masonry = array();
class WPBakeryShortCode_zo_masonry extends CmsShortCode{
	protected function content($atts, $content = null){
	   global $wp_query,$post;
        //media script
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );
        
        wp_register_script('medix-modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array('jquery'));
    	wp_register_script('medix-waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'));
    	wp_register_script('medix-imagesloaded', get_template_directory_uri() . '/assets/js/jquery.imagesloaded.js', array('jquery'));
    	wp_register_script('medix-jquery-shuffle', get_template_directory_uri() . '/assets/js/jquery.shuffle.js', array('jquery','medix-modernizr','medix-imagesloaded'));
    	wp_register_script('medix-zo-jquery-shuffle', get_template_directory_uri() . '/assets/js/jquery.shuffle.zo.js', array('medix-jquery-shuffle'));
        wp_register_script('medix-zo-masonry', get_template_directory_uri() . '/assets/js/zo.masonry.js', array('medix-jquery-shuffle', 'jquery-ui-resizable'));
        wp_register_script('medix-zo-masonry-admin', get_template_directory_uri() . '/assets/js/zo.masonry.admin.js', array('medix-zo-masonry'));
        wp_enqueue_style('medix-zo-plugin-stylesheet', get_template_directory_uri() . '/assets/css/zo-style.css');
	    wp_register_style('medix-zo-jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.2.0');
     
        $html_id = cmsHtmlID('zo-masonry');
        $source = isset($atts['source']) ? $atts['source'] : 'size:10|order_by:date|post_type:gallery';
        if (get_query_var('paged')){ 
        	$paged = get_query_var('paged'); 
        }
	    elseif(get_query_var('page')){ 
	    	$paged = get_query_var('page'); 
	    }
	    else{ 
	    	$paged = 1; 
	    } 
        list($args, $wp_query) = vc_build_loop_query($source);
        
        if( (strpos($source,'tax_query') == false) && (strpos($source,'post_type:gallery') == true )){
            $terms = get_terms('gallery_category');
            $tx_category = array(); 
            foreach ($terms as $txcat){
                if ($txcat->parent != 0) {
                    $tx_category[] = $txcat->term_id;
                }
            }
            
           $sources = explode('|',$source);
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
       // move term item to cat
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
     
        if($paged > 1){
            $args['paged'] = $paged;
            $wp_query = new WP_Query($args);
        }
        $atts['limit'] = isset($args['posts_per_page'])?$args['posts_per_page']:12;
        $atts['posts'] = $wp_query;

        $grid = shortcode_atts(array(
            'col_lg' => 4,
            'col_md' => 3,
            'col_sm' => 2,
            'col_xs' => 1,
            'layout' => 'basic',
            'margin' => 0,
            'ratio' => 0.5
        ), $atts);

        $atts['item_class'] = "zo-masonry-item";

        $class = isset($atts['class'])?$atts['class']:'';
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']). ' '. $class;
        $atts['post_id'] = get_the_ID();
        $atts['html_id'] = $html_id;
        //Masonry Settings
        global $zo_masonry;
        $zo_masonry[$html_id] = array(
            'post_id' => get_the_ID(),
            'grid_margin' => (int)$atts['margin'],
            'grid_ratio' => (float)$atts['ratio'],
            'grid_cols_xs' => (int)$grid['col_xs'],
            'grid_cols_sm' => (int)$grid['col_sm'],
            'grid_cols_md' => (int)$grid['col_md'],
            'grid_cols_lg' => (int)$grid['col_lg'],
        );

        wp_localize_script('medix-zo-masonry', "zoMasonry", $zo_masonry);
        wp_enqueue_script('medix-zo-masonry');
         
        if( current_user_can( 'manage_options' )  ) {  
            wp_enqueue_script('jquery-ui-resizable');
            wp_enqueue_style('medix-zo-jquery-ui');
            wp_enqueue_script('medix-zo-masonry-admin');
            wp_localize_script( 'medix-zo-masonry-admin', 'my_ajax_object',array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
            
        }
		return parent::content($atts, $content);
	}
}
 

if( !function_exists('zo_masonry_callback') ) {
    /**
     * Masonry Callback Function
     * Using for save item size
     */
    function zo_masonry_callback()
    {

        $postID = $_POST['pid'];
        $id = str_replace('-', '_', $_POST['id']);
        $item = $_POST['item'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $data = json_encode(array(
            'item' => $item,
            'width' => $width,
            'height' => $height
        ));
        $result = get_post_meta($postID, '_zo_masonry_' . $id . $item, true);
        if ($result == '') {
            delete_post_meta($postID, '_zo_masonry_' . $id . $item);
            add_post_meta($postID, '_zo_masonry_' . $id . $item, $data);
        } else {
            update_post_meta($postID, '_zo_masonry_' . $id . $item, $data);
        }
        die();
    }
}
add_action('wp_ajax_zo_masonry_save', 'zo_masonry_callback');


if( !function_exists('zo_masonry_size') ) {
    /**
     * Get Masonry Item size
     *
     * @return array(width,height)
     */
    function zo_masonry_size($postID, $id, $item) {
        $id = str_replace('-', '_', $id);
        $result = get_post_meta($postID , '_zo_masonry_' . $id  . $item, true);
        if( $result ) {
            return json_decode($result, true);
        }
        return array(
            'width' => 1,
            'height' => 1
        );
    }
}
