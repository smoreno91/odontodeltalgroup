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
<div class="cms-grid-services-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = 'thumbnail';
        $delay= 150;
        while($posts->have_posts()){
            $posts->the_post();
            $meta_options = medix_get_meta_option();
            $icon_img = !empty($meta_options['icon_image']['url']) ? $meta_options['icon_image']['url'] : '';
            $titles = explode(' ', get_the_title());
            $first  = $titles[0];
            $rest   = ltrim(get_the_title(), $first.' ');
            ?>
            <div class="teaser text-center <?php echo esc_attr($atts['item_class']);?> wow fadeIn" data-wow-delay="<?php echo esc_attr($delay);?>ms" >
                <?php if(!empty($icon_img)):?>
				<div class="teaser_icon">
					<img src="<?php echo esc_url($icon_img);?>" alt=""/>
				</div>
                <?php endif;?>
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
			</div>
            <?php
            $delay += 150;
        }
        ?>
    </div>
    <?php
    if(isset($atts['show_patination']) && $atts['show_patination'])
        medix_paging_nav();
    ?>
</div>