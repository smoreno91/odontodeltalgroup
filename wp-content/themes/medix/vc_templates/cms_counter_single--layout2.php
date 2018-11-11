<?php 
    $icon_name = "icon_" . $atts['icon_type'];
    $iconClass = isset($atts[$icon_name])?$atts[$icon_name]:'';
     
?>
<div class="cms-counter-wraper layout2 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>" onclick="">
    <div class="cms-counter-body">
        <div class="cms-counter-single">
            <div class="row">
				<div class="col-xs-6 col-xxs-12">
                    <?php if( $iconClass ): ?>
        				<span class="cms-icon"><i class="<?php echo esc_attr($iconClass); ?>"></i></span>
        			<?php endif; ?>
					<div id="counter_<?php echo esc_attr($atts['html_id']);?>" class="cms-counter bold <?php echo esc_attr(strtolower($atts['type']));?>" data-suffix="<span><?php echo esc_attr($atts['suffix']);?></span>" data-prefix="<?php echo esc_attr($atts['prefix']);?>" data-type="<?php echo esc_attr(strtolower($atts['type']));?>" data-digit="<?php echo esc_attr($atts['digit']);?>">
    			</div> 
				 
				</div>
                <?php if($atts['c_title']):?>
				<div class="col-xs-6 col-xxs-12">
					<p class="desc"><?php echo apply_filters('the_title',$atts['c_title']);?></p>
				</div>
                <?php endif;?>
			</div>
		</div>
    </div>
         
</div>