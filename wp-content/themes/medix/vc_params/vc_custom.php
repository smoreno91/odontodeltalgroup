<?php
/* VC single image */
    add_action( 'vc_after_init', 'medix_add_vc_single_image_new_style' );
    function medix_add_vc_single_image_new_style() {
      $param = WPBMap::getParam( 'vc_single_image', 'style' );
      $param['value'][esc_html__( 'Top overlap', 'medix' )] = 'top-overlap';
      vc_update_shortcode_param( 'vc_single_image', $param );
    }
/* VC Tabs */
    add_action( 'vc_after_init', 'medix_add_vc_tta_tabs_new_style' );
    function medix_add_vc_tta_tabs_new_style() {
      $param = WPBMap::getParam( 'vc_tta_tabs', 'style' );
      $param['value'][esc_html__( 'Regular', 'medix' )] = 'theme-regular';
      $param['value'][esc_html__( 'Featured image', 'medix' )] = 'theme-image';
      $param['value'][esc_html__( 'Bordered', 'medix' )] = 'theme-border';
      $param['std'] = 'theme-regular';
      vc_update_shortcode_param( 'vc_tta_tabs', $param );
    }
     
    add_action( 'vc_after_init', 'medix_add_vc_tta_tabs_new_shape' ); 
    function medix_add_vc_tta_tabs_new_shape() {
      $param = WPBMap::getParam( 'vc_tta_tabs', 'shape' );
      $param['value'][esc_html__( 'Theme Style', 'medix' )] = 'theme';
      $param['std'] = 'theme';
      vc_update_shortcode_param( 'vc_tta_tabs', $param );
    }
     
    add_action( 'vc_after_init', 'medix_add_vc_tta_tabs_new_color' ); 
    function medix_add_vc_tta_tabs_new_color() {
      $param = WPBMap::getParam( 'vc_tta_tabs', 'color' );
      $param['value'][esc_html__( 'Theme Color', 'medix' )] = 'theme';
      $param['std'] = 'theme';
      vc_update_shortcode_param( 'vc_tta_tabs', $param );
    }
  
/* VC Tour */
    add_action( 'vc_after_init', 'medix_add_vc_tta_tour_new_style' );
    function medix_add_vc_tta_tour_new_style() {
      $param = WPBMap::getParam( 'vc_tta_tour', 'style' );
      $param['value'][esc_html__( 'Theme vertical', 'medix' )] = 'theme-vertical';
      $param['value'][esc_html__( 'Theme vertical home', 'medix' )] = 'theme-vertical-home';
      $param['std'] = 'theme-vertical';
      vc_update_shortcode_param( 'vc_tta_tour', $param );
    }
    
    add_action( 'vc_after_init', 'medix_add_vc_tta_tour_new_shape' ); 
    function medix_add_vc_tta_tour_new_shape() {
      $param = WPBMap::getParam( 'vc_tta_tour', 'shape' );
      $param['value'][esc_html__( 'Theme Style', 'medix' )] = 'theme';
      $param['std'] = 'theme';
      vc_update_shortcode_param( 'vc_tta_tour', $param );
    }
     
    add_action( 'vc_after_init', 'medix_add_vc_tta_tour_new_color' ); 
    function medix_add_vc_tta_tour_new_color() {
      $param = WPBMap::getParam( 'vc_tta_tour', 'color' );
      $param['value'][esc_html__( 'Theme Color', 'medix' )] = 'theme';
      $param['std'] = 'theme';
      vc_update_shortcode_param( 'vc_tta_tour', $param );
    }
 
 