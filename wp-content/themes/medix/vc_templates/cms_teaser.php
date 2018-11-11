<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $classes=array('cms-teaser',vc_shortcode_custom_css_class( $css ));
    $link = (isset($atts['link'])) ? $atts['link'] : '';
    $link = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href = $link['url'];
        $a_title = !empty($link['title']) ? $link['title'] : '' ;
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    if(!empty($atts['css'])){
        $classes[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );
    
    $icon_name = "icon_" . $atts['icon_type'];
    $icon_class = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
      
?>


<?php 
if($layout == 'layout1'){ 
    $image_url = '';
    if (!empty($atts['image'])) {
        $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
        $image_url = $attachment_image[0];
    }else{
        $image_url = esc_url(get_template_directory_uri().'/assets/images/teaser/teaser01.jpg');
    }
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
    
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout1" style="background-image: url('<?php echo esc_url($image_url);?>');">
        <div class="bg_overlay" style="background: <?php echo !empty($background_overlay)? $background_overlay : 'rgba(1, 178, 183, 0.85)';?>;"></div>
		<div class="teaser_content">
			<div class="teaser text-center">
				<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : '#ffffff';?>">
					<?php echo $icon_html;?>
				</div>
                <?php if(!empty($title)) 
				    echo '<'.$title_heading.'>'. esc_html($title).'</'.$title_heading.'>';
				if(!empty($content))
                    echo wpb_js_remove_wpautop( $content, true );
                ?>
                <?php if($use_link){?>
				<a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo !empty($a_title) ? esc_html($a_title): esc_html__('Regular Button','medix');?></a>
                <?php }?>
			</div>
		</div>
	</div>
<?php } ?>
<?php 
if($layout == 'layout2'){ 
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
    $notitle_cls = empty($title) ? 'no-title' : '';
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout2 <?php echo esc_attr($notitle_cls);?> text-center">
		<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : '#ffffff';?>">
			<?php echo $icon_html;?>
		</div>
        <?php 
        if(!empty($title)){ 
            if($use_link)
            echo '<'.$title_heading.'><a href="'. esc_url($a_href).'">'. esc_html($title).'</a></'.$title_heading.'>';
            else
            echo '<'.$title_heading.'>'. esc_html($title).'</'.$title_heading.'>';
        } 
        if(!empty($content))
            echo wpb_js_remove_wpautop( $content, true );
        ?>
        <?php if($use_link && !empty($a_title)){?>
		  <a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo esc_html($a_title);?></a>
        <?php }?>            
	</div>
<?php } ?>
<?php 
if($layout == 'layout3'){ 
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
     
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout3 text-center">
		<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?> <?php echo ( isset($icon_border) && $icon_border == '1') ? 'border_icon': ''; ?> <?php echo !empty($icon_bg)? 'bg_icon' : '';?> <?php echo (isset($icon_round) && $icon_round == '1') ? 'round': ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : '#ffffff';?>; border-color:<?php echo (isset($icon_border) && $icon_border == '1' && !empty($icon_color))? $icon_color : 'transparent';?>; background:<?php echo !empty($icon_bg)? $icon_bg : 'transparent';?>;">
			<?php echo $icon_html;?>
		</div>
        <?php 
        if(!empty($title)){ 
            if($use_link)
            echo '<'.$title_heading.'><a href="'. esc_url($a_href).'">'. esc_html($title).'</a></'.$title_heading.'>';
            else
            echo '<'.$title_heading.'>'. esc_html($title).'</'.$title_heading.'>';
        }
        if(!empty($content))
            echo wpb_js_remove_wpautop( $content, true );
        ?>
        <?php if($use_link && !empty($a_title)){?>
		  <a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo esc_html($a_title);?></a>
        <?php }?>            
	</div>
<?php } ?>
<?php 
if($layout == 'layout4'){ 
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
    $with_border_cls = ( isset($with_border) && $with_border == '1') ? 'with_border': ''; 
    $background_type_cls = !empty($background_type) ? $background_type : '';
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout4 text-center <?php echo esc_attr($with_border_cls);?> <?php echo esc_attr($background_type_cls);?>">
		<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?> <?php echo ( isset($icon_border) && $icon_border == '1') ? 'border_icon': ''; ?> <?php echo !empty($icon_bg)? 'bg_icon' : '';?> <?php echo (isset($icon_round) && $icon_round == '1') ? 'round': ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; border-color:<?php echo (isset($icon_border) && $icon_border == '1' && !empty($icon_color))? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; background:<?php echo !empty($icon_bg)? $icon_bg : 'transparent';?>;">
			<?php echo $icon_html;?>
		</div>
        <?php 
        if(!empty($title)){ 
            echo '<'.$title_heading.'>'. esc_html($title).'</'.$title_heading.'>';
        }
        if(!empty($content))
            echo wpb_js_remove_wpautop( $content, true );
        ?>
        <?php if($use_link && !empty($a_title)){?>
		  <a href="<?php echo esc_url($a_href);?>" class="btn <?php echo esc_attr($btn_type)?>"><?php echo esc_html($a_title);?></a>
        <?php }?>            
	</div>
<?php } ?>	 
<?php 
if($layout == 'layout5'){ 
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
    $with_border_cls = ( isset($with_border) && $with_border == '1') ? 'with_border': ''; 
    $background_type_cls = !empty($background_type) ? $background_type : '';
    $text_right_cls = ( isset($text_right) && $text_right == '1') ? 'text-right': ''; 
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout5 <?php echo esc_attr($with_border_cls);?> <?php echo esc_attr($background_type_cls);?> <?php echo esc_attr($text_right_cls);?>">
        <?php if( $text_right_cls == ''){?>
        <div class="media-left">
			<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?> <?php echo ( isset($icon_border) && $icon_border == '1') ? 'border_icon': ''; ?> <?php echo !empty($icon_bg)? 'bg_icon' : '';?> <?php echo (isset($icon_round) && $icon_round == '1') ? 'round': ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; border-color:<?php echo (isset($icon_border) && $icon_border == '1' && !empty($icon_color))? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; background:<?php echo !empty($icon_bg)? $icon_bg : 'transparent';?>;">
    			<?php echo $icon_html;?>
    		</div>
		</div>
        <?php } ?>
		<div class="media-body">
			<?php 
            if(!empty($title)){ 
                echo '<'.$title_heading.'>'. esc_html($title).'</'.$title_heading.'>';
            }
            if(!empty($content))
                echo wpb_js_remove_wpautop( $content, true );
            ?>
		</div> 
        <?php if( $text_right_cls != ''){?>
        <div class="media-right">
			<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?> <?php echo ( isset($icon_border) && $icon_border == '1') ? 'border_icon': ''; ?> <?php echo !empty($icon_bg)? 'bg_icon' : '';?> <?php echo (isset($icon_round) && $icon_round == '1') ? 'round': ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; border-color:<?php echo (isset($icon_border) && $icon_border == '1' && !empty($icon_color))? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; background:<?php echo !empty($icon_bg)? $icon_bg : 'transparent';?>;">
    			<?php echo $icon_html;?>
    		</div>
		</div>   
        <?php } ?>    
	</div>
<?php } ?>
<?php 
if($layout == 'layout6'){ 
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
    $background_type_cls = !empty($background_type) ? $background_type : '';
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout6 table_section <?php echo esc_attr($background_type_cls);?>">
        <div class="row">
			<div class="col-sm-5">
				<?php 
                if(!empty($title)){ 
                    echo '<'.$title_heading.' class="text-md-right">'. esc_html($title).'</'.$title_heading.'>';
                }
                ?>
			</div>

			<div class="col-sm-1 text-center">
				<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?> <?php echo ( isset($icon_border) && $icon_border == '1') ? 'border_icon': ''; ?> <?php echo !empty($icon_bg)? 'bg_icon' : '';?> <?php echo (isset($icon_round) && $icon_round == '1') ? 'round': ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; border-color:<?php echo (isset($icon_border) && $icon_border == '1' && !empty($icon_color))? $icon_color : 'rgba(255, 255, 255, 0.6)';?>; background:<?php echo !empty($icon_bg)? $icon_bg : 'transparent';?>;">
        			<?php echo $icon_html;?>
        		</div>
			</div>
			<div class="col-sm-5">
				<?php 
                if(!empty($content))
                    echo wpb_js_remove_wpautop( $content, true );
                ?>
			</div>
		</div>
	</div>
<?php } ?>	
<?php 
if($layout == 'layout7'){ 
    $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
    $background_type_cls = !empty($background_type) ? $background_type : '';
    $orther_link = (isset($atts['orther_link'])) ? $atts['orther_link'] : '';
    $orther_link = vc_build_link( $orther_link );
    $orther_use_link = false;
    if ( strlen( $orther_link['url'] ) > 0 ) {
        $orther_use_link = true;
        $oa_href = $orther_link['url'];
        $oa_title = !empty($orther_link['title']) ? $orther_link['title'] : '' ;
        $oa_target = strlen( $orther_link['target'] ) > 0 ? $orther_link['target'] : '_self';
    }
    $titles = explode(' ', $title);
    $first  = $titles[0];
    $rest   = ltrim($title, $first.' ');
    ?>
    <div class="<?php echo esc_attr($css_class);?> layout7 <?php echo esc_attr($background_type_cls);?>">
        <div class="media teaser">
		  
			<div class="media-left">
				<div class="teaser_icon <?php echo !empty($icon_size) ? esc_attr($icon_size) : ''; ?>" style="color:<?php echo !empty($icon_color)? $icon_color : 'rgba(255, 255, 255, 0.6)';?>;">
        			<?php echo $icon_html;?>
        		</div>
			</div>
			<div class="media-body">
				<?php 
                if(!empty($title)){ 
                    echo '<'.$title_heading.' class="module-header">';
    					echo '<a href="'. esc_url($a_href) .'" target="'.esc_attr($a_target).'">';
                            if(!empty($titles[0]))
    						  echo '<span class="thin">'. esc_html($titles[0]) .'</span><br/>';
                            if(!empty($rest))
    						  echo esc_html($rest);
                        echo '</a>';
    				echo '</'.$title_heading.'>'; 
                }
                if(!empty($content))
                    echo wpb_js_remove_wpautop( $content, true );
                ?>
                <?php if($orther_use_link && !empty($oa_title)){?>
        		  <a href="<?php echo esc_url($oa_href);?>" class="small-text"><?php echo esc_html($oa_title);?></a>
                <?php }?>
			</div>
		</div>
	</div>
<?php } ?>	
 
             
 
