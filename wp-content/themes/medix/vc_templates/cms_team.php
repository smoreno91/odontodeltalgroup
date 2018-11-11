<?php 
     
    /* get categories */
    $taxo = 'category';
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
    
    $classes=array('cms-team');
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }     
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
?>
<?php if($atts['layout'] == 'layout1'){?>
<div class="cms-grid-team <?php echo esc_attr($css_class);?> layout1" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row cms-grid">
        <?php
        $posts = $atts['posts'];
        $delay= 150;
        while($posts->have_posts()){
            $posts->the_post();
            $title = get_the_title();
            $titles = explode(' ',$title); 
            $title2 = $title;
            if(count($titles) > 1){
                $title1 = '<span class="thin">'.$titles[0].'</span><br/>';
                $title2 = $titles[1];
            }
            ?>
            <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?> wow fadeIn" data-wow-delay="<?php echo esc_attr($delay);?>ms">
                <div class="team-item-wrap text-center" onclick="">
                    <?php 
                        if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false)):
                            $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail');
                        else:
                            $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                        endif;
                        echo '';
                    ?>
                    <div class="team-meta">
                        <div class="item-media">
						  <?php echo $thumbnail; ?>
                        </div>
						<div class="item-content">
                            <div class="display_table">
                                <div class="display_table_cell">
                                    <h4>
                                        <a href="<?php the_permalink();?>"><?php echo $title1;?><?php echo $title2;?></a>
        							</h4>
                                    <?php medix_team_meta_layout1(); ?> 
                                </div>
                            </div>
						</div>
					</div>
                </div>
            </div>
            <?php
            $delay += 150;
        }
        ?>
    </div>
</div>
<?php }else{?>
<div class="cms-grid-team <?php echo esc_attr($css_class);?> default" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row cms-grid">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
             
            ?>
             <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?>">
                <div class="port-item-wrap">
                    <?php 
                        if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false)):
                            $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail');
                        else:
                            $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                        endif;
                        echo '';
                    ?>
                    <div class="team-meta">
						<?php echo $thumbnail; ?>
						<div class="caption">
							<h3>
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
							</h3>
                            <?php medix_team_meta(); ?> 
						</div>
					</div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php }?>