<div class="form-group">
	<input type="checkbox" name="<?php echo isset( $name ) ? $name : ''; ?>"
	       class="<?php echo isset( $class ) ? $class : ''; ?>"
	       id="<?php echo isset( $id ) ? $id : ''; ?>" <?php echo isset( $checked ) ? $checked : ''; ?> />
	<label for="<?php echo isset( $id ) ? $id : ''; ?>"
	       class="custom_label"><?php echo isset( $label ) ? $label : ''; ?></label>
</div>