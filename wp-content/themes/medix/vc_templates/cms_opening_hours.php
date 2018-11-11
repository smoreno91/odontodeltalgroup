<?php 
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes=array('cms-opening-hours');
if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$style = !empty($atts['style']) ? $atts['style'] : 'default';

?>
<div class="list1 <?php echo esc_attr($css_class);?> <?php echo esc_attr($style);?>">
    <ul class="list1 no-bullets">
        <?php if(!empty($atts['mon_fri'])): ?>
            <li class="content-justify">
                <span class="medium"><?php echo esc_html__('Monday – Friday','medix')?></span>
                <span><?php echo esc_html($atts['mon_fri']);?></span>
            </li>
        <?php endif; ?>
        <?php if(!empty($atts['set'])): ?>
        <li class="content-justify">
            <span class="medium"><?php echo esc_html__('Saturday','medix')?></span>
            <span><?php echo esc_html($atts['set']);?></span>
        </li>
        <?php endif; ?>
        <?php if(!empty($atts['sun'])): ?>
        <li class="content-justify">
            <span class="medium"><?php echo esc_html__('Sunday','medix')?></span>
            <span><?php echo esc_html($atts['sun']);?></span>
        </li>
        <?php endif; ?>
    </ul>
    
</div>
