<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-youtube');
    
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
     
    $link = (isset($atts['link'])) ? $atts['link'] : '';
    $link = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href = $link['url'];
        $a_title = !empty($link['title']) ? $link['title'] : 'Read more' ;
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    $background_icon = !empty($atts['background_icon']) ? $atts['background_icon'] : '';
?>
<?php if(!empty($atts['url'])):?>
<div class="<?php echo esc_attr($css_class);?>">
    <div class="embed-responsive embed-responsive-16by9">
		<a href="<?php echo esc_url($atts['url'])?>" class="embed-placeholder <?php echo esc_attr($background_icon);?>"></a>
        <?php if(!empty($atts['title']) || !empty($atts['sub_title'])):?>
		<div class="text-placeholder">
            <?php if(!empty($atts['title'])):?>
			<h3 class="text-uppercase">
                <?php if($use_link):?>    
				<a href="<?php echo esc_url($a_href);?>" target="<?php echo esc_attr($a_target);?>" title="<?php echo esc_attr($a_title);?>"><?php echo esc_html($atts['title']);?></a>
                <?php else:?>
                <?php echo esc_html($atts['title']);?>
                <?php endif; ?>
			</h3>
            <?php endif;?>
            <?php if(!empty($atts['sub_title'])):?>
			<p class="fontsize_20 text-uppercase thin">Presentation</p>
            <?php endif;?>
		</div>
        <?php endif;?>
	</div>
</div>
<?php endif; ?>
 