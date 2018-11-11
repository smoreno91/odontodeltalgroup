<div class="cms-carousel owl-carousel cms-carousel-gallery <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        
        ?>
        <div class="cms-carousel-item">
            <?php 
                if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)):
                    $class = ' has-thumbnail';
                    $thumbnail = get_the_post_thumbnail(get_the_ID(),'large');
                else:
                    $class = ' no-image';
                    $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg').'" alt="'.get_the_title().'" />';
                endif;
                
            ?>
            <div class="gallery-item text-center">
                <div class="item-media">
    				<div class="cms-grid-media <?php echo esc_attr($class);?>"><?php echo $thumbnail;?></div>
    			</div>
                <div class="item-content text-center">
                    <h4 class="item-title highlight">
    					<a href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
    				</h4>
    				<span class="categories-links small-text">
                        <?php echo get_the_term_list( get_the_ID(), 'gallery_category', '', ' / ', '' ); ?>
    				</span>
    				<div class="gal-desc">
                		<?php echo medix_grid_limit_words(strip_tags(get_the_excerpt()),23);  ?>
                	</div>  
    			</div>
            </div>
        </div>
        <?php
    }
    ?>
</div>