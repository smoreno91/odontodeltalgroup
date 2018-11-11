<select
	<?php echo ( isset( $multiple ) && $multiple == true ) ? 'multiple' : "" ?>
        class="form-control show-tick <?php echo $class; ?>"
        name="<?php echo $name; ?>"
        id="<?php echo $id; ?>"
        data-live-search="true">
	<?php if ( ! empty( $default_option ) ): ?>
		<?php
		$first_key = $default_option;
		reset( $first_key );
		$first_key = key( $first_key );
		?>
        <option value="<?php echo $first_key; ?>"><?php echo $default_option[ $first_key ]; ?></option>
	<?php endif ?>
	
	<?php foreach ( $options as $key => $option_value ): ?>
		<?php if ( ! is_array( $value ) ): ?>
			<?php $checked = ( $value == $key ) ? 'selected' : ''; ?>
		<?php else: ?>
			<?php $checked = ( in_array( $key, $value ) ) ? 'selected' : ''; ?>
		<?php endif ?>
        <option <?php if ( isset( $show_content ) && $show_content == true ){ ?> data-content="<?php esc_attr_e( $option_value ); ?>" title="<?php esc_attr_e( $option_value ) ?>" <?php } ?> value="<?php esc_attr_e( $key ); ?>" <?php echo $checked; ?>><?php esc_attr_e( $option_value ) ?></option>
	<?php endforeach ?>
</select>