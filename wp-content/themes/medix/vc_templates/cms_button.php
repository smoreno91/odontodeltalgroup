<?php 
$size = $align = $link = $title = $default_is_dark = $button_block = $el_class = $add_icon = $i_align = $css = $a_href = $a_title = $a_target = $icon_name ='';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
}

$wrapper_classes = array(
	'cms-btn',
    $this->getExtraClass( $el_class ),
    'text-' . $align,
);  
$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$default_is_dark_class = (isset($default_is_dark) && $default_is_dark)?'is-dark':'';
$button_classes = array(
    'btn',
    $btn_type,
    $default_is_dark_class,
	$size,
);

$button_html = $title;

if ( '' === trim( $title ) ) {
	$button_classes[] = '';
	$button_html = '<span>&nbsp;</span>';
}
if ( 'true' === $button_block && 'inline' !== $align ) {
	$button_classes[] = 'btn-block';
}

if ( isset($add_icon) && $add_icon == '1' ) {
	$button_classes[] = 'btn-icon-' . $i_align;
    $icon_name = "icon_" . $atts['icon_type'];
    $icon_class = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
     
	$icon_html = '<i class="btn-icon ' . esc_attr( $icon_class ) . '"></i>';
 
	if ( 'left' === $i_align ) {
		$button_html = $icon_html . ' ' . $button_html;
	} else {
		$button_html .= ' ' . $icon_html;
	}
}

$attributes[] = 'style=""';

if ( $button_classes ) {
	$button_classes = esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $button_classes ) ), $this->settings['base'], $atts ) );
	$attributes[] = 'class="' . trim( $button_classes ) . '"';
}

if ( $use_link ) {
	$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
	$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	if ( ! empty( $a_target ) ) {
		$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
	}
}
$attributes = implode( ' ', $attributes );
?> <div class="<?php echo trim( esc_attr( $css_class ) ) ?>"> 
<?php if ( $use_link ) {
		echo '<a ' . $attributes . '>' . $button_html . '</a>';
} else {
	echo '<button ' . $attributes . '>' . $button_html . '</button>';
} ?> </div>