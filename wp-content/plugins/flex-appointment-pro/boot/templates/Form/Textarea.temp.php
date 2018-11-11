<div class="form-line">
	<textarea rows="4" class="form-control no-resize" name="<?php echo isset($name) ? $name : '' ?>"
	          placeholder="<?php echo isset($placeholder) ? $placeholder : 'Please type what you want...'; ?>">
		<?php echo isset($content) ? $content : ''; ?>
	</textarea>
</div>