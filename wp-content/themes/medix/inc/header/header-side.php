<?php
/**
 * @name : Default Header
 * @package : CMSSuperHeroes
 * @author : Fox
 */
 
?>
<?php
$theme_options = medix_get_theme_option();
$meta_options = medix_get_meta_option();
$uniqid_id = uniqid('register-modal-');
$uniqid_id_login = uniqid('login-modal-');

$full_width_class = 'container';
if( !empty($theme_options['header_full_width']) && $theme_options['header_full_width'] == '1')
    $full_width_class = 'container-fullwidth';
    
$header_top_dark = (isset($_GET['header_top_bg']) && trim($_GET['header_top_bg']) == 'dark' ) ? 'dark': '';

$slider_push = ( !empty($theme_options['slider_push']) && $theme_options['slider_push'] == '1') ? 'header-slide':'';
$header_side_right = ( !empty($theme_options['header_side_on_right']) && $theme_options['header_side_on_right'] == '1') ? 'header_side_right':'';
$header_side_is_dark = ( !empty($theme_options['header_side_is_dark']) && $theme_options['header_side_is_dark'] == '1') ? 'ds':'ls';

if(isset($_GET['type'])){
    if($_GET['type'] == 'slide-left-light'){
        $slider_push = 'header-slide'; $header_side_right = ''; $header_side_is_dark = 'ls';
    }
    if($_GET['type'] == 'slide-right-light'){
        $slider_push = 'header-slide'; $header_side_right = 'header_side_right'; $header_side_is_dark = 'ls';
    }    
    if($_GET['type'] == 'push-left-light'){
        $slider_push = ''; $header_side_right = ''; $header_side_is_dark = 'ls';
    }    
    if($_GET['type'] == 'push-right-light'){
        $slider_push = ''; $header_side_right = 'header_side_right'; $header_side_is_dark = 'ls';
    }    
    if($_GET['type'] == 'slide-left-dark'){
        $slider_push = 'header-slide'; $header_side_right = ''; $header_side_is_dark = 'ds';
    }    
    if($_GET['type'] == 'slide-right-dark'){
        $slider_push = 'header-slide'; $header_side_right = 'header_side_right'; $header_side_is_dark = 'ds';
    }    
    if($_GET['type'] == 'push-left-dark'){
        $slider_push = ''; $header_side_right = ''; $header_side_is_dark = 'ds';
    }    
    if($_GET['type'] == 'push-right-dark'){
        $slider_push = ''; $header_side_right = 'header_side_right'; $header_side_is_dark = 'ds';
    }    
}
 
?>
<?php if ( isset($theme_options['disable_header_top']) && !$theme_options['disable_header_top'] ) : ?>
<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' )  ) : ?>
<div class="header-top <?php echo esc_attr($header_top_dark);?>">
    <div class="container-fullwidth">
        <div class="header-top-wrap clearfix">
            <div class="header-top-left">
                <?php dynamic_sidebar('sidebar-2'); ?>
                <?php if(class_exists('UserPress')): ?>
                 <ul class="accounts-link">
                    <?php if(is_user_logged_in()): ?>
                        <li><?php echo str_replace('href','class="button-loged" href', wp_loginout(home_url('/'),false)); ?></li>
                    <?php else: ?>
                        <li>
                        <a class="button-signin-form" data-toggle="modal" data-target="#<?php echo esc_attr($uniqid_id_login); ?>"><?php esc_html_e('Login','medix'); ?></a> 
                        <a class="button-signup-form" data-toggle="modal" data-target="#<?php echo esc_attr($uniqid_id); ?>"><?php esc_html_e('Register','medix'); ?></a></li>
                    <?php endif; ?>
                 </ul>
                 <?php endif; ?>
            </div>
            
            <div class="header-top-right">
                <?php if ( is_active_sidebar( 'sidebar-3' )  ) : ?>
                    <?php dynamic_sidebar('sidebar-3'); ?>
                <?php endif;?>
            </div>
            
        </div>
    </div>
</div>
<?php if(class_exists('UserPress')): ?>
    <div class="modal fade form-login" id="<?php echo esc_attr($uniqid_id_login); ?>" tabindex="-1" >
        <div class="modal-dialogs container">
            <div class="modal-content clearfix modal-content-login" >
                <div class="row">
                    <div class="acc-wrap">
                        <div class="modal-content-right col-xs-12">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                                <?php  echo do_shortcode('[user-press layout="" form_type="login" is_logged="profile"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade form-register" id="<?php echo esc_attr($uniqid_id); ?>" tabindex="-1" >
        <div class="modal-dialogs container">
            <div class="modal-content clearfix modal-content-register">
                <div class="row">
                    <div class="acc-wrap">
                        <div class="modal-content-right col-xs-12">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                                <?php up_get_template_part('default/form', 'register'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php endif;?> 
<?php endif;?> 

<div class="page_header_side <?php echo esc_attr($header_side_right);?> <?php echo esc_attr($header_side_is_dark);?>"> 
    <span class="toggle_menu_side <?php echo esc_attr($slider_push);?>"><i class="fa fa-bars"></i></span>
    <div class="scroll-wrapper">
        <div class="scrollbar-macosx scroll-content">
            <div class="side_header_inner">
                <div id="cshero-header-logo-side" class="side-branding text-center">
                    <?php medix_header_logo(); ?>
                </div>
                <div id="cshero-header-side" class="side_nav_menu">
                    <nav id="side-navigation" class="mainmenu_side_wrapper">
                        <?php medix_header_navigation(); ?>
                    </nav> 
                </div>
                <div class="text-center socials">
                    <?php medix_social_from_themeoption('header','color-bg-icon','rounded-icon');?>
            	</div>
            </div>
        </div>  
    </div>
</div>