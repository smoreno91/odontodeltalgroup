<?php
/**
 * Created by PhpStorm.
 * User: FOX
 * Date: 2/23/2016
 * Time: 3:48 PM
 */

/**
 * get terms
 *
 * @param string $taxonomy
 * @param bool $slug
 * @param array $options
 * @return array
 */
function medix_get_terms($taxonomy = 'category', $slug = true, $options = array()){

    $_terms = get_terms($taxonomy, $options);

    $terms = array();

    if(empty( $_terms ) || is_wp_error( $_terms ))
        return $terms;

    foreach ($_terms as $_term){
        if($slug){
            $terms[$_term->slug] = $_term->name;
        } else {
            $terms[$_term->term_id] = $_term->name;
        }
    }
    
    return $terms;
}

/**
 * get list menu.
 * @return array
 */
function medix_get_nav_menu(){

    $menus = array(
        '' => esc_html__('Default', 'medix')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }

    return $menus;
}

/* Include the TGM_Plugin_Activation class.*/
require_once ( get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php' );

/* load list plugins */
require_once( get_template_directory() . '/inc/options/require.plugins.php' );

/* load demo data setting */
require_once( get_template_directory() . '/inc/demo-data.php' );

/* lip font-awesome */
require_once get_template_directory() . '/inc/libs/font-awesome.php';

/* lip font-glyphicons */
require_once get_template_directory() . '/inc/libs/font-glyphicons.php';

/* lip font-rticon2 */
require_once get_template_directory() . '/inc/libs/font-rticon2.php';

/* load mega menu. */
require_once( get_template_directory() . '/inc/mega-menu/functions.php' );

/* load theme options. */
require_once( get_template_directory() . '/inc/options/function.options.php' );

/* load mata options */
require_once(get_template_directory() . '/inc/options/meta-options.php');

/* load template functions */
require_once( get_template_directory() . '/inc/template.functions.php' );

/* load static css. */
require_once( get_template_directory() . '/inc/dynamic/static.css.php' );

/* load dynamic css*/
require_once( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

/* Woo commerce function */
if(class_exists('Woocommerce')){
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}