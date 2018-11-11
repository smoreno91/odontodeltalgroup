<?php 
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes=array('cms-contact-block');
if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
$is_center = ( isset($atts['is_center']) && $atts['is_center'] =='1' ) ? 'text-center' : '';
$style = !empty($atts['style']) ? $atts['style'] : 'default';

$contacts = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $contacts['values'] );

?>
<div class="list1 <?php echo esc_attr($css_class);?> <?php echo esc_attr($is_center);?> <?php echo esc_attr($style);?> ">
    <ul>
     <?php foreach($values as $value){ ?>
    	<li>
            <?php if(!empty($value['icon_class'])) echo '<i class="'.$value['icon_class'].'"></i>';?>
            <?php if(!empty($value['title'])) echo esc_html($value['title']);?>
    	</li>	
        <?php }?>
    </ul>
</div>
 
