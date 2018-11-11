<?php 
    /* get categories */
        $taxo = 'gallery_category';
        $_category = array();
        if(!isset($atts['cat']) || $atts['cat']==''){
            $args = [
                'taxonomy'     => $taxo,
                'parent'        => 0,
                'hide_empty'    => true           
            ];
            $terms = get_terms($args);
            foreach ($terms as $cat){
                $_category[] = $cat->term_id;
            }
             
        } else {
            $_category  = explode(',', $atts['cat']);
        }
        $atts['categories'] = $_category;
        $word_number = !empty($atts['word_number']) ? $atts['word_number'] : '18';
        if(isset($atts['show_read_more']) && $atts['show_read_more']):  
            wp_register_script( 'cms-loadmore-js', get_template_directory_uri().'/assets/js/cms_loadmore.js', array('jquery') ,'1.0',true);
            // What page are we on? And what is the pages limit?
            global $wp_query;
            $max = $wp_query->max_num_pages;
            $limit = $atts['limit'];
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
            // Add some parameters for the JS.
            $current_id =  str_replace('-','_',$atts['html_id']);
            wp_localize_script(
                'cms-loadmore-js',
                'cms_more_obj'.$current_id,
                array(
                    'startPage' => $paged,
                    'maxPages' => $max,
                    'total' => $wp_query->found_posts,
                    'perpage' => $limit,
                    'nextLink' => next_posts($max, false),
                    'masonry' => $atts['layout']
                )
            );
            wp_enqueue_script( 'cms-loadmore-js' ); 
        endif;
        $btn_bg_color_cls = !empty($atts['btn_bg_color']) ? $atts['btn_bg_color'] : ''; 
        $gallery_layout_cls = !empty($atts['gallery_layout']) ? $atts['gallery_layout'] : 'default';
?>
<div class="cms-grid-wraper cms-grid-gallery cms-gallerys <?php echo esc_attr($gallery_layout_cls);?> <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter">
            <ul class="cms-filter-category list-unstyled list-inline <?php echo (!empty($atts['filter_align_center']) && $atts['filter_align_center']) ? 'text-center' : ''; ?>">
                <li><a class="active" href="#" data-group="all"><?php echo esc_html('All'); ?></a></li>
                <?php 
                if(is_array($atts['categories']))
                foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_html($term->name);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <?php if($gallery_layout_cls=='default'):?>
    <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = 'large';
        
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="gallery-item mutted-hover text-center" onclick="">
                    <?php 
                        if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                            $class = ' has-thumbnail';
                            $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $image_url = esc_url($image[0]);
                        else:
                            $class = ' no-image';
                            $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                            $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
                        endif;
                    ?>
					<div class="item-media">
						<div class="cms-grid-media <?php echo esc_attr($class);?>"><?php echo $thumbnail;?></div>
						<div class="media-links">
							<div class="links-wrap">
                                <a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
								<a class="p-link" title="" href="<?php the_permalink();?>"></a>
							</div>
						</div>
					</div>
					<div class="item-content">
						<h4 class="item-meta">
							<a class="port-link" href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
						</h4>
					</div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php endif;?>
    
    <?php if($gallery_layout_cls=='layout1'):?>
        <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
            <?php
            $posts = $atts['posts'];
            $size = 'large';
            while($posts->have_posts()){
                $posts->the_post();
                $groups = array();
                $groups[] = '"all"';
                foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                    $groups[] = '"category-'.$category->slug.'"';
                }
                ?>
                <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                    <div class="gallery-item mutted-hover text-center" onclick="">
                        <?php 
                            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                                $class = ' has-thumbnail';
                                $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                $image_url = esc_url($image[0]);
                            else:
                                $class = ' no-image';
                                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                                $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
                            endif;
                        ?>
    					<div class="item-media">
    						<div class="cms-grid-media <?php echo esc_attr($class);?>"><?php echo $thumbnail;?></div>
    						<div class="media-links">
    							<div class="links-wrap">
                                    <a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
    							</div>
    						</div>
    					</div>
                    </div>
                    <div class="item-title text-center">
    					<span class="categories-links">
                            <?php echo get_the_term_list( get_the_ID(), 'gallery_category', '', ' / ', '' ); ?>
    					</span>
    					<h3>
    						<a class="port-link" href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
    					</h3>
    				</div>
                </div>
                <?php
            }
            ?>
        </div>
    <?php endif;?>
    
    <?php if($gallery_layout_cls=='layout2'):?>
        <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
            <?php
            $posts = $atts['posts'];
            $size = 'large';
            while($posts->have_posts()){
                $posts->the_post();
                $groups = array();
                $groups[] = '"all"';
                foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                    $groups[] = '"category-'.$category->slug.'"';
                }
                ?>
                <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                    <div class="gallery-item mutted-hover text-center" onclick="">
                        <?php 
                            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                                $class = ' has-thumbnail';
                                $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                $image_url = esc_url($image[0]);
                            else:
                                $class = ' no-image';
                                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                                $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
                            endif;
                        ?>
    					<div class="item-media">
    						<div class="cms-grid-media <?php echo esc_attr($class);?>"><?php echo $thumbnail;?></div>
    						<div class="media-links">
    							<div class="links-wrap">
                                    <a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
    							</div>
    						</div>
    					</div>
                    </div>
                    <div class="item-content text-center">
                        <h4 class="item-title highlight">
							<a href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
						</h4>
    					<span class="categories-links small-text">
                            <?php echo get_the_term_list( get_the_ID(), 'gallery_category', '', ' / ', '' ); ?>
    					</span>
    					<div class="gal-desc">
                    		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                    	</div>  
    				</div>
                </div>
                <?php
            }
            ?>
        </div>
    <?php endif;?>
    <?php
    if(isset($atts['show_read_more']) && $atts['show_read_more'])
        echo '<div class="loadmore text-center"><div class="cms_pagination grid-loadmore '.esc_attr($btn_bg_color_cls).'"></div></div>';
    if(isset($atts['show_patination']) && $atts['show_patination'])
        medix_paging_nav();
    ?>
</div>