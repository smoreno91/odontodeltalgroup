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
         
?>
<div class="cms-grid-wraper blog-grid <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
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
        $index = 1; 
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            
            $post_format= get_post_format();
            ?>
            <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?> fadeIn" data-groups='[<?php echo implode(',', $groups);?>]'>
                <article id="post-<?php the_ID(); ?>" <?php post_class('medix-events-loop'); ?>>
                    
                    <a href="<?php the_permalink();?>" title="<?php the_title()?>">
                    <?php medix_post_thumbnail(); ?>
                    </a>
                    <div class="entry-wrap">
                    	<header class="entry-header">
                    		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                    		<div class="entry-meta">
                    			<?php medix_archive_detail(); ?>
                    		</div> 
                    	</header> 
                     
                    	<div class="entry-content">
                    		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),$word_number);  ?>
                    	</div> 
                    </div>
                    
                </article>
                
            </div>
            <?php
            $index++;
        }
        ?>
    </div>
    <?php 
    
    if(isset($atts['show_patination']) && $atts['show_patination'])
        medix_paging_nav();
     
    ?>
</div>