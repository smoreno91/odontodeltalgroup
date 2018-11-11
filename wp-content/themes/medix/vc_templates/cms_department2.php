<?php 
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
     
    $classes=array('cms-department');
    
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    
?>
<div class="<?php echo esc_attr($css_class);?> department2" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row vertical-tabs bordered">
        <div class="col-lg-4 col-md-5">
         
        	<div class="with_padding tab-list">
                <?php if(!empty($atts['title'])){?>
        		<h4 class="text-uppercase"><?php echo esc_html($atts['title']);?></h4>
                <?php }?>
                <?php if(is_array($atts['categories'])){ ?>
        		<ul class="nav list1 no-bullets" role="tablist">
                <?php 
                $i=1;
                foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
        			<li <?php echo $i==1? 'class="active"':'';?>>
        				<a href="#vertical-tab<?php echo $i;?>" role="tab" data-toggle="tab"><?php echo esc_html($term->name);?></a>
        			</li>
                <?php $i++; endforeach; ?>
        		</ul>
                <?php }?>
        	</div>
        
        </div>
    
        <div class="col-lg-8 col-md-7">
     
    	   <div class="tab-content no-border">
                <?php 
                $j=1;
                $posts = $atts['posts'];
                
                foreach($atts['categories'] as $category){
                    $term_cat = get_term( $category, $taxo );
                    $cat_per_posts[$term_cat->term_id] = array();
                    foreach($posts as $post) {
                        $terms = get_the_terms($post->ID,$taxo);
                        if ( ! empty( $terms ) ) {
                            foreach ( $terms as $term ) {
                                if($term->term_id == $term_cat->term_id)
                                    $cat_per_posts[$term_cat->term_id][] = $post ;
                            }
                             
                        }
                    }
                      
                    ?>
                      
        			<div class="tab-pane fade <?php echo $j==1?'in active':'';?>" id="vertical-tab<?php echo $j;?>">
                        <h4 class="module-header"><?php echo esc_html__('Our Services','medix');?></h4>
                        <div class="cms-carousel-department owl-carousel">
                            <?php
                            $posts = $atts['posts'];
                            foreach($cat_per_posts[$term_cat->term_id] as $p){
                                
                                if(!(get_the_post_thumbnail($p->ID,'large'))):
                                    $class = ' no-image';
                                    $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.$p->name.'" />';
                                else:
                                    $thumbnail = get_the_post_thumbnail($p->ID,'large'); 
                                    $class = ' has-image';
                                endif;
                                
                                ?>
                                <div class="carousel-item vertical-item">
									<div class="item-media">
										<?php echo $thumbnail;?>
									</div>
									<div class="item-content">
										<h4 class="entry-title">
											<a href="service-single.html">Laboratory Analysis</a>
										</h4>
										<p>
											Aliquyam eriat, sed diam voluptua at vero eos et accusam et justo duo dolores rebum clita kasd gubergren, no sea takimata sanctus.
										</p>
									</div>
								</div>
                                  
                                <?php
                            }
                            ?>
                        </div>
            		  
            		</div>
                    
            <?php $j++; }  ?>
    		  
    		</div>
    	</div>
    </div>
</div>