<?php
/**
 * @name : Footer bottom layout 4
 * @package : CMSSuperHeroes
 * @author : Knight
 */
?>
<?php 
$theme_option = medix_get_theme_option();

echo '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-left footer-bottom-logo">';
    if(!empty($theme_option['footer_bottom_logo']['url'])) {
            $footer_bottom_logo_url = !empty($theme_option['footer_bottom_logo_url']) ? $theme_option['footer_bottom_logo_url'] : home_url('/') ;
            echo '<a href="' . esc_url($footer_bottom_logo_url) . '"><img alt="' .  get_bloginfo( "name" ) . '" src="' . esc_url($theme_option['footer_bottom_logo']['url']) . '"></a>';
        }
echo "</div>";
echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">';
    echo '<div class="footer-bottom-wrap copyright-col">';
        if(!empty($theme_option['footer-bottom-copyright-text'])){
            echo '<span class="copyright">';
            echo balanceTags($theme_option['footer-bottom-copyright-text']);
            echo '</span>';
        }
        if ( is_active_sidebar( 'sidebar-footer-bottom-sidebar') ){
            dynamic_sidebar( 'sidebar-footer-bottom-sidebar' );
        } 
    echo "</div>";
echo "</div>";
echo '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-right col-right">';
        if ( is_active_sidebar( 'sidebar-footer-bottom-layout-4-right') ){
            dynamic_sidebar( 'sidebar-footer-bottom-layout-4-right' );
        } 
echo "</div>";
?>