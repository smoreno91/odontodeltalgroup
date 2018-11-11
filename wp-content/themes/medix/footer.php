<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
 
    </div><!-- .site-content -->
    <?php
    $theme_options = medix_get_theme_option();
    
    $ft_cls = (!empty($theme_options['footer_top_layout'])) ? $theme_options['footer_top_layout'] : 'layout-1'; 
    $fb_cls = (!empty($theme_options['footer_bottom_layout'])) ? $theme_options['footer_bottom_layout'] : 'layout-1';
    
    $ft_has_bg_img = (!empty($theme_options['footer_top_background']['background-image']) ) ? 'has-bg-img' : '';
    $ft_has_bg_color_overide = (!empty($theme_options['footer_top_background']['background-color']) && empty($ft_has_bg_img) && $ft_cls =='layout-2' ) ? 'overide-bg-color' : '';
    
    $has_bg_img = (!empty($theme_options['footer_bottom_background']['background-image']) ) ? 'has-bg-img' : '';
    $has_bg_color_overide = (!empty($theme_options['footer_bottom_background']['background-color']) && empty($has_bg_img) && $fb_cls =='layout-3' ) ? 'overide-bg-color' : '';
     
    $fb_style_cls = get_footer_bottom_style();
    
    $normal_cls = (isset($_GET['normal']) && trim($_GET['normal']) == '1' ) ? 'normal' : '';
            
    ?>  
    <footer id="colophon" class="site-footer">
        <?php if(empty($theme_options['disable_footer_top'])):?>
        <div id="footer-top" class="footer-top <?php echo esc_attr($ft_cls);?> <?php echo esc_attr($ft_has_bg_img);?> <?php echo esc_attr($ft_has_bg_color_overide);?>">
        <?php if(!empty($theme_options['footer_top_background_color']['color']) || !empty($opt_theme_options['footer_top_background_color']['rgba']) || $theme_options['footer_top_layout'] == 'layout-2') echo '<div class="bg-overlay"></div>';?>
            <div class="container">
                <div class="row">

                    <?php medix_footer_top(); ?>

                </div>
            </div>
        </div><!-- #footer-top -->
        <?php endif; ?>
         
        <div id="footer-bottom" class="footer-bottom <?php echo esc_attr($fb_cls);?> <?php echo esc_attr($fb_style_cls);?> <?php echo esc_attr($normal_cls);?> <?php echo esc_attr($has_bg_img);?> <?php echo esc_attr($has_bg_color_overide);?>">
            <div class="container">
                <div class="row">

                    <?php medix_footer_bottom(); ?>

                </div>
            </div>
        </div><!-- #footer-bottom -->
         
    </footer><!-- .site-footer -->

</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>