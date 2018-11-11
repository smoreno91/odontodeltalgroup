<?php
/**
 * @name : Footer bottom layout 1
 * @package : CMSSuperHeroes
 * @author : Knight
 */
?>
<?php 
$theme_option = medix_get_theme_option();

echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">';
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

?>