<ul class="nav nav-tabs" role="tablist">
	<?php if ( is_array( $settings ) ): ?>
		<?php foreach ( $settings as $key) {?>
			<li role="presentation" class="<?php echo $key['class']; ?>">
				<a href="<?php echo $key['href']; ?>" data-toggle="tab">
					<i class="material-icons"><?php echo $key['icon'] ? $key['icon'] : ''; ?></i>
					<?php
					echo $key['title'];
					?>
				</a>
			</li>
		<?php } ?>
	<?php endif; ?>
</ul>

<div class="tab-content">
	<?php if ( is_array( $settings ) ): ?>
		<?php
		foreach ( $settings as $key ) {?>
			<div role="tabpanel" class="tab-pane <?php echo $key['class']; ?> " id="<?php echo $key['id']; ?>">
				<?php echo $key['content']; ?>
			</div>
		<?php } ?>
	<?php endif; ?>
</div>