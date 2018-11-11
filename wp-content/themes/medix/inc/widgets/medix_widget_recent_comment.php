<?php

add_action( 'widgets_init', create_function( '', "register_widget( 'Medix_Widget_Recent_Comment' );" ) );
class Medix_Widget_Recent_Comment extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'Medix recent comment', 'medix' )
		);
		parent::__construct( 'medix_recent_comment', esc_html__( 'Medix - Recent Comment', 'medix' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( empty( $instance['number'] ) || !$number = absint( $instance['number'] ) ) {
			$number = 10;
		}
		$args = array();
		$args['post_type'] = empty( $instance['post_type'] ) ? '' : $instance['post_type'];
		$args['status'] = 'approve';
		$args['number'] = $number;
		$comments = get_comments($args);
		if ( !empty($comments) ){
			echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			echo '<ul>';
			foreach( $comments as $comment ){ ?>
				<li>
					<div class="avatar pull-left"><?php echo get_avatar( $comment->comment_author_email ) ?></div>
					<div class="comment_info media-body">
						<p class="author"><?php echo esc_html($comment->comment_author); ?></p>
						<p class="comment_content"><?php echo wp_trim_words( $comment->comment_content, $num_words = 5, $more = '...' ) ?></p>
						<p class="on_post"><?php echo esc_html__('on', 'medix') ?> <a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>"><?php echo get_the_title($comment->comment_post_ID) ?></a></p>
					</div>
                     
				</li>
			<?php }
			echo '</ul>';
			echo $after_widget;
		}
		
	}
	// widget options
	function form( $instance ){
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
		$post_type = isset( $instance['post_type'] ) ? esc_attr( $instance['post_type'] ) : '';
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'medix' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo esc_html__( 'Number of post to show:', 'medix' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'post_type' )); ?>"><?php echo esc_html__( 'Type of list:', 'medix' ); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'post_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_type' )); ?>">
				<option value=""><?php echo esc_html__('All', 'medix' ) ?></option>
				<option value="product" <?php echo ($post_type == 'product') ? 'selected="selected"': ''; ?>><?php echo esc_html__('Products', 'medix' ) ?></option>
				<option value="post" <?php echo ($post_type == 'post') ? 'selected="selected"': ''; ?>><?php echo esc_html__('Post', 'medix' ) ?></option>
			</select>
		</p>
		
		<?php
	}
}