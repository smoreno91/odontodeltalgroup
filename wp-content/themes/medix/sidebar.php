<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 sidebar">
		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>

		</div><!-- .widget-area -->
	</div><!-- #sidebar -->
<?php endif; ?>