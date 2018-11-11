<?php
 extract(shortcode_atts(array(
        'color_mode'    => ''
    ), $atts));

$testimonial = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $testimonial['values'] );
if(!isset($values[0]['text'])){
    echo '<p class="require required">'.esc_html__('Please add a testimonial text!','medix').'</p>';
    return;
}
 
?>
<?php if(count($values) > 0){?>
<div class="testimonial-carousel-two <?php echo esc_attr($color_mode); ?>">
    <div class="owl-carousel-two owl-carousel testimonials-owl-dots" data-responsive-lg="3" data-responsive-md="3" data-responsive-sm="3" data-responsive-xs="3" data-center="true" data-loop="true" data-margin="20">
        <?php
        foreach($values as $value){
            if(isset($value['author_avatar']) && !empty($value['author_avatar'])) {
                $img = wpb_getImageBySize( array(
                    'attach_id' => $value['author_avatar'],
                    'thumb_size' => '90',
                    'class' => 'circle avatar',
                ));
            }
        ?>
        <?php if(isset($img)):?>
    	<div>
    	   <?php echo $img['thumbnail']; ?>	 
    	</div>
        <?php endif;?>
        <?php }?>
    </div>
    
    <div class="owl-carousel-two owl-carousel testimonials-owl-content" data-responsive-lg="1" data-responsive-md="1" data-responsive-sm="1" data-responsive-xs="1" data-loop="true" data-margin="0">
         <?php
        foreach($values as $value){
            if(isset($value['text']) && !empty($value['text'])){
        ?>
    	<blockquote class="blockquote-big margin_0">
    		<?php if(isset($value['text'])) echo wpautop($value['text']);?>
    		<div class="item-meta">
    			<?php if(isset($value['author_name'])) echo '<h4 class="author-name">'.esc_attr($value['author_name']).'</h4>';?>
                <?php if(isset($value['author_position'])) echo '<p class="author-position">'.esc_attr($value['author_position']).'</p>';?>
    		</div>
    	</blockquote>
        <?php }}?>
    	
     
    </div>
</div>
<?php } ?>
 
