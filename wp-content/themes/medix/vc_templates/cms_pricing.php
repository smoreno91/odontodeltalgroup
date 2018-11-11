<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-pricing',vc_shortcode_custom_css_class( $css ));
    $link = (isset($atts['link'])) ? $atts['link'] : '';
    $link = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href = $link['url'];
        $a_title = !empty($link['title']) ? $link['title'] : '' ;
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    $features = (array) vc_param_group_parse_atts($features );  
?>


<?php 
if($layout == 'layout1'){ 
    $image_url = '';
    if (!empty($atts['image'])) {
        $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
        $image_url = $attachment_image[0];
    }else{
        $image_url = esc_url(get_template_directory_uri().'/assets/images/teaser/teaser01.jpg');
    }
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout1 text-center" style="background-image: url('<?php echo esc_url($image_url);?>');">
        <div class="bg_overlay" style="background: <?php echo !empty($background_overlay)? $background_overlay : 'rgba(1, 178, 183, 0.85)';?>;"></div>
        <?php if(!empty($title)){ 
            $title_color = !empty($title_color)? $title_color : '#102035';
			echo '<div class="plan-name"><h3 style="color:'.$title_color.';">'. esc_html($title).'</h3></div>';
        }
        ?>
        <?php if(!empty($price)): ?>
        <div class="plan-price">
            <?php if(!empty($unit)) echo '<span class="small">'.$unit.'</span> ';?>
			<?php 
		     $prices = explode('.',$price);
             echo '<span>'.$prices[0].'</span> ';
             if(!empty($prices[1])) 
             echo '<span class="small">.'.$prices[1].'</span> ';
            ?>
            <?php if(!empty($sub_title)) echo '<p>'.$sub_title.'</p>';?>
		</div>
        <?php endif;?>
        <?php if(!empty($features)): ?>
        <div class="features-list">
			<ul>
                <?php foreach($features as $feature): ?>
                    <?php if(!empty($feature['feature_name'])): ?>
                        <li class="<?php echo ( isset($feature['removed']) && $feature['removed'] =='1' ) ? 'disabled' : 'enabled';?>"><?php echo esc_attr($feature['feature_name'] ); ?></li> 
    			     <?php endif; ?>
                <?php endforeach; ?>
			</ul>
		</div>
        <?php endif; ?>
        <?php if($use_link){?>
        <div class="call-to-action">
			<a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo !empty($a_title) ? esc_html($a_title): esc_html__('Sign Up Now','medix');?></a>
        </div>
        <?php }?>
	</div>
<?php } ?>
<?php 
if($layout == 'layout2'){ 
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout2 text-center">
        <?php if(!empty($title)){ 
			echo '<div class="plan-name"><h3>'. esc_html($title).'</h3></div>';
        }
        ?>
        <?php if(!empty($price)): ?>
        <div class="plan-price">
            <?php if(!empty($unit)) echo '<span class="small">'.$unit.'</span> ';?>
			<?php 
		     $prices = explode('.',$price);
             echo '<span>'.$prices[0].'</span> ';
             if(!empty($prices[1])) 
             echo '<span class="small">.'.$prices[1].'</span> ';
            ?>
            <?php if(!empty($sub_title)) echo '<p>'.$sub_title.'</p>';?>
		</div>
        <?php endif;?>
        <?php if(!empty($features)): ?>
        <div class="features-list">
			<ul>
                <?php foreach($features as $feature): ?>
                    <?php if(!empty($feature['feature_name'])): ?>
                        <li class="<?php echo ( isset($feature['removed']) && $feature['removed'] == '1' ) ? 'disabled' : 'enabled';?>"><?php echo esc_attr($feature['feature_name'] ); ?></li> 
    			     <?php endif; ?>
                <?php endforeach; ?>
			</ul>
		</div>
        <?php endif; ?>
        <?php if($use_link){?>
        <div class="call-to-action">
			<a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo !empty($a_title) ? esc_html($a_title): esc_html__('Sign Up Now','medix');?></a>
        </div>
        <?php }?>
	</div>
<?php } ?>
<?php 
if($layout == 'layout3'){ 
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout3 text-center <?php echo ( isset($is_center) && $is_center =='1' ) ? 'centered' : '';?>">
        <?php 
        if(!empty($price)): 
        $price_color = !empty($price_color)? $price_color : '#102035';
        ?>
        <div class="plan-price" style="color:<?php echo esc_attr($price_color);?>;">
            <?php if(!empty($unit)) echo '<span class="small">'.$unit.'</span> ';?>
			<?php 
		     $prices = explode('.',$price);
             echo '<span>'.$prices[0].'</span> ';
             if(!empty($prices[1])) 
             echo '<span class="small">.'.$prices[1].'</span> ';
            ?>
            <?php if(!empty($sub_title)) echo '<p>'.$sub_title.'</p>';?>
		</div>
        <?php endif;?>
        <?php if(!empty($features)): ?>
        <div class="features-list">
			<ul>
                <?php foreach($features as $feature): ?>
                    <?php if(!empty($feature['feature_name'])): ?>
                        <li><?php echo esc_attr($feature['feature_name'] ); ?></li> 
    			     <?php endif; ?>
                <?php endforeach; ?>
			</ul>
		</div>
        <?php endif; ?>
        <?php if($use_link){?>
        <div class="call-to-action">
			<a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo !empty($a_title) ? esc_html($a_title): esc_html__('Sign Up Now','medix');?></a>
        </div>
        <?php }?>
	</div>
<?php } ?>
 
 
             
 
