<?php 
     
    /* get categories */
    $taxo = 'tribe_events_cat';
    $_category = array();
    if(!isset($atts['cat']) || $atts['cat']==''){
        $terms = get_terms($taxo);
        foreach ($terms as $cat){
            $_category[] = $cat->term_id;
        }
    } else {
        $_category  = explode(',', $atts['cat']);
    }
    $atts['categories'] = $_category;
    
    $classes=array('cms-events');
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }     
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
?>
 
<div class="<?php echo esc_attr($css_class);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
             
            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false)):
                $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail');
            else:
                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg').'" alt="'.get_the_title().'" />';
            endif;
             
            ?>
            <div class="event-item">
                <div class="row">
                    <div class="col-md-6">
                        <div class="item-media">
                            <a href="<?php the_permalink();?>"><?php echo $thumbnail; ?></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="item-content">
                            <h4 class="entry-title text-uppercase">
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
							</h4>

							<p class="item-meta greylinks">
								<i class="rt-icon2-calendar4 highlight"></i> <?php echo get_the_date(); ?>,
								<i class="rt-icon2-location2 highlight"></i> <?php echo tribe_get_venue(get_the_ID());?>
							</p>
							<?php the_excerpt()?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
       <?php medix_paging_nav(); ?>
</div>
 