<?php
    $classes=array('fancyboxe-single');
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
 
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    
    $icon_name = $iconClass = $a_href = $a_title = $a_target = $image_url = $link = '';
    $icon_name = "icon_" . $atts['icon_type'];
    $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
    
    $link = (isset($atts['link'])) ? $atts['link'] : '';
    $link = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href = $link['url'];
        $a_title = !empty($link['title'])?$link['title']: esc_html__('Read More','medix');
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
     
    if (!empty($atts['image'])) {
        $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
        $image_url = $attachment_image[0];
    }
            
    $fancy_style = ( !empty($atts['fancy_style']) ) ? $atts['fancy_style'] : 'style-0';
     
    ?>
    <div class="cms-fancyboxes-wraper  <?php echo esc_attr($css_class);?> <?php echo esc_attr($atts['template']);?> clearfix" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    switch ($fancy_style) {
        case 'style-1': 
        $background_color_style = !empty($atts['background_color']) ? 'style="background-color:'.$atts['background_color'].';"' : '';
        $top_overlap_cls = (isset($atts['top_overlap']) && $atts['top_overlap']=='1') ? 'top-overlap' : '';
        ?>
            <div class="cms-fancybox-item fancy-style1 <?php echo !empty($atts['background_color']) ? 'cs' : '';?> <?php echo esc_attr($top_overlap_cls);?>" <?php echo $background_color_style;?>>
                <div class="style1-wrap">
                    <?php if (!empty($iconClass)) : ?>
                        <div class="fancy-icon">
                            <i class="<?php echo esc_attr($iconClass);?> background-icon"></i>
                        </div>
                    <?php endif; ?>
                    <?php  
                    if(!empty($atts['title_item']) || !empty($atts['title_thin']) ){ 
                        echo '<h4 class="fancy-title">';
                            if(!empty($atts['title_thin']))
                                echo '<span class="thin small">'.$atts['title_thin'].'</span>'; echo '<br>';
                            if(!empty($atts['title_item']))
                                echo $atts['title_item'];
                        echo '</h4>';
                    } 
                    
                    if(!empty($atts['description_item']))
                        echo '<p>'.$atts['description_item'].'</p>';
                    if($use_link)
                        echo '<a class="small-text" href="'.$a_href.'" target="'.$a_target.'">'.$a_title.'</a>';
                    ?>
                </div>
            </div>     
        <?php
        break;
        case 'style-2': 
        $background_color_style = !empty($atts['background_color']) ? 'style="background-color:'.$atts['background_color'].';"' : '';
        $top_overlap_cls = (isset($atts['top_overlap']) && $atts['top_overlap']=='1') ? 'top-overlap' : '';
        $top_background_color_style = !empty($atts['top_background_color']) ? 'style="background-color:'.$atts['top_background_color'].';"' : ''; 
        ?>
            <div class="cms-fancybox-item fancy-style2 main_bg_color text-center <?php echo esc_attr($top_overlap_cls);?>" <?php echo $background_color_style;?>>
                <?php  
                if(!empty($atts['title_item']) || !empty($atts['title_thin']) ){ 
                    echo '<h4 class="fancy-title" '.$top_background_color_style.'>';
                        if(!empty($atts['title_thin']))
                            echo '<span class="thin small">'.$atts['title_thin'].'</span>'; echo '<br>';
                        if(!empty($atts['title_item']))
                            echo $atts['title_item'];
                    echo '</h4>';
                } 
                if(!empty($atts['description_item']))
                    echo '<div class="with_padding">'.apply_filters('the_content',$atts['description_item']).'</div>';
                if($use_link)
                    echo '<div class="action small-text"><a href="'.$a_href.'" target="'.$a_target.'">'.$a_title.'</a></div>';
                ?>
            </div>     
        <?php
        break;
        case 'style-3': 
        ?>
            <div class="cms-fancybox-item fancy-style3">
                <div class="cms-teaser media text-left">
                    <?php if (!empty($iconClass)) : ?>
        				<div class="media-left media-middle">
        					<div class="teaser_icon size_big round">
        						<i class="<?php echo esc_attr($iconClass);?>"></i>
        					</div>
        				</div>
                    <?php endif; ?>
                    <?php
                    if(!empty($atts['title_item']) || !empty($atts['title_thin']) ){ 
                        echo '<div class="media-body media-middle">';
                            if(!empty($atts['title_thin']))
                                echo '<p class="title1">'.esc_html($atts['title_thin']).'</p>';
                            if(!empty($atts['title_item']))
                                echo '<p class="title2">'.esc_html($atts['title_item']).'</p>';
                        echo '</div>';
                    } 
                    if(!empty($atts['description_item']))
                        echo '<p>'.apply_filters('the_content',$atts['description_item']).'</p>';
                    ?>
    		      </div>
            </div>     
        <?php
        break;
        default:
            ?>
            <div class="cms-fancybox-item fancy-style-default">
                <?php if (!empty($iconClass)) : ?>
                    <div class="fancy-icon">
                        <i class="<?php echo esc_attr($iconClass);?>"></i>
                    </div>
                <?php endif; ?>
                <?php if (!empty($atts['image'])) : ?>
                    <img src="<?php echo esc_url($image_url);?>" alt="" class="img-responsive"/>
                <?php endif; ?>
                <div class="fancy-content">
                     <?php if($atts['title_item']):?>
                        <h3 class="fancy-title">
                            <?php echo apply_filters('the_title',$atts['title_item']);?>
                        </h3>
                    <?php endif;?>
                    
                    <?php if($atts['description_item']): ?>
                        <div class="fancy-description">
                            <?php echo apply_filters('the_content',$atts['description_item']);?>
                        </div>
                    <?php endif; ?>
                    
                </div>
                <?php if($use_link):?>
                    <a class="readmore" href="<?php echo $a_href;?>" target="<?php echo $a_target;?>"><?php echo $a_title;?></a>
                <?php endif;?>
            </div>
            <?php
                break;
        }
        ?>
    </div>