<?php

add_action( 'widgets_init', create_function( '', "register_widget( 'ListServices' );" ) );

class ListServices extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'list_services',esc_html__( 'List of services', 'medix' ),array('description' => esc_html__( 'List of services widget.', 'medix' )) 
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Our Services', 'medix' ) : $instance['title'], $instance, $this->id_base);
        $number = (int) $instance['number'];

        echo $before_widget;

        if($title) {
            echo $before_title.$title.$after_title;
        }

        $args = array(
            'posts_per_page' => $number,
            'post_type' => 'services',
            'post_status' => 'publish',
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
                <div class="cms-services-list">
                    <ul class="list2 triangle-bullet">
                        <?php 
                        while ($wp_query->have_posts()): $wp_query->the_post(); 
                        ?>
                            <li>
                                <a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li> 
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php 
             wp_reset_postdata(); 
            } else { ?>
                <span class="notfound">No post found!</span>
            <?php
            }
            echo $after_widget;
            wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['extra_class'] = $new_instance['extra_class'];

        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
                     $number = 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'medix' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
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