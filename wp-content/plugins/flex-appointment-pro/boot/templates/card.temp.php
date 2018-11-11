<div class="<?php echo ! isset( $class ) ? $class : 'col-lg-12 col-md-12 col-sm-12 col-xs-12'; ?>" jstcache="0">
	<div class="custom_card">
		<div class="header">
			<h2>
				<?php echo isset( $title ) ? $title : ''; ?>
				<small><?php echo isset( $description ) ? $description : ''; ?></small>
			</h2>
		</div>
		<div class="body">
			<?php echo isset( $content ) ? $content : ''; ?>
			<?php if ($button == true): ?>
				<button id="" type="submit" class="btn btn-primary waves-effect">Save Settings</button>
			<?php endif; ?>
		</div>
	</div>
</div>


