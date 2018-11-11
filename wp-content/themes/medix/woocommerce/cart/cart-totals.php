<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="cart_totals-wrap row <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
			<div class="medix-cart-shiping col-sm-6">
				<div class="cart-totals-shipping">
					<h5 class="shiping-title"><?php esc_html_e( 'Calculate Shipping', 'medix' ); ?></h5>
					<?php woocommerce_shipping_calculator(); ?>
				</div>
			</div>
			<div class="medix-cart-total col-sm-6">
				<div class="cart-totals-inner">
                    <h5 class="cart-totals-title"><?php esc_html_e( 'Cart Totals', 'medix' ); ?></h5>
                    <table>
                        <tr>
                            <td><?php esc_html_e( 'Cart Subtotal: ', 'medix' ); ?></td>
                            <td><?php wc_cart_totals_subtotal_html(); ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e( 'Shiping and Handling: ', 'medix' ); ?></td>
                            <td><?php echo WC()->cart->get_cart_shipping_total(); ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e( 'Order Total: ', 'medix' ); ?></td>
                            <td><?php wc_cart_totals_order_total_html(); ?></td>
                        </tr>
                    </table>
					 
				</div>
			 
			</div>


			<?php if ( WC()->cart->get_cart_tax() ) : ?>
				<p><small><?php

					$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
						? ' ' . esc_html__( ' (taxes estimated for )', 'medix' ) . WC()->countries->estimated_for_prefix() .  WC()->countries->countries[ WC()->countries->get_base_country() ]
						: '';

					printf( esc_html__( 'Note: Shipping and taxes are estimated and will be updated during checkout based on your billing and shipping information.', 'medix' ), $estimated_text );

				?></small></p>
			<?php endif; ?>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>
