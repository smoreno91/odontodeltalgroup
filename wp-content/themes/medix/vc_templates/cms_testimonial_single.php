<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-testimonial-single',vc_shortcode_custom_css_class( $css ));
     
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
 
    $image_url = '';
    if (!empty($atts['author_avatar'])) {
        $attachment_image = wp_get_attachment_image_src($atts['author_avatar'], 'full');
        $image_url = $attachment_image[0];
    }else{
        $image_url = esc_url(get_template_directory_uri().'/assets/images/teaser/no-image-thumbnail.jpg');
    }
     
    ?>
    <div class="<?php echo esc_attr($css_class);?>">
        <blockquote class="blockquote-big text-center">
            <img src="<?php echo esc_url($image_url);?>" alt=""/>
            <?php 
            if(!empty($atts['text'])):
                echo esc_html($atts['text']);    
            endif; 
            ?>
			<div class="item-meta">
                <?php 
                if(!empty($atts['author_name'])):
                    echo  '<h4>'. esc_html($atts['author_name']).'</h4>';    
                endif; 
                ?>
                 <?php 
                if(!empty($atts['author_position'])):
                    echo '<p>'.esc_html($atts['author_position']).'</p>';    
                endif; 
                ?>
			</div>
		</blockquote> 
    </div>
 
 
             
 
