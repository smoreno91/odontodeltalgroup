<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

global $product;
$gallery_att_ids = $product->get_gallery_image_ids();
$related = wc_get_related_products($product->get_ID());  

if($gallery_att_ids || $related){
    global $cms_carousel;
	wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css','','2.0.0b','all');
    wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),'2.0.0b',true);
    wp_enqueue_script('owl-carousel-cms',get_template_directory_uri().'/assets/js/owl.carousel.cms.js',array('jquery'),'1.0.0',true);
    
    $cms_carousel['cms-product-gallery'] = array(
	    'loop' => 'true',
	    'mouseDrag' => 'true',
	    'nav' => 'false',
	    'dots' => 'false',
	    'margin' => 10,
	    'autoplay' => 'false',
	    'autoplayTimeout' => 2000,
	    'smartSpeed' => 1500,
	    'autoplayHoverPause' => 'false',
	    'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
	    'responsive' => array(
	        0 => array(
	        "items" => 3,
	        ),
	        480 => array(
	            "items" => 3,
	        ),
	        992 => array(
	            "items" => 4,
	        ),
            1200 => array(
	            "items" => 4,
	        ),
	    )
	);
    
	$cms_carousel['related-product-carousel'] = array(
	    'loop' => 'true',
	    'mouseDrag' => 'true',
	    'nav' => 'false',
	    'dots' => 'false',
	    'margin' => 30,
	    'autoplay' => 'false',
	    'autoplayTimeout' => 2000,
	    'smartSpeed' => 1500,
	    'autoplayHoverPause' => 'false',
	    'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
	    'responsive' => array(
	        0 => array(
	        "items" => 2,
	        ),
	        768 => array(
	            "items" => 2,
	            ),
	        992 => array(
	            "items" => 3,
	            ),
	        1200 => array(
	            "items" => 3,
	            )
	        )
	);
    
	//$cms_carousel['upsells-product-carousel'] = $cms_carousel['related-product-carousel'];
	wp_localize_script('owl-carousel-cms', "cmscarousel", $cms_carousel);
	wp_enqueue_script('owl-carousel-cms');
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div  id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 product-images">
    	<?php
    		/**
    		 * woocommerce_before_single_product_summary hook.
    		 *
    		 * @hooked woocommerce_show_product_sale_flash - 10
    		 * @hooked woocommerce_show_product_images - 20
    		 */
    		do_action( 'woocommerce_before_single_product_summary' );
    	?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
        	<div class="shop-desc">
        
        		<?php
        			/**
        			 * woocommerce_single_product_summary hook.
        			 *
        			 * @hooked woocommerce_template_single_title - 5
        			 * @hooked woocommerce_template_single_rating - 10
        			 * @hooked woocommerce_template_single_price - 10
        			 * @hooked woocommerce_template_single_excerpt - 20
        			 * @hooked woocommerce_template_single_add_to_cart - 30
        			 * @hooked woocommerce_template_single_meta - 40
        			 * @hooked woocommerce_template_single_sharing - 50
        			 */
        			do_action( 'woocommerce_single_product_summary' );
        		?>
        
        	</div><!-- .summary -->
        </div>
    </div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
    <div class="product-related shop-products-list clearfix">
	    <h3 class="product-related-title"><?php echo esc_html__('Related Products','medix');?></h3>
        <?php do_action('cms_single_product_related'); ?>
           
	</div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
