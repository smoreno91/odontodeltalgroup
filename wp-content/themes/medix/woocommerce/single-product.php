<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
  
$theme_options = medix_get_theme_option();
$is_sidebar_cls = medix_shop_single_sidebar();
$page_class = $is_sidebar_cls !='is-sidebar-full' ? 'has-sidebar col-md-9 col-sm-12' : 'has-sidebar col-md-12 col-sm-12';

get_header(); ?>
    <div class="container">
		<div class="row <?php echo esc_attr($is_sidebar_cls); ?>">
            
            <div class="<?php echo esc_attr($page_class); ?>">
        	<?php
        		/**
        		 * woocommerce_before_main_content hook.
        		 *
        		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
        		 * @hooked woocommerce_breadcrumb - 20
        		 */
        		do_action( 'woocommerce_before_main_content' );
        	?>
    
    		<?php while ( have_posts() ) : the_post(); ?>
    
    			<?php wc_get_template_part( 'content', 'single-product' ); ?>
    
    		<?php endwhile; // end of the loop. ?>
    
        	<?php
        		/**
        		 * woocommerce_after_main_content hook.
        		 *
        		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
        		 */
        		do_action( 'woocommerce_after_main_content' );
        	?>
            </div>	
        	<?php
        		/**
        		 * woocommerce_sidebar hook.
        		 *
        		 * @hooked woocommerce_get_sidebar - 10
        		 */
        		//do_action( 'woocommerce_sidebar' );
                if($is_sidebar_cls != 'is-sidebar-full'): ?>
        		<div class="col-md-3 col-sm-12 col-xs-12 left-sidebar">
        			<div id="secondary" class="main-side-bar widget-area">
        		    		<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>							
        						<?php dynamic_sidebar( 'sidebar-shop' ); ?>
        					<?php else: ?>
        						<?php dynamic_sidebar( 'sidebar-1' ); ?>
        					<?php endif; ?>
        			</div><!-- #secondary -->
                </div>
            <?php endif; ?>
    
    </div>
	</div>
<?php get_footer(); ?>
