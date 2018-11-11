<div class="form-group">
	<?php if ( isset( $label ) && ! empty( $label ) ): ?>
		<label class="custom_label"><?php echo $label; ?></label>
	<?php endif; ?>
	<select id="<?php echo isset( $id ) ? $id : ''; ?>"
	        class="form-control show-tick <?php echo isset( $class ) ? $class : ''; ?> "
	        name="<?php echo isset( $name ) ? $name : ''; ?>">
		<?php if ( is_array( $options ) ): ?>
			<?php foreach ( $options as $key => $value ) { ?>
				<?php if ( ! is_array( $value ) ): ?>
					<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
				<?php else: ?>
					<option
						value="<?php echo $key; ?>" <?php echo "selected"; ?>><?php echo $value['value']; ?></option>
				<?php endif; ?>
			<?php } ?>
		<?php endif; ?>
	</select>
</div>