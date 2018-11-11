<?php 
    /* get categories */
        $taxo = 'services_category';
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
        $word_number = !empty($atts['word_number']) ? $atts['word_number'] : '';
?>
<div class="cms-grid-services-wraper layout2 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row cms-grid  <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $delay= 100;
        while($posts->have_posts()){
            $posts->the_post();
             
            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)):
                $class = ' has-thumbnail';
                $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail',array('class' => 'round'));
            else:
                $class = ' no-image';
                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg').'" alt="'.get_the_title().'" class="round"/>';
            endif;
             
            $titles = explode(' ', get_the_title());
            $first  = $titles[0];
            $rest   = ltrim(get_the_title(), $first.' ');
                    
            ?> 
            <div class="text-center <?php echo esc_attr($atts['item_class']);?> to_animate wow fadeIn" data-wow-delay="<?php echo esc_attr($delay);?>ms">
				<div class="cms-grid-media"><?php echo $thumbnail;?></div>
                <h4 class="title">
					<a href="<?php the_permalink();?>">
                        <?php if(!empty($titles[0])):?>
						<span class="thin"><?php echo esc_html($titles[0])?></span><br/>
                        <?php endif;?>
                        <?php if(!empty($rest)):?>
						<?php echo esc_html($rest)?>
                        <?php endif;?>
                    </a>
				</h4>
				<p><?php echo !empty($word_number) ? medix_grid_limit_words(get_the_excerpt(), $word_number) : get_the_excerpt(); ?></p>
                <a href="<?php the_permalink();?>" class="small-text"><?php echo esc_html__('Our Provider','medix');?></a>
			</div>
            <?php
            $delay += 100;
        }
        ?>
    </div>
    <?php
    if(isset($atts['show_patination']) && $atts['show_patination'])
        medix_paging_nav();
    ?>
</div>
 