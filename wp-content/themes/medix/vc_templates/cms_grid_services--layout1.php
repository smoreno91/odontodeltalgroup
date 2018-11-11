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
<div class="cms-grid-services-wraper layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row cms-grid with_grid_dividers <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $delay= 100;
        while($posts->have_posts()){
            $posts->the_post();
            $meta_options = medix_get_meta_option();
            $icon_img = !empty($meta_options['icon_image']['url']) ? $meta_options['icon_image']['url'] : '';
            ?> 
            <div class="teaser text-center darklinks <?php echo esc_attr($atts['item_class']);?> to_animate wow fadeIn" data-wow-delay="<?php echo esc_attr($delay);?>ms" >
                <?php if(!empty($icon_img)):?>
            		<div class="teaser_icon">
            			<img src="<?php echo esc_url($icon_img);?>" alt=""/>
            		</div>
                <?php endif;?>
        		<h4 class="title"><?php echo esc_html(get_the_title())?></h4>
        		<p><?php echo !empty($word_number) ? medix_grid_limit_words(get_the_excerpt(), $word_number) : get_the_excerpt(); ?></p>
        		<a href="<?php the_permalink();?>" class="small-text"><?php echo esc_html__('Read more','medix');?></a>
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
 