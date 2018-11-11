<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-title-header');
     
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
     
?>
<?php
    $style = ( !empty($atts['style']) ) ? $atts['style'] : 'style-0';
    $title1_color = ( !empty($atts['title1_color']) ) ? $atts['title1_color'] : '#102035';
    $title2_color = ( !empty($atts['title2_color']) ) ? $atts['title2_color'] : '#102035';
    
    $title1_line_height_att = '';
    if(!empty($atts['title1_line_height']))
        $title1_line_height_att = ' line-height:'.$atts['title1_line_height'].';';
        
    $title1_fontsize_att = '';
    if(!empty($atts['title1_fontsize'])){
        if(strpos($atts['title1_fontsize'],'px')==true)
        $title1_fontsize_att = ' font-size:'.$atts['title1_fontsize'].';';
        else
        $title1_fontsize_att = ' font-size:'.$atts['title1_fontsize'].'px;';
    } 
    
    $title2_fontsize_att = '';
    if(!empty($atts['title2_fontsize'])){
        if(strpos($atts['title2_fontsize'],'px')==true)
        $title2_fontsize_att = ' font-size:'.$atts['title2_fontsize'].';';
        else
        $title2_fontsize_att = ' font-size:'.$atts['title2_fontsize'].'px;';
    } 
    $title2_line_height_att = '';
    if(!empty($atts['title2_line_height']))
        $title2_line_height_att = ' line-height:'.$atts['title2_line_height'].';';
    
    $is_center = ( isset($atts['is_center']) && $atts['is_center'] =='1' ) ? 'text-center' : '';
    if(!empty($title1) || !empty($title2)): ?>
    <div class="<?php echo esc_attr($css_class);?> <?php echo esc_attr($style);?> <?php echo esc_attr($is_center);?>">
    <?php 
        switch ($style) {
        case 'style-1':
        ?> 
            <h4 class="module-header">
                <?php 
                if(!empty($title1)) 
                    echo '<span class="title1 big" style="color:'.esc_attr($title1_color).';'.esc_attr($title1_fontsize_att.$title1_line_height_att).';">'. esc_html($title1).'</span>';
                  if(!empty($title2)) 
                    echo '<span class="title2 thin" style="color:'.esc_attr($title2_color).';'.esc_attr($title2_fontsize_att.$title2_line_height_att).'">'. esc_html($title2).'</span>';
                ?>
            </h4>
        <?php
        break;
        default:
            ?>
            <h4 class="module-header">
                <?php if(!empty($title1)):?>
                	<span class="title1 thin" style="color:<?php echo esc_attr($title1_color);?>;<?php echo esc_attr($title1_fontsize_att.$title1_line_height_att);?>"><?php echo esc_html($title1);?></span>
                	<br/>
                <?php endif;?>
                <?php if(!empty($title2)):?>
            	   <span class="title2 big" style="color:<?php echo esc_attr($title2_color);?>;<?php echo esc_attr($title2_fontsize_att.$title2_line_height_att);?>"><?php echo esc_html($title2);?></span>
                <?php endif;?>
            </h4>  
        <?php
        break;
        }
        ?>
        </div>
    
    <?php endif; ?>
 
 
 
             
 
