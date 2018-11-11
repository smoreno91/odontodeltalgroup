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
    $btn_bg_color_cls = !empty($atts['btn_bg_color']) ? $atts['btn_bg_color'] : 'bgprimary';
?>
<div class="cms-grid-wraper blog-grid3 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" && $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter">
            <ul class="cms-filter-category list-unstyled list-inline">
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
    <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $delay= 100;
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            
            $post_format= get_post_format();
            ?>
            <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?> to_animate wow fadeIn" data-wow-delay="<?php echo esc_attr($delay);?>ms" data-groups='[<?php echo implode(',', $groups);?>]'>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="side-item content-padding">
                    <div class="row">
                    <?php
                    switch($post_format){
                        case 'audio':
                    ?>   
                        <div class="col-xs-4 col-xxs-12">
                            <?php medix_post_audio(); ?> 
                        </div>
                        <div class="col-xs-8 col-xxs-12">
                            <div class="item-content">
                            	<header class="entry-header">
                            		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header> 
                             
                            	<div class="entry-content">
                            		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                            	</div> 
                            </div>
                        </div>
                    <?php break; case 'video': ?>
                        <div class="col-xs-4 col-xxs-12">
                            <div class="entry-video">
                                <?php medix_post_video(); ?>
                            </div>
                        </div>
                        <div class="col-xs-8 col-xxs-12">
                            <div class="item-content">
                            	<header class="entry-header">
                            		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header> 
                             
                            	<div class="entry-content">
                            		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                            	</div> 
                                
                            </div>
                        </div>
                    <?php break; case 'gallery': ?>
                        <div class="col-xs-4 col-xxs-12">
                            <?php medix_post_gallery(); ?>
                        </div>
                        <div class="col-xs-8 col-xxs-12">
                            <div class="item-content">
                            	<header class="entry-header">
                            		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header> 
                             
                            	<div class="entry-content">
                            		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                            	</div> 
                                
                            </div>
                        </div>
                    <?php break; case 'status': ?>
                        <?php
                        $style ='';
                        if(has_post_thumbnail()){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $image_url = esc_url($image[0]);
                            $style = 'style="background-image:url('.$image_url.'); background-size: cover;"';
                        }
                        ?>
                        <div class="item-content" <?php echo $style;?>>
                        	<div class="entry-inner">
                                <?php medix_post_status(); ?>
                            	<header class="entry-header">
                                    <div class="status-links"><a href="<?php echo esc_url( get_permalink() ); ?>" title=""><?php echo get_post_format();?></a></div>
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header>
                                <?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            </div> 
                        </div>
                    <?php break; case 'link': ?>
                        <div class="item-content">
                        	<div class="entry-inner">
                                <header class="entry-header">
                            		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header> 
                             
                            	<div class="entry-content">
                            		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                            	</div> 
                            </div> 
                        </div>     
                    <?php break; case 'quote': ?>
                        <?php
                        $style ='';
                        if(has_post_thumbnail()){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $image_url = esc_url($image[0]);
                            $style = 'style="background-image:url('.$image_url.'); background-size: cover;"';
                        }
                        ?>
                        <div class="item-content" <?php echo $style;?>>
                        	<div class="entry-inner">
                            	<header class="entry-header">
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header> 
                                <?php medix_post_quote(); ?>
                            </div>
                        </div>
                        
                    <?php break; default: ?>
                        <div class="col-xs-4 col-xxs-12">
                            <a href="<?php the_permalink();?>" title="<?php the_title()?>">
                            <?php medix_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                        <div class="col-xs-8 col-xxs-12">
                            <div class="item-content">
                            	<header class="entry-header">
                            		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            		<div class="entry-meta">
                            			<?php echo get_the_date(); ?>
                            		</div> 
                            	</header> 
                             
                            	<div class="entry-content">
                            		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                            	</div> 
                                 
                            </div>
                        </div>
                    <?php break; } ?>
                    
                    <?php 
                    if(isset($atts['show_social_sharing']) && $atts['show_social_sharing'])
                        medix_footer_share();
                    ?> 
                    </div>
                    </div>
                </article>
                
            </div>
            <?php
            $delay += 150;
        }
        ?>
    </div>
    <?php 
    if(isset($atts['show_read_more']) && $atts['show_read_more'])
        echo '<div class="loadmore text-center"><div class="cms_pagination grid-loadmore '.esc_attr($btn_bg_color_cls).'"></div></div>';
    if(isset($atts['show_patination']) && $atts['show_patination'])
        medix_paging_nav();
     
    ?>
</div>