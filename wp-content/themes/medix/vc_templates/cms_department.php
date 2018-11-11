<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-department');
    
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    $values = (array) vc_param_group_parse_atts($values );  
?>
<div class="<?php echo esc_attr($css_class);?>">
    <div class="row vertical-tabs bordered">
        <div class="col-lg-4 col-md-5">
         
        	<div class="with_padding tab-list">
                <?php if(!empty($atts['title'])){?>
        		<h4 class="text-uppercase"><?php echo esc_html($atts['title']);?></h4>
                <?php }?>
        		<ul class="nav list1 no-bullets" role="tablist">
                <?php 
                $i=1;
                foreach($values as $value): ?>
        			<li <?php echo $i==1? 'class="active"':'';?>>
        				<a href="#vertical-tab<?php echo $i;?>" role="tab" data-toggle="tab"><?php echo esc_html($value['tab_title']);?></a>
        			</li>
                <?php $i++; endforeach; ?>
        		</ul>
        	</div>
        
        </div>
    
        <div class="col-lg-8 col-md-12">
     
    	   <div class="tab-content no-border">
                <?php 
                $j=1;
                foreach($values as $value): 
                    $link = (isset($value['link'])) ? $value['link'] : '';
                    $link = vc_build_link( $link );
                    $use_link = false;
                    if ( strlen( $link['url'] ) > 0 ) {
                        $use_link = true;
                        $a_href = $link['url'];
                        $a_title = !empty($link['title']) ? $link['title'] : 'Read more' ;
                        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                    }
                    
                    $image_url = '';
                    $cls='col-sm-12';
                    if (!empty($value['image'])) {
                        $attachment_image = wp_get_attachment_image_src($value['image'], 'full');
                        $image_url = $attachment_image[0];
                        $cls='col-sm-6';
                    } 
                    
                ?>
    			<div class="tab-pane fade <?php echo $j==1?'in active':'';?>" id="vertical-tab<?php echo $j;?>">
        			<div class="row">
        				<div class="<?php echo esc_attr($cls);?>">
                            <?php if( !empty($value['title1']) || !empty($value['title2']) ):?>
        					<h4 class="module-header bottommargin_50">
        						<span class="thin"><?php echo esc_html($value['title1']);?></span>
        						<br>
        						<span class="big"><?php echo esc_html($value['title2']);?></span>
        					</h4>
                            <?php endif;?>
                           
                            <?php if(isset($value['text'])) echo wpautop($value['text']);?>
        				    <?php if($use_link):?>
        					<a href="<?php echo esc_url($a_href);?>" target="<?php echo esc_attr($a_target);?>" class="btn btn-white"><?php echo esc_html($a_title);?></a>
                             <?php endif;?>
        				</div>
                        <?php if (!empty($value['image'])):?>
        				<div class="<?php echo esc_attr($cls);?> text-center">
        					<img src="<?php echo esc_url($image_url);?>" alt="" class="top-overlap"/>
        				</div>
                        <?php endif;?>
        			</div>
        		</div>
            <?php $j++; endforeach; ?>
    		  
    		</div>
    	</div>
    </div>
</div>