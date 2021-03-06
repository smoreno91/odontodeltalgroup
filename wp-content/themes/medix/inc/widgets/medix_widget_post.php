<?php

add_action( 'widgets_init', create_function( '', "register_widget( 'Medix_Widget_Post' );" ) );

class Medix_Widget_Post extends WP_Widget {
    
    function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'Medix recent post', 'medix' )
		);
		parent::__construct( 'medix_recent_post', esc_html__( 'Medix - Recent Post', 'medix' ), $widget_ops );
	}
   

    function widget($args, $instance) {
        extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( empty( $instance['number_post'] ) || !$number = absint( $instance['number_post'] ) ) {
			$number = 10;
		}
		
		$showreadmore = isset( $instance['showreadmore'] ) ? absint( $instance['showreadmore'] ) : 1;
		$ordertype = isset( $instance['ordertype'] ) ? $instance['ordertype'] : 'recent';
		$showdate = isset( $instance['showdate'] ) ? absint( $instance['showdate'] ) : 1;
		$showimage = isset( $instance['showimage'] ) ? absint( $instance['showimage'] ) : 1;
		$showviews = isset( $instance['showviews'] ) ? absint( $instance['showviews'] ) : 1;
		
		if($ordertype == 'recent'){
            $args_sql = array(
                'posts_per_page' => $number,
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => 1
            );
		}else{
			$args_sql = array(
				'post_type' => 'post',
				'order'     => 'DESC',
				'posts_per_page' => $number,
				'post_status' => array('publish', 'future'),
				'orderby'   => 'meta_value_num',
				'meta_key' => 'post_views_count'
			);
		}
		$wp_query = new WP_Query($args_sql);
		 
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		if ($wp_query->have_posts()){ 
		echo '<ul>';
        while ($wp_query->have_posts()): $wp_query->the_post(); 
            $archive_year  = get_the_time('Y'); 
            $archive_month = get_the_time('m'); 
            $archive_day   = get_the_time('d');
            ?>
			<li>
				<?php 
                if($showimage){ 
                    if ( has_post_thumbnail() ){
                    $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail');
                    }else{
                        $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg').'" alt="'.get_the_title().'" />';
                    } 
                      
                ?>
                <div class="entry-thumbnail"> 
                    <a href="<?php the_permalink(); ?>" class="img"> 
                      <?php 
                        echo $thumbnail;
                      ?> 
                    </a> 
                </div>
				<?php } ?>
				<div class="post-info">
                    <h4>
						<a class="post-title" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
                    </h4>
                    <?php if($showdate || $showviews || $showreadmore ){ ?>
                    <div class="post-meta">
						<?php if($showdate){ ?>
                            <a class="entry-date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
						<?php } ?>
						<?php if($showviews){ ?>
							<?php $views = medix_get_post_viewed(get_the_ID()); ?>
							<span class="post-views"><i class="fa fa-eye"></i> <?php echo sprintf( _n( '%s (View)', '%s (Views)', $views, 'medix' ), $views ); ?></span>
						<?php } ?>
						<?php if($showreadmore){ ?>
							<a class="post-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read more', 'medix'); ?></a>
						<?php } ?>
                    </div>
                    <?php } ?>
				</div>
			</li>
		<?php endwhile; 
		echo '</ul>';
        }
		echo $after_widget;
		
		wp_reset_query(); 
    }
    function form( $instance ){
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$ordertype = isset( $instance['ordertype'] ) ? esc_attr( $instance['ordertype'] ) : '';
		$number = isset( $instance['number_post'] ) ? absint( $instance['number_post'] ) : 10;
		$showreadmore = isset( $instance['showreadmore'] ) ? absint( $instance['showreadmore'] ) : 1;
		$showdate = isset( $instance['showdate'] ) ? absint( $instance['showdate'] ) : 1;
		$showimage = isset( $instance['showimage'] ) ? absint( $instance['showimage'] ) : 1;
		$showviews = isset( $instance['showviews'] ) ? absint( $instance['showviews'] ) : 1;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'medix' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number_post' )); ?>"><?php echo esc_html__( 'Number of post to show:', 'medix' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number_post' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_post' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'ordertype' )); ?>"><?php echo esc_html__( 'Order type:', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'ordertype' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ordertype' )); ?>">
			<option value="recent"<?php echo ($ordertype == 'recent') ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'Recent first', 'medix' ); ?></option>
			<option value="popular"<?php echo ($ordertype == 'popular') ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'Popular first', 'medix' ); ?></option>
		</select></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'showreadmore' )); ?>"><?php echo esc_html__( 'Show readmore:', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'showreadmore' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'showreadmore' )); ?>">
			<option value="1"><?php echo esc_html__( 'Yes', 'medix' ); ?></option>
			<option value="0"<?php echo (!$showreadmore) ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'medix' ); ?></option>
		</select></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'showdate' )); ?>"><?php echo esc_html__( 'Show date:', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'showdate' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'showdate' )); ?>">
			<option value="1"><?php echo esc_html__( 'Yes', 'medix' ); ?></option>
			<option value="0"<?php echo (!$showdate) ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'medix' ); ?></option>
		</select></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'showimage' )); ?>"><?php echo esc_html__( 'Show image:', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'showimage' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'showimage' )); ?>">
			<option value="1"><?php echo esc_html__( 'Yes', 'medix' ); ?></option>
			<option value="0"<?php echo (!$showimage) ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'medix' ); ?></option>
		</select></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'showviews' )); ?>"><?php echo esc_html__( 'Show views:', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'showviews' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'showviews' )); ?>">
			<option value="1"><?php echo esc_html__( 'Yes', 'medix' ); ?></option>
			<option value="0"<?php echo (!$showviews) ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'medix' ); ?></option>
		</select></p>
		
		<?php
	}
}
?>