<?php

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/* Cross Sell Product */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

/* Loop product */

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'medix_template_loop_product_thumbnail', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'medix_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5);
 
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'medix_output_content_wrapper', 10);
add_action('woocommerce_after_main_content', 'medix_output_content_wrapper_end', 10);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
add_action('woocommerce_before_single_product_summary', 'medix_show_product_images', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'cms_single_product_related', 'woocommerce_output_related_products', 20 );
//add_action('woocommerce_after_single_product_summary', 'medix_output_recent_products', 20);

/**
 * Get the product thumbnail for the loop.
 */
function medix_template_loop_product_thumbnail() {
    if ( has_post_thumbnail() ) {
        $thumbnail = get_the_post_thumbnail(get_the_ID(),'full');
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        $image_url = esc_url($image[0]);
    }
	echo '<div class="shop-media entry" onclick="">';
    echo woocommerce_get_product_thumbnail();
    echo '<div class="icons-list">';
        echo '<a class="icon-link" href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'"><i class="fa fa-link"></i></a>';
        echo '<a class="magic-popup" href="'.$image_url.'"><i class="fa fa-search"></i></a>';
    echo '</div> ';
    echo '<div class="bg-overlay"></div>';
	echo '</div>';
}

/**
 * Get the product title for the loop.
 */
function medix_template_loop_product_title() {
	echo '<h3 class="product-title">';
	echo '<a href="' . get_the_permalink() . '" class="p-title">'.get_the_title().'</a>';
	echo '</h3>';
    
}

function medix_output_content_wrapper(){
    echo '<div class="shop-wrapper">';   
}

function medix_output_content_wrapper_end(){
    echo '</div>';
}

function medix_show_product_images(){
     global $post, $product;
 
		if ( has_post_thumbnail() ) {
             
			$attachment_count = count( $product->get_gallery_image_ids() );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('title'	 => $props['title'],'alt'    => $props['alt'],) );
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<div class="shop-media entry">%s<div class="icons-list"><a href="%s" itemprop="image" class="magic-popup" title="%s"><i class="fa fa-search"></i></a></div><div class="bg-overlay"></div></div>',
                    $image,
                    esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$gallery
				),
				$post->ID
			);
            
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'medix' ) ), $post->ID );
		}

		do_action( 'woocommerce_product_thumbnails' );
     
}
 

/* Remove field label */
add_filter( 'woocommerce_form_field_args' , 'medix_override_woocommerce_form_field' );
function medix_override_woocommerce_form_field( $args ) {
    $args['label'] = false;    
    return $args;
}

/* Overide checkout field */
function medix_override_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = esc_html__('First Name *','medix');
    $fields['billing']['billing_last_name']['placeholder'] = esc_html__('Last Name *','medix');
    $fields['billing']['billing_company']['placeholder'] = esc_html__('Company Name','medix');
    $fields['billing']['billing_email']['placeholder'] = esc_html__('Email Address *','medix');
    $fields['billing']['billing_phone']['placeholder'] = esc_html__('Phone *','medix');
    $fields['billing']['billing_city']['placeholder'] = esc_html__('Town / City *','medix');
    $fields['billing']['billing_postcode']['placeholder'] = esc_html__('Postcode *','medix');
    $fields['billing']['billing_state']['placeholder'] = esc_html__('State *','medix');
    $fields['billing']['billing_country']['placeholder'] = esc_html__('Country *','medix');

    $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__('First Name *','medix');
    $fields['shipping']['shipping_last_name']['placeholder'] = esc_html__('Last Name *','medix');
    $fields['shipping']['shipping_company']['placeholder'] = esc_html__('Company Name','medix');
    $fields['shipping']['shipping_city']['placeholder'] = esc_html__('Town / City *','medix');
    $fields['shipping']['shipping_postcode']['placeholder'] = esc_html__('Postcode *','medix');
    $fields['shipping']['shipping_state']['placeholder'] = esc_html__('State *','medix');
    $fields['shipping']['shipping_country']['placeholder'] = esc_html__('Country *','medix');
    
    $fields['account']['account_username']['placeholder'] = esc_html__('Username or email *','medix');
    $fields['account']['account_password']['placeholder'] = esc_html__('Password *','medix');
    $fields['account']['account_password-2']['placeholder'] = esc_html__('Retype Password *','medix');

    $fields['order']['order_comments']['placeholder'] = esc_html__('Order Notes','medix');

    /* Add Email/ Phone on Shipping fields*/
    $fields['shipping']['shipping_email'] = array(
		'label'     	=> esc_html__('Email Address', 'medix'),
		'placeholder'   => _x('Email Address', 'placeholder', 'medix'),
		'required'  	=> false,
		'class'     	=> array('form-row-first'),
		'clear'     	=> false
	);
    $fields['shipping']['shipping_phone'] = array(
		'label'     	=> esc_html__('Phone', 'medix'),
		'placeholder'   => _x('Phone', 'placeholder', 'medix'),
		'required'  	=> false,
		'class'     	=> array('form-row-last'),
		'clear'     	=> true,
		'order'			=> '6'
	);

    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'medix_override_checkout_fields' );

/* Reordering Checkout form field */
add_filter("woocommerce_checkout_fields", "medix_order_fields");
function medix_order_fields($fields) {

    $order = array(
    	"billing_country",
        "billing_first_name", 
        "billing_last_name", 
        "billing_company", 
        "billing_address_1", 
        "billing_address_2",
        "billing_city",
        "billing_state",
        "billing_postcode", 
        "billing_email", 
        "billing_phone",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }
    $fields["billing"] = $ordered_fields;   
    return $fields;
}
add_filter("woocommerce_checkout_fields", "medix_shipping_order_fields");
function medix_shipping_order_fields($fields) {
    $order = array(
    	"shipping_country",
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_company", 
        "shipping_address_1", 
        "shipping_address_2",
        "shipping_city",
        "shipping_state",
        "shipping_postcode", 
        "shipping_email", 
        "shipping_phone",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["shipping"][$field];
    }
    $fields["shipping"] = $ordered_fields;   
    return $fields;
}	

