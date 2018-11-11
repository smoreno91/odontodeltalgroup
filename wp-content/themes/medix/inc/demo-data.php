<?php
/**
 * demo data.
 *
 * config.
 */
function medix_set_woo_page(){
    
    $woo_pages = array(
        'woocommerce_shop_page_id' => 'Shop',
        'woocommerce_cart_page_id' => 'Cart',
        'woocommerce_checkout_page_id' => 'Checkout'
    );
    
    foreach ($woo_pages as $key => $woo_page){
    
        $page = get_page_by_title($woo_page);
    
        if(!isset($page->ID))
            return ;
             
        update_option($key, $page->ID);
    
    }
}

add_action('ef3-import-finish', 'medix_set_woo_page');

add_action('ef3-import-finish', 'medix_set_woo_page');

function medix_set_home_page(){

    $home_page = 'Center';

    $page = get_page_by_title($home_page);

    if(!isset($page->ID))
        return ;

    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->ID);
}

add_action('ef3-import-finish', 'medix_set_home_page');

add_filter('ef3-theme-options-opt-name', 'medix_set_demo_opt_name');

function medix_set_demo_opt_name(){
    return 'opt_theme_options';
}

add_filter('ef3-replace-content', 'medix_replace_content', 10 , 2);

function medix_replace_content($replaces, $attachment){
    return array(
        //'/image="(.+?)"/' => 'image="'.$attachment.'"',
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
        //'/src="(.+?)"/' => 'src="'.ef3_import_export()->acess_url.'ef3-placeholder-image.jpg"'
    );
}

add_filter('ef3-replace-theme-options', 'medix_replace_theme_options');

function medix_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
add_filter('ef3-enable-create-demo', 'medix_enable_create_demo');

function medix_enable_create_demo(){
    return false;
}