<div class="cms-carousel owl-carousel cms-carousel-services <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        $titles = explode(' ', get_the_title());
        $first  = $titles[0];
        $rest   = ltrim(get_the_title(), $first.' ');
        ?>
        <div class="cms-carousel-item">
            <?php 
                if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)):
                    $class = ' has-thumbnail';
                    $thumbnail = get_the_post_thumbnail(get_the_ID(),'thumbnail');
                else:
                    $class = ' no-image';
                    $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg').'" alt="'.get_the_title().'" />';
                endif;
                
            ?>
            <div class="text-center vertical-item">
                <?php echo '<div class="service-media '.esc_attr($class).'">'.$thumbnail.'</div>'; ?>
                <?php echo '<h4 class="title">';
					echo '<a href="'.get_the_permalink().'">';
                        if(!empty($titles[0])) 
					       echo '<span class="thin">'.esc_html($titles[0]).'</span><br/>';
                        if(!empty($rest))
						  echo esc_html($rest);
				echo '</a></h4>';
				echo '<p>'. get_the_excerpt().'</p>';
                ?>
			</div>
            
        </div>
        <?php
    }
    ?>
</div>