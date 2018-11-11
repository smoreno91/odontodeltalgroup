<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
    <div class="wrap-404">
        <div id="primary" class="container">
        	<main id="main" class="site-main">
                <section class="error-404 not-found">
                    <div class="inline-block text-center">
    					<p class="not_found">
    						<span class="highlight"><?php echo esc_html('404'); ?></span>
    						<span class="oops"><?php esc_html_e('Ooops!', 'medix'); ?></span>
    					</p>
    					<h2><?php esc_html_e('Sory, page not found!', 'medix'); ?></h2>
    					<p>
                            <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'medix'); ?></a>
    					</p>
    				</div>
        		</section>
        		<!-- .error-404 -->
        	</main><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
</div><!-- .site-content -->
    <?php
    $theme_options = medix_get_theme_option();
    $fb_cls = (!empty($theme_options['footer_bottom_layout'])) ? $theme_options['footer_bottom_layout'] : 'layout-1';
    $has_bg_img = (!empty($theme_options['footer_bottom_background']['background-image']) ) ? 'has-bg-img' : '';
    $has_bg_color_overide = (!empty($theme_options['footer_bottom_background']['background-color']) && empty($has_bg_img) && $fb_cls =='layout-3' ) ? 'overide-bg-color' : '';
    
    $ls_cls = (isset($_GET['ls']) && trim($_GET['ls']) == '1' ) ? 'ls': '';
    $cs_cls = (isset($_GET['cs']) && trim($_GET['cs']) == '1' ) ? 'cs': ''; 
    
    $normal_cls = (isset($_GET['normal']) && trim($_GET['normal']) == '1' ) ? 'normal' : '';
            
    ?>  
    <footer id="colophon" class="site-footer">
          
        <div id="footer-bottom" class="footer-bottom <?php echo esc_attr($fb_cls);?> <?php echo esc_attr($ls_cls);?> <?php echo esc_attr($cs_cls);?> <?php echo esc_attr($normal_cls);?> <?php echo esc_attr($has_bg_img);?> <?php echo esc_attr($has_bg_color_overide);?>">
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