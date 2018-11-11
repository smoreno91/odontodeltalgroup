<?php if ( isset( $label ) && ! empty( $label ) ): ?>
	<label class="custom_label"><?php echo $label; ?></label>
<?php endif; ?>
<div class="form-group">
	<div class="form-line">
		<input id="<?php echo isset( $id ) ? $id : ''; ?>" type="text"
		       class="form-control <?php echo isset( $class ) ? $class : ''; ?>"
		       name="<?php echo isset( $name ) ? $name : ''; ?>"
		       placeholder="<?php echo isset( $placeholder ) ? $placeholder : ''; ?>"
		       value="<?php echo isset( $value ) ? $value : ''; ?>" <?php echo isset( $required ) ? 'required' : ''; ?>>
	</div>
</div>