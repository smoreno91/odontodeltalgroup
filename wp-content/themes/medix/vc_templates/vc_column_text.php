<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */

$el_class = $css = $css_animation = $list_style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter.' '.$list_style, $this->settings['base'], $atts );

$style = '';
if(!empty($font_size) || !empty($line_height) || !empty($color)){
    $style .= ' style="';
        if(!empty($font_size)){
            if(strpos($font_size,'px') == false) $font_size.='px';
            $style .= 'font-size:'.$font_size.';';
        } 
        if(!empty($line_height)){
            if(strpos($line_height,'px') == false) $line_height.='px';
            $style .= 'line-height:'.$line_height.';'; 
        } 
        if(!empty($color)){
            $style .= 'color:'.$color.';'; 
        } 
    $style .= '"';
}

$output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper"'.$style.'>
			' . wpb_js_remove_wpautop( $content, true ) . '
		</div>
	</div>
';

echo $output;
  
 