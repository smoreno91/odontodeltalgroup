<div class="switch">
	<label>
		<?php echo isset( $labelLeft ) ? $labelLeft : 'OFF'; ?>
		<input name="<?php echo isset( $name ) ? $name : ''; ?>"
		       type="checkbox" <?php isset( $checked ) ? $checked : ''; ?>>
		<span class="lever <?php echo isset( $class ) ? $class : ''; ?>"></span>
		<?php echo isset( $labelRight ) ? $labelRight : 'ON'; ?>
	</label>
</div>