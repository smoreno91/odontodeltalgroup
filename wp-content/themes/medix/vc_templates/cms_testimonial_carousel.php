<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_cms_images_carousel
 */
/* get Shortcode custom value */
    extract(shortcode_atts(array(
        'layout_mode'   => '1',
        'color_mode'    => '',
        'nav_post'      => '',
        'nav'           => true,
        'dots'          => false,
        'dotdata'       => false
    ), $atts));


$testimonial = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $testimonial['values'] );
if(!isset($values[0]['text'])){
    echo '<p class="require required">'.esc_html__('Please add a testimonial text!','medix').'</p>';
    return;
}
$css_class = 'layout'.$layout_mode.' '.$color_mode;
$show_nav = $nav ? 'has-nav' : '';
$show_dots = $dots ? 'has-dots' : '';
$thumbnail = '';
?>
<div class="cms-testimonial-wrap <?php echo esc_attr($css_class); ?>">
    <div class="cms-carousel owl-carousel <?php echo esc_attr($show_nav.' '.$show_dots.' '.$nav_post.' '.$color_mode);?>" id="<?php echo esc_attr($atts['html_id']);?>">
        <?php
            switch ($layout_mode) {
                case '1': 
                    foreach($values as $value){
                        if(isset($value['text']) && !empty($value['text'])){
                            $image_url = '';
                            if (!empty($value['author_avatar'])) {
                                $attachment_image = wp_get_attachment_image_src($value['author_avatar'], 'thumbnail');
                                $image_url = $attachment_image[0];
                            } 
                             
                            ?>
                            <div class="item">
    							<div class="media">
                                    <?php
                                    if(!empty($image_url)){
                                        echo '<img src="'.esc_url($image_url).'" alt="" class="testi-avatar"/>';
                                    }
                                    ?>
    								 
    								<div class="media-body">
                                        <?php
                                        if(!empty($value['author_name'])){
                                            echo '<h4 class="author-name"> '.esc_attr($value['author_name']).'</h4>';
                                        }
                                        if(!empty($value['author_position'])){
                                            echo '<p class="position">'.esc_attr($value['author_position']).'</p>';
                                        }
                                        ?>
    								</div>
    							</div>
                                <?php 
                                if(!empty($value['text'])){
                                    echo '<p class="desc">'.esc_attr($value['text']).'</p>';
                                }
                                ?>
    							 
    						</div>
                        <?php
                        }
                         
                    }
                    break;
                case '2': 
                    foreach($values as $value){
                        if(isset($value['text']) && !empty($value['text'])){ 
                            $image_url = '';
                            if (!empty($value['author_avatar'])) {
                                $attachment_image = wp_get_attachment_image_src($value['author_avatar'], 'thumbnail');
                                $image_url = $attachment_image[0];
                            }else{
                                $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
                            }
                        ?>
                            <blockquote class="blockquote-big text-center">
                                <?php
                                if(!empty($image_url)){
                                    echo '<img src="'.esc_url($image_url).'" alt=""/>';
                                }
                                ?>
                                <?php echo esc_html($value['text']);?>
                    			<div class="item-meta">
                                    <?php 
                                    if(!empty($value['author_name'])):
                                        echo  '<h4>'. esc_html($value['author_name']).'</h4>';    
                                    endif; 
                                    ?>
                                     <?php 
                                    if(!empty($value['author_position'])):
                                        echo '<p>'.esc_html($value['author_position']).'</p>';    
                                    endif; 
                                    ?>
                    			</div>
                    		</blockquote>
                    <?php 
                        }    
                    }
                    break;
                case '3': 
                    foreach($values as $value){
                        if(isset($value['text']) && !empty($value['text'])){ 
                            $image_url = '';
                            if (!empty($value['author_avatar'])) {
                                $attachment_image = wp_get_attachment_image_src($value['author_avatar'], 'thumbnail');
                                $image_url = $attachment_image[0];
                            }
                            $background_type_cls = !empty($value['background_type']) ? $value['background_type']: '';     
                        ?>
                        <div class="blockquote-item">
							<blockquote class="blockquote-big <?php echo esc_attr($background_type_cls);?>">
								<?php echo esc_html($value['text']);?>
							</blockquote>
							<div class="media">
                                <?php
                                if(!empty($image_url)){
                                    ?>
                                    <div class="media-left media-middle">
    									<img src="<?php echo esc_url($image_url);?>" alt="" class="round"/>
    								</div>
                                    <?php
                                }
                                ?>
								<?php if(!empty($value['author_name'])):?>
								<div class="media-body media-middle">
									<h5 class="text-uppercase highlight3 margin_0"><?php echo esc_html($value['author_name']);?></h5>
								</div>
                                <?php endif;?>
                                <?php 
                                if(!empty($value['author_position'])):
                                    echo '<p>'.esc_html($value['author_position']).'</p>';    
                                endif; 
                                ?>
							</div>
						</div>   
                    <?php 
                        }    
                    }
                    break;
            }
            
        ?>
    </div>
</div>
