<?php
/**
 * Widget API: Social_media class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Text widget.
 *
 * @since 2.8.0
 *
 * @see Cms_Widget
 */
add_action( 'widgets_init', create_function( '', "register_widget( 'Social_media' );" ) );
class Social_media extends WP_Widget {

	/**
	 * Sets up a new Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'social_media',
			'description' => esc_html__( 'Arbitrary text or HTML.','medix' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'social_media', esc_html__( 'Social media','medix' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content for the current Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Text widget instance.
	 */
	public function widget( $args, $instance ) {
        extract($args);
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";
 
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
        // no 'class' attribute - add one with the value of width
        if( strpos($args['before_widget'], 'class') === false ) {
            $args['before_widget'] = str_replace('>', 'class="'. $extra_class . '"', $args['before_widget']);
        }
        // there is 'class' attribute - append width value to it
        else {
            $args['before_widget'] = str_replace('class="', 'class="'. $extra_class . ' ', $args['before_widget']);
        }
        
        $social_position = $instance['social_position'];
        $social_type = $instance['social_type'];
        $social_round = (int) $instance['social_round'] == 1 ? 'round' : '';
        $social_layout = $instance['social_layout'];
         
        if($social_layout == 'layout1'){
            medix_social_from_themeoption($social_position,$social_type,$social_round);
        }
        if($social_layout == 'layout2'){
            medix_social_from_themeoption_layout2($social_position,$social_type,$social_round);
        }
		echo $args['after_widget'];
	}
 

	/**
	 * Outputs the Text widget settings form.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $social_position = isset( $instance['social_position'] ) ? esc_attr( $instance['social_position'] ) : 'header';
        $social_type = isset( $instance['social_type'] ) ? esc_attr( $instance['social_type'] ) : 'color-bg-icon';
        $social_round = isset($instance['social_round']) ? esc_attr($instance['social_round']) : '';
        $social_layout = isset($instance['social_layout']) ? esc_attr($instance['social_layout']) : 'layout1';
         
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','medix'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'social_position' )); ?>"><?php echo esc_html__( 'Position', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'social_position' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'social_position' )); ?>">
			<option value="header_top" <?php echo $social_position=='header_top' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('From Header Top Setting', 'medix'); ?></option>
			<option value="header" <?php echo $social_position=='header' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('From Header Setting', 'medix'); ?></option>
            <option value="footer_top_layout1" <?php echo $social_position=='footer_top_layout1' ? 'selected="selected"' : '' ; ?>><?php echo esc_html__('From Footer Top Layout 1', 'medix');?></option>
			<option value="footer_top_layout3" <?php echo $social_position=='footer_top_layout3' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('From Footer Top Layout 3', 'medix'); ?></option>
            <option value="footer_bottom_layout4" <?php echo $social_position=='footer_bottom_layout4' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('From Footer Bottom Layout 4', 'medix'); ?></option>
		</select></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'social_type' )); ?>"><?php echo esc_html__( 'Type', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'social_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'social_type' )); ?>">
			<option value="color-bg-icon" <?php echo $social_type=='color-bg-icon' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('Color background icon', 'medix'); ?></option>
			<option value="color-icon bg-icon" <?php echo $social_type=='color-icon bg-icon' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('Color icon and background icon', 'medix'); ?></option>
            <option value="color-icon" <?php echo $social_type=='color-icon' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('Color icon', 'medix');?></option>
		</select></p>
          
        <p><label for="<?php echo esc_attr($this->get_field_id( 'social_round' )); ?>"><?php echo esc_html__( 'Social round', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'social_round' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'social_round' )); ?>">
			<option value="1"><?php echo esc_html__( 'Yes', 'medix' ); ?></option>
			<option value="0"<?php echo (!$social_round) ? ' selected="selected"' : ''; ?>><?php echo esc_html__( 'No', 'medix' ); ?></option>
		</select></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'social_layout' )); ?>"><?php echo esc_html__( 'Type', 'medix' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'social_layout' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'social_layout' )); ?>">
			<option value="layout1" <?php echo $social_layout=='layout1' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('Layout 1 (Default)', 'medix'); ?></option>
			<option value="layout2" <?php echo $social_layout=='layout2' ? 'selected="selected"' : '' ; ?> ><?php echo esc_html__('Layout 2 (vertical with title)', 'medix'); ?></option>
		</select></p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>"><?php echo esc_html__( 'Extra Class', 'medix' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
		<?php
	}
}
