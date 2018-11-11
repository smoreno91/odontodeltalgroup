<?php
vc_map(array(
    "name"        => 'Cms Events',
    "base"        => "cms_events",
    "icon"        => "cs_icon_for_vc",
    "category"    =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "params" => array(
         
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'medix' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'medix' ),
        ), 
         
    )
));
class WPBakeryShortCode_cms_events extends CmsShortCode
{
    protected function content($atts, $content = null){
        global $wp_query,$post;
		  
        $html_id = cmsHtmlID('cms-events');
        
        if (get_query_var('paged')){ 
        	$paged = get_query_var('paged'); 
        }
	    elseif(get_query_var('page')){ 
	    	$paged = get_query_var('page'); 
	    }
	    else{ 
	    	$paged = 1; 
	    } 
        
        $args = array(
          'post_status'=>'publish',
          'post_type'=> 'tribe_events',
          'posts_per_page'=>10,
          //order by startdate from newest to oldest
          'meta_key'=>'_EventStartDate',
          'orderby'=>'_EventStartDate',
          'order'=>'DESC',
          //required in 3.x
          'eventDisplay'=>'custom',
        );
 
        $wp_query = new WP_Query( $args );
        if($paged > 1){
	    	$args['paged'] = $paged;
	    	$wp_query = new WP_Query($args);
	    }  
        /* get posts */
        $atts['posts'] = $wp_query;
         
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
    }
  
}
 

?>