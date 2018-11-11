<?php

add_action( 'widgets_init', create_function( '', "register_widget( 'Gallery_Post_Widget' );" ) );

class Gallery_Post_Widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'gallery_post',esc_html__( 'Gallery Posts', 'medix' ),array('description' => esc_html__( 'Gallery Posts Widget.', 'medix' )) 
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Gallery Posts', 'medix' ) : $instance['title'], $instance, $this->id_base);
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
            global $cms_carousel;
        	wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.0.0b','all');
            wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.0.0b',true);
            wp_enqueue_script('owl-carousel-cms',get_template_directory_uri().'/assets/js/owl.carousel.cms.js',array('jquery'),'1.0.0',true);
            $cms_carousel['gallery-post-carousel'] = array(
        	    'loop' => 'true',
        	    'mouseDrag' => 'true',
        	    'nav' => 'true',
        	    'dots' => 'false',
        	    'margin' => '0',
        	    'autoplay' => 'auto',
                'animateOut' => 'fadeOut',
        	    'autoplayTimeout' => 2000,
        	    'smartSpeed' => 1500,
        	    'autoplayHoverPause' => 'false',
        	    'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
        	    'responsive' => array(
        	        0 => array(
        	        "items" => 1,
        	        ),
        	        480 => array(
        	            "items" => 1,
        	        ),
        	        992 => array(
        	            "items" => 1,
        	        ),
                    1200 => array(
        	            "items" => 1,
        	        ),
        	    )
        	);
            wp_localize_script('owl-carousel-cms', "cmscarousel", $cms_carousel);
	       
            ?>
                <div class="gallery-post-carousel">
                    <div class="cms-carousel owl-carousel" id="gallery-post-carousel">
                        <?php 
                        while ($wp_query->have_posts()): $wp_query->the_post(); 
                        $archive_year  = get_the_time('Y'); 
                        $archive_month = get_the_time('m'); 
                        $archive_day   = get_the_time('d');
                        ?>
                            <?php if ( has_post_thumbnail() ){
                            $thumbnail = get_the_post_thumbnail(get_the_ID(),'large');
                            }else{
                                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                            } 
                            ?>
                            
                            <div class="vertical-item">
								<div class="item-media">
									<?php echo $thumbnail;?>
								</div>
								<div class="item-content">
									<h4 class="entry-title"><a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<p class="item-meta greylinks">
										<span><?php echo esc_html__('By','medix');?>
											<a href="#"><?php the_author_posts_link(); ?></a> 
                                            <?php if ($show_date) { ?>
                                                <a class="entry-date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
                                            <?php }?>
                                        </span>
									</p>
                                    <?php if ($show_decs) { ?>
                                        <div class="description"><?php echo medix_grid_limit_words( strip_tags( get_the_excerpt() ),10); ?></div>
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