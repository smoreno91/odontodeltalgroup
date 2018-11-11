<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-pie',vc_shortcode_custom_css_class( $css ));
     
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
     
    $percent = !empty($value) ? $value : 96;  
    $size = !empty($size) ? $size : 270;
    $line = !empty($line) ? $line : 20;
    $bgcolor = !empty($bgcolor) ? $bgcolor : '#f5f5f5'; 
    $trackcolor = !empty($trackcolor) ? $trackcolor : '#c14240';
    $speed = !empty($speed) ? $speed : 3000;
?>
<div class="<?php echo esc_attr($css_class);?>">
    <div class="text-center">
		<div class="chart" data-percent="<?php echo esc_attr($percent);?>" data-size="<?php echo esc_attr($size);?>" data-line="<?php echo esc_attr($line);?>" data-bgcolor="<?php echo esc_attr($bgcolor);?>" data-trackcolor="<?php echo esc_attr($trackcolor);?>" data-speed="<?php echo esc_attr($speed);?>">
			<span class="percent"></span>
            <?php 
            if(!empty($title)) echo '<h4>'.esc_html($title).'</h4>';
            ?>
		</div>
	</div>
</div>
 
 
             
 
