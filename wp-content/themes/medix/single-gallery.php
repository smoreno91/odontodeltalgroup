<?php
/**
 * The Template for displaying all single posts
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
$_get_sidebar = medix_post_sidebar();
$theme_options = medix_get_theme_option();
$meta_options = medix_get_meta_option();
$gallery_layout = medix_get_gallery_single_layout();
get_header(); ?>
<?php
$gallery_category = get_the_terms( get_the_ID(), 'gallery_category', '', ', ' );
?>
<div id="primary" class="container gallery-single">
    <div class="row <?php echo esc_attr($gallery_layout);?>">
        <?php if($gallery_layout=='layout1'): ?>
            <div class="col-md-10 col-md-push-1 text-center"> 
                <main id="main" class="site-main">
                    <?php
                    while ( have_posts() ) : the_post();?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('medix-gallery-single'); ?>>
                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                            <div class="categories-links small-text"><?php the_terms( get_the_ID(), 'gallery_category', '', ' ' ); ?></div>
                        	 
                            <div class="item-media">
                        	   <?php medix_post_thumbnail(); ?>  
                            </div>
                        	<div class="item-content text-center">
                                <p class="excerpt_text"><?php echo medix_limit_words(strip_tags(get_the_excerpt()));?>  </p>
                        		<?php the_content();?>
                                <?php medix_single_event_share(); ?>  
                        	</div> 
                        </article> 
                    <?php endwhile;
                    ?>
                </main>
            </div>
        <?php endif;?>
        <?php if($gallery_layout=='layout2'): 
            $term_ids = wp_list_pluck($gallery_category,'term_id');
        ?>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"> 
                <main id="main" class="site-main">
                    <?php
                      
                    while ( have_posts() ) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('medix-gallery-single'); ?>>
                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                            <div class="item-meta content-justify">
                                <span class="date highlight3 small-text">
                        			<?php the_date(); ?>
                        		</span>
                                <div class="categories-links small-text"><?php the_terms( get_the_ID(), 'gallery_category', '', ' ' ); ?></div>
                            </div>
                              
                            <div class="entry-thumbnail">
                        	   <?php medix_post_thumbnail(); ?>  
                            </div>
                        	<div class="item-content">
                                <p class="excerpt_text"><?php echo medix_limit_words(strip_tags(get_the_excerpt()));?>  </p>
                        		<?php the_content();?>
                        	</div> 
                        </article> 
            
                   <?php endwhile;  
                    ?>
                </main>
                <div class="cms-accordion panel-group" id="accordion">
                    <?php if( !empty($meta_options['opt_gallery_client_name'])):?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" class="media">
									<span class="media-left media-middle">
										<span class="panel_button"></span>
									</span>
									<span class="media-body media-middle"><?php echo esc_html__('client','medix');?></span>
								</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="media bottommargin_20">
                                    <?php if(!empty($meta_options['opt_gallery_client_avatar']['url'])):?>
									<div class="media-left">
                                        <img src="<?php echo esc_url($meta_options['opt_gallery_client_avatar']['url']);?>" class="img-circle" alt="">
									</div>
                                    <?php endif;?>
									<div class="media-body">
										<h4 class="bottommargin_0 entry-title"><?php echo esc_html($meta_options['opt_gallery_client_name']);?></h4>
                                        <?php if( !empty($meta_options['opt_gallery_client_position']) ):?>
										<span class="highlight"><?php echo esc_html($meta_options['opt_gallery_client_position']);?></span>
                                        <?php endif;?>
									</div>
								</div>
                                <?php if( !empty($meta_options['opt_gallery_client_desc']) ):?>
								<p><?php echo esc_html($meta_options['opt_gallery_client_desc']);?></p>
                                <?php endif;?>
                                
								<div class="social-icons">
                                    <?php if(!empty($meta_options['opt_gallery_social_link_1']) && !empty($meta_options['opt_gallery_social_icon_class_1'])):?>
									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_1']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_1']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_1']);?>"></a>
                                    <?php endif;?>
									<?php if(!empty($meta_options['opt_gallery_social_link_2']) && !empty($meta_options['opt_gallery_social_icon_class_2'])):?>
									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_2']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_2']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_2']);?>"></a>
                                    <?php endif;?>
                                    <?php if(!empty($meta_options['opt_gallery_social_link_3']) && !empty($meta_options['opt_gallery_social_icon_class_3'])):?>
									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_3']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_3']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_3']);?>"></a>
                                    <?php endif;?>
                                    <?php if(!empty($meta_options['opt_gallery_social_link_4']) && !empty($meta_options['opt_gallery_social_icon_class_4'])):?>
									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_4']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_4']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_4']);?>"></a>
                                    <?php endif;?>
                                    <?php if(!empty($meta_options['opt_gallery_social_link_5']) && !empty($meta_options['opt_gallery_social_icon_class_5'])):?>
									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_5']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_5']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_5']);?>"></a>
                                    <?php endif;?>
								</div>
							</div>
						</div>
					</div>
                    <?php endif;?>
                    <?php if( count($term_ids)> 0):?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion1" href="#collapse2" class="media collapsed">
									<span class="media-left media-middle">
										<span class="panel_button"></span>
									</span>
									<span class="media-body media-middle"><?php echo esc_html__('Categories','medix');?></span>
								</a>
							</h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
                                <?php
                                    foreach($term_ids as $tid ){
                                        $desc = term_description( $tid, 'gallery_category' );
                                        echo '<p>'.$desc.'</p>';
                                    }
                                ?>
								
							</div>
						</div>
					</div>
                    <?php endif;?>
                    <?php if( !empty($meta_options['opt_gallery_service_content'])):?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion1" href="#collapse3" class="media collapsed">
									<span class="media-left media-middle">
										<span class="panel_button"></span>
									</span>
									<span class="media-body media-middle"><?php echo esc_html__('Services','medix'); ?></span>
								</a>
							</h4>
						</div>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body list1 darklinks">
								<?php echo $meta_options['opt_gallery_service_content'];?>
							</div>
						</div>
					</div>
                    <?php endif;?>
				</div>
            </div>
            <?php get_sidebar(); ?>
        <?php endif;?>
        <?php if($gallery_layout=='layout3'): 
            $term_ids = wp_list_pluck($gallery_category,'term_id');
        ?>
            <div class="col-xs-12 col-sm-12 col-md-12"> 
                <main id="main" class="site-main">
                    <?php
                    while ( have_posts() ) : the_post(); ?>
                    
                        <article id="post-<?php the_ID(); ?>" <?php post_class('medix-gallery-single'); ?>>
                            <div class="entry-thumbnail">
                        	   <?php medix_post_thumbnail(); ?>  
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                    <div class="item-meta content-justify">
                                        <span class="date highlight3 small-text">
                                			<?php the_date(); ?>
                                		</span>
                                        <div class="categories-links small-text"><?php the_terms( get_the_ID(), 'gallery_category', '', ' ' ); ?></div>
                                    </div>
                                    <div class="item-content">
                                        <p class="excerpt_text"><?php echo medix_limit_words(strip_tags(get_the_excerpt()));?>  </p>
                                		<?php the_content();?>
                                	</div>
                                    <?php medix_post_gallery_nav(); ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="cms-accordion panel-group" id="accordion">
                                        <?php if( !empty($meta_options['opt_gallery_client_name'])):?>
                    					<div class="panel panel-default">
                    						<div class="panel-heading">
                    							<h4 class="panel-title">
                    								<a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" class="media">
                    									<span class="media-left media-middle">
                    										<span class="panel_button"></span>
                    									</span>
                    									<span class="media-body media-middle"><?php echo esc_html__('client','medix');?></span>
                    								</a>
                    							</h4>
                    						</div>
                    						<div id="collapse1" class="panel-collapse collapse in">
                    							<div class="panel-body">
                    								<div class="media bottommargin_20">
                                                        <?php if(!empty($meta_options['opt_gallery_client_avatar']['url'])):?>
                    									<div class="media-left">
                                                            <img src="<?php echo esc_url($meta_options['opt_gallery_client_avatar']['url']);?>" class="img-circle" alt="">
                    									</div>
                                                        <?php endif;?>
                    									<div class="media-body">
                    										<h4 class="bottommargin_0 entry-title"><?php echo esc_html($meta_options['opt_gallery_client_name']);?></h4>
                                                            <?php if( !empty($meta_options['opt_gallery_client_position']) ):?>
                    										<span class="highlight"><?php echo esc_html($meta_options['opt_gallery_client_position']);?></span>
                                                            <?php endif;?>
                    									</div>
                    								</div>
                                                    <?php if( !empty($meta_options['opt_gallery_client_desc']) ):?>
                    								<p><?php echo esc_html($meta_options['opt_gallery_client_desc']);?></p>
                                                    <?php endif;?>
                                                    
                    								<div class="social-icons">
                                                        <?php if(!empty($meta_options['opt_gallery_social_link_1']) && !empty($meta_options['opt_gallery_social_icon_class_1'])):?>
                    									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_1']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_1']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_1']);?>"></a>
                                                        <?php endif;?>
                    									<?php if(!empty($meta_options['opt_gallery_social_link_2']) && !empty($meta_options['opt_gallery_social_icon_class_2'])):?>
                    									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_2']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_2']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_2']);?>"></a>
                                                        <?php endif;?>
                                                        <?php if(!empty($meta_options['opt_gallery_social_link_3']) && !empty($meta_options['opt_gallery_social_icon_class_3'])):?>
                    									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_3']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_3']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_3']);?>"></a>
                                                        <?php endif;?>
                                                        <?php if(!empty($meta_options['opt_gallery_social_link_4']) && !empty($meta_options['opt_gallery_social_icon_class_4'])):?>
                    									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_4']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_4']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_4']);?>"></a>
                                                        <?php endif;?>
                                                        <?php if(!empty($meta_options['opt_gallery_social_link_5']) && !empty($meta_options['opt_gallery_social_icon_class_5'])):?>
                    									<a class="social-icon soc-<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_5']);?> color-icon" href="<?php echo esc_url($meta_options['opt_gallery_social_link_5']);?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($meta_options['opt_gallery_social_icon_class_5']);?>"></a>
                                                        <?php endif;?>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                                        <?php endif;?>
                                        <?php if( count($term_ids)> 0):?>
                    					<div class="panel panel-default">
                    						<div class="panel-heading">
                    							<h4 class="panel-title">
                    								<a data-toggle="collapse" data-parent="#accordion1" href="#collapse2" class="media collapsed">
                    									<span class="media-left media-middle">
                    										<span class="panel_button"></span>
                    									</span>
                    									<span class="media-body media-middle"><?php echo esc_html__('Categories','medix');?></span>
                    								</a>
                    							</h4>
                    						</div>
                    						<div id="collapse2" class="panel-collapse collapse">
                    							<div class="panel-body">
                                                    <?php
                                                        foreach($term_ids as $tid ){
                                                            $desc = term_description( $tid, 'gallery_category' );
                                                            echo '<p>'.$desc.'</p>';
                                                        }
                                                    ?>
                    								
                    							</div>
                    						</div>
                    					</div>
                                        <?php endif;?>
                                        <?php if( !empty($meta_options['opt_gallery_service_content'])):?>
                    					<div class="panel panel-default">
                    						<div class="panel-heading">
                    							<h4 class="panel-title">
                    								<a data-toggle="collapse" data-parent="#accordion1" href="#collapse3" class="media collapsed">
                    									<span class="media-left media-middle">
                    										<span class="panel_button"></span>
                    									</span>
                    									<span class="media-body media-middle"><?php echo esc_html__('Services','medix'); ?></span>
                    								</a>
                    							</h4>
                    						</div>
                    						<div id="collapse3" class="panel-collapse collapse">
                    							<div class="panel-body list1 darklinks">
                    								<?php echo $meta_options['opt_gallery_service_content'];?>
                    							</div>
                    						</div>
                    					</div>
                                        <?php endif;?>
                    				</div> 
                                </div>
                            </div>
                        </article> 
                        
                    <?php endwhile;
                    ?>
                </main>
            </div>
        <?php endif;?>
    </div><!-- #main -->

</div><!-- #primary -->
<?php 
if($gallery_layout=='layout1'):     
    if($gallery_category){  
        $term_ids = wp_list_pluck($gallery_category,'term_id');
        $args = array(
          'post_type' => 'gallery',
          'tax_query' => array(
                array(
                    'taxonomy' => 'gallery_category',
                    'field' => 'id',
                    'terms' => $term_ids,
                    'operator'=> 'IN'  
                 )),
          'posts_per_page' => 4,
          'orderby' => 'rand',
          'post__not_in'=>array( get_the_ID())
       );
    }else{  
        $args = array(
            'post__not_in'        => array( get_the_ID() ),
            'posts_per_page' => 4,
            'post_type' => 'gallery',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1
        );
    }

    $wp_query = new WP_Query($args);
    
    if ($wp_query->have_posts()){ 
        global $cms_carousel;
    	wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.0.0b','all');
        wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.0.0b',true);
        wp_enqueue_script('owl-carousel-cms',get_template_directory_uri().'/assets/js/owl.carousel.cms.js',array('jquery'),'1.0.0',true);
          
    	$cms_carousel['gallery-related-items'] = array(
    	    'loop' => 'true',
    	    'mouseDrag' => 'true',
    	    'nav' => 'true',
    	    'dots' => 'false',
    	    'margin' => 0,
    	    'autoplay' => 'false',
    	    'autoplayTimeout' => 2000,
    	    'smartSpeed' => 1500,
    	    'autoplayHoverPause' => 'false',
    	    'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
    	    'responsive' => array(
    	        0 => array(
    	            "items" => 1,
    	        ),
    	        768 => array(
    	            "items" => 2,
    	            ),
    	        992 => array(
    	            "items" => 3,
    	            ),
    	        1200 => array(
    	            "items" => 4,
    	            )
    	        )
    	);
         
    	wp_localize_script('owl-carousel-cms', "cmscarousel", $cms_carousel);
    	wp_enqueue_script('owl-carousel-cms');
    
        ?>
        <div class="cms-gallerys gallery-related">
            <div id="gallery-related-items" class="gallery-related-single cms-carousel owl-carousel">
            <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                <div class="gallery-related-item">
                    <div class="gallery-item mutted-hover text-center" onclick="">
                        <?php 
                            if(has_post_thumbnail()):
                                $class = ' has-thumbnail';
                                $thumbnail = get_the_post_thumbnail(get_the_ID(),'large');
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                $image_url = esc_url($image[0]);
                            else:
                                $class = ' no-image';
                                $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                                $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
                            endif;
                        ?>
                        <div class="item-media">
    						<div class="cms-grid-media <?php echo esc_attr($class);?>"><?php echo $thumbnail;?></div>
    						<div class="media-links">
    							<div class="links-wrap">
                                    <a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
    							</div>
    						</div>
    					</div>
                    </div> 
                    <div class="item-title text-center">
    					<span class="categories-links">
                            <?php echo get_the_term_list( get_the_ID(), 'gallery_category', '', ' / ', '' ); ?>
    					</span>
    					<h3>
    						<a class="port-link" href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
    					</h3>
    				</div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
 <?php } ?>
<?php endif;?>
<?php get_footer(); ?>