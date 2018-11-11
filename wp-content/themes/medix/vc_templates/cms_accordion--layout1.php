<?php 
$html_id=$atts['html_id'];
$template=$atts['template'];
$item_class="";
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$options=(array) vc_param_group_parse_atts($options );
 
?>
<?php if(!empty($options)): ?>
	<div id="<?php echo esc_attr($html_id); ?>" class="cms-accordion layout1 panel-group <?php echo esc_attr($class); ?>">
         
            <?php 
            $k = 1;
            foreach($options as $option): 
            $rad = $k.rand();
            $image_url = '';
            if (!empty($option['image'])) {
                $attachment_image = wp_get_attachment_image_src($option['image'], 'full');
                $image_url = $attachment_image[0];
            }
            $link = (isset($option['link'])) ? $option['link'] : '';
            $link = vc_build_link( $link );
            $use_link = false;
            if ( strlen( $link['url'] ) > 0 ) {
                $use_link = true;
                $a_href = $link['url'];
                $a_title = !empty($link['title']) ? $link['title'] : '' ;
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            $icon_att = '';
            if(!empty($option['icon_class']))
             $icon_att = '<i class="indicator '. esc_attr($option['icon_class']) .'"></i>';
            
            ?>
            <div class="panel panel-default">
                <?php if(!empty($option['title'])): ?>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle <?php echo !empty($option['is_open'])?'':'collapsed';?>" data-toggle="collapse" data-parent="#<?php echo esc_attr($html_id); ?>" href="#collapse<?php echo $rad; ?>"><?php echo $icon_att;?><?php echo esc_attr($option['title'] ); ?></a>
                        </h4>
                    </div>
                <?php endif; ?>
                <?php if(!empty($option['desc'])): ?>
                    <div id="collapse<?php echo $rad; ?>" class="panel-collapse collapse <?php echo !empty($option['is_open'])?'in':'';?>">
                        <div class="panel-body">
                            
                            <?php if(!empty($image_url)):?>
                            <div class="media">
								<div class="media-left">
                                    <?php if($use_link):?>
									<a href="<?php echo esc_url($a_href);?>" class="">
										<img src="<?php echo esc_url($image_url);?>" alt=""/>
									</a>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url($image_url);?>" alt=""/>
                                    <?php endif; ?> 
								</div>
								<div class="media-body">
									<?php echo esc_html($option['desc'] ); ?>
								</div>
							</div>
                            <?php else:?>
                                <p><?php echo esc_html($option['desc'] ); ?></p>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif; ?> 
            </div>
             
            <?php 
            $k++;
            endforeach; 
            ?>
		  
	</div>
<?php endif; ?>