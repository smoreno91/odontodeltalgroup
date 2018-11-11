<?php

extract( $atts );
 
$css_class = '';
$classes=array('cms-client-wrap');
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$client = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $client['values'] );

?>
<div class="<?php echo esc_attr($css_class); ?>">
    <div class="cms-carousel owl-carousel" id="<?php echo esc_attr($atts['html_id']);?>">
        <?php
            foreach($values as $value){
                $image_url = '';
                if (!empty($value['image'])) {
                    $attachment_image = wp_get_attachment_image_src($value['image'], 'full');
                    $image_url = $attachment_image[0];
                } 
                $link = (isset($value['link'])) ? $value['link'] : '#';
                $link = vc_build_link( $link );
                $use_link = false;
                if ( strlen( $link['url'] ) > 0 ) {
                    $use_link = true;
                    $a_href = $link['url'];
                    $a_title = !empty($link['title'])?$link['title']: '';
                    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                }
                ?>
                <div class="client-logo text-center">
                    <?php if($use_link):?>
                        <a href="<?php echo esc_url($a_href);?>" title="<?php echo esc_attr($a_title);?>" target="<?php echo esc_attr($a_target);?>">
                            <?php if(!empty($image_url)):?>
                            <img src="<?php echo esc_url($image_url);?>" alt="" class="img-responsive"/>
                            <?php endif; ?> 
                        </a>
                    <?php else: ?>
                        <?php if(!empty($image_url)):?>
                        <img src="<?php echo esc_url($image_url);?>" alt="" class="img-responsive"/>
                        <?php endif; ?> 
                    <?php endif; ?> 
                    
                </div>
                
                <?php
            }
        ?>
    </div>
</div>
