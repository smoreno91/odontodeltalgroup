<?php
/**
 * The template for displaying login form.
 *
 * Override this template by copying it to yourtheme/userpress/layoutname/form-login.php
 *
 * @author 		UserPress
 * @package 	UserPress/Templates
 * @version     1.0.0
 */

if (! defined ( 'ABSPATH' )) {
	exit (); // Exit if accessed directly
}
?>
<div class="user-press-login">
	<div class="login-form">
		<div class="fields-content">
			<div class="field-group">
				<label class="label"><?php esc_html_e('Username', 'medix');?></label> 
				<input id="user" type="text" class="input user_name" placeholder="<?php esc_html_e('User Name','medix');?>" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>"/>
			</div>
			<div class="field-group">
				<label class="label"><?php esc_html_e('Password', 'medix');?></label> 
				<input id="pass" type="password" class="input password" placeholder="<?php esc_html_e('Password','medix');?>" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>"/>
			</div>
			<div class="field-group group-remember-forgot">
                <div class="remember-me pull-left">
    				<input id="check" type="checkbox" class="check" checked="checked" />
                    <label class="checkme" for="check"><?php esc_html_e('Remember Me', 'medix');?></label>
                </div>
                <div class="forgot-password pull-right">
                    <p><a class="switch_to_sign_up"> <?php esc_html_e('Create New Account','medix');?></a><span> / </span><a class="forget-password" href="<?php echo wp_lostpassword_url(get_permalink()); ?>"><?php esc_html_e('Forget Password?', 'medix') ?></a></p>
                </div>
                <div class="clear"></div>
			</div>
			<div class="field-group">
				<button type="button" class="btn btn-secondary button-login"><?php esc_html_e('Sign In', 'medix');?></button>
			</div>
		</div>
		 
	</div>
</div>
