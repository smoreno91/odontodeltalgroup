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
    
    $classes=array('cms-gallery-category');
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }     
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
   
    $overlap_cls = ( isset($atts['overlapped_nav']) && $atts['overlapped_nav']=='true')? 'overlapped-owl-nav' : '';
    $center_cls = ( isset($atts['center']) && $atts['center']=='true')? 'center-scale' : '';
    $image_size = !empty($atts['image_size']) ? $atts['image_size'] : 'full';
  
?>

<div class="cms-gallery-carousel">
    <?php if( isset($atts['enable_filter']) && $atts['enable_filter']=='1'){?>
    <div class="filters carousel_filters text-center">
        <a href="#" data-filter="*" class="selected"><?php echo esc_html__('All','medix'); ?></a>
        <?php 
        if(is_array($atts['categories']))
        foreach($atts['categories'] as $category):?>
            <?php $term = get_term( $category, $taxo );?>
            <a href="#" data-filter=".<?php echo esc_attr($term->slug);?>"><?php echo esc_html($term->name);?></a>
        <?php endforeach;?>
    </div>
    <?php }?>
    <div class="cms-carousel owl-carousel filterable-carousel <?php echo esc_attr($center_cls);?> <?php echo esc_attr($overlap_cls);?>" id="<?php echo esc_attr($atts['html_id']);?>" data-filters=".carousel_filters">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = $category->slug;
            }
            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)):
                $class = ' has-thumbnail';
                $thumbnail = get_the_post_thumbnail(get_the_ID(),$image_size);
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                $image_url = esc_url($image[0]);
            else:
                $class = ' no-image';
                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
            endif;
              
            ?>
            <div class="carousel-item vertical-item <?php echo implode(' ', $groups);?>">
        		<div class="item-media">
        			<?php echo $thumbnail;?>
        			<div class="media-links">
        				<div class="links-wrap">
        					<a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
        				</div>
        			</div>
        		</div>
        	</div>
             
            <?php
        }
        ?>
    </div>
</div>
