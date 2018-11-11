<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
$is_sidebar_cls = medix_shop_sidebar();
$page_class = $is_sidebar_cls !='is-sidebar-full' ? 'has-sidebar col-md-9 col-sm-12' : 'has-sidebar col-md-12 col-sm-12';
$loop_custom_class= medix_get_catalog_cols(); 
 
get_header( 'shop' ); ?>
<section id="primary" class="content-area medix-product-list">
    <div class="container">
    <div class="row <?php echo esc_attr($is_sidebar_cls); ?>">
        
        <div class="<?php echo esc_attr($page_class); ?>">
            <main id="main" class="site-main"> 
        	<?php
        		/**
        		 * woocommerce_before_main_content hook.
        		 *
        		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
        		 * @hooked woocommerce_breadcrumb - 20
        		 */
        		//do_action( 'woocommerce_before_main_content' );
        	?>
      
    		<?php
    			/**
    			 * woocommerce_archive_description hook.
    			 *
    			 * @hooked woocommerce_taxonomy_archive_description - 10
    			 * @hooked woocommerce_product_archive_description - 10
    			 */
    			do_action( 'woocommerce_archive_description' );
    		?>
    
    		<?php if ( have_posts() ) : ?>
                <div class="shop-top clearfix">
    			<?php
    				/**
    				 * woocommerce_before_shop_loop hook.
    				 *
    				 * @hooked woocommerce_result_count - 20
    				 * @hooked woocommerce_catalog_ordering - 30
    				 */
    				do_action( 'woocommerce_before_shop_loop' );
    			?>
                </div>
    			<?php woocommerce_product_loop_start(); ?>
                    
    				<?php woocommerce_product_subcategories(); ?>
                     
                    <?php 
    					$i =1; 
    					$time = 0.1;
    			 
    			        while ( have_posts() ) : the_post();  
                        
                        ?>
                        <div class="products <?php echo esc_attr($loop_custom_class) ?>" >
    						<?php wc_get_template_part( 'content', 'product' ); ?>
    					</div><?php endwhile; ?>
                           
                 <?php woocommerce_product_loop_end(); ?>
    			<?php
    				/**
    				 * woocommerce_after_shop_loop hook.
    				 *
    				 * @hooked woocommerce_pagination - 10
    				 */
    				do_action( 'woocommerce_after_shop_loop' );
    			?>
               
    		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
    
    			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
    
    		<?php endif; ?>
    
        	<?php
        		/**
        		 * woocommerce_after_main_content hook.
        		 *
        		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
        		 */
        		//do_action( 'woocommerce_after_main_content' );
        	?>
            </main>
            </div>
            <?php if($is_sidebar_cls != 'is-sidebar-full'): ?>
        		<div class="col-md-3 col-sm-12 col-xs-12 woo-sidebar">
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
     
</section><!-- #primary -->
<?php get_footer( 'shop' ); ?>
