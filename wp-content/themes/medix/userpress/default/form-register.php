<?php
/**
 * The template for displaying register form.
 *
 * Override this template by copying it to yourtheme/userpress/layoutname/form-register.php
 *
 * @author 		UserPress
 * @package 	UserPress/Templates
 * @version     1.0.0
 */
if (! defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}
$theme_options = medix_get_theme_option(); 
?>

<div class="user-press-register">
	<div class="register-form">
		<div class="fields-content">
			<div class="field-group">
				<label class="label"><?php esc_html_e('Username', 'medix');?></label> 
				<input id="res_user" type="text" class="input" placeholder="<?php esc_html_e('User name', 'medix'); ?>" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>" data-user-length="<?php esc_html_e('Username too short. At least 4 characters is required.', 'medix'); ?>" data-special-char="<?php esc_html_e("The value of text field can't contain any of the following characters: \ / : * ? \" < > space", 'medix'); ?>"/>
			</div>
            <div class="field-group">
				<label class="label"><?php esc_html_e('Email', 'medix');?></label> 
				<input id="res_email" type="text" class="input" placeholder="<?php esc_html_e('Email', 'medix'); ?>" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>"  data-email-format="<?php esc_html_e('The Email address is incorrect!', 'medix'); ?>"/>
			</div>
			<div class="field-group">
				<label class="label"><?php esc_html_e('Password', 'medix');?></label> 
				<input id="res_pass1" type="password" class="input" data-type="password" placeholder="<?php esc_html_e('Password', 'medix'); ?>" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>" data-pass-length="<?php esc_html_e( 'Password length must be greater than 5.', 'medix' ); ?>"/>
			</div>
			<div class="field-group">
				<label class="label"><?php esc_html_e('Confirm Password', 'medix');?></label> 
				<input id="res_pass2" type="password" class="input" data-type="password" placeholder="<?php esc_html_e('Confirm Password', 'medix'); ?>" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>" data-pass-confirm="<?php esc_html_e('Your password and confirmation password do not match.', 'medix'); ?>"/>
			</div>
            <?php if(isset($theme_options['terms_of_use_link']) && $theme_options['terms_of_use_link']!=''):?>
			<div class="field-group terms-of-use">
				<input id="terms-of-use" type="checkbox" class="terms-of-use" data-validate="<?php esc_html_e('Required Field', 'medix'); ?>"/>
                <label class="checkme" for="terms-of-use"><?php esc_html_e('I Agree to the', 'medix');?></label><a class="terms-of-use-link" href="<?php echo $theme_options['terms_of_use_link'];?>"><?php esc_html_e('Terms of use ?', 'medix');?></a>
            </div>
            <?php endif; ?>
			<div class="field-group">
				<button type="button" class="btn btn-secondary button-register btn-up-register"><?php esc_html_e('Sign Up', 'medix');?></button>
			</div>
           
		</div>
	</div>
     
</div>