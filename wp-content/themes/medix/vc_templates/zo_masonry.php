<?php 
    /* get categories */
    $taxonomy = 'gallery_category';
    $_category = array();
    if(!isset($atts['cat']) || $atts['cat']==''){
        $args = [
            'taxonomy'     => $taxonomy,
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
    wp_enqueue_style( 'wp-mediaelement' );
    wp_enqueue_script( 'wp-mediaelement' );
     
    wp_register_script( 'cms-zo-loadmore-js', get_template_directory_uri().'/assets/js/cms_loadmore.js', array('jquery') ,'1.0',true);
    // What page are we on? And what is the pages limit?
    global $wp_query;
    $max = $wp_query->max_num_pages;
    $limit = $atts['limit'];
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    // Add some parameters for the JS.
    $current_id =  str_replace('-','_',$atts['html_id']);
    wp_localize_script(
        'cms-zo-loadmore-js',
        'cms_more_obj'.$current_id,
        array(
            'startPage' => $paged,
            'maxPages' => $max,
            'total' => $wp_query->found_posts,
            'perpage' => $limit,
            'nextLink' => next_posts($max, false),
            'masonry' => 'masonry',  
        )
    );
    wp_enqueue_script( 'cms-zo-loadmore-js' ); 
?>
<div class="cms-grid-wraper zo-masonry-wrapper cms-gallerys <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if( isset($atts['filter']) && $atts['filter'] == 1 ) :?>
        <div class="zo-masonry-filter">
            <ul class="zo-filter-category container list-unstyled list-inline <?php echo (!empty($atts['filter_align_center']) && $atts['filter_align_center']) ? 'text-center' : ''; ?>">
                <li><a class="active" href="#" data-group="all"><?php esc_html_e('ALL','medix')?></a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxonomy );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_attr($term->name);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="zo-masonry cms-grid-masonry">
        <?php
        $posts = $atts['posts'];
        $i = 0;
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxonomy) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            /**
             * Get Masonry Size
             * It's require, don't remove it
             * zo_masonry_size()
             */
            $size = zo_masonry_size($atts['post_id'] , $atts['html_id'], $i);
            
             $likes = get_post_meta(get_the_ID() , '_cms_post_likes', true);
            if(!$likes) $likes = 0;
            
            ?>
            <div class="zo-masonry-item cms-grid-item item-w<?php echo esc_attr($size['width']); ?> item-h<?php echo esc_attr($size['height']); ?>"
                     data-groups='[<?php echo implode(',', $groups);?>]' data-index="<?php echo esc_attr($i); ?>" data-id="<?php echo esc_attr($atts['post_id']); ?>" onclick="">
                <?php 
                    if(has_post_thumbnail()):
                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                        $thumbnail = $thumbnail[0];
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                        $image_url = esc_url($image[0]);
                    else:
                        $thumbnail = esc_url(get_template_directory_uri().'/assets/images/no-image.jpg');
                        $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image.jpg');
                    endif;

                ?>
                <div class="zo-masonry-inner" style="background-image: url('<?php echo esc_url($thumbnail); ?>')">
                    <div class="gallery-item mutted-hover text-center" onclick="">
                         
						<div class="media-links">
							<div class="links-wrap">
                                <a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
							</div>
						</div>
    					<div class="item-content">
    						<h4 class="item-meta">
    							<a class="port-link" href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
    						</h4>
    					</div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
    <?php if( !empty($atts['show_patination']) && $atts['show_patination']){?>
     
        <div class="cms_pagination grid-loadmore text-center"></div>
     
    <?php } ?>
</div>